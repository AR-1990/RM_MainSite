@extends('admin.layout.app')

@section('title', 'Project Categories')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Project Categories</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Project Categories</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>All Project Categories</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.project-categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Projects</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {!! $categoryRows ?: '<tr><td colspan="7" class="text-center py-4">No project categories found.</td></tr>' !!}
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
