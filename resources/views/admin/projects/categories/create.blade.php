@extends('admin.layout.app')

@section('title', 'Create Project Category')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Project Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.project-categories.index') }}">Project Categories</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>New Project Category</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.project-categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Auto generate ho jayega agar khali chhor dein">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="custom-switch mt-2">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="custom-switch-input" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Active</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                    <a href="{{ route('admin.project-categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
