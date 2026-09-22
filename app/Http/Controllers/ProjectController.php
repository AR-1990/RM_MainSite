<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active();
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filter by project type
        if ($request->filled('type')) {
            $query->byType($request->type);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }
        
        // Filter by location
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }
        
        // Filter by price range
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->byPriceRange($request->min_price, $request->max_price);
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'area_low':
                $query->orderBy('area', 'asc');
                break;
            case 'area_high':
                $query->orderBy('area', 'desc');
                break;
            case 'completion_date':
                $query->orderBy('completion_date', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        
        $projects = $query->paginate(12)->withQueryString();
        
        // Get filter options
        $projectTypes = Project::active()->distinct()->pluck('project_type');
        $statuses = Project::active()->distinct()->pluck('status');
        $locations = Project::active()->distinct()->pluck('location');
        
        // Get featured projects for sidebar
        $featuredProjects = Project::active()->featured()->take(5)->get();
        
        $properties = collect();

        return view('projects.index', compact('projects', 'projectTypes', 'statuses', 'locations', 'featuredProjects', 'properties'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (empty($query)) {
            return redirect()->route('projects.index');
        }
        
        $projects = Project::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('developer', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);
        
        $properties = collect();

        return view('projects.search', compact('projects', 'query', 'properties'));
    }

    public function show($slug)
    {
        $project = Project::active()->where('slug', $slug)->firstOrFail();
        
        // Get related projects
        $relatedProjects = Project::active()
            ->where('id', '!=', $project->id)
            ->where(function ($query) use ($project) {
                $query->where('project_type', $project->project_type)
                    ->orWhere('location', $project->location);
            })
            ->take(6)
            ->get();
        
        // Get featured projects for sidebar
        $featuredProjects = Project::active()
            ->featured()
            ->where('id', '!=', $project->id)
            ->take(5)
            ->get();
        
        return view('projects.show', compact('project', 'relatedProjects', 'featuredProjects'));
    }

    public function submitInquiry(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
            'interest_type' => 'required|in:buy,rent,invest,consultation',
            'budget' => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Here you would typically save the inquiry to a database
            // For now, we'll just return success
            
            // You can create a ProjectInquiry model and save:
            // ProjectInquiry::create([
            //     'project_id' => $project->id,
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'message' => $request->message,
            //     'interest_type' => $request->interest_type,
            //     'budget' => $request->budget,
            //     'timeline' => $request->timeline,
            //     'ip_address' => $request->ip(),
            //     'user_agent' => $request->userAgent(),
            // ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your inquiry! We will contact you within 24 hours.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
