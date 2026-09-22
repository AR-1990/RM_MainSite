@extends('admin.layout.app')

@section('title', 'Expense Details')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>Expense Details</h3>
        <div>
            <a href="{{ route('admin.accounts.expenses.edit', $expense->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
            <a href="{{ route('admin.accounts.expenses.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm">
                        <tr><th>Title</th><td>{{ $expense->title }}</td></tr>
                        <tr><th>Amount</th><td>PKR {{ number_format($expense->amount, 2) }}</td></tr>
                        <tr><th>Date</th><td>{{ $expense->expense_date->format('Y-m-d') }}</td></tr>
                        <tr><th>Category</th><td>{{ $expense->category->name }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm">
                        <tr><th>Created By</th><td>{{ $expense->creator->name }}</td></tr>
                        <tr><th>Created At</th><td>{{ $expense->created_at->format('Y-m-d H:i') }}</td></tr>
                        <tr><th>Updated At</th><td>{{ $expense->updated_at->format('Y-m-d H:i') }}</td></tr>
                    </table>
                </div>
            </div>
            @if($expense->notes)
            <div class="mt-3">
                <h6>Notes</h6>
                <p class="mb-0">{{ $expense->notes }}</p>
            </div>
            @endif
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


