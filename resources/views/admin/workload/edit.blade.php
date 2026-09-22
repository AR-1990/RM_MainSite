@extends('admin.layout.app')

@section('title', 'Edit Task')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Task</h3>
                <p class="text-subtitle text-muted">Modify task information and assignments</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.workload.index') }}">Workload Management</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.workload.show', $task->id) }}">Task Details</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Task: {{ $task->title }}</h4>
                </div>
                <div class="card-body">
                    <form id="editTaskForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Task Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ $task->description }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority *</label>
                                            <select class="form-select" id="priority" name="priority" required>
                                                <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                                                <option value="urgent" {{ $task->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status *</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Timeline Section -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="bi bi-calendar-event"></i> Timeline Management
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="start_date" class="form-label">Start Date *</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" 
                                                           value="{{ $task->start_date ? ($task->start_date instanceof \Carbon\Carbon ? $task->start_date->format('Y-m-d') : \Carbon\Carbon::parse($task->start_date)->format('Y-m-d')) : '' }}" required>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="due_date" class="form-label">Due Date *</label>
                                                    <input type="date" class="form-control" id="due_date" name="due_date" 
                                                           value="{{ $task->due_date ? ($task->due_date instanceof \Carbon\Carbon ? $task->due_date->format('Y-m-d') : \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) : '' }}" required>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                                                                <div class="mb-3">
                                                    <label for="reminder_time" class="form-label">Reminder Time</label>
                                                    <input type="time" class="form-control" id="reminder_time" name="reminder_time"
                                                           value="{{ $task->formatted_reminder_time }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="frequency" class="form-label">Frequency *</label>
                                                    <select class="form-select" id="frequency" name="frequency" required>
                                                        <option value="one_time" {{ $task->frequency === 'one_time' ? 'selected' : '' }}>One Time</option>
                                                        <option value="daily" {{ $task->frequency === 'daily' ? 'selected' : '' }}>Daily</option>
                                                        <option value="weekly" {{ $task->frequency === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                                        <option value="monthly" {{ $task->frequency === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row" id="recurring-settings" style="display: {{ $task->frequency !== 'one_time' ? 'block' : 'none' }};">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="is_recurring" name="is_recurring" 
                                                               {{ $task->is_recurring ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_recurring">
                                                            Recurring Task
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="recurring_interval" class="form-label">Recurring Interval</label>
                                                    <input type="number" class="form-control" id="recurring_interval" name="recurring_interval" 
                                                           value="{{ $task->recurring_interval }}" min="1" 
                                                           placeholder="e.g., Every 2 weeks">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="next_reminder_date" class="form-label">Next Reminder Date</label>
                                                    <input type="date" class="form-control" id="next_reminder_date" name="next_reminder_date" 
                                                           value="{{ $task->next_reminder_date ? ($task->next_reminder_date instanceof \Carbon\Carbon ? $task->next_reminder_date->format('Y-m-d') : \Carbon\Carbon::parse($task->next_reminder_date)->format('Y-m-d')) : '' }}">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Timeline Preview -->
                                        <div class="mt-3 p-3 bg-light rounded">
                                            <h6 class="mb-2">Timeline Preview</h6>
                                            <div class="row text-center">
                                                <div class="col-md-3">
                                                    <div class="border rounded p-2">
                                                        <small class="text-muted d-block">Start</small>
                                                        <strong id="start-preview">
                                                            @if($task->start_date)
                                                                @if($task->start_date instanceof \Carbon\Carbon)
                                                                    {{ $task->start_date->format('M d, Y') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }}
                                                                @endif
                                                            @else
                                                                Not set
                                                            @endif
                                                        </strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="border rounded p-2">
                                                        <small class="text-muted d-block">Due</small>
                                                        <strong id="due-preview">
                                                            @if($task->due_date)
                                                                @if($task->due_date instanceof \Carbon\Carbon)
                                                                    {{ $task->due_date->format('M d, Y') }}
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                                                @endif
                                                            @else
                                                                Not set
                                                            @endif
                                                        </strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="border rounded p-2">
                                                        <small class="text-muted d-block">Reminder</small>
                                                        <strong id="reminder-preview">{{ $task->formatted_reminder_time ?? 'Not set' }}</strong>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="border rounded p-2">
                                                        <small class="text-muted d-block">Frequency</small>
                                                        <strong id="frequency-preview">{{ ucfirst($task->frequency) }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                               {{ $task->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Task is active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-md-4">
                                <!-- Assigned Users -->
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Assigned Users</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="assignedUsersList">
                                            @foreach($task->assignments as $assignment)
                                                <div class="assigned-user-item d-flex align-items-center mb-2 p-2 border rounded">
                                                    <div class="flex-grow-1">
                                                        <strong>{{ $assignment->user->name }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ ucfirst($assignment->role) }}</small>
                                                    </div>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                            onclick="removeAssignedUser(this, {{ $assignment->user_id }})">
                                                        <i class="bi bi-x"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="newUser" class="form-label">Add User</label>
                                            <select class="form-select" id="newUser">
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" data-name="{{ $user->name }}">
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="newUserRole" class="form-label">Role</label>
                                            <select class="form-select" id="newUserRole">
                                                <option value="assignee">Assignee</option>
                                                <option value="reviewer">Reviewer</option>
                                                <option value="supervisor">Supervisor</option>
                                            </select>
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100" onclick="addAssignedUser()">
                                            <i class="bi bi-plus"></i> Add User
                                        </button>
                                    </div>
                                </div>

                                <!-- Current Attachments -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title">Current Attachments</h6>
                                    </div>
                                    <div class="card-body">
                                        @forelse($task->attachments as $attachment)
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="me-2">
                                                    <i class="bi {{ $attachment->file_icon }}"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <small class="d-block">{{ $attachment->original_name }}</small>
                                                    <small class="text-muted">{{ $attachment->file_size_formatted }}</small>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="removeCurrentAttachment({{ $attachment->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        @empty
                                            <p class="text-muted small">No attachments</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- New Attachments -->
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h6 class="card-title">Add New Attachments</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple 
                                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.gif">
                                            <div class="form-text">Max file size: 10MB. Supported: PDF, DOC, XLS, Images</div>
                                        </div>
                                        
                                        <div id="attachmentPreview" class="mb-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Task
                            </button>
                            <a href="{{ route('admin.workload.show', $task->id) }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
let assignedUsers = [
    @foreach($task->assignments as $assignment)
        {
            user_id: {{ $assignment->user_id }},
            role: '{{ $assignment->role }}',
            name: '{{ $assignment->user->name }}'
        },
    @endforeach
];

let removedAttachments = [];

// Add assigned user
function addAssignedUser() {
    const userId = $('#newUser').val();
    const role = $('#newUserRole').val();
    const userName = $('#newUser option:selected').data('name');
    
    if (!userId) {
        iziToast.warning({
            title: 'Warning',
            message: 'Please select a user',
            position: 'topRight'
        });
        return;
    }
    
    // Check if user is already assigned
    if (assignedUsers.some(u => u.user_id == userId)) {
        iziToast.warning({
            title: 'Warning',
            message: 'User is already assigned to this task',
            position: 'topRight'
        });
        return;
    }
    
    const userItem = `
        <div class="assigned-user-item d-flex align-items-center mb-2 p-2 border rounded">
            <div class="flex-grow-1">
                <strong>${userName}</strong>
                <br>
                <small class="text-muted">${role.charAt(0).toUpperCase() + role.slice(1)}</small>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeAssignedUser(this, ${userId})">
                <i class="bi bi-x"></i>
            </button>
        </div>
    `;
    
    $('#assignedUsersList').append(userItem);
    assignedUsers.push({ user_id: userId, role: role, name: userName });
    
    $('#newUser').val('');
}

// Remove assigned user
function removeAssignedUser(button, userId) {
    assignedUsers = assignedUsers.filter(u => u.user_id != userId);
    $(button).closest('.assigned-user-item').remove();
}

// Remove current attachment
function removeCurrentAttachment(attachmentId) {
    if (confirm('Are you sure you want to remove this attachment?')) {
        removedAttachments.push(attachmentId);
        $(event.target).closest('.d-flex').remove();
    }
}

// File attachment preview
$('#attachments').on('change', function() {
    const files = this.files;
    const preview = $('#attachmentPreview');
    preview.empty();
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        
        const previewItem = `
            <div class="d-flex align-items-center mb-2 p-2 border rounded">
                <div class="me-2">
                    <i class="bi bi-file-earmark"></i>
                </div>
                <div class="flex-grow-1">
                    <small class="d-block">${file.name}</small>
                    <small class="text-muted">${fileSize} MB</small>
                </div>
            </div>
        `;
        
        preview.append(previewItem);
    }
});

// Timeline preview updates
function updateTimelinePreview() {
    const startDate = $('#start_date').val();
    const dueDate = $('#due_date').val();
    const reminderTime = $('#reminder_time').val();
    const frequency = $('#frequency').val();
    
    // Update start date preview
    if (startDate) {
        const start = new Date(startDate);
        $('#start-preview').text(start.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }));
    } else {
        $('#start-preview').text('Not set');
    }
    
    // Update due date preview
    if (dueDate) {
        const due = new Date(dueDate);
        $('#due-preview').text(due.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }));
    } else {
        $('#due-preview').text('Not set');
    }
    
    // Update reminder time preview
    if (reminderTime) {
        $('#reminder-preview').text(reminderTime);
    } else {
        $('#reminder-preview').text('Not set');
    }
    
    // Update frequency preview
    $('#frequency-preview').text(frequency.charAt(0).toUpperCase() + frequency.slice(1).replace('_', ' '));
    
    // Show/hide recurring settings
    if (frequency !== 'one_time') {
        $('#recurring-settings').show();
        $('#recurring_interval').prop('required', true);
    } else {
        $('#recurring-settings').hide();
        $('#recurring_interval').prop('required', false);
    }
}

// Bind timeline preview updates
$('#start_date, #due_date, #reminder_time, #frequency').on('change', updateTimelinePreview);

// Initialize timeline preview
updateTimelinePreview();

// Form validation
function validateForm() {
    let isValid = true;
    
    // Clear previous errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').empty();
    
    // Required fields
    const requiredFields = ['title', 'description', 'priority', 'status', 'start_date', 'due_date', 'frequency'];
    requiredFields.forEach(field => {
        const value = $(`#${field}`).val();
        if (!value || value.trim() === '') {
            $(`#${field}`).addClass('is-invalid');
            $(`#${field}`).siblings('.invalid-feedback').text('This field is required.');
            isValid = false;
        }
    });
    
    // Check if assigned users exist
    if (assignedUsers.length === 0) {
        iziToast.warning({
            title: 'Warning',
            message: 'At least one user must be assigned to the task',
            position: 'topRight'
        });
        isValid = false;
    }
    
    // Date validation
    const startDate = $('#start_date').val();
    const dueDate = $('#due_date').val();
    
    if (startDate && dueDate && startDate > dueDate) {
        $('#due_date').addClass('is-invalid');
        $('#due_date').siblings('.invalid-feedback').text('Due date must be after start date.');
        isValid = false;
    }
    
    return isValid;
}

// Form submission
$('#editTaskForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!validateForm()) {
        return;
    }
    
    // Prepare form data
    const formData = new FormData(this);
    
    // Add assigned users
    assignedUsers.forEach((user, index) => {
        formData.append(`assigned_users[${index}][user_id]`, user.user_id);
        formData.append(`assigned_users[${index}][role]`, user.role);
    });
    
    // Add removed attachments
    removedAttachments.forEach((attachmentId, index) => {
        formData.append(`removed_attachments[${index}]`, attachmentId);
    });
    
    // Submit form
    $.ajax({
        url: '{{ route("admin.workload.update", $task->id) }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                iziToast.success({
                    title: 'Success',
                    message: 'Task updated successfully',
                    position: 'topRight'
                });
                setTimeout(() => {
                    window.location.href = '{{ route("admin.workload.show", $task->id) }}';
                }, 1500);
            } else {
                if (response.errors) {
                    Object.keys(response.errors).forEach(field => {
                        const input = $(`#${field}`);
                        input.addClass('is-invalid');
                        input.siblings('.invalid-feedback').text(response.errors[field][0]);
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: response.message || 'Failed to update task',
                        position: 'topRight'
                    });
                }
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(field => {
                    const input = $(`#${field}`);
                    input.addClass('is-invalid');
                    input.siblings('.invalid-feedback').text(errors[field][0]);
                });
            } else {
                iziToast.error({
                    title: 'Error',
                    message: 'Failed to update task',
                    position: 'topRight'
                });
            }
        }
    });
});
</script>
@endpush
