<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->latest()->paginate(15);

        return view('admin.projects.categories.index', [
            'categories' => $categories,
            'categoryRows' => $categories->getCollection()
                ->map(fn ($category, $index) => view('admin.projects.categories.partials.row', [
                    'category' => $category,
                    'rowNumber' => ($categories->firstItem() ?? 0) + $index,
                ])->render())
                ->implode(''),
        ]);
    }

    public function create()
    {
        return view('admin.projects.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:project_categories,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:project_categories,slug'],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) $request->boolean('is_active');

        ProjectCategory::create($data);

        return redirect()->route('admin.project-categories.index')->with('success', 'Project category created successfully!');
    }

    public function show(ProjectCategory $projectCategory)
    {
        $projectCategory->loadCount('projects');

        $projects = $projectCategory->projects()->latest()->paginate(10);

        return view('admin.projects.categories.show', [
            'projectCategory' => $projectCategory,
            'projectRows' => $projects->getCollection()
                ->map(fn ($project) => view('admin.projects.categories.partials.project-row', compact('project'))->render())
                ->implode(''),
            'projects' => $projects,
        ]);
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('admin.projects.categories.edit', compact('projectCategory'));
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('project_categories', 'name')->ignore($projectCategory->id)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('project_categories', 'slug')->ignore($projectCategory->id)],
            'description' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = (bool) $request->boolean('is_active');

        $projectCategory->update($data);
        $projectCategory->projects()->update(['project_type' => $projectCategory->fresh()->name]);

        return redirect()->route('admin.project-categories.index')->with('success', 'Project category updated successfully!');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        if ($projectCategory->projects()->count() > 0) {
            return redirect()->back()->with('error', 'Yeh category projects ke sath linked hai, is liye delete nahi ho sakti.');
        }

        $projectCategory->delete();

        return redirect()->route('admin.project-categories.index')->with('success', 'Project category deleted successfully!');
    }

    public function toggleStatus(ProjectCategory $projectCategory)
    {
        $projectCategory->update(['is_active' => !$projectCategory->is_active]);

        return redirect()->back()->with('success', 'Project category status updated successfully!');
    }
}
