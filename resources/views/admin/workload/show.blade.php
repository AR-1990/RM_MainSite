@extends('admin.layout.app')

@section('title', 'Task Details')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Task Details</h3>
                <p class="text-subtitle text-muted">View detailed information about the task</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.workload.index') }}">Workload Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Task Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <!-- Task Information -->
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $task->title }}</h4>
                    <div class="d-flex gap-2">
                        <span class="badge bg-{{ $task->priority_badge_class }}">{{ ucfirst($task->priority) }}</span>
                        <span class="badge bg-{{ $task->status_badge_class }}">{{ ucfirst($task->status) }}</span>
                        @if($task->is_recurring)
                            <span class="badge bg-info">Recurring</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Start Date:</strong> 
                            @if($task->start_date)
                                @if($task->start_date instanceof \Carbon\Carbon)
                                    {{ $task->start_date->format('M d, Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}
                                @endif
                            @else
                                Not set
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Due Date:</strong> 
                            @if($task->due_date)
                                <span class="{{ $task->is_overdue ? 'text-danger' : '' }}">
                                    @if($task->due_date instanceof \Carbon\Carbon)
                                        {{ $task->due_date->format('M d, Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                    @endif
                                    @if($task->is_overdue)
                                        (Overdue by {{ $task->days_until_due }} days)
                                    @endif
                                </span>
                            @else
                                Not set
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Frequency:</strong> {{ $task->frequency_text }}
                        </div>
                        <div class="col-md-6">
                            <strong>Reminder Time:</strong> 
                            @if($task->reminder_time)
                                @if($task->reminder_time instanceof \Carbon\Carbon)
                                    {{ $task->reminder_time->format('H:i') }}
                                @else
                                    {{ $task->reminder_time }}
                                @endif
                            @else
                                Not set
                            @endif
                        </div>
                    </div>

                    @if($task->description)
                        <div class="mb-3">
                            <strong>Description:</strong>
                            <div class="mt-2 p-3 bg-light rounded">
                                {!! $task->description !!}
                            </div>
                        </div>
                    @endif

                    @if($task->is_recurring)
                        <div class="mb-3">
                            <strong>Recurring Interval:</strong> {{ $task->recurring_interval }}
                            @if($task->next_reminder_date)
                                <br><small class="text-muted">Next reminder: 
                                    @if($task->next_reminder_date instanceof \Carbon\Carbon)
                                        {{ $task->next_reminder_date->format('M d, Y H:i') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($task->next_reminder_date)->format('M d, Y H:i') }}
                                    @endif
                                </small>
                            @endif
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.workload.edit', $task->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Task
                        </a>
                        <button type="button" class="btn btn-{{ $task->status === 'completed' ? 'warning' : 'success' }}" 
                                onclick="toggleTaskStatus({{ $task->id }})">
                            @if($task->status === 'completed')
                                <i class="bi bi-arrow-clockwise"></i> Mark In Progress
                            @else
                                <i class="bi bi-check-circle"></i> Mark Completed
                            @endif
                        </button>

                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Comments & Notes</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form id="commentForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <textarea class="form-control" id="commentText" rows="3" placeholder="Add a comment or note..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="commentType" class="form-label">Comment Type</label>
                                        <select class="form-select" id="commentType" required>
                                            <option value="">Select type...</option>
                                            <option value="comment">Comment</option>
                                            <option value="update">Update</option>
                                            <option value="reminder">Reminder</option>
                                            <option value="note">Note</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="isInternal">
                                        <label class="form-check-label" for="isInternal">
                                            Internal Note
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Add Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="commentsList">
                        @forelse($task->comments()->orderBy('created_at', 'desc')->get() as $comment)
                            <div class="comment-item border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>{{ $comment->user->name }}</strong>
                                        <span class="badge bg-{{ $comment->type_badge_class }} ms-2">{{ ucfirst($comment->type) }}</span>
                                        @if($comment->is_internal)
                                            <span class="badge bg-secondary ms-1">Internal</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ $comment->time_ago }}</small>
                                </div>
                                <div class="mt-2">
                                    {!! $comment->formatted_comment !!}
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No comments yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Audit Trail Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Audit Trail</h5>
                    <small class="text-muted">Complete history of all changes made to this task</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date/Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($task->auditLogs()->with('user')->orderBy('created_at', 'desc')->get() as $log)
                                    <tr>
                                        <td>
                                            <small class="text-muted">{{ $log->created_at->format('M d, Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $log->user->name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $log->action === 'created' ? 'success' : ($log->action === 'updated' ? 'info' : 'warning') }}">
                                                {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small>{{ $log->formatted_change }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No audit logs found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <!-- Assigned Users -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Assigned Users</h5>
                </div>
                <div class="card-body">
                    @forelse($task->assignments as $assignment)
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar avatar-sm me-3">
                                <img src="{{ url('' . $assignment->user->profile_photo_url) ?? url('assets-admin/img/avatar.png') }}" 
                                     alt="{{ $assignment->user->name }}" class="rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $assignment->user->name }}</h6>
                                <small class="text-muted">{{ ucfirst($assignment->role) }}</small>
                            </div>
                            <span class="badge bg-{{ $assignment->status_badge_class }}">{{ ucfirst($assignment->status) }}</span>
                        </div>
                    @empty
                        <p class="text-muted">No users assigned.</p>
                    @endforelse
                </div>
            </div>

            <!-- Attachments -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Attachments</h5>
                </div>
                <div class="card-body">
                    @forelse($task->attachments as $attachment)
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="bi {{ $attachment->file_icon }} fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $attachment->original_name }}</h6>
                                <small class="text-muted">{{ $attachment->file_size_formatted }}</small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-primary" title="View File">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('admin.workload.download-attachment', $attachment->id) }}" class="btn btn-success" title="Download File">
                                    <i class="bi bi-download me-1"></i> Download
                                </a>
                                <button type="button" class="btn btn-danger" 
                                        onclick="deleteAttachment({{ $attachment->id }})" title="Delete File">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No attachments.</p>
                    @endforelse
                </div>
            </div>

            <!-- Reminders -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">Reminders</h5>
                </div>
                <div class="card-body">
                    @forelse($task->reminders as $reminder)
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="bi bi-bell fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ ucfirst($reminder->type) }}</h6>
                                <small class="text-muted">{{ $reminder->reminder_time->format('H:i') }}</small>
                            </div>
                            <span class="badge bg-{{ $reminder->is_sent ? 'success' : 'warning' }}">
                                {{ $reminder->is_sent ? 'Sent' : 'Pending' }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted">No reminders set.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')
<script>
let taskId = {{ $task->id }};

// Toggle task status
function toggleTaskStatus(taskId) {
    console.log('Toggling status for task:', taskId);
    $.ajax({
        url: `/admin/workload/${taskId}/toggle-status`,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log('Toggle status success:', response);
            if (response.success) {
                iziToast.success({
                    title: 'Success',
                    message: response.message,
                    position: 'topRight'
                });
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                iziToast.error({
                    title: 'Error',
                    message: response.message || 'Failed to update status',
                    position: 'topRight'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('Toggle status error:', { xhr, status, error });
            iziToast.error({
                title: 'Error',
                message: 'Failed to update status: ' + (xhr.responseJSON?.message || error),
                position: 'topRight'
            });
        }
    });
}

// Add comment
$('#commentForm').on('submit', function(e) {
    e.preventDefault();
    
    const comment = $('#commentText').val().trim();
    const type = $('#commentType').val();
    const isInternal = $('#isInternal').is(':checked');
    
    console.log('Submitting comment:', { comment, type, isInternal, taskId });
    
    if (!comment) {
        iziToast.warning({
            title: 'Warning',
            message: 'Please enter a comment',
            position: 'topRight'
        });
        return;
    }
    
    if (!type) {
        iziToast.warning({
            title: 'Warning',
            message: 'Please select a comment type',
            position: 'topRight'
        });
        return;
    }
    
    // Prepare the data, ensuring is_internal is always sent
    const formData = {
        _token: '{{ csrf_token() }}',
        comment: comment,
        type: type,
        is_internal: isInternal ? 1 : 0
    };
    
    console.log('Form data being sent:', formData);
    
    $.ajax({
        url: `/admin/workload/${taskId}/add-comment`,
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Comment submission success:', response);
            if (response.success) {
                iziToast.success({
                    title: 'Success',
                    message: 'Comment added successfully',
                    position: 'topRight'
                });
                $('#commentText').val('');
                $('#commentType').val('');
                $('#isInternal').prop('checked', false);
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                iziToast.error({
                    title: 'Error',
                    message: response.message || 'Failed to add comment',
                    position: 'topRight'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('Comment submission error:', { xhr, status, error });
            iziToast.error({
                title: 'Error',
                message: 'Failed to add comment: ' + (xhr.responseJSON?.message || error),
                position: 'topRight'
            });
        }
    });
});

// Delete attachment
function deleteAttachment(attachmentId) {
    if (confirm('Are you sure you want to delete this attachment?')) {
        $.ajax({
            url: `/admin/workload/attachments/${attachmentId}`,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: 'Attachment deleted successfully',
                        position: 'topRight'
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message || 'Failed to delete attachment',
                        position: 'topRight'
                    });
                }
            },
            error: function() {
                iziToast.error({
                    title: 'Error',
                    message: 'Failed to delete attachment',
                    position: 'topRight'
                });
            }
        });
    }
}


</script>
@endpush
