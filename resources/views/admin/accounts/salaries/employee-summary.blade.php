@extends('admin.layout.app')

@section('title', 'Employee Salary Summary')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>{{ $user->name }} - Salary Summary</h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card"><div class="card-body">
                <div class="text-muted">Total Paid</div>
                <h3>PKR {{ number_format($totalPaid, 2) }}</h3>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card"><div class="card-body">
                <div class="text-muted">Advances (Pending)</div>
                <h3>PKR {{ number_format($pendingAdv, 2) }}</h3>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card"><div class="card-body">
                <div class="text-muted">Advances (Settled)</div>
                <h3>PKR {{ number_format($settledAdv, 2) }}</h3>
            </div></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5>By Month</h5></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead><tr><th>Month</th><th>Total Paid (PKR)</th></tr></thead>
                    <tbody>
                        @forelse($byMonth as $m)
                            <tr><td>{{ $m->month }}</td><td>PKR {{ number_format($m->total, 2) }}</td></tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-muted">No payments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


