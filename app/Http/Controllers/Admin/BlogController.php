<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'user'])
            ->latest('published_at')
            ->paginate(10);
        
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Create directory if it doesn't exist
            $uploadDir = public_path('uploads/blog-images');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file to uploads directory
            $image->move($uploadDir, $imageName);
            $data['featured_image'] = 'uploads/blog-images/' . $imageName;
        }

        // Handle published date
        if ($request->published_at) {
            $data['published_at'] = Carbon::parse($request->published_at);
        } else {
            $data['published_at'] = now();
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'user']);
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($blog->featured_image) {
                $oldImagePath = public_path('uploads/' . $blog->featured_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('featured_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            
            // Create directory if it doesn't exist
            $uploadDir = public_path('uploads/blog-images');
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file to uploads directory
            $image->move($uploadDir, $imageName);
            $data['featured_image'] = 'uploads/blog-images/' . $imageName;
        }

        // Handle published date
        if ($request->published_at) {
            $data['published_at'] = Carbon::parse($request->published_at);
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            $imagePath = public_path($blog->featured_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->update(['is_active' => !$blog->is_active]);
        
        $status = $blog->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Blog post {$status} successfully!");
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['is_featured' => !$blog->is_featured]);
        
        $status = $blog->is_featured ? 'marked as featured' : 'removed from featured';
        return redirect()->back()
            ->with('success', "Blog post {$status} successfully!");
    }
}