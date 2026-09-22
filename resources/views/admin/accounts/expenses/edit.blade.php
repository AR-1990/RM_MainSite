@extends('admin.layout.app')

@section('title', 'Edit Expense')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Edit Expense</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.expenses.update', $expense->id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ $expense->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $expense->title }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" value="{{ $expense->amount }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date" name="expense_date" class="form-control" value="{{ $expense->expense_date->format('Y-m-d') }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3">{{ $expense->notes }}</textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.accounts.expenses.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header"><h5 class="mb-0">Audit Log</h5></div>
        <div class="card-body">
            @forelse($expense->logs()->latest()->get() as $log)
                <div class="mb-2">
                    <div><span class="badge bg-light text-dark">{{ strtoupper($log->action) }}</span> by <strong>{{ $log->user->name }}</strong> on {{ $log->created_at->format('Y-m-d H:i') }}</div>
                </div>
            @empty
                <div class="text-muted">No changes logged yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection


