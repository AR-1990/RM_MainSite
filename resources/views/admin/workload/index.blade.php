@extends('admin.layout.app')

@section('title', 'Workload Management')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Workload Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Workload Management</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Tasks</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['total_tasks'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pending</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['pending_tasks'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>In Progress</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['in_progress_tasks'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Completed</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['completed_tasks'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Overdue</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['overdue_tasks'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Due Today</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['due_today'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Due This Week</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['due_this_week'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Due This Month</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['due_this_month'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Tasks</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.workload.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create Task
                            </a>
                            <a href="{{ route('admin.workload.export') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Export
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="workload-table">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th>
                                        <th style="min-width: 200px;">Title</th>
                                        <th style="width: 80px;">Priority</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 80px;">Frequency</th>
                                        <th style="width: 120px;">Due Date</th>
                                        <th style="min-width: 150px;">Assigned Users</th>
                                        <th style="width: 100px;">Progress</th>
                                        <th style="width: 200px; min-width: 200px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td class="text-center">{{ $task->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    <div class="avatar">
                                                        <div class="avatar-title bg-light text-primary rounded-circle">
                                                            <i class="fas fa-tasks"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="font-weight-600 text-truncate" style="max-width: 180px;" title="{{ $task->title }}">
                                                        {{ $task->title }}
                                                    </div>
                                                    <div class="text-small text-muted text-truncate" style="max-width: 180px;" title="{{ strip_tags($task->description) }}">
                                                        {{ Str::limit(strip_tags($task->description), 40) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge {{ $task->priority_badge_class }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="badge {{ $task->status_badge_class }} mb-1">
                                                    {{ ucfirst($task->status) }}
                                                </span>
                                                @if($task->is_overdue)
                                                    <span class="badge badge-danger badge-sm">Overdue</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-info">
                                                {{ $task->frequency_text }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-small">
                                                <div class="font-weight-600">
                                                    @if($task->due_date instanceof \Carbon\Carbon)
                                                        {{ $task->due_date->format('M d, Y') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                    @endif
                                                </div>
                                                @if($task->days_until_due > 0)
                                                    <div class="text-success">{{ $task->days_until_due }} days left</div>
                                                @elseif($task->days_until_due < 0)
                                                    <div class="text-danger">{{ abs($task->days_until_due) }} days overdue</div>
                                                @else
                                                    <div class="text-warning">Due today</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @foreach($task->assignments->take(2) as $assignment)
                                                <div class="d-flex align-items-center mb-1">
                                                    <div class="avatar avatar-sm mr-2">
                                                        <div class="avatar-title bg-light text-primary rounded-circle">
                                                            {{ substr($assignment->user->name, 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="font-weight-600 text-truncate" style="max-width: 100px;" title="{{ $assignment->user->name }}">
                                                            {{ $assignment->user->name }}
                                                        </div>
                                                        <div class="text-small text-muted">{{ ucfirst($assignment->role) }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($task->assignments->count() > 2)
                                                <div class="text-muted text-small">
                                                    +{{ $task->assignments->count() - 2 }} more
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-{{ $task->progress_percentage == 100 ? 'success' : 'primary' }}" 
                                                     style="width: {{ $task->progress_percentage }}%"></div>
                                            </div>
                                            <div class="text-small text-muted mt-1">
                                                {{ $task->progress_percentage }}%
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-1">
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.workload.show', $task) }}" 
                                                       class="btn btn-sm btn-info flex-fill" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.workload.edit', $task) }}" 
                                                       class="btn btn-sm btn-warning flex-fill" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <button type="button" 
                                                            class="btn btn-sm btn-{{ $task->status === 'completed' ? 'warning' : 'success' }} flex-fill"
                                                            onclick="toggleTaskStatus({{ $task->id }})"
                                                            title="{{ $task->status === 'completed' ? 'Mark as Pending' : 'Mark as Completed' }}">
                                                        <i class="fas fa-{{ $task->status === 'completed' ? 'undo' : 'check' }}"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger flex-fill"
                                                            onclick="deleteTask({{ $task->id }})"
                                                            title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Custom styles for better table layout */
.table-responsive {
    overflow-x: auto;
    min-height: 400px;
}

#workload-table {
    min-width: 1200px; /* Ensure minimum width for all columns */
}

#workload-table th,
#workload-table td {
    vertical-align: middle;
    white-space: nowrap;
}

#workload-table td:nth-child(2), /* Title column */
#workload-table td:nth-child(7) { /* Assigned Users column */
    white-space: normal;
}

.btn-group .btn {
    margin: 0 1px;
}

.gap-1 {
    gap: 0.25rem;
}

.flex-fill {
    flex: 1 1 auto;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .table-responsive {
        font-size: 0.9rem;
    }
    
    #workload-table th,
    #workload-table td {
        padding: 0.5rem 0.25rem;
    }
}

@media (max-width: 768px) {
    .card-header-action {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .card-header-action .btn {
        width: 100%;
    }
}
</style>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Initialize DataTable with responsive features
    $('#workload-table').DataTable({
        "pageLength": 25,
        "order": [[5, "asc"]], // Sort by due date by default
        "responsive": true,
        "scrollX": true,
        "scrollCollapse": true,
        "autoWidth": false,
        "language": {
            "search": "Search tasks:",
            "lengthMenu": "Show _MENU_ tasks per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ tasks",
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": [8] }, // Actions column not sortable
            { "width": "50px", "targets": [0] }, // ID
            { "width": "200px", "targets": [1] }, // Title
            { "width": "80px", "targets": [2] }, // Priority
            { "width": "100px", "targets": [3] }, // Status
            { "width": "80px", "targets": [4] }, // Frequency
            { "width": "120px", "targets": [5] }, // Due Date
            { "width": "150px", "targets": [6] }, // Assigned Users
            { "width": "100px", "targets": [7] }, // Progress
            { "width": "200px", "targets": [8] }  // Actions
        ]
    });
});

function toggleTaskStatus(taskId) {
    $.ajax({
        url: `/admin/workload/${taskId}/toggle-status`,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                iziToast.success({
                    title: 'Success!',
                    message: response.message,
                    position: 'topRight'
                });
                setTimeout(function() {
                    location.reload();
                }, 1500);
            }
        },
        error: function() {
            iziToast.error({
                title: 'Error!',
                message: 'Failed to update task status',
                position: 'topRight'
            });
        }
    });
}

function deleteTask(taskId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/workload/${taskId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Success!',
                            message: response.message,
                            position: 'topRight'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Failed to delete task',
                        position: 'topRight'
                    });
                }
            });
        }
    });
}
</script>
@endpush
