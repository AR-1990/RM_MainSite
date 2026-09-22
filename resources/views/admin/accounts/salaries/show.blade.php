@extends('admin.layout.app')

@section('title', 'Salary Receipt')

@section('content')
<div class="page-heading">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h3>Salary Receipt</h3>
        <button id="downloadJpgBtn" class="btn btn-primary"><i class="fas fa-image"></i> Download JPG</button>
    </div>
    <div class="card shadow-sm" id="receiptCard">
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="mb-1">Randhawa Marketing</h4>
                    <div class="text-muted">Salary Payment Receipt</div>
                    <div class="mt-3">
                        <div class="fw-bold">Employee</div>
                        <div><strong>{{ $payment->user->name }}</strong></div>
                        <div class="text-muted small">{{ $payment->user->email }}</div>
                        <div class="text-muted small">Employee ID: {{ $payment->user->id }}</div>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="mb-1">Receipt #: <strong>SP-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</strong></div>
                    <div class="mb-1">Month: <strong>{{ $payment->month }}</strong></div>
                    <div class="mb-1">Paid On: <strong>{{ optional($payment->paid_on)->format('Y-m-d H:i') ?: '-' }}</strong></div>
                    <div class="mb-1">Method: <strong>{{ $payment->payment_method ?: '-' }}</strong></div>
                    <div class="">Reference: <strong>{{ $payment->reference_no ?: '-' }}</strong></div>
                </div>
            </div>
            <div class="border rounded p-3">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm mb-0">
                            <tr><th class="w-50">Basic Salary</th><td>PKR {{ number_format($payment->basic_salary, 2) }}</td></tr>
                            <tr><th>Allowances</th><td>PKR {{ number_format($payment->allowances, 2) }}</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm mb-0">
                            <tr><th class="w-50">Deductions</th><td>PKR {{ number_format($payment->deductions, 2) }}</td></tr>
                            <tr><th>Net Salary</th><td><strong>PKR {{ number_format($payment->net_salary, 2) }}</strong></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            @if($payment->notes)
            <p class="mt-3"><strong>Notes (legacy field):</strong> {{ $payment->notes }}</p>
            @endif
            <div class="mt-4 d-flex justify-content-between">
                <div>
                    <div class="text-muted small">Prepared By</div>
                    <div class="fw-bold">{{ optional(auth()->user())->name }}</div>
                </div>
                <div class="text-end">
                    <div class="text-muted small">Signature</div>
                    <div style="height:40px;border-bottom:1px solid #999; width:220px; margin-left:auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Notes</h5>
            <form method="POST" action="{{ route('admin.accounts.salaries.notes.add', $payment->id) }}" class="d-flex">
                @csrf
                <input type="text" name="note" class="form-control form-control-sm me-2" placeholder="Add note..." required>
                <button class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-body">
            @forelse(($payment->paymentNotes ?? collect()) as $n)
                <div class="d-flex justify-content-between border-bottom py-2">
                    <div>{{ $n->note }}</div>
                    <div class="text-muted small">by {{ $n->author->name }} on {{ $n->created_at->format('Y-m-d H:i') }}</div>
                </div>
            @empty
                <div class="text-muted">No notes yet.</div>
            @endforelse
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header"><h5 class="mb-0">Audit Log</h5></div>
        <div class="card-body">
            @forelse($payment->logs()->latest()->get() as $log)
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script>
document.getElementById('downloadJpgBtn').addEventListener('click', async function() {
    const card = document.getElementById('receiptCard');
    const canvas = await html2canvas(card, { backgroundColor: '#ffffff', scale: 2 });
    const dataUrl = canvas.toDataURL('image/jpeg', 0.95);
    const a = document.createElement('a');
    a.href = dataUrl;
    a.download = 'salary_receipt_{{ $payment->id }}.jpg';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
});
</script>
@endpush


