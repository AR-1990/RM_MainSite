@extends('admin.layout.app')

@section('title', 'Attendance Management')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Attendance Management</h3>
                <p class="text-subtitle text-muted">Manage employee attendance records with outdoor work support</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-users text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="totalRecords">0</h4>
                                <span class="text-muted small">Total Records</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-check-circle text-success" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="presentCount">0</h4>
                                <span class="text-muted small">Present</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-clock text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="lateCount">0</h4>
                                <span class="text-muted small">Late</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-times-circle text-danger" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="absentCount">0</h4>
                                <span class="text-muted small">Absent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-calendar-times text-secondary" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="leaveCount">0</h4>
                                <span class="text-muted small">Leave</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-hourglass-half text-info" style="font-size: 1.5rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h4 id="pendingApproval">0</h4>
                                <span class="text-muted small">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Filters & Actions</h4>
                </div>
                <div class="card-body">
                    <form id="filterForm" class="row g-3">
                        <div class="col-md-2">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-2">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date', now()->endOfMonth()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-2">
                            <label for="user_id" class="form-label">Employee</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">All Employees</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">All Status</option>
                                <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                                <option value="half_day" {{ request('status') == 'half_day' ? 'selected' : '' }}>Half Day</option>
                                <option value="outdoor" {{ request('status') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                <option value="leave" {{ request('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="work_type" class="form-label">Work Type</label>
                            <select class="form-select" id="work_type" name="work_type">
                                <option value="">All Types</option>
                                <option value="office" {{ request('work_type') == 'office' ? 'selected' : '' }}>Office</option>
                                <option value="outdoor" {{ request('work_type') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                <option value="remote" {{ request('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="meeting" {{ request('work_type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="late_filter" class="form-label">Late Status</label>
                            <select class="form-select" id="late_filter" name="late_filter">
                                <option value="">All</option>
                                <option value="late" {{ request('late_filter') == 'late' ? 'selected' : '' }}>Late Only</option>
                                <option value="on_time" {{ request('late_filter') == 'on_time' ? 'selected' : '' }}>On Time Only</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="is_approved" class="form-label">Approval</label>
                            <select class="form-select" id="is_approved" name="is_approved">
                                <option value="">All</option>
                                <option value="1" {{ request('is_approved') == '1' ? 'selected' : '' }}>Approved</option>
                                <option value="0" {{ request('is_approved') == '0' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-success" onclick="bulkAction('approve')">
                                    <i class="fas fa-check"></i> Approve Selected
                                </button>
                                <button type="button" class="btn btn-warning" onclick="bulkAction('status_change')">
                                    <i class="fas fa-edit"></i> Change Status
                                </button>
                                <button type="button" class="btn btn-danger" onclick="bulkAction('delete')">
                                    <i class="fas fa-trash"></i> Delete Selected
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Record
                            </a>
                            <a href="{{ route('admin.attendance.export') }}" class="btn btn-info">
                                <i class="fas fa-download"></i> Export Basic CSV
                            </a>
                            <a href="{{ route('admin.attendance.export-enhanced') }}" class="btn btn-success">
                                <i class="fas fa-file-csv"></i> Export Enhanced CSV
                            </a>
                            <button type="button" class="btn btn-warning" onclick="processLateCalculation()">
                                <i class="fas fa-calculator"></i> Process Late Calc
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Records Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Attendance Records</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="attendanceTable">
                            <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Status</th>
                                    <th>Work Type</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Late Status</th>
                                    <th>Total Hours</th>
                                    <th>Overtime</th>
                                    <th>Location</th>
                                    <th>Comments</th>
                                    <th>Approved</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendanceRecords as $record)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input record-checkbox" value="{{ $record->id }}">
                                        </td>
                                        <td>
                                            <strong>{{ $record->formatted_date }}</strong>
                                            @if($record->is_late)
                                                <br><small class="text-warning">Late</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <img src="{{ url('images/avatar/account.jpg') }}" alt="Avatar">
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.attendance.user-profile', $record->user->id) }}" 
                                                       class="text-decoration-none" 
                                                       title="View {{ $record->user->name }}'s attendance profile">
                                                        <strong>{{ $record->user->name ?? 'N/A' }}</strong>
                                                    </a>
                                                    <br><small class="text-muted">{{ $record->user->email ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="{{ $record->status_badge_class }}">
                                                {{ ucfirst(str_replace('_', ' ', $record->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="{{ $record->work_type_badge_class }}">
                                                {{ ucfirst($record->work_type) }}
                                            </span>
                                            @if($record->isOutdoorWork() && $record->hasLocation())
                                                <br><small class="text-info">{{ $record->location }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ $record->formatted_check_in_time }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ $record->formatted_check_out_time }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($record->status === 'absent' || $record->status === 'leave')
                                                <span class="badge bg-secondary">N/A</span>
                                            @else
                                                <span class="{{ $record->late_status_badge_class }}">
                                                    {{ $record->late_status }}
                                                </span>
                                                @if($record->is_late && $record->late_minutes)
                                                    <br><small class="text-muted">{{ $record->late_minutes }} min late</small>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $record->formatted_total_hours }}</strong>
                                            @if($record->break_hours > 0)
                                                <br><small class="text-muted">Break: {{ $record->break_hours }}h</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->overtime_hours > 0)
                                                <span class="badge bg-success">{{ $record->overtime_hours }}h OT</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->hasLocation())
                                                <span class="text-primary">{{ $record->location }}</span>
                                            @else
                                                <span class="text-muted">Office</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->hasComments())
                                                <span class="text-info" title="{{ $record->comments }}">
                                                    {{ Str::limit($record->comments, 30) }}
                                                </span>
                                            @else
                                                <span class="text-muted">No comments</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($record->is_approved)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check"></i> Approved
                                                </span>
                                                <br><small class="text-muted">
                                                    by {{ $record->approver->name ?? 'N/A' }}
                                                </small>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock"></i> Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.attendance.show', $record->id) }}" 
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.attendance.edit', $record->id) }}" 
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success" 
                                                        onclick="toggleApproval({{ $record->id }})" title="Toggle Approval">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" 
                                                        onclick="deleteRecord({{ $record->id }})" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <h5>No attendance records found</h5>
                                                <p>Start by adding attendance records for your employees.</p>
                                                <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Add First Record
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($attendanceRecords->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $attendanceRecords->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusChangeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newStatus" class="form-label">New Status</label>
                    <select class="form-select" id="newStatus">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                        <option value="late">Late</option>
                        <option value="half_day">Half Day</option>
                        <option value="outdoor">Outdoor</option>
                        <option value="leave">Leave</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="confirmStatusChange()">Change Status</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
let selectedRecords = [];
let currentBulkAction = '';

// Initialize DataTable
$(document).ready(function() {
    loadStats();
    
    // Select all checkbox
    $('#selectAll').change(function() {
        $('.record-checkbox').prop('checked', $(this).is(':checked'));
        updateSelectedRecords();
    });

    // Individual record checkboxes
    $(document).on('change', '.record-checkbox', function() {
        updateSelectedRecords();
        updateSelectAllState();
    });
});

// Update selected records array
function updateSelectedRecords() {
    selectedRecords = $('.record-checkbox:checked').map(function() {
        return $(this).val();
    }).get();
}

// Update select all checkbox state
function updateSelectAllState() {
    const totalRecords = $('.record-checkbox').length;
    const checkedRecords = $('.record-checkbox:checked').length;
    
    if (checkedRecords === 0) {
        $('#selectAll').prop('indeterminate', false).prop('checked', false);
    } else if (checkedRecords === totalRecords) {
        $('#selectAll').prop('indeterminate', false).prop('checked', true);
    } else {
        $('#selectAll').prop('indeterminate', true);
    }
}

// Bulk actions
function bulkAction(action) {
    if (selectedRecords.length === 0) {
        iziToast.error({
            title: 'Error',
            message: 'Please select at least one record.',
            position: 'topRight'
        });
        return;
    }

    currentBulkAction = action;

    switch (action) {
        case 'approve':
            if (confirm('Are you sure you want to approve ' + selectedRecords.length + ' selected records?')) {
                performBulkAction(action);
            }
            break;
        case 'delete':
            if (confirm('Are you sure you want to delete ' + selectedRecords.length + ' selected records? This action cannot be undone.')) {
                performBulkAction(action);
            }
            break;
        case 'status_change':
            $('#statusChangeModal').modal('show');
            break;
    }
}

// Confirm status change
function confirmStatusChange() {
    const newStatus = $('#newStatus').val();
    if (!newStatus) {
        iziToast.error({
            title: 'Error',
            message: 'Please select a new status.',
            position: 'topRight'
        });
        return;
    }

    $('#statusChangeModal').modal('hide');
    performBulkAction('status_change', { new_status: newStatus });
}

// Perform bulk action
function performBulkAction(action, additionalData = {}) {
    const data = {
        action: action,
        record_ids: selectedRecords,
        ...additionalData
    };

    $.ajax({
        url: '{{ route("admin.attendance.bulk-action") }}',
        type: 'POST',
        data: data,
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
            let message = 'An error occurred while performing the bulk action.';
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

// Load enhanced statistics
function loadEnhancedStats() {
    $.ajax({
        url: '{{ route("admin.attendance.enhanced-stats") }}',
        type: 'GET',
        data: $('#filterForm').serialize(),
        success: function(response) {
            if (response.success) {
                const stats = response.data;
                $('#totalRecords').text(stats.total_records);
                $('#presentCount').text(stats.status_counts.present || 0);
                $('#lateCount').text(stats.late_stats.total_late || 0);
                $('#absentCount').text(stats.status_counts.absent || 0);
                $('#leaveCount').text(stats.status_counts.leave || 0);
                $('#pendingApproval').text(stats.approval_stats[0] || 0);
            }
        },
        error: function() {
            console.log('Error loading enhanced statistics');
        }
    });
}

// Process late calculation for existing records
function processLateCalculation() {
    if (confirm('This will process late calculation for all existing attendance records. Continue?')) {
        $.ajax({
            url: '{{ route("admin.attendance.process-late-calculation") }}',
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
                let message = 'An error occurred while processing late calculation.';
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

// Filter form submission
$('#filterForm').submit(function(e) {
    e.preventDefault();
    loadEnhancedStats();
});

// Load enhanced stats on page load
$(document).ready(function() {
    loadEnhancedStats();
});
</script>
@endpush
