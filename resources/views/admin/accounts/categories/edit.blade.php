@extends('admin.layout.app')

@section('title', 'Edit Category')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Edit Expense Category</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.categories.update', $category->id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.accounts.categories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


