@extends('admin.layout.app')

@section('title', 'Create New User')

@section('content')
@php
    $roles = !empty($roles ?? []) ? $roles : ['user', 'agent', 'admin'];
    $departments = !empty($departments ?? []) ? $departments : ['Sales', 'Marketing', 'HR', 'Finance', 'IT', 'Operations', 'Customer Service'];
    $designations = !empty($designations ?? []) ? $designations : ['Manager', 'Senior Executive', 'Executive', 'Assistant', 'Intern'];
@endphp
<section class="section">
    <div class="section-header">
        <h1>Create New User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h6 class="text-primary mb-3">Basic Information</h6>
                                    
                                    <div class="form-group">
                                        <label for="name">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                               required minlength="8">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required minlength="8">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role <span class="text-danger">*</span></label>
                                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
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
                                               value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="employee_id">Employee ID</label>
                                        <input type="text" id="employee_id" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" 
                                               value="{{ old('employee_id') }}">
                                        @error('employee_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select id="department" name="department" class="form-control @error('department') is-invalid @enderror">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>
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
                                                <option value="{{ $desig }}" {{ old('designation') == $desig ? 'selected' : '' }}>
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
                                               value="{{ old('date_of_joining') }}">
                                        @error('date_of_joining')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="basic_salary">Basic Salary (₹)</label>
                                        <input type="number" id="basic_salary" name="basic_salary" class="form-control @error('basic_salary') is-invalid @enderror" 
                                               value="{{ old('basic_salary') }}" min="0" step="0.01">
                                        @error('basic_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="allowances">Allowances (₹)</label>
                                        <input type="number" id="allowances" name="allowances" class="form-control @error('allowances') is-invalid @enderror" 
                                               value="{{ old('allowances') }}" min="0" step="0.01">
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
                                                  rows="3" placeholder="Enter skills separated by commas">{{ old('skills') }}</textarea>
                                        @error('skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="experience_summary">Experience Summary</label>
                                        <textarea id="experience_summary" name="experience_summary" class="form-control @error('experience_summary') is-invalid @enderror" 
                                                  rows="3" placeholder="Brief summary of work experience">{{ old('experience_summary') }}</textarea>
                                        @error('experience_summary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <input type="text" id="education" name="education" class="form-control @error('education') is-invalid @enderror" 
                                               value="{{ old('education') }}" placeholder="Highest education qualification">
                                        @error('education')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="certifications">Certifications</label>
                                        <input type="text" id="certifications" name="certifications" class="form-control @error('certifications') is-invalid @enderror" 
                                               value="{{ old('certifications') }}" placeholder="Professional certifications">
                                        @error('certifications')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="create_portal_account" name="create_portal_account" checked>
                                            <label class="custom-control-label" for="create_portal_account">
                                                Create portal account for this user
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Create User
                                        </button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Back to Users
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

    // Form validation
    $('form').on('submit', function(e) {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirmation').val();
        
        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Password and Confirm Password do not match!');
            return false;
        }
        
        if (password.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long!');
            return false;
        }
    });

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
