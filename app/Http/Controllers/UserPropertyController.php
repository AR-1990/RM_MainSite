<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyCategory;
use App\Models\PropertyImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPropertyController extends Controller
{
    public function index()
    {
        $baseQuery = Property::query()->where('user_id', Auth::id());

        $properties = (clone $baseQuery)
            ->with(['category', 'primaryImage'])
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'live' => (clone $baseQuery)->where('is_active', true)->where('is_deactivated', false)->count(),
            'pending' => (clone $baseQuery)->where('is_active', false)->where('is_deactivated', false)->count(),
            'hidden' => (clone $baseQuery)->where('is_deactivated', true)->count(),
        ];

        return view('user.properties.index', compact('properties', 'stats'));
    }

    public function create()
    {
        return view('user.properties.create', $this->getFormViewData());
    }

    public function store(Request $request): RedirectResponse
    {
        $this->normalizePropertyRequest($request);

        $data = $request->validate($this->rules(true));
        $property = new Property($this->extractPropertyData($data));
        $property->user_id = Auth::id();
        $property->is_active = false;
        $property->is_sold = false;
        $property->is_deactivated = false;
        $property->primary_image = $this->storeUploadedFile($request->file('primary_image'), 'uploads/properties/primary');
        $property->save();

        $this->syncAdditionalImages($request, $property);
        $this->syncAmenities($property, $request->input('amenities_text'));

        return redirect()->route('myProperty')
            ->with('success', 'Property submitted successfully. Pending from admin side, we will contact you in 3 days.');
    }

    public function edit(Property $property)
    {
        $this->authorizeProperty($property);
        $property->load(['category', 'images', 'amenities']);

        return view('user.properties.edit', $this->getFormViewData($property));
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $this->authorizeProperty($property);
        $this->normalizePropertyRequest($request);

        $data = $request->validate($this->rules(false));
        $property->fill($this->extractPropertyData($data));
        $property->is_active = false;
        $property->is_deactivated = false;

        if ($request->hasFile('primary_image')) {
            $this->deleteFileIfExists($property->primary_image);
            $property->primary_image = $this->storeUploadedFile($request->file('primary_image'), 'uploads/properties/primary');
        }

        $property->save();

        $this->syncAdditionalImages($request, $property);
        $this->syncAmenities($property, $request->input('amenities_text'));

        return redirect()->route('myProperty')
            ->with('success', 'Property updated successfully. It is pending admin approval again.');
    }

    protected function getFormViewData(?Property $property = null): array
    {
        return [
            'property' => $property,
            'categories' => PropertyCategory::where('is_active', true)->orderBy('name')->get(),
            'statusOptions' => [
                'for_sale' => 'For Sale',
                'for_rent' => 'For Rent',
            ],
            'sizePrefixes' => ['Marla', 'Square Feet', 'Square Yards'],
            'marlaValues' => ['250', '225', '272'],
            'furnishedOptions' => ['Furnished', 'Non-Furnished', 'N/A'],
            'amenitiesText' => $property
                ? $property->amenities->pluck('amenity_name')->filter()->implode(', ')
                : '',
        ];
    }

    protected function rules(bool $primaryImageRequired): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'full_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'property_category_id' => ['required', 'exists:property_categories,id'],
            'property_status' => ['required', 'in:for_rent,for_sale'],
            'size_prefix' => ['required', 'in:Marla,Square Feet,Square Yards'],
            'size' => ['required', 'numeric', 'min:0'],
            'marla_value' => ['required', 'numeric', 'min:0'],
            'furnished_status' => ['required', 'in:Furnished,Non-Furnished,N/A'],
            'rooms' => ['required', 'integer', 'min:0'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'garages' => ['nullable', 'integer', 'min:0'],
            'video_url' => ['nullable', 'url'],
            'primary_image' => [$primaryImageRequired ? 'required' : 'nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'amenities_text' => ['nullable', 'string'],
        ];
    }

    protected function extractPropertyData(array $data): array
    {
        unset($data['primary_image'], $data['amenities_text'], $data['images']);

        $data['garages'] = $data['garages'] ?? 0;

        return $data;
    }

    protected function isPlotCategory($categoryId): bool
    {
        if (!$categoryId) {
            return false;
        }

        return PropertyCategory::whereKey($categoryId)
            ->whereRaw('LOWER(name) = ?', ['plot'])
            ->exists();
    }

    protected function normalizePropertyRequest(Request $request): void
    {
        if ($this->isPlotCategory($request->input('property_category_id'))) {
            $request->merge([
                'furnished_status' => 'N/A',
                'rooms' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'garages' => 0,
            ]);

            return;
        }

        if (!$request->filled('garages')) {
            $request->merge(['garages' => 0]);
        }
    }

    protected function syncAmenities(Property $property, ?string $amenitiesText): void
    {
        $property->amenities()->delete();

        $amenities = collect(explode(',', (string) $amenitiesText))
            ->map(fn ($amenity) => trim($amenity))
            ->filter()
            ->unique()
            ->values();

        foreach ($amenities as $amenity) {
            PropertyAmenity::create([
                'property_id' => $property->id,
                'amenity_name' => $amenity,
                'amenity_type' => 'general',
                'is_available' => true,
            ]);
        }
    }

    protected function syncAdditionalImages(Request $request, Property $property): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $startOrder = $property->images()->count();

        foreach ($request->file('images') as $index => $image) {
            PropertyImage::create([
                'property_id' => $property->id,
                'image_path' => $this->storeUploadedFile($image, 'uploads/properties/images'),
                'is_primary' => false,
                'sort_order' => $startOrder + $index + 1,
            ]);
        }
    }

    protected function storeUploadedFile($file, string $directory): string
    {
        $uploadPath = public_path($directory);

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
        $file->move($uploadPath, $fileName);

        return $directory . '/' . $fileName;
    }

    protected function deleteFileIfExists(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }

    protected function authorizeProperty(Property $property): void
    {
        abort_if($property->user_id !== Auth::id(), 403);
    }
}
