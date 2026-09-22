@extends('admin.layout.app')

@section('title', 'Expenses')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>Expenses</h3>
        <a href="{{ route('admin.accounts.expenses.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Expense</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">All</option>
                        @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start</label>
                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">End</label>
                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-secondary">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $e)
                        <tr>
                            <td>{{ $e->expense_date->format('Y-m-d') }}</td>
                            <td>{{ $e->title }}</td>
                            <td>{{ $e->category->name }}</td>
                            <td>PKR {{ number_format($e->amount, 2) }}</td>
                            <td>{{ $e->creator->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.accounts.expenses.show', $e->id) }}" class="btn btn-sm btn-info me-1"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.accounts.expenses.edit', $e->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.accounts.expenses.destroy', $e->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this expense?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">No expenses found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">{{ $expenses->appends(request()->query())->links() }}</div>
        </div>
    </div>
</div>
@endsection


