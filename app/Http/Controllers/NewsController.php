<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the news
     */
    public function index(Request $request)
    {
        $query = News::active()->orderBy('posted_date', 'desc');
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Category filter (featured)
        if ($request->has('category') && $request->category === 'featured') {
            $query->featured();
        }
        
        // Date filter
        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('posted_date', $date);
        }
        
        $news = $query->paginate(12);
        
        // Get featured news for sidebar
        $featuredNews = News::active()->featured()->latest('posted_date')->take(5)->get();
        
        // Get recent news for sidebar
        $recentNews = News::active()->latest('posted_date')->take(5)->get();
        
        return view('news.index', compact('news', 'featuredNews', 'recentNews'));
    }

    /**
     * Display the specified news article
     */
    public function show($slug)
    {
        $news = News::active()->where('slug', $slug)->firstOrFail();
        
        // Get related news (same category or similar content)
        $relatedNews = News::active()
            ->where('id', '!=', $news->id)
            ->where(function($query) use ($news) {
                $query->where('featured', $news->featured)
                      ->orWhere('posted_date', '>=', now()->subDays(30));
            })
            ->latest('posted_date')
            ->take(3)
            ->get();
        
        // Get featured news for sidebar
        $featuredNews = News::active()->featured()->latest('posted_date')->take(5)->get();
        
        // Get recent news for sidebar
        $recentNews = News::active()->latest('posted_date')->take(5)->get();
        
        return view('news.show', compact('news', 'relatedNews', 'featuredNews', 'recentNews'));
    }

    /**
     * Search news
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('news.index');
        }
        
        $news = News::active()
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->orderBy('posted_date', 'desc')
            ->paginate(12);
        
        // Get featured news for sidebar
        $featuredNews = News::active()->featured()->latest('posted_date')->take(5)->get();
        
        // Get recent news for sidebar
        $recentNews = News::active()->latest('posted_date')->take(5)->get();
        
        return view('news.search', compact('news', 'featuredNews', 'recentNews', 'query'));
    }
}
