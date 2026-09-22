<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyFloor;
use App\Models\PropertyImage;
use App\Models\PropertyAmenity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
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
        $isPlot = $this->isPlotCategory($request->input('property_category_id'));

        $customPriceEnabled = $request->boolean('use_custom_price_label');

        if ($isPlot) {
            $request->merge([
                'furnished_status' => 'N/A',
                'rooms' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'garages' => 0,
            ]);
        }

        if (!$request->filled('garages')) {
            $request->merge(['garages' => 0]);
        }

        $request->merge([
            'use_custom_price_label' => $customPriceEnabled,
            'custom_price_label' => $customPriceEnabled
                ? trim((string) $request->input('custom_price_label'))
                : null,
        ]);
    }

    public function index(Request $request)
    {
        if ($request->routeIs('admin.properties.index')) {
            return redirect()->route('admin.property.table');
        }

        $query = Property::with(['category', 'primaryImage'])
            ->active()
            ->notSold();
    
        // Apply filters
        if ($request->filled('status')) {
            $query->where('property_status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('property_category_id', $request->category);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('city', 'like', '%' . $searchTerm . '%')
                  ->orWhere('full_address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        if ($request->filled('amenities')) {
            $amenities = is_array($request->amenities) ? $request->amenities : [$request->amenities];
            $query->whereHas('amenities', function($q) use ($amenities) {
                $q->whereIn('amenity_name', $amenities);
            });
        }

        // Apply sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $properties = $query->paginate(12);
        $categories = \App\Models\PropertyCategory::where('is_active', true)->get();
       
        return view('property.index', compact('properties', 'categories'));
    }

    public function show($id)
    {
        try {
            $property = Property::with(['category', 'images', 'floors', 'amenities', 'user.profile'])
                ->findOrFail($id);

            if (request()->routeIs('admin.properties.show')) {
                return view('admin.property.show', compact('property'));
            }

            $canPreviewInactive = Auth::check() && (
                Auth::id() === $property->user_id ||
                in_array(Auth::user()->role, ['admin', 'agent'], true)
            );

            if ((!$property->is_active || $property->is_deactivated) && !$canPreviewInactive) {
                abort(404, 'Property not found');
            }
            
            // Debug information
            Log::info('Property loaded', [
                'id' => $property->id,
                'title' => $property->title,
                'floors_count' => $property->floors->count(),
                'images_count' => $property->images->count(),
                'amenities_count' => $property->amenities->count()
            ]);
            
            return view('property.show', compact('property'));
        } catch (\Exception $e) {
            Log::error('Error loading property', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            abort(404, 'Property not found');
        }
    }

    public function create()
    {
        $categories = PropertyCategory::where('is_active', true)->get();
        return view('admin.property.add-property', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->normalizePropertyRequest($request);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_address' => 'required|string',
            'city' => 'required|string',
            'location' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'use_custom_price_label' => 'nullable|boolean',
            'custom_price_label' => 'nullable|string|max:120|required_if:use_custom_price_label,1',
            'property_category_id' => 'required|exists:property_categories,id',
            'property_status' => 'required|in:for_rent,for_sale',
            'size_prefix' => 'required|in:Marla,Square Feet,Square Yards',
            'size' => 'required|string|max:120',
            'marla_value' => 'required|numeric|min:0',
            'furnished_status' => 'required|in:Furnished,Non-Furnished,N/A',
            'rooms' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'garages' => 'nullable|integer|min:0',
            'video_url' => 'nullable|url',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'floors' => 'nullable|array',
            'floors.*.floor_name' => 'required_with:floors|string',
            'floors.*.floor_price' => 'required_with:floors|numeric|min:0',
            'floors.*.floor_size' => 'required_with:floors|numeric|min:0',
            'floors.*.bedrooms' => 'required_with:floors|integer|min:0',
            'floors.*.bathrooms' => 'required_with:floors|integer|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Handle primary image upload using moveTo
        if ($request->hasFile('primary_image')) {
            $primaryImage = $request->file('primary_image');
            $primaryImageName = time() . '_' . $primaryImage->getClientOriginalName();
            $primaryImagePath = 'uploads/properties/primary/' . $primaryImageName;
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/properties/primary');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $primaryImage->move($uploadPath, $primaryImageName);
            $data['primary_image'] = $primaryImagePath;
        }

        $property = Property::create($data);

        // Handle additional images using moveTo
        if ($request->hasFile('images')) {
            $uploadPath = public_path('uploads/properties/images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                $imagePath = 'uploads/properties/images/' . $imageName;
                
                $image->move($uploadPath, $imageName);
                
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imagePath,
                    'is_primary' => false,
                    'sort_order' => $index + 1
                ]);
            }
        }

        // Handle amenities
        if ($request->amenities) {
            foreach ($request->amenities as $amenity) {
                PropertyAmenity::create([
                    'property_id' => $property->id,
                    'amenity_name' => $amenity,
                    'amenity_type' => 'general',
                    'is_available' => true
                ]);
            }
        }

        // Handle floors
        if ($request->floors) {
            $floorUploadPath = public_path('uploads/properties/floors');
            if (!file_exists($floorUploadPath)) {
                mkdir($floorUploadPath, 0755, true);
            }
            
            foreach ($request->floors as $floorData) {
                $floorImagePath = null;
                
                if (isset($floorData['floor_image']) && $floorData['floor_image']) {
                    $floorImage = $floorData['floor_image'];
                    $floorImageName = time() . '_' . $floorData['floor_image']->getClientOriginalName();
                    $floorImagePath = 'uploads/properties/floors/' . $floorImageName;
                    
                    $floorImage->move($floorUploadPath, $floorImageName);
                }
                
                PropertyFloor::create([
                    'property_id' => $property->id,
                    'floor_name' => $floorData['floor_name'],
                    'floor_price' => $floorData['floor_price'],
                    'price_prefix' => $floorData['price_prefix'] ?? 'PKR',
                    'floor_size' => $floorData['floor_size'],
                    'size_postfix' => $floorData['size_postfix'] ?? 'sq ft',
                    'bedrooms' => $floorData['bedrooms'],
                    'bathrooms' => $floorData['bathrooms'],
                    'floor_image' => $floorImagePath,
                    'description' => $floorData['description'] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.property.table')->with('success', 'Property added successfully!');
    }

    public function edit($id)
    {
        $property = Property::with(['category', 'images', 'floors', 'amenities'])->findOrFail($id);
        $categories = PropertyCategory::where('is_active', true)->get();
        
        return view('admin.property.edit-property', compact('property', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        
        $this->normalizePropertyRequest($request);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'full_address' => 'required|string',
            'city' => 'required|string',
            'location' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'use_custom_price_label' => 'nullable|boolean',
            'custom_price_label' => 'nullable|string|max:120|required_if:use_custom_price_label,1',
            'property_category_id' => 'required|exists:property_categories,id',
            'property_status' => 'required|in:for_rent,for_sale',
            'size_prefix' => 'required|in:Marla,Square Feet,Square Yards',
            'size' => 'required|string|max:120',
            'marla_value' => 'required|numeric|min:0',
            'furnished_status' => 'required|in:Furnished,Non-Furnished,N/A',
            'rooms' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'garages' => 'nullable|integer|min:0',
            'video_url' => 'nullable|url',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
        ]);

        $data = $request->all();

        // Handle primary image upload using moveTo
        if ($request->hasFile('primary_image')) {
            // Delete old primary image
            if ($property->primary_image && file_exists(public_path($property->primary_image))) {
                unlink(public_path($property->primary_image));
            }
            
            $primaryImage = $request->file('primary_image');
            $primaryImageName = time() . '_' . $primaryImage->getClientOriginalName();
            $primaryImagePath = 'uploads/properties/primary/' . $primaryImageName;
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/properties/primary');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $primaryImage->move($uploadPath, $primaryImageName);
            $data['primary_image'] = $primaryImagePath;
        }

        $property->update($data);

        // Handle additional images using moveTo
        if ($request->hasFile('images')) {
            $uploadPath = public_path('uploads/properties/images');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                $imagePath = 'uploads/properties/images/' . $imageName;
                
                $image->move($uploadPath, $imageName);
                
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imagePath,
                    'is_primary' => false,
                    'sort_order' => $property->images()->count() + $index + 1
                ]);
            }
        }

        // Update amenities
        $property->amenities()->delete();
        if ($request->amenities) {
            foreach ($request->amenities as $amenity) {
                PropertyAmenity::create([
                    'property_id' => $property->id,
                    'amenity_name' => $amenity,
                    'amenity_type' => 'general',
                    'is_available' => true
                ]);
            }
        }

        return redirect()->route('admin.property.table')->with('success', 'Property updated successfully!');
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        
        // Delete images
        foreach ($property->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
        }
        
        // Delete primary image
        if ($property->primary_image && file_exists(public_path($property->primary_image))) {
            unlink(public_path($property->primary_image));
        }
        
        // Delete floor images
        foreach ($property->floors as $floor) {
            if ($floor->floor_image && file_exists(public_path($floor->floor_image))) {
                unlink(public_path($floor->floor_image));
            }
        }
        
        $property->delete();
        
        return redirect()->route('admin.property.table')->with('success', 'Property deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['is_active' => !$property->is_active]);
        
        return redirect()->back()->with('success', 'Property status updated successfully!');
    }

    public function toggleSold($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['is_sold' => !$property->is_sold]);
        
        return redirect()->back()->with('success', 'Property sold status updated successfully!');
    }

    public function toggleDeactivated($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['is_deactivated' => !$property->is_deactivated]);
        
        return redirect()->back()->with('success', 'Property deactivation status updated successfully!');
    }
}
