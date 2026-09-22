@extends('admin.layout.app')

@section('title', 'Salaries')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Salaries</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first text-end">
                <a href="{{ route('admin.accounts.salaries.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Salary</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <input type="month" class="form-control" name="month" value="{{ $month }}">
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-secondary">Filter</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Basic</th>
                            <th>Allowances</th>
                            <th>Deductions</th>
                            <th>Net</th>
                            <th>Paid On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $p)
                        <tr>
                            <td>{{ $p->user->name }}</td>
                            <td>{{ $p->month }}</td>
                            <td>PKR {{ number_format($p->basic_salary, 2) }}</td>
                            <td>PKR {{ number_format($p->allowances, 2) }}</td>
                            <td>PKR {{ number_format($p->deductions, 2) }}</td>
                            <td><strong>PKR {{ number_format($p->net_salary, 2) }}</strong></td>
                            <td>{{ optional($p->paid_on)->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.accounts.salaries.show', $p->id) }}" class="btn btn-sm btn-info"><i class="fas fa-file-invoice"></i> Receipt</a>
                                <a href="{{ route('admin.accounts.salaries.edit', $p->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.accounts.salaries.destroy', $p->id) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this payment?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted">No salary payments found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">{{ $payments->links() }}</div>
        </div>
    </div>
</div>
@endsection


