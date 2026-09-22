@extends('admin.layout.app')

@section('title', 'Add Salary Payment')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Add Salary Payment</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.salaries.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="form-label">Employee</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">Select Employee</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <input type="month" name="month" class="form-control" value="{{ now()->format('Y-m') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Basic Salary</label>
                    <input type="number" step="0.01" name="basic_salary" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Allowances</label>
                    <input type="number" step="0.01" name="allowances" class="form-control" value="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Deductions</label>
                    <input type="number" step="0.01" name="deductions" class="form-control" value="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Paid On</label>
                    <input type="datetime-local" name="paid_on" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Method</label>
                    <input type="text" name="payment_method" class="form-control" placeholder="Cash/Bank/Online">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Reference #</label>
                    <input type="text" name="reference_no" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.accounts.salaries.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


