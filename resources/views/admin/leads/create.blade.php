@extends('admin.layout.app')

@section('title', 'Create New Lead')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create New Lead</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-plus-circle"></i> Lead Information</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.leads.index') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-list"></i> View All Leads
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('admin.leads.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Basic Information Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="fas fa-info-circle text-primary"></i> Basic Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-label">Lead Title <span class="text-danger">*</span></label>
                                            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" 
                                                   value="{{ old('title') }}" required placeholder="Enter lead title">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="source" class="form-label">Source <span class="text-danger">*</span></label>
                                            <select id="source" name="source" class="form-control @error('source') is-invalid @enderror" required>
                                                <option value="">Select Source</option>
                                                <option value="contact_form" {{ old('source') == 'contact_form' ? 'selected' : '' }}>Contact Form</option>
                                                <option value="website" {{ old('source') == 'website' ? 'selected' : '' }}>Website</option>
                                                <option value="referral" {{ old('source') == 'referral' ? 'selected' : '' }}>Referral</option>
                                                <option value="social_media" {{ old('source') == 'social_media' ? 'selected' : '' }}>Social Media</option>
                                                <option value="cold_call" {{ old('source') == 'cold_call' ? 'selected' : '' }}>Cold Call</option>
                                                <option value="other" {{ old('source') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('source')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                            <select id="priority" name="priority" class="form-control @error('priority') is-invalid @enderror" required>
                                                <option value="">Select Priority</option>
                                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                                            </select>
                                            @error('priority')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company" class="form-label">Company</label>
                                            <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror" 
                                                   value="{{ old('company') }}" placeholder="Enter company name">
                                            @error('company')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea id="description" name="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                                                      placeholder="Enter lead description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="fas fa-address-book text-success"></i> Contact Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_name" class="form-label">Contact Name <span class="text-danger">*</span></label>
                                            <input type="text" id="contact_name" name="contact_name" class="form-control @error('contact_name') is-invalid @enderror" 
                                                   value="{{ old('contact_name') }}" required placeholder="Enter contact name">
                                            @error('contact_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_email" class="form-label">Contact Email <span class="text-danger">*</span></label>
                                            <input type="email" id="contact_email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" 
                                                   value="{{ old('contact_email') }}" required placeholder="Enter contact email">
                                            @error('contact_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="contact_phone" class="form-label">Contact Phone</label>
                                            <input type="tel" id="contact_phone" name="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" 
                                                   value="{{ old('contact_phone') }}" placeholder="Enter contact phone">
                                            @error('contact_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Financial & Assignment Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="fas fa-dollar-sign text-warning"></i> Financial & Assignment
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="value" class="form-label">Lead Value</label>
                                            <div class="input-group">
                                                <input type="number" id="value" name="value" class="form-control @error('value') is-invalid @enderror" 
                                                       value="{{ old('value') }}" step="0.01" min="0" placeholder="Enter lead value">
                                                <div class="input-group-append">
                                                    <select name="currency" class="form-control">
                                                        <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                        <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                        <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>CAD</option>
                                                        <option value="AUD" {{ old('currency') == 'AUD' ? 'selected' : '' }}>AUD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @error('value')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="expected_close_date" class="form-label">Expected Close Date</label>
                                            <input type="date" id="expected_close_date" name="expected_close_date" class="form-control @error('expected_close_date') is-invalid @enderror" 
                                                   value="{{ old('expected_close_date') }}" min="{{ date('Y-m-d') }}">
                                            @error('expected_close_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assigned_to" class="form-label">Assign To</label>
                                            <select id="assigned_to" name="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">
                                                <option value="">Unassigned</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('assigned_to')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notes" class="form-label">Notes</label>
                                            <textarea id="notes" name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror" 
                                                      placeholder="Enter additional notes">{{ old('notes') }}</textarea>
                                            @error('notes')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-section">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary btn-lg mr-2">
                                                <i class="fas fa-save"></i> Create Lead
                                            </button>
                                            <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary btn-lg">
                                                <i class="fas fa-arrow-left"></i> Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<style>
.form-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.section-title {
    color: #495057;
    margin-bottom: 1.5rem;
    font-weight: 600;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border-radius: 6px;
    border: 1px solid #d1d3e2;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.input-group-append .form-control {
    border-left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

.card-header-action {
    float: right;
}

@media (max-width: 768px) {
    .form-section {
        padding: 1rem;
    }
    
    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    
    .card-header-action {
        float: none;
        margin-top: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Use SweetAlert instead of basic alert
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill in all required fields.',
                        confirmButtonColor: '#007bff'
                    });
                } else {
                    alert('Please fill in all required fields.');
                }
            }
        });
    }

    // Real-time validation
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
            }
        }, 5000);
    });
});
</script>
@endpush
