<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'user'])
            ->active()
            ->published()
            ->latest('published_at');

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->where('blog_category_id', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        $blogs = $query->paginate(9);

        // Get all active categories for sidebar
        $categories = BlogCategory::active()
            ->withCount(['blogs' => function($query) {
                $query->active()->published();
            }])
            ->orderBy('name')
            ->get();

        // Get featured blogs for sidebar
        $featuredBlogs = Blog::with(['category'])
            ->active()
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get recent blogs for sidebar
        $recentBlogs = Blog::with(['category'])
            ->active()
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('blog', compact('blogs', 'categories', 'featuredBlogs', 'recentBlogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'user'])
            ->where('slug', $slug)
            ->active()
            ->published()
            ->firstOrFail();

        // Increment view count
        $blog->incrementViews();

        // Get related blogs (same category, excluding current blog)
        $relatedBlogs = Blog::with(['category'])
            ->where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->active()
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get all active categories for sidebar
        $categories = BlogCategory::active()
            ->withCount(['blogs' => function($query) {
                $query->active()->published();
            }])
            ->orderBy('name')
            ->get();

        // Get recent blogs for sidebar
        $recentBlogs = Blog::with(['category'])
            ->active()
            ->published()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('blog-detail', compact('blog', 'relatedBlogs', 'categories', 'recentBlogs'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $blogs = Blog::with(['category', 'user'])
            ->where('blog_category_id', $category->id)
            ->active()
            ->published()
            ->latest('published_at')
            ->paginate(9);

        // Get all active categories for sidebar
        $categories = BlogCategory::active()
            ->withCount(['blogs' => function($query) {
                $query->active()->published();
            }])
            ->orderBy('name')
            ->get();

        // Get featured blogs for sidebar
        $featuredBlogs = Blog::with(['category'])
            ->active()
            ->published()
            ->featured()
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('blog', compact('blogs', 'categories', 'featuredBlogs', 'category'));
    }
}
