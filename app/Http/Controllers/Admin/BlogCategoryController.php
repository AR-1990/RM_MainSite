<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')->latest()->paginate(10);
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories',
            'description' => 'nullable|string|max:500',
            'color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'is_active' => 'boolean'
        ]);

        BlogCategory::create($request->all());

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category created successfully!');
    }

    public function show(BlogCategory $blogCategory)
    {
        $blogCategory->loadCount('blogs');
        $blogs = $blogCategory->blogs()->with('user')->latest('published_at')->paginate(10);
        
        return view('admin.blog.categories.show', compact('blogCategory', 'blogs'));
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog.categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $blogCategory->id,
            'description' => 'nullable|string|max:500',
            'color' => 'required|regex:/^#[a-fA-F0-9]{6}$/',
            'is_active' => 'boolean'
        ]);

        $blogCategory->update($request->all());

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category updated successfully!');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->blogs()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete category that has blog posts. Please move or delete the posts first.');
        }

        $blogCategory->delete();

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category deleted successfully!');
    }

    public function toggleStatus(BlogCategory $blogCategory)
    {
        $blogCategory->update(['is_active' => !$blogCategory->is_active]);
        
        $status = $blogCategory->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Blog category {$status} successfully!");
    }
}