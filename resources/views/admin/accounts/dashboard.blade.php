@extends('admin.layout.app')

@section('title', 'Accounts Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Accounts</h3>
                <p class="text-subtitle text-muted">Overview of salaries and expenses</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Accounts</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">This Month Salaries</h5>
                        <h3>PKR {{ number_format($monthlySalaries, 2) }}</h3>
                    </div>
                    <i class="fas fa-money-check-alt text-success" style="font-size:2rem"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">This Month Expenses</h5>
                        <h3>PKR {{ number_format($monthlyExpense, 2) }}</h3>
                    </div>
                    <i class="fas fa-receipt text-danger" style="font-size:2rem"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><h5>Quick Actions</h5></div>
                <div class="card-body">
                    <a href="{{ route('admin.accounts.salaries.create') }}" class="btn btn-primary w-100 mb-2"><i class="fas fa-plus"></i> Add Salary Payment</a>
                    <a href="{{ route('admin.accounts.expenses.create') }}" class="btn btn-secondary w-100 mb-2"><i class="fas fa-plus"></i> Add Expense</a>
                    <a href="{{ route('admin.accounts.categories.index') }}" class="btn btn-light w-100"><i class="fas fa-tags"></i> Manage Categories</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Categories</h5></div>
                <div class="card-body">
                    @forelse($categories as $cat)
                        <span class="badge bg-{{ $cat->is_active ? 'success' : 'secondary' }} me-1 mb-1">{{ $cat->name }}</span>
                    @empty
                        <p class="text-muted">No categories yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


