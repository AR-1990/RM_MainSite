<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(15);
        $projectCategories = ProjectCategory::active()->orderBy('name')->get();
        $stats = [
            'total' => Project::count(),
            'active' => Project::where('is_active', true)->count(),
            'featured' => Project::where('is_featured', true)->count(),
            'residential' => Project::where('project_type', 'residential')->count(),
            'commercial' => Project::where('project_type', 'commercial')->count(),
            'mixed' => Project::where('project_type', 'mixed')->count(),
            'upcoming' => Project::where('status', 'upcoming')->count(),
            'under_construction' => Project::where('status', 'under_construction')->count(),
            'ready_to_move' => Project::where('status', 'ready_to_move')->count(),
        ];
        
        return view('admin.projects.index', [
            'projects' => $projects,
            'stats' => $stats,
            'projectCategoryFilterOptions' => $projectCategories
                ->map(fn ($category) => '<option value="' . e($category->name) . '">' . e($category->name) . '</option>')
                ->implode(''),
        ]);
    }

    public function create()
    {
        return view('admin.projects.create', [
            'projectCategoryOptions' => ProjectCategory::renderOptions(
                ProjectCategory::active()->orderBy('name')->get(),
                old('project_type')
            ),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'nullable|in:per_sqft,total,negotiable',
            'area' => 'nullable|numeric|min:0',
            'area_unit' => 'nullable|in:sqft,sqm,acres',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'floors' => 'nullable|integer|min:1',
            'project_type' => 'nullable|exists:project_categories,name',
            'status' => 'nullable|in:upcoming,under_construction,ready_to_move',
            'completion_date' => 'nullable|date',
            'developer' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'nullable|in:on,off,1,0,true,false',
            'is_featured' => 'nullable|in:on,off,1,0,true,false',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brochure' => 'nullable|file|mimes:pdf|max:5120',
            'floor_plans.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:5120',
            'video_url' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Log incoming request data
            Log::info('Project creation request received', [
                'all_data' => $request->all(),
                'description_length' => strlen($request->input('description', '')),
                'has_files' => $request->hasFile('main_image') || $request->hasFile('gallery_images')
            ]);
            
            $data = $request->all();

            // Ensure DB non-null columns have safe defaults (in case migration not applied)
            if (!array_key_exists('description', $data) || $data['description'] === null) { $data['description'] = ''; }
            if (!array_key_exists('location', $data) || $data['location'] === null) { $data['location'] = ''; }
            if (!array_key_exists('price', $data) || $data['price'] === null || $data['price'] === '') { $data['price'] = 0; }
            if (!array_key_exists('area', $data) || $data['area'] === null || $data['area'] === '') { $data['area'] = 0; }
            $data = $this->syncProjectType($data);

            // Auto-generate unique slug from title if slug not provided
            if (empty($data['slug'] ?? null) && !empty($data['title'])) {
                $baseSlug = Str::slug($data['title']);
                $slug = $baseSlug;
                $counter = 1;
                while (Project::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                $data['slug'] = $slug;
            }
            
            // Handle boolean fields
            $data['is_active'] = in_array($request->input('is_active'), ['on', '1', 'true']);
            $data['is_featured'] = in_array($request->input('is_featured'), ['on', '1', 'true']);
            
            // Handle arrays
            $data['amenities'] = $request->input('amenities') ?: [];
            $data['features'] = $request->input('features') ?: [];
            
            // Handle main image
            if ($request->hasFile('main_image')) {
                $mainImage = $request->file('main_image');
                $mainImageName = 'project_' . time() . '_' . uniqid() . '.' . $mainImage->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/main');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Move file to uploads directory
                $mainImage->move($uploadDir, $mainImageName);
                $data['main_image'] = 'uploads/projects/main/' . $mainImageName;
            }
            
            // Handle gallery images
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/gallery');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                foreach ($request->file('gallery_images') as $image) {
                    $imageName = 'gallery_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to uploads directory
                    $image->move($uploadDir, $imageName);
                    $galleryImages[] = 'uploads/projects/gallery/' . $imageName;
                }
                $data['gallery_images'] = $galleryImages;
            }
            
            $project = Project::create($data);
            
            Log::info('Project created successfully', ['project_id' => $project->id, 'title' => $project->title]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Project created successfully!',
                    'redirect' => route('admin.projects.index')
                ]);
            }
            return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
            
        } catch (ValidationException $e) {
            throw $e;
        } catch (QueryException $e) {
            $this->throwProjectValidationException($e);
        } catch (\Exception $e) {
            Log::error('Error creating project', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', [
            'project' => $project,
            'projectCategoryOptions' => ProjectCategory::renderOptions(
                ProjectCategory::orderByRaw('is_active desc')->orderBy('name')->get(),
                old('project_type', $project->project_type)
            ),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'location' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'price_type' => 'nullable|in:per_sqft,total,negotiable',
            'area' => 'nullable|numeric|min:0',
            'area_unit' => 'nullable|in:sqft,sqm,acres',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'floors' => 'nullable|integer|min:1',
            'project_type' => 'nullable|exists:project_categories,name',
            'status' => 'nullable|in:upcoming,under_construction,ready_to_move',
            'completion_date' => 'nullable|date',
            'developer' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'nullable|in:on,off,1,0,true,false',
            'is_featured' => 'nullable|in:on,off,1,0,true,false',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brochure' => 'nullable|file|mimes:pdf|max:5120',
            'floor_plans.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:5120',
            'video_url' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Log incoming request data
            Log::info('Project update request received', [
                'project_id' => $project->id,
                'all_data' => $request->all(),
                'description_length' => strlen($request->input('description', '')),
                'has_files' => $request->hasFile('main_image') || $request->hasFile('gallery_images')
            ]);
            
            $data = $request->all();
            $data = $this->syncProjectType($data, $project);

            // Auto-generate unique slug from title if missing
            if (empty($data['slug'] ?? null)) {
                $baseSlug = Str::slug($data['title']);
                $slug = $baseSlug;
                $counter = 1;
                while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                $data['slug'] = $slug;
            }
            
            // Handle boolean fields
            $data['is_active'] = in_array($request->input('is_active'), ['on', '1', 'true']);
            $data['is_featured'] = in_array($request->input('is_featured'), ['on', '1', 'true']);
            
            // Handle arrays
            $data['amenities'] = $request->input('amenities') ?: [];
            $data['features'] = $request->input('features') ?: [];
            
            // Handle main image
            if ($request->hasFile('main_image')) {
                // Delete old image
                if ($project->main_image) {
                    $oldImagePath = public_path('uploads/' . $project->main_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                
                $mainImage = $request->file('main_image');
                $mainImageName = 'project_' . time() . '_' . uniqid() . '.' . $mainImage->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/main');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Move file to uploads directory
                $mainImage->move($uploadDir, $mainImageName);
                $data['main_image'] = 'uploads/projects/main/' . $mainImageName;
            }
            
            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                $galleryImages = $project->gallery_images ?: [];
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/gallery');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                foreach ($request->file('gallery_images') as $image) {
                    $imageName = 'gallery_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to uploads directory
                    $image->move($uploadDir, $imageName);
                    $galleryImages[] = 'uploads/projects/gallery/' . $imageName;
                }
                $data['gallery_images'] = $galleryImages;
            }
            
            // Handle floor plans
            if ($request->hasFile('floor_plans')) {
                $floorPlans = $project->floor_plans ?: [];
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/floorplans');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                foreach ($request->file('floor_plans') as $plan) {
                    $planName = 'floorplan_' . time() . '_' . uniqid() . '.' . $plan->getClientOriginalExtension();
                    
                    // Move file to uploads directory
                    $plan->move($uploadDir, $planName);
                    $floorPlans[] = 'uploads/projects/floorplans/' . $planName;
                }
                $data['floor_plans'] = $floorPlans;
            }
            
            // Handle brochure
            if ($request->hasFile('brochure')) {
                // Delete old brochure
                if ($project->brochure) {
                    $oldBrochurePath = public_path('uploads/' . $project->brochure);
                    if (file_exists($oldBrochurePath)) {
                        unlink($oldBrochurePath);
                    }
                }
                
                $brochure = $request->file('brochure');
                $brochureName = 'brochure_' . time() . '_' . uniqid() . '.' . $brochure->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $uploadDir = public_path('uploads/projects/brochures');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Move file to uploads directory
                $brochure->move($uploadDir, $brochureName);
                $data['brochure'] = 'uploads/projects/brochures/' . $brochureName;
            }
            
            $project->update($data);
            
            Log::info('Project updated successfully', ['project_id' => $project->id, 'title' => $project->title]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Project updated successfully!',
                    'redirect' => route('admin.projects.index')
                ]);
            }
            return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
            
        } catch (ValidationException $e) {
            throw $e;
        } catch (QueryException $e) {
            $this->throwProjectValidationException($e);
        } catch (\Exception $e) {
            Log::error('Error updating project', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again later.'
                ], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }

    public function destroy(Project $project)
    {
        try {
                    // Delete images and files
        if ($project->main_image) {
            $mainImagePath = public_path($project->main_image);
            if (file_exists($mainImagePath)) {
                unlink($mainImagePath);
            }
        }
        
        if ($project->gallery_images) {
            foreach ($project->gallery_images as $image) {
                $imagePath = public_path($image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
            
            $project->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error deleting project', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function toggleStatus(Project $project)
    {
        try {
            $project->update(['is_active' => !$project->is_active]);
            
            $status = $project->is_active ? 'activated' : 'deactivated';
            
            return response()->json([
                'success' => true,
                'message' => "Project {$status} successfully!",
                'new_status' => $project->is_active ? 'active' : 'inactive'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function toggleFeatured(Project $project)
    {
        try {
            $project->update(['is_featured' => !$project->is_featured]);
            
            $featured = $project->is_featured ? 'marked as featured' : 'unmarked as featured';
            
            return response()->json([
                'success' => true,
                'message' => "Project {$featured} successfully!",
                'new_featured' => $project->is_featured ? 'featured' : 'not-featured'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function getStats()
    {
        $stats = [
            'total' => Project::count(),
            'active' => Project::where('is_active', true)->count(),
            'featured' => Project::where('is_featured', true)->count(),
            'residential' => Project::where('project_type', 'residential')->count(),
            'commercial' => Project::where('project_type', 'commercial')->count(),
            'mixed' => Project::where('project_type', 'mixed')->count(),
            'upcoming' => Project::where('status', 'upcoming')->count(),
            'under_construction' => Project::where('status', 'under_construction')->count(),
            'ready_to_move' => Project::where('status', 'ready_to_move')->count(),
        ];
        
        return response()->json($stats);
    }

    public function export(Request $request)
    {
        try {
            $query = Project::query();
            
            // Apply filters
            if ($request->filled('status')) {
                $query->where('is_active', $request->status);
            }
            
            if ($request->filled('featured')) {
                $query->where('is_featured', $request->featured);
            }
            
            if ($request->filled('type')) {
                $query->where('project_type', $request->type);
            }
            
            if ($request->filled('search')) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('location', 'like', '%' . $request->search . '%');
            }
            
            $projects = $query->latest()->get();
            
            $filename = 'projects_export_' . date('Y-m-d_H-i-s') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            
            $callback = function() use ($projects) {
                $file = fopen('php://output', 'w');
                
                // CSV headers
                fputcsv($file, [
                    'ID', 'Title', 'Type', 'Location', 'Price', 'Price Type', 'Area', 'Area Unit',
                    'Bedrooms', 'Bathrooms', 'Floors', 'Status', 'Featured', 'Developer',
                    'Completion Date', 'Created Date'
                ]);
                
                // CSV data
                foreach ($projects as $project) {
                    fputcsv($file, [
                        $project->id,
                        $project->title,
                        $project->project_type,
                        $project->location,
                        $project->price,
                        $project->price_type,
                        $project->area,
                        $project->area_unit,
                        $project->bedrooms,
                        $project->bathrooms,
                        $project->floors,
                        $project->is_active ? 'Active' : 'Inactive',
                        $project->is_featured ? 'Yes' : 'No',
                        $project->developer,
                        $project->completion_date ? $project->completion_date->format('Y-m-d') : '',
                        $project->created_at->format('Y-m-d H:i:s')
                    ]);
                }
                
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
            
        } catch (\Exception $e) {
            Log::error('Error exporting projects', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to export projects.'
            ], 500);
        }
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid image file.'
            ], 400);
        }

        try {
            $image = $request->file('image');
            $imageName = 'temp_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadDir = public_path('uploads/projects/temp');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file to uploads directory
            $image->move($uploadDir, $imageName);
            $imagePath = 'uploads/projects/temp/' . $imageName;
            
            return response()->json([
                'success' => true,
                'url' => url($imagePath),
                'path' => $imagePath
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image.'
            ], 500);
        }
    }

    public function setupStorage()
    {
        try {
            $this->ensureStorageDirectories();
            
            return response()->json([
                'success' => true,
                'message' => 'Storage directories created successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create storage directories: ' . $e->getMessage()
            ], 500);
        }
    }

    private function ensureStorageDirectories()
    {
        $directories = [
            'projects/main',
            'projects/gallery',
            'projects/temp'
        ];

        foreach ($directories as $directory) {
                    if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        }
    }

    protected function syncProjectType(array $data, ?Project $project = null): array
    {
        $projectType = $data['project_type'] ?? null;

        if (!$projectType) {
            if ($project) {
                $data['project_type'] = $project->project_type;
            }

            return $data;
        }

        $category = ProjectCategory::where('name', $projectType)->first();

        if ($category) {
            $data['project_type'] = $category->name;
        }

        return $data;
    }

    protected function throwProjectValidationException(QueryException $e): void
    {
        $message = $e->getMessage();

        Log::error('Project query validation error', [
            'error' => $message,
            'sql' => $e->getSql(),
        ]);

        if (str_contains($message, "Data truncated for column 'project_type'")) {
            throw ValidationException::withMessages([
                'project_type' => 'Selected Project Type database mein allowed nahi tha. Category dobara select karein.',
            ]);
        }

        if (str_contains($message, "Duplicate entry") && str_contains($message, "projects_slug_unique")) {
            throw ValidationException::withMessages([
                'title' => 'Is title se slug already mojood hai. Title change karein.',
            ]);
        }

        if (preg_match("/column '([^']+)'/i", $message, $matches) === 1) {
            throw ValidationException::withMessages([
                $matches[1] => 'Is field ki value theek nahi hai.',
            ]);
        }

        throw $e;
    }
}
