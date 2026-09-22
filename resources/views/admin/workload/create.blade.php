@extends('admin.layout.app')

@section('title', 'Create Task')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create New Task</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.workload.index') }}">Workload Management</a></div>
                <div class="breadcrumb-item">Create Task</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Task Information</h4>
                    </div>
                    <div class="card-body">
                        <form id="create-task-form" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Task Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="priority">Priority <span class="text-danger">*</span></label>
                                        <select class="form-control" id="priority" name="priority" required>
                                            <option value="">Select Priority</option>
                                            <option value="low">Low</option>
                                            <option value="medium" selected>Medium</option>
                                            <option value="high">High</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="pending" selected>Pending</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Dates and Frequency -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="due_date">Due Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="frequency">Frequency <span class="text-danger">*</span></label>
                                        <select class="form-control" id="frequency" name="frequency" required>
                                            <option value="">Select Frequency</option>
                                            <option value="one_time" selected>One Time</option>
                                            <option value="daily">Daily</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recurring Settings -->
                            <div class="row" id="recurring-settings" style="display: none;">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_recurring" name="is_recurring" checked>
                                            <label class="form-check-label" for="is_recurring">
                                                Recurring Task
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="recurring_interval">Recurring Interval (days)</label>
                                        <input type="number" class="form-control" id="recurring_interval" name="recurring_interval" min="1" value="1">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reminder_time">Reminder Time</label>
                                        <input type="time" class="form-control" id="reminder_time" name="reminder_time">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Assignments -->
                            <div class="form-group">
                                <label>Assign Users <span class="text-danger">*</span></label>
                                <div id="user-assignments">
                                    <div class="row mb-2 user-assignment-row">
                                        <div class="col-md-5">
                                            <select class="form-control" name="assigned_users[0][user_id]" required>
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control" name="assigned_users[0][role]" required>
                                                <option value="">Select Role</option>
                                                <option value="assignee" selected>Assignee</option>
                                                <option value="reviewer">Reviewer</option>
                                                <option value="supervisor">Supervisor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger btn-sm remove-user" style="display: none;">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-sm" id="add-user">
                                    <i class="fas fa-plus"></i> Add Another User
                                </button>
                            </div>

                            <!-- File Attachments -->
                            <div class="form-group">
                                <label>File Attachments</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.txt,.zip,.rar">
                                    <label class="custom-file-label" for="attachments">Choose files (PDF, DOC, Images, etc.)</label>
                                </div>
                                <small class="form-text text-muted">
                                    Supported formats: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, JPG, PNG, GIF, TXT, ZIP, RAR (Max: 10MB each)
                                </small>
                                <div id="file-preview" class="mt-2"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save"></i> Create Task
                                </button>
                                <a href="{{ route('admin.workload.index') }}" class="btn btn-secondary btn-lg ml-2">
                                    <i class="fas fa-arrow-left"></i> Back to Tasks
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
$(document).ready(function() {
    // Set default dates
    const today = new Date();
    const nextWeek = new Date(today.getTime() + 7 * 24 * 60 * 60 * 1000);
    
    $('#start_date').val(today.toISOString().split('T')[0]);
    $('#due_date').val(nextWeek.toISOString().split('T')[0]);

    // Handle frequency change
    $('#frequency').change(function() {
        const frequency = $(this).val();
        if (frequency !== 'one_time') {
            $('#recurring-settings').show();
            $('#recurring_interval').prop('required', true);
        } else {
            $('#recurring-settings').hide();
            $('#recurring_interval').prop('required', false);
        }
    });

    // Handle user assignment addition
    let userIndex = 1;
    $('#add-user').click(function() {
        const newRow = `
            <div class="row mb-2 user-assignment-row">
                <div class="col-md-5">
                    <select class="form-control" name="assigned_users[${userIndex}][user_id]" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="assigned_users[${userIndex}][role]" required>
                        <option value="">Select Role</option>
                        <option value="assignee" selected>Assignee</option>
                        <option value="reviewer">Reviewer</option>
                        <option value="supervisor">Supervisor</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-sm remove-user">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;
        $('#user-assignments').append(newRow);
        userIndex++;
        
        // Show remove buttons for all rows except first
        $('.user-assignment-row').each(function(index) {
            if (index > 0) {
                $(this).find('.remove-user').show();
            }
        });
    });

    // Handle user assignment removal
    $(document).on('click', '.remove-user', function() {
        $(this).closest('.user-assignment-row').remove();
        
        // Hide remove button from first row if only one remains
        if ($('.user-assignment-row').length === 1) {
            $('.user-assignment-row').find('.remove-user').hide();
        }
    });

    // Handle file input change
    $('#attachments').change(function() {
        const files = this.files;
        const preview = $('#file-preview');
        preview.empty();
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            const fileIcon = getFileIcon(file.name);
            
            const fileItem = `
                <div class="alert alert-info d-flex align-items-center">
                    <i class="${fileIcon} mr-2"></i>
                    <div>
                        <strong>${file.name}</strong>
                        <br>
                        <small>Size: ${fileSize} MB</small>
                    </div>
                </div>
            `;
            preview.append(fileItem);
        }
        
        // Update custom file label
        if (files.length > 0) {
            $('.custom-file-label').text(files.length + ' file(s) selected');
        } else {
            $('.custom-file-label').text('Choose files (PDF, DOC, Images, etc.)');
        }
    });

    // Form submission
    $('#create-task-form').submit(function(e) {
        e.preventDefault();
        
        // Clear previous validation errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();
        
        const formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("admin.workload.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success!',
                        message: response.message,
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.href = response.redirect;
                    }, 1500);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(field) {
                        const input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        
                        // Handle array fields
                        if (field.includes('[')) {
                            const baseField = field.split('[')[0];
                            const index = field.match(/\[(\d+)\]/)[1];
                            const subField = field.match(/\[(\w+)\]/)[1];
                            
                            $(`[name="${baseField}[${index}][${subField}]"]`).addClass('is-invalid');
                            $(`[name="${baseField}[${index}][${subField}]"]`).siblings('.invalid-feedback').text(errors[field][0]);
                        } else {
                            input.siblings('.invalid-feedback').text(errors[field][0]);
                        }
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: 'An error occurred while creating the task',
                        position: 'topRight'
                    });
                }
            }
        });
    });
});

function getFileIcon(filename) {
    const ext = filename.split('.').pop().toLowerCase();
    
    if (['pdf'].includes(ext)) return 'fas fa-file-pdf text-danger';
    if (['doc', 'docx'].includes(ext)) return 'fas fa-file-word text-primary';
    if (['xls', 'xlsx'].includes(ext)) return 'fas fa-file-excel text-success';
    if (['ppt', 'pptx'].includes(ext)) return 'fas fa-file-powerpoint text-warning';
    if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) return 'fas fa-file-image text-info';
    if (['zip', 'rar'].includes(ext)) return 'fas fa-file-archive text-secondary';
    
    return 'fas fa-file text-muted';
}
</script>
@endpush
