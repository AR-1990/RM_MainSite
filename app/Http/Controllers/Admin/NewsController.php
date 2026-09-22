<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the news
     */
    public function index(Request $request)
    {
        $query = News::query();
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Featured filter
        if ($request->has('featured') && $request->featured !== '') {
            $query->where('featured', $request->featured === 'featured');
        }
        
        // Date range filter
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('posted_date', '>=', $request->from_date);
        }
        
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('posted_date', '<=', $request->to_date);
        }
        
        $news = $query->orderBy('posted_date', 'desc')->paginate(15);
        
        // Get statistics
        $stats = [
            'total' => News::count(),
            'active' => News::where('is_active', true)->count(),
            'featured' => News::where('featured', true)->count(),
            'this_month' => News::whereMonth('posted_date', now()->month)->count(),
        ];
        
        return view('admin.news.index', compact('news', 'stats'));
    }

    /**
     * Show the form for creating a new news article
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news article
     */
    public function store(Request $request)
    {
        try {
            // Debug: Log all incoming data
            Log::info('News Store Request Data:', $request->all());
            Log::info('Request method:', ['method' => $request->method()]);
            Log::info('Request URL:', ['url' => $request->url()]);
            
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'youtube_link' => 'required|url',
                'posted_date' => 'required|date',
                'is_active' => 'nullable|in:on,off,1,0,true,false',
                'featured' => 'nullable|in:on,off,1,0,true,false',
                'meta_description' => 'nullable|string|max:500',
                'meta_keywords' => 'nullable|string|max:500',
            ]);

            // Custom YouTube link validation
            $validator->after(function ($validator) use ($request) {
                $youtubeLink = $request->youtube_link;
                if (!preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/', $youtubeLink)) {
                    $validator->errors()->add('youtube_link', 'Please enter a valid YouTube URL.');
                }
            });

            if ($validator->fails()) {
                Log::info('Validation failed:', $validator->errors()->toArray());
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Debug: Log the data being sent to create
            $newsData = [
                'title' => $request->title,
                'content' => $request->content,
                'youtube_link' => $request->youtube_link,
                'posted_date' => $request->posted_date,
                'is_active' => $request->has('is_active') && $request->is_active === 'on',
                'featured' => $request->has('featured') && $request->featured === 'on',
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
            ];
            
            Log::info('News Data to Create:', $newsData);
            
            $news = News::create($newsData);
            
            Log::info('News Created Successfully:', ['id' => $news->id, 'title' => $news->title]);
            
            return redirect()->route('admin.news.index')
                ->with('success', 'News article created successfully!');
                
        } catch (\Exception $e) {
            Log::error('News Store Method Error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            return redirect()->back()
                ->with('error', 'Error in news store method: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified news article
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified news article
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified news article
     */
    public function update(Request $request, News $news)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'youtube_link' => 'required|url',
            'posted_date' => 'required|date',
            'is_active' => 'nullable|in:on,off,1,0,true,false',
            'featured' => 'nullable|in:on,off,1,0,true,false',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        // Custom YouTube link validation
        $validator->after(function ($validator) use ($request) {
            $youtubeLink = $request->youtube_link;
            if (!preg_match('/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/', $youtubeLink)) {
                $validator->errors()->add('youtube_link', 'Please enter a valid YouTube URL.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $news->update([
                'title' => $request->title,
                'content' => $request->content,
                'youtube_link' => $request->youtube_link,
                'posted_date' => $request->posted_date,
                'is_active' => $request->has('is_active') && $request->is_active === 'on',
                'featured' => $request->has('featured') && $request->featured === 'on',
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
            ]);

            return redirect()->route('admin.news.index')
                ->with('success', 'News article updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating news article: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified news article
     */
    public function destroy(News $news)
    {
        try {
            $news->delete();
            return redirect()->route('admin.news.index')
                ->with('success', 'News article deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting news article: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the active status of a news article
     */
    public function toggleStatus(News $news)
    {
        try {
            $news->update(['is_active' => !$news->is_active]);
            $status = $news->is_active ? 'activated' : 'deactivated';
            
            return response()->json([
                'success' => true,
                'message' => "News article {$status} successfully!",
                'is_active' => $news->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle the featured status of a news article
     */
    public function toggleFeatured(News $news)
    {
        try {
            $news->update(['featured' => !$news->featured]);
            $status = $news->featured ? 'marked as featured' : 'unmarked as featured';
            
            return response()->json([
                'success' => true,
                'message' => "News article {$status} successfully!",
                'featured' => $news->featured
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating featured status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Perform bulk actions on news articles
     */
    public function bulkAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:delete,activate,deactivate,feature,unfeature',
            'news_ids' => 'required|array',
            'news_ids.*' => 'exists:news,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request data'
            ], 400);
        }

        try {
            $newsIds = $request->news_ids;
            $action = $request->action;
            $count = 0;

            switch ($action) {
                case 'delete':
                    News::whereIn('id', $newsIds)->delete();
                    $count = count($newsIds);
                    break;
                    
                case 'activate':
                    News::whereIn('id', $newsIds)->update(['is_active' => true]);
                    $count = count($newsIds);
                    break;
                    
                case 'deactivate':
                    News::whereIn('id', $newsIds)->update(['is_active' => false]);
                    $count = count($newsIds);
                    break;
                    
                case 'feature':
                    News::whereIn('id', $newsIds)->update(['featured' => true]);
                    $count = count($newsIds);
                    break;
                    
                case 'unfeature':
                    News::whereIn('id', $newsIds)->update(['featured' => false]);
                    $count = count($newsIds);
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => "Bulk action completed successfully! {$count} news articles affected."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error performing bulk action: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export news data
     */
    public function export(Request $request)
    {
        $query = News::query();
        
        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status === 'active');
        }
        
        if ($request->has('featured') && $request->featured !== '') {
            $query->where('featured', $request->featured === 'featured');
        }
        
        $news = $query->orderBy('posted_date', 'desc')->get();
        
        $filename = 'news_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($news) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, ['ID', 'Title', 'Content', 'YouTube Link', 'Posted Date', 'Status', 'Featured', 'Created At']);
            
            // CSV data
            foreach ($news as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->title,
                    strip_tags($item->content),
                    $item->youtube_link,
                    $item->posted_date->format('Y-m-d'),
                    $item->is_active ? 'Active' : 'Inactive',
                    $item->featured ? 'Yes' : 'No',
                    $item->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get news statistics
     */
    public function getStats()
    {
        $stats = [
            'total' => News::count(),
            'active' => News::where('is_active', true)->count(),
            'featured' => News::where('featured', true)->count(),
            'this_month' => News::whereMonth('posted_date', now()->month)->count(),
            'this_year' => News::whereYear('posted_date', now()->year)->count(),
            'recent' => News::where('posted_date', '>=', now()->subDays(7))->count(),
        ];
        
        return response()->json($stats);
    }

    /**
     * Upload image for CKEditor
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            
            // Validate file
            $validator = Validator::make(['upload' => $file], [
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'error' => [
                        'message' => 'Invalid file type. Only JPEG, PNG, JPG, and GIF files are allowed (max 2MB).'
                    ]
                ]);
            }
            
            try {
                // Generate unique filename
                $filename = 'news_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Store file in public/uploads/news directory
                $uploadDir = public_path('uploads/news');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $file->move($uploadDir, $filename);
                $path = 'uploads/news/' . $filename;
                
                return response()->json([
                    'url' => asset($path)
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => [
                        'message' => 'Upload failed: ' . $e->getMessage()
                    ]
                ], 500);
            }
        }
        
        return response()->json([
            'error' => [
                'message' => 'No file uploaded.'
            ]
        ]);
    }

    /**
     * Setup upload directories (call this from browser to initialize uploads)
     */
    public function setupStorage()
    {
        try {
            $this->ensureUploadDirectories();
            
            return response()->json([
                'success' => true,
                'message' => 'Upload directories created successfully!',
                'directories' => [
                    'public/uploads' => file_exists(public_path('uploads')),
                    'public/uploads/news' => file_exists(public_path('uploads/news')),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error setting up upload directories: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ensure upload directories exist for file uploads
     */
    private function ensureUploadDirectories()
    {
        $directories = [
            public_path('uploads'),
            public_path('uploads/news'),
        ];

        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        }

        // Create .gitkeep files to preserve empty directories
        $gitkeepFiles = [
            public_path('uploads/.gitkeep'),
            public_path('uploads/news/.gitkeep'),
        ];

        foreach ($gitkeepFiles as $gitkeepFile) {
            if (!file_exists($gitkeepFile)) {
                file_put_contents($gitkeepFile, '');
            }
        }
    }
}
