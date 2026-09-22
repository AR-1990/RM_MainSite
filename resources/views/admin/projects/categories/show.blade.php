@extends('admin.layout.app')

@section('title', 'Project Category Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Project Category Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.project-categories.index') }}">Project Categories</a></div>
                <div class="breadcrumb-item">{{ $projectCategory->name }}</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>{{ $projectCategory->name }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.project-categories.edit', $projectCategory) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Slug:</strong> {{ $projectCategory->slug }}</p>
                <p><strong>Description:</strong> {{ $projectCategory->description ?: 'No description' }}</p>
                <p><strong>Status:</strong> {{ $projectCategory->is_active ? 'Active' : 'Inactive' }}</p>
                <p><strong>Projects:</strong> {{ $projectCategory->projects_count }}</p>

                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {!! $projectRows ?: '<tr><td colspan="5" class="text-center py-4">No projects linked with this category.</td></tr>' !!}
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
