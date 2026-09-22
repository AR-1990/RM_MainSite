@extends('admin.layout.app')

@section('title', 'Expense Categories')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>Expense Categories</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.categories.store') }}" class="row g-3 mb-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">New Category</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g., Utilities" required>
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                        <tr>
                            <td>{{ $cat->name }}</td>
                            <td>
                                <span class="badge bg-{{ $cat->is_active ? 'success' : 'secondary' }}">{{ $cat->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.accounts.categories.edit', $cat->id) }}" class="btn btn-sm btn-warning me-1"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.accounts.categories.toggle', $cat->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">Toggle</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">{{ $categories->links() }}</div>
        </div>
    </div>
</div>
@endsection


