<div class="row">
    <div class="col-md-6">
        <h6 class="font-weight-bold">Loan Information</h6>
        <table class="table table-borderless">
            <tr>
                <td class="font-weight-bold">Amount:</td>
                <td>{{ $loan->amount_formatted }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Date:</td>
                <td>{{ $loan->advance_date->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Status:</td>
                <td>{!! $loan->status_badge !!}</td>
            </tr>
            @if($loan->description)
            <tr>
                <td class="font-weight-bold">Description:</td>
                <td>{{ $loan->description }}</td>
            </tr>
            @endif
            @if($loan->settled_on)
            <tr>
                <td class="font-weight-bold">Settled On:</td>
                <td>{{ $loan->settled_on->format('d M Y') }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold">Settled Via:</td>
                <td>{!! $loan->settled_via_badge !!}</td>
            </tr>
            @endif
        </table>
    </div>
    <div class="col-md-6">
        <h6 class="font-weight-bold">Payment Progress</h6>
        <div class="text-center mb-3">
            <div class="progress" style="height: 25px;">
                <div class="progress-bar" role="progressbar" 
                     style="width: {{ $loan->progress_percentage }}%;" 
                     aria-valuenow="{{ $loan->progress_percentage }}" 
                     aria-valuemin="0" aria-valuemax="100">
                    {{ $loan->progress_percentage }}%
                </div>
            </div>
            <small class="text-muted">
                ₹{{ number_format($loan->paid_amount, 2) }} of ₹{{ number_format($loan->amount, 2) }} paid
            </small>
        </div>
        
        @if($loan->is_pending)
        <div class="alert alert-warning">
            <strong>Remaining Amount:</strong> ₹{{ number_format($loan->remaining_amount, 2) }}
        </div>
        @endif
    </div>
</div>

@if($installments->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <h6 class="font-weight-bold">Payment History</h6>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($installments as $installment)
                    <tr>
                        <td>{{ $installment->payment_date->format('d M Y') }}</td>
                        <td>{{ $installment->amount_formatted }}</td>
                        <td>{!! $installment->payment_method_badge !!}</td>
                        <td>{{ $installment->description ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
