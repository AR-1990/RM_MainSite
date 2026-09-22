@extends('admin.layout.app')

@section('title', 'Subscription Details')

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/ionicons/css/ionicons.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Subscription Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Subscription Information</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="btn btn-warning">
                                <i class="ion-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-secondary">
                                <i class="ion-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Email Address</label>
                                    <div class="form-control-plaintext">
                                        <i class="ion-ios-mail text-primary mr-2"></i>
                                        {{ $subscription->email }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Status</label>
                                    <div class="form-control-plaintext">
                                        <span class="badge {{ $subscription->status_badge_class }}">
                                            {{ $subscription->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Source</label>
                                    <div class="form-control-plaintext">
                                        <span class="badge badge-info">{{ ucfirst($subscription->source) }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Subscription ID</label>
                                    <div class="form-control-plaintext">
                                        #{{ $subscription->id }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Subscribed At</label>
                                    <div class="form-control-plaintext">
                                        <i class="ion-ios-calendar text-success mr-2"></i>
                                        {{ $subscription->subscribed_at->format('M d, Y H:i:s') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Duration</label>
                                    <div class="form-control-plaintext">
                                        <i class="ion-ios-time text-info mr-2"></i>
                                        {{ $subscription->duration_in_days }} days
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($subscription->unsubscribed_at)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Unsubscribed At</label>
                                    <div class="form-control-plaintext">
                                        <i class="ion-ios-close-circle text-danger mr-2"></i>
                                        {{ $subscription->unsubscribed_at->format('M d, Y H:i:s') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($subscription->notes)
                        <div class="form-group">
                            <label class="font-weight-bold">Notes</label>
                            <div class="form-control-plaintext">
                                <i class="ion-ios-document text-warning mr-2"></i>
                                {{ $subscription->notes }}
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="font-weight-bold">Created</label>
                            <div class="form-control-plaintext">
                                <i class="ion-ios-calendar-outline text-secondary mr-2"></i>
                                {{ $subscription->created_at->format('M d, Y H:i:s') }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Last Updated</label>
                            <div class="form-control-plaintext">
                                <i class="ion-ios-refresh text-secondary mr-2"></i>
                                {{ $subscription->updated_at->format('M d, Y H:i:s') }}
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Quick Actions</h5>
                                <div class="btn-group">
                                    @if($subscription->is_active)
                                        <form method="POST" action="{{ route('admin.subscriptions.toggle-status', $subscription) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure you want to deactivate this subscription?')">
                                                <i class="ion-close"></i> Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.subscriptions.toggle-status', $subscription) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to activate this subscription?')">
                                                <i class="ion-checkmark"></i> Activate
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.subscriptions.destroy', $subscription) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this subscription? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="ion-trash-a"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any additional JavaScript functionality here
    console.log('Subscription details page loaded');
});
</script>
@endpush
