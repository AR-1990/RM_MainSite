@extends('admin.layout.app')

@section('title', 'Edit Salary Payment')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <h3>Edit Salary Payment</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.accounts.salaries.update', $payment->id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-4">
                    <label class="form-label">Employee</label>
                    <select name="user_id" class="form-select" required>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ $payment->user_id == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <input type="month" name="month" class="form-control" value="{{ $payment->month }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Basic Salary</label>
                    <input type="number" step="0.01" name="basic_salary" class="form-control" value="{{ $payment->basic_salary }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Allowances</label>
                    <input type="number" step="0.01" name="allowances" class="form-control" value="{{ $payment->allowances }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Deductions</label>
                    <input type="number" step="0.01" name="deductions" class="form-control" value="{{ $payment->deductions }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Paid On</label>
                    <input type="datetime-local" name="paid_on" class="form-control" value="{{ $payment->paid_on ? $payment->paid_on->format('Y-m-d\TH:i') : '' }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Method</label>
                    <input type="text" name="payment_method" class="form-control" value="{{ $payment->payment_method }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Reference #</label>
                    <input type="text" name="reference_no" class="form-control" value="{{ $payment->reference_no }}">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.accounts.salaries.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


