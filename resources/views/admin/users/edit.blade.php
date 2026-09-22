@extends('admin.layout.app')

@section('title', 'Edit User')

@section('content')
@php
    $roles = !empty($roles ?? []) ? $roles : ['user', 'agent', 'admin'];
    $departments = !empty($departments ?? []) ? $departments : ['Sales', 'Marketing', 'HR', 'Finance', 'IT', 'Operations', 'Customer Service'];
    $designations = !empty($designations ?? []) ? $designations : ['Manager', 'Senior Executive', 'Executive', 'Assistant', 'Intern'];
@endphp
<section class="section">
    <div class="section-header">
        <h1>Edit User: {{ $user->name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit User Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Basic Information</h6>
                                    
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                                    {{ ucfirst($role) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Profile Information -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Profile Information</h6>
                                    
                                    <div class="form-group">
                                        <label for="profile_picture">Profile Picture</label>
                                        @if($user->profile?->profile_picture)
                                            <div class="mb-2">
                                                <img src="{{ url('' . $user->profile_picture_url) }}" alt="Current Profile Picture" 
                                                     class="img-thumbnail" style="max-width: 100px;">
                                                <small class="d-block text-muted">Current picture</small>
                                            </div>
                                        @endif
                                        <input type="file" id="profile_picture" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror" 
                                               accept="image/*">
                                        <small class="form-text text-muted">Max size: 2MB. Supported formats: JPG, PNG, GIF</small>
                                        @error('profile_picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone', $user->profile?->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="employee_id">Employee ID</label>
                                        <input type="text" id="employee_id" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" 
                                               value="{{ old('employee_id', $user->profile?->employee_id) }}">
                                        @error('employee_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select id="department" name="department" class="form-control @error('department') is-invalid @enderror">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept }}" {{ old('department', $user->profile?->department) == $dept ? 'selected' : '' }}>
                                                    {{ $dept }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <select id="designation" name="designation" class="form-control @error('designation') is-invalid @enderror">
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $desig)
                                                <option value="{{ $desig }}" {{ old('designation', $user->profile?->designation) == $desig ? 'selected' : '' }}>
                                                    {{ $desig }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('designation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Employment Details -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Employment Details</h6>
                                    
                                    <div class="form-group">
                                        <label for="date_of_joining">Date of Joining</label>
                                        <input type="date" id="date_of_joining" name="date_of_joining" class="form-control @error('date_of_joining') is-invalid @enderror" 
                                               value="{{ old('date_of_joining', $user->profile?->date_of_joining?->format('Y-m-d')) }}">
                                        @error('date_of_joining')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="basic_salary">Basic Salary (₹)</label>
                                        <input type="number" id="basic_salary" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" 
                                               value="{{ old('basic_salary', $user->profile?->basic_salary) }}" min="0" step="0.01">
                                        @error('basic_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="allowances">Allowances (₹)</label>
                                        <input type="number" id="allowances" name="allowances" class="form-control @error('allowances') is-invalid @enderror" 
                                               value="{{ old('allowances', $user->profile?->allowances) }}" min="0" step="0.01">
                                        @error('allowances')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Total Salary (₹)</label>
                                        <input type="text" id="total_salary" class="form-control" readonly>
                                        <small class="form-text text-muted">Automatically calculated</small>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Additional Information</h6>
                                    
                                    <div class="form-group">
                                        <label for="skills">Skills</label>
                                        <textarea id="skills" name="skills" class="form-control @error('skills') is-invalid @enderror" 
                                                  rows="3" placeholder="Enter skills separated by commas">{{ old('skills', $user->profile?->skills) }}</textarea>
                                        @error('skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="experience_summary">Experience Summary</label>
                                        <textarea id="experience_summary" name="experience_summary" class="form-control @error('experience_summary') is-invalid @enderror" 
                                                  rows="3" placeholder="Brief summary of work experience">{{ old('experience_summary', $user->profile?->experience_summary) }}</textarea>
                                        @error('experience_summary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text" id="education" name="education" class="form-control @error('education') is-invalid @enderror" 
                                               value="{{ old('education', $user->profile?->education) }}" placeholder="Highest education qualification">
                                        @error('education')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="certifications">Certifications</label>
                                        <input type="text" id="certifications" name="certifications" class="form-control @error('certifications') is-invalid @enderror" 
                                               value="{{ old('certifications', $user->profile?->certifications) }}" placeholder="Professional certifications">
                                        @error('certifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Address Information -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Address Information</h6>
                                    
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" 
                                                  rows="3" placeholder="Full address">{{ old('address', $user->profile?->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" 
                                               value="{{ old('city', $user->profile?->city) }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" id="state" name="state" class="form-control @error('state') is-invalid @enderror" 
                                               value="{{ old('state', $user->profile?->state) }}">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" id="country" name="country" class="form-control @error('country') is-invalid @enderror" 
                                               value="{{ old('country', $user->profile?->country) }}">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" id="postal_code" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" 
                                               value="{{ old('postal_code', $user->profile?->postal_code) }}">
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Banking & Documents -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Banking & Documents</h6>
                                    
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" id="bank_name" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" 
                                               value="{{ old('bank_name', $user->profile?->bank_name) }}">
                                        @error('bank_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="bank_account_number">Bank Account Number</label>
                                        <input type="text" id="bank_account_number" name="bank_account_number" class="form-control @error('bank_account_number') is-invalid @enderror" 
                                               value="{{ old('bank_account_number', $user->profile?->bank_account_number) }}">
                                        @error('bank_account_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="ifsc_code">IFSC Code</label>
                                        <input type="text" id="ifsc_code" name="ifsc_code" class="form-control @error('ifsc_code') is-invalid @enderror" 
                                               value="{{ old('ifsc_code', $user->profile?->ifsc_code) }}">
                                        @error('ifsc_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pan_number">PAN Number</label>
                                        <input type="text" id="pan_number" name="pan_number" class="form-control @error('pan_number') is-invalid @enderror" 
                                               value="{{ old('pan_number', $user->profile?->pan_number) }}">
                                        @error('pan_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="aadhar_number">Aadhar Number</label>
                                        <input type="text" id="aadhar_number" name="aadhar_number" class="form-control @error('aadhar_number') is-invalid @enderror" 
                                               value="{{ old('aadhar_number', $user->profile?->aadhar_number) }}">
                                        @error('aadhar_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update User
                                        </button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Back to Users
                                        </a>
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                                            <i class="fas fa-eye"></i> View User
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
$(document).ready(function() {
    ['#role', '#department', '#designation'].forEach(function(selector) {
        if ($(selector).hasClass('select2-hidden-accessible')) {
            $(selector).select2('destroy');
        }
        $(selector).next('.select2-container').remove();
    });

    // Calculate total salary
    function calculateTotalSalary() {
        var basicSalary = parseFloat($('#basic_salary').val()) || 0;
        var allowances = parseFloat($('#allowances').val()) || 0;
        var total = basicSalary + allowances;
        $('#total_salary').val('₹' + total.toFixed(2));
    }

    $('#basic_salary, #allowances').on('input', calculateTotalSalary);

    // Initialize total salary on page load
    calculateTotalSalary();

    // Profile picture preview
    $('#profile_picture').on('change', function() {
        var file = this.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2MB
                alert('File size must be less than 2MB');
                this.value = '';
                return;
            }
            
            var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid image file (JPG, PNG, GIF)');
                this.value = '';
                return;
            }
        }
    });
});
</script>
@endpush
