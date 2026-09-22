@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>My Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Profile Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img alt="image" src="{{ url('' . auth()->user()->profile_picture_url) }}" 
                             class="rounded-circle" width="120" style="border: 3px solid #6777ef;">
                        <h4 class="mt-3">{{ auth()->user()->name }}</h4>
                        <p class="text-muted">{{ auth()->user()->designation }}</p>
                        
                        <div class="mb-3">
                            {!! auth()->user()->role_badge !!}
                            {!! auth()->user()->status_badge !!}
                        </div>

                        <div class="row text-center">
                            <div class="col-6">
                                <h6 class="text-primary">{{ auth()->user()->assignedLeads()->count() }}</h6>
                                <small class="text-muted">My Leads</small>
                            </div>
                            <div class="col-6">
                                <h6 class="text-success">{{ auth()->user()->attendanceRecords()->count() }}</h6>
                                <small class="text-muted">Attendance</small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProfileModal">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="card">
                    <div class="card-header">
                        <h4>Quick Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-primary">{{ auth()->user()->workloadTasks()->count() }}</h6>
                                    <small class="text-muted">My Tasks</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-info">{{ auth()->user()->profile?->date_of_joining?->diffForHumans() ?? 'N/A' }}</h6>
                                    <small class="text-muted">Joined</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-md-8">
                <!-- Basic Information -->
                <div class="card">
                    <div class="card-header">
                        <h4>Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Email:</td>
                                        <td>{{ auth()->user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Phone:</td>
                                        <td>{{ auth()->user()->profile?->phone ?? 'Not provided' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Employee ID:</td>
                                        <td>{{ auth()->user()->profile?->employee_id ?? 'Not assigned' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Department:</td>
                                        <td>{{ auth()->user()->department }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Designation:</td>
                                        <td>{{ auth()->user()->designation }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Date of Joining:</td>
                                        <td>{{ auth()->user()->date_of_joining }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Portal Access:</td>
                                        <td>
                                            @if(auth()->user()->profile?->is_portal_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Last Login:</td>
                                        <td>{{ auth()->user()->profile?->last_login_at?->diffForHumans() ?? 'Never' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary Information -->
                @if(auth()->user()->profile?->basic_salary)
                <div class="card">
                    <div class="card-header">
                        <h4>Salary Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-primary">₹{{ number_format(auth()->user()->profile->basic_salary, 2) }}</h6>
                                    <small class="text-muted">Basic Salary</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-success">₹{{ number_format(auth()->user()->profile->allowances, 2) }}</h6>
                                    <small class="text-muted">Allowances</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-info">{{ auth()->user()->salary_formatted }}</h6>
                                    <small class="text-muted">Total Salary</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Address Information -->
                @if(auth()->user()->profile?->address || auth()->user()->profile?->city)
                <div class="card">
                    <div class="card-header">
                        <h4>Address Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Address:</strong> {{ auth()->user()->profile?->full_address ?? 'Not provided' }}</p>
                    </div>
                </div>
                @endif

                <!-- Skills & Experience -->
                @if(auth()->user()->profile?->skills || auth()->user()->profile?->experience_summary)
                <div class="card">
                    <div class="card-header">
                        <h4>Skills & Experience</h4>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->profile?->skills)
                        <div class="mb-3">
                            <strong>Skills:</strong>
                            <p>{{ auth()->user()->profile->skills }}</p>
                        </div>
                        @endif
                        
                        @if(auth()->user()->profile?->experience_summary)
                        <div class="mb-3">
                            <strong>Experience Summary:</strong>
                            <p>{{ auth()->user()->profile->experience_summary }}</p>
                        </div>
                        @endif
                        
                        @if(auth()->user()->profile?->education)
                        <div class="mb-3">
                            <strong>Education:</strong>
                            <p>{{ auth()->user()->profile->education }}</p>
                        </div>
                        @endif
                        
                        @if(auth()->user()->profile?->certifications)
                        <div class="mb-3">
                            <strong>Certifications:</strong>
                            <p>{{ auth()->user()->profile->certifications }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="editProfileForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ auth()->user()->profile?->phone }}">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ auth()->user()->profile?->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ auth()->user()->profile?->city }}">
                            </div>
                            <div class="form-group">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="{{ auth()->user()->profile?->state }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="{{ auth()->user()->profile?->country }}">
                            </div>
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" value="{{ auth()->user()->profile?->postal_code }}">
                            </div>
                            <div class="form-group">
                                <label>Skills</label>
                                <textarea name="skills" class="form-control" rows="3" placeholder="Enter skills separated by commas">{{ auth()->user()->profile?->skills }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Experience Summary</label>
                                <textarea name="experience_summary" class="form-control" rows="3">{{ auth()->user()->profile?->experience_summary }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Edit Profile Form Submission
    $('#editProfileForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '{{ route("user.profile.update") }}',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Profile updated successfully!',
                        position: 'topRight'
                    });
                    
                    // Reload page to show updated information
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr) {
                var message = 'An error occurred';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                iziToast.error({
                    title: 'Error',
                    message: message,
                    position: 'topRight'
                });
            }
        });
    });
});
</script>
@endpush
