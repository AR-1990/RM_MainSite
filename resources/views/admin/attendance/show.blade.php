@extends('admin.layout.app')

@section('title', 'Attendance Record Details')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Attendance Record Details</h3>
                <p class="text-subtitle text-muted">View detailed information about the attendance record</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Record Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Attendance Information</h4>
                        <div>
                            <a href="{{ route('admin.attendance.edit', $attendanceRecord->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Record
                            </a>
                            <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">Basic Information</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Employee:</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <img src="{{ url('images/avatar/account.jpg') }}" alt="Avatar">
                                            </div>
                                            <div>
                                                <strong>{{ $attendanceRecord->user->name ?? 'N/A' }}</strong>
                                                <br><small class="text-muted">{{ $attendanceRecord->user->email ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Date:</strong></td>
                                    <td>
                                        <span class="badge bg-primary">{{ $attendanceRecord->formatted_date }}</span>
                                        @if($attendanceRecord->is_late)
                                            <br><small class="text-warning">Late arrival</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="{{ $attendanceRecord->status_badge_class }}">
                                            {{ ucfirst(str_replace('_', ' ', $attendanceRecord->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Work Type:</strong></td>
                                    <td>
                                        <span class="{{ $attendanceRecord->work_type_badge_class }}">
                                            {{ ucfirst($attendanceRecord->work_type) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Approval:</strong></td>
                                    <td>
                                        @if($attendanceRecord->is_approved)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> Approved
                                            </span>
                                            <br><small class="text-muted">
                                                by {{ $attendanceRecord->approver->name ?? 'N/A' }} 
                                                on {{ $attendanceRecord->approved_at ? $attendanceRecord->approved_at->format('d M Y H:i') : 'N/A' }}
                                            </small>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock"></i> Pending Approval
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Time Information -->
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">Time Details</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Check In:</strong></td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $attendanceRecord->formatted_check_in_time }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Check Out:</strong></td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $attendanceRecord->formatted_check_out_time }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Total Hours:</strong></td>
                                    <td>
                                        <strong>{{ $attendanceRecord->formatted_total_hours }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Break Start:</strong></td>
                                    <td>
                                        @if($attendanceRecord->break_start_time)
                                            <span class="badge bg-info">{{ $attendanceRecord->break_start_time->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">No break</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Break End:</strong></td>
                                    <td>
                                        @if($attendanceRecord->break_end_time)
                                            <span class="badge bg-info">{{ $attendanceRecord->break_end_time->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">No break</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Break Hours:</strong></td>
                                    <td>
                                        @if($attendanceRecord->break_hours > 0)
                                            <span class="text-info">{{ $attendanceRecord->break_hours }} hours</span>
                                        @else
                                            <span class="text-muted">No break</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Outdoor Work Details -->
                    @if($attendanceRecord->isOutdoorWork())
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <h5 class="text-primary mb-3">Outdoor Work Details</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><strong>Location:</strong></label>
                                            <p class="form-control-static">
                                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                {{ $attendanceRecord->location ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"><strong>Work Description:</strong></label>
                                            <p class="form-control-static">
                                                {{ $attendanceRecord->work_description ?? 'No description provided' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Comments -->
                    @if($attendanceRecord->hasComments())
                        <div class="row mt-4">
                            <div class="col-12">
                                <hr>
                                <h5 class="text-primary mb-3">Comments</h5>
                                <div class="alert alert-info">
                                    <i class="fas fa-comment me-2"></i>
                                    {{ $attendanceRecord->comments }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-success" onclick="toggleApproval({{ $attendanceRecord->id }})">
                                        @if($attendanceRecord->is_approved)
                                            <i class="fas fa-times"></i> Remove Approval
                                        @else
                                            <i class="fas fa-check"></i> Approve Record
                                        @endif
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger" onclick="deleteRecord({{ $attendanceRecord->id }})">
                                        <i class="fas fa-trash"></i> Delete Record
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
// Toggle approval
function toggleApproval(recordId) {
    $.ajax({
        url: `/admin/attendance/${recordId}/toggle-approval`,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                iziToast.success({
                    title: 'Success',
                    message: response.message,
                    position: 'topRight'
                });
                
                // Reload page to show updated data
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                iziToast.error({
                    title: 'Error',
                    message: response.message,
                    position: 'topRight'
                });
            }
        },
        error: function(xhr) {
            let message = 'An error occurred while toggling approval.';
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
}

// Delete record
function deleteRecord(recordId) {
    if (confirm('Are you sure you want to delete this attendance record? This action cannot be undone.')) {
        $.ajax({
            url: `/admin/attendance/${recordId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });
                    
                    // Redirect to index page after success
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.attendance.index") }}';
                    }, 1500);
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            },
            error: function(xhr) {
                let message = 'An error occurred while deleting the record.';
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
    }
}
</script>
@endpush
