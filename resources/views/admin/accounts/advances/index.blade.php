@extends('admin.layout.app')

@section('title', 'Salary Advances')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>Salary Advances</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.advances.store') }}" class="row g-3 mb-4">
                @csrf
                <div class="col-md-3">
                    <label class="form-label">Employee</label>
                    <select name="user_id" class="form-select" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Amount (PKR)</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="advance_date" class="form-control" value="{{ now() ? now()->format('Y-m-d') : date('Y-m-d') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="fas fa-plus"></i> Add Advance</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Settled On</th>
                            <th>Settled Via</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advances as $a)
                        <tr>
                            <td>{{ is_string($a->advance_date) ? $a->advance_date : $a->advance_date->format('Y-m-d') }}</td>
                            <td>{{ $a->user->name }}</td>
                            <td>PKR {{ number_format($a->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $a->status == 'pending' ? 'warning' : 'success' }}">{{ ucfirst($a->status) }}</span>
                            </td>
                            <td>{{ $a->settled_on ? (is_string($a->settled_on) ? $a->settled_on : $a->settled_on->format('Y-m-d')) : '-' }}</td>
                            <td>{{ $a->settled_via ? str_replace('_',' ', $a->settled_via) : '-' }}</td>
                            <td class="text-end">
                                @if($a->status == 'pending')
                                <form method="POST" action="{{ route('admin.accounts.advances.settle', $a->id) }}" class="row gx-1 gy-1 justify-content-end">
                                    @csrf
                                    <div class="col-auto">
                                        <input type="number" step="0.01" name="amount" class="form-control form-control-sm" placeholder="Amount" required>
                                    </div>
                                    <div class="col-auto">
                                        <select name="settled_via" class="form-select form-select-sm">
                                            <option value="salary_deduction">Salary Deduction</option>
                                            <option value="manual">Manual</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" name="settled_on" class="form-control form-control-sm" value="{{ now() ? now()->format('Y-m-d') : date('Y-m-d') }}">
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="notes" class="form-control form-control-sm" placeholder="Notes">
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-success">Add Installment</button>
                                    </div>
                                </form>
                                @endif
                                <div class="mt-2 text-start">
                                    @php $paid = $a->installments->sum('amount'); $remaining = max($a->amount - $paid, 0); @endphp
                                    <small class="text-muted">Paid: PKR {{ number_format($paid,2) }} | Remaining: PKR {{ number_format($remaining,2) }}</small>
                                    @if($a->installments->count())
                                        <div class="mt-1">
                                            <details>
                                                <summary class="small">View installments ({{ $a->installments->count() }})</summary>
                                                <div class="table-responsive mt-2">
                                                    <table class="table table-sm">
                                                        <thead><tr><th>Date</th><th>Amount</th><th>Method</th><th>Notes</th></tr></thead>
                                                        <tbody>
                                                        @foreach($a->installments as $ins)
                                                            <tr>
                                                                <td>{{ is_string($ins->pay_date) ? $ins->pay_date : $ins->pay_date->format('Y-m-d') }}</td>
                                                                <td>PKR {{ number_format($ins->amount,2) }}</td>
                                                                <td>{{ str_replace('_',' ', $ins->method) }}</td>
                                                                <td>{{ $ins->notes }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </details>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted">No advances recorded.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">{{ $advances->links() }}</div>
        </div>
    </div>
</div>
@endsection


