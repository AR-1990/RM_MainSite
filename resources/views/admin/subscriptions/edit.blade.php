@extends('admin.layout.app')

@section('title', 'Edit Subscription')

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/ionicons/css/ionicons.min.css') }}">
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Subscription</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Subscription Details</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.subscriptions.update', $subscription) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $subscription->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="source">Source</label>
                                        <select id="source" name="source" class="form-control @error('source') is-invalid @enderror">
                                            <option value="">Select Source</option>
                                            <option value="newsletter" {{ old('source', $subscription->source) == 'newsletter' ? 'selected' : '' }}>Newsletter</option>
                                            <option value="contact_form" {{ old('source', $subscription->source) == 'contact_form' ? 'selected' : '' }}>Contact Form</option>
                                            <option value="website" {{ old('source', $subscription->source) == 'website' ? 'selected' : '' }}>Website</option>
                                            <option value="referral" {{ old('source', $subscription->source) == 'referral' ? 'selected' : '' }}>Referral</option>
                                            <option value="social_media" {{ old('source', $subscription->source) == 'social_media' ? 'selected' : '' }}>Social Media</option>
                                            <option value="manual" {{ old('source', $subscription->source) == 'manual' ? 'selected' : '' }}>Manual Entry</option>
                                            <option value="other" {{ old('source', $subscription->source) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('source')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea id="notes" name="notes" class="form-control @error('notes') is-invalid @enderror" rows="4" placeholder="Any additional notes about this subscription...">{{ old('notes', $subscription->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subscription Status</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $subscription->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Active Subscription</label>
                                        </div>
                                        <small class="form-text text-muted">Uncheck this to deactivate the subscription.</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subscription Information</label>
                                        <div class="form-text">
                                            <strong>Subscribed:</strong> {{ $subscription->subscribed_at->format('M d, Y H:i') }}<br>
                                            @if($subscription->unsubscribed_at)
                                                <strong>Unsubscribed:</strong> {{ $subscription->unsubscribed_at->format('M d, Y H:i') }}<br>
                                            @endif
                                            <strong>Duration:</strong> {{ $subscription->duration_in_days }} days
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ion-checkmark"></i> Update Subscription
                                </button>
                                <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-secondary">
                                    <i class="ion-arrow-left"></i> Cancel
                                </a>
                                <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="btn btn-info">
                                    <i class="ion-eye"></i> View Details
                                </a>
                            </div>
                        </form>
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
    // Form validation
    const form = document.querySelector('form');
    const emailInput = document.getElementById('email');
    
    form.addEventListener('submit', function(e) {
        if (!emailInput.value.trim()) {
            e.preventDefault();
            emailInput.focus();
            alert('Please enter an email address.');
            return false;
        }
        
        // Basic email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            e.preventDefault();
            emailInput.focus();
            alert('Please enter a valid email address.');
            return false;
        }
    });
    
    // Auto-focus on email input
    emailInput.focus();
});
</script>
@endpush
