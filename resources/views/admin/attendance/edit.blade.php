@extends('admin.layout.app')

@section('title', 'Edit Attendance Record')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Attendance Record</h3>
                <p class="text-subtitle text-muted">Modify an existing attendance record</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Record</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Attendance Information</h4>
                    <div class="alert alert-info mt-2">
                        <i class="fas fa-info-circle"></i>
                        <strong>Tip:</strong> You can save attendance records with minimal information and update them later. 
                        Use "Save as Draft" for incomplete records, or fill in all details and use "Update Attendance Record".
                    </div>
                </div>
                <div class="card-body">
                    <form id="attendanceEditForm" class="form">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Employee Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id" class="form-label">Employee <span class="text-danger">*</span></label>
                                    <select class="form-select" id="user_id" name="user_id" required>
                                        <option value="">Select Employee</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $attendanceRecord->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select an employee.</div>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date" name="date" 
                                           value="{{ $attendanceRecord->date->format('Y-m-d') }}" max="{{ today()->format('Y-m-d') }}" required>
                                    <div class="invalid-feedback">Please select a valid date.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="present" {{ $attendanceRecord->status == 'present' ? 'selected' : '' }}>Present</option>
                                        <option value="absent" {{ $attendanceRecord->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                        <option value="late" {{ $attendanceRecord->status == 'late' ? 'selected' : '' }}>Late</option>
                                        <option value="half_day" {{ $attendanceRecord->status == 'half_day' ? 'selected' : '' }}>Half Day</option>
                                        <option value="outdoor" {{ $attendanceRecord->status == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                        <option value="leave" {{ $attendanceRecord->status == 'leave' ? 'selected' : '' }}>Leave</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a status.</div>
                                </div>
                            </div>

                            <!-- Work Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_type" class="form-label">Work Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="work_type" name="work_type" required>
                                        <option value="">Select Work Type</option>
                                        <option value="office" {{ $attendanceRecord->work_type == 'office' ? 'selected' : '' }}>Office</option>
                                        <option value="outdoor" {{ $attendanceRecord->status == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                        <option value="remote" {{ $attendanceRecord->work_type == 'remote' ? 'selected' : '' }}>Remote</option>
                                        <option value="meeting" {{ $attendanceRecord->work_type == 'meeting' ? 'selected' : '' }}>Meeting</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a work type.</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Check In Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="check_in_time" class="form-label">Check In Time</label>
                                    <input type="time" class="form-control" id="check_in_time" name="check_in_time" 
                                           value="{{ $attendanceRecord->check_in_time ? $attendanceRecord->check_in_time->format('H:i') : '' }}">
                                    <div class="form-text">Leave empty if not applicable</div>
                                </div>
                            </div>

                            <!-- Check Out Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="check_out_time" class="form-label">Check Out Time</label>
                                    <input type="time" class="form-control" id="check_out_time" name="check_out_time" 
                                           value="{{ $attendanceRecord->check_out_time ? $attendanceRecord->check_out_time->format('H:i') : '' }}">
                                    <div class="form-text">Leave empty if not applicable</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Expected Check In Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expected_check_in" class="form-label">Expected Check In Time</label>
                                    <input type="time" class="form-control" id="expected_check_in" name="expected_check_in" 
                                           value="{{ $attendanceRecord->expected_check_in ? $attendanceRecord->expected_check_in->format('H:i') : '09:00' }}">
                                    <div class="form-text">Standard check-in time for late calculation</div>
                                </div>
                            </div>

                            <!-- Expected Check Out Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expected_check_out" class="form-label">Expected Check Out Time</label>
                                    <input type="time" class="form-control" id="expected_check_out" name="expected_check_out" 
                                           value="{{ $attendanceRecord->expected_check_out ? $attendanceRecord->expected_check_out->format('H:i') : '17:00' }}">
                                    <div class="form-text">Standard check-out time for overtime calculation</div>
                                </div>
                            </div>
                        </div>

                        <!-- Real-time Calculation Display -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <strong>Late Status:</strong> <span id="lateMinutesDisplay" class="text-success">
                                        @if($attendanceRecord->late_minutes > 0)
                                            {{ $attendanceRecord->late_minutes }} minutes late
                                        @else
                                            On time
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <strong>Overtime:</strong> <span id="overtimeDisplay" class="{{ $attendanceRecord->overtime_hours > 0 ? 'text-info' : 'text-muted' }}">
                                        @if($attendanceRecord->overtime_hours > 0)
                                            {{ $attendanceRecord->overtime_hours }} hours overtime
                                        @else
                                            No overtime
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Break Start Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="break_start_time" class="form-label">Break Start Time</label>
                                    <input type="time" class="form-control" id="break_start_time" name="break_start_time" 
                                           value="{{ $attendanceRecord->break_start_time ? $attendanceRecord->break_start_time->format('H:i') : '' }}">
                                    <div class="form-text">Leave empty if not applicable</div>
                                </div>
                            </div>

                            <!-- Break End Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="break_end_time" class="form-label">Break End Time</label>
                                    <input type="time" class="form-control" id="break_end_time" name="break_end_time" 
                                           value="{{ $attendanceRecord->break_end_time ? $attendanceRecord->break_end_time->format('H:i') : '' }}">
                                    <div class="form-text">Leave empty if not applicable</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Break Hours -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="break_hours" class="form-label">Break Hours</label>
                                    <input type="number" class="form-control" id="break_hours" name="break_hours" 
                                           step="0.5" min="0" max="24" placeholder="0.0" 
                                           value="{{ $attendanceRecord->break_hours ?? 0 }}">
                                    <div class="form-text">Total break hours (e.g., 1.5 for 1 hour 30 minutes)</div>
                                </div>
                            </div>

                            <!-- Approval Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_approved" class="form-label">Approval Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved" value="1" 
                                               {{ $attendanceRecord->is_approved ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_approved">
                                            Mark as Approved
                                        </label>
                                    </div>
                                    <div class="form-text">Check if this record is pre-approved</div>
                                </div>
                            </div>
                        </div>

                        <!-- Outdoor Work Fields (shown when work type is outdoor) -->
                        <div id="outdoorFields" class="row" style="display: {{ $attendanceRecord->work_type == 'outdoor' ? 'block' : 'none' }};">
                            <div class="col-12">
                                <hr>
                                <h5 class="text-primary">Outdoor Work Details</h5>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="location" 
                                           placeholder="e.g., Client Office, Site Visit, etc." 
                                           value="{{ $attendanceRecord->location ?? '' }}">
                                    <div class="form-text">Where the outdoor work is being performed</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_description" class="form-label">Work Description</label>
                                    <textarea class="form-control" id="work_description" name="work_description" 
                                              rows="3" placeholder="Describe the work being done outdoors">{{ $attendanceRecord->work_description ?? '' }}</textarea>
                                    <div class="form-text">What work is being performed at this location</div>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Note -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="attendance_note" class="form-label">Attendance Note</label>
                                    <textarea class="form-control" id="attendance_note" name="attendance_note" 
                                              rows="3" placeholder="Special notes about attendance, late reasons, or work details">{{ $attendanceRecord->attendance_note ?? '' }}</textarea>
                                    <div class="form-text">Specific notes about attendance, late arrival reasons, or work details</div>
                                </div>
                            </div>
                        </div>

                        <!-- General Comments -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea class="form-control" id="comments" name="comments" 
                                              rows="4" placeholder="Any additional comments or notes about this attendance record">{{ $attendanceRecord->comments ?? '' }}</textarea>
                                    <div class="form-text">Optional comments about the attendance record</div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.attendance.show', $attendanceRecord->id) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Details
                                    </a>
                                    <div>
                                        <button type="button" class="btn btn-outline-secondary me-2" id="clearFields">
                                            <i class="fas fa-eraser"></i> Clear Fields
                                        </button>
                                        <button type="button" class="btn btn-outline-warning me-2" id="saveAsDraft">
                                            <i class="fas fa-save"></i> Save as Draft
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Attendance Record
                                        </button>
                                    </div>
                                </div>
                            </div>
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
$(document).ready(function() {
    // Show/hide outdoor fields based on work type
    $('#work_type').change(function() {
        if ($(this).val() === 'outdoor') {
            $('#outdoorFields').slideDown();
        } else {
            $('#outdoorFields').slideUp();
        }
    });

    // Real-time late and overtime calculation
    function calculateLateAndOvertime() {
        const expectedCheckIn = $('#expected_check_in').val();
        const expectedCheckOut = $('#expected_check_out').val();
        const actualCheckIn = $('#check_in_time').val();
        const actualCheckOut = $('#check_out_time').val();
        
        let lateMinutes = 0;
        let overtimeHours = 0;
        
        if (expectedCheckIn && actualCheckIn) {
            const expected = moment(expectedCheckIn, 'HH:mm');
            const actual = moment(actualCheckIn, 'HH:mm');
            if (actual.isAfter(expected)) {
                lateMinutes = actual.diff(expected, 'minutes');
            }
        }
        
        if (expectedCheckOut && actualCheckOut) {
            const expected = moment(expectedCheckOut, 'HH:mm');
            const actual = moment(actualCheckOut, 'HH:mm');
            if (actual.isAfter(expected)) {
                overtimeHours = (actual.diff(expected, 'minutes') / 60).toFixed(2);
            }
        }
        
        // Update display
        $('#lateMinutesDisplay').text(lateMinutes > 0 ? `${lateMinutes} minutes late` : 'On time');
        $('#overtimeDisplay').text(overtimeHours > 0 ? `${overtimeHours} hours overtime` : 'No overtime');
        
        // Update badge colors
        if (lateMinutes > 0) {
            $('#lateMinutesDisplay').removeClass('text-success').addClass('text-warning');
        } else {
            $('#lateMinutesDisplay').removeClass('text-warning').addClass('text-success');
        }
        
        if (overtimeHours > 0) {
            $('#overtimeDisplay').removeClass('text-muted').addClass('text-info');
        } else {
            $('#overtimeDisplay').removeClass('text-info').addClass('text-muted');
        }
    }
    
        // Bind calculation to time field changes
    $('#expected_check_in, #expected_check_out, #check_in_time, #check_out_time').on('change', calculateLateAndOvertime);
    
    // Initialize calculation display on page load
    calculateLateAndOvertime();
    
    // Clear Fields functionality
    $('#clearFields').click(function() {
        if (confirm('Are you sure you want to clear all fields? This action cannot be undone.')) {
            $('#attendanceEditForm')[0].reset();
            $('#expected_check_in').val('09:00');
            $('#expected_check_out').val('17:00');
            $('#break_hours').val('0');
            $('#outdoorFields').hide();
            calculateLateAndOvertime();
            
            iziToast.info({
                title: 'Fields Cleared',
                message: 'All form fields have been cleared.',
                position: 'topRight'
            });
        }
    });
    
    // Show submission summary
    function showSubmissionSummary() {
        const employee = $('#user_id option:selected').text();
        const date = $('#date').val();
        const status = $('#status option:selected').text();
        const workType = $('#work_type option:selected').text();
        const checkIn = $('#check_in_time').val() || 'Not specified';
        const checkOut = $('#check_out_time').val() || 'Not specified';
        const lateStatus = $('#lateMinutesDisplay').text();
        const overtime = $('#overtimeDisplay').text();
        
        const summary = `
            <strong>Employee:</strong> ${employee}<br>
            <strong>Date:</strong> ${date}<br>
            <strong>Status:</strong> ${status}<br>
            <strong>Work Type:</strong> ${workType}<br>
            <strong>Check In:</strong> ${checkIn}<br>
            <strong>Check Out:</strong> ${checkOut}<br>
            <strong>Late Status:</strong> ${lateStatus}<br>
            <strong>Overtime:</strong> ${overtime}
        `;
        
        iziToast.info({
            title: 'Update Summary',
            message: summary,
            position: 'topRight',
            timeout: 5000
        });
    }
    
    // Save as Draft functionality
    $('#saveAsDraft').click(function() {
        if (confirm('Save as draft? This will fill in minimal required values and save the record for later completion.')) {
            // Set minimal required values for draft
            if (!$('#check_in_time').val()) {
                $('#check_in_time').val('00:00');
            }
            if (!$('#check_out_time').val()) {
                $('#check_out_time').val('00:00');
            }
            if (!$('#break_hours').val()) {
                $('#break_hours').val('0');
            }
            if (!$('#expected_check_in').val()) {
                $('#expected_check_in').val('09:00');
            }
            if (!$('#expected_check_out').val()) {
                $('#expected_check_out').val('17:00');
            }
            
            // Submit as draft
            submitForm(true);
        }
    });
    
    // Form validation and submission
    $('#attendanceEditForm').submit(function(e) {
        e.preventDefault();
        
        // Remove previous validation classes
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').hide();
        
        // Basic validation
        let isValid = true;
        
        if (!$('#user_id').val()) {
            $('#user_id').addClass('is-invalid');
            isValid = false;
        }
        
        if (!$('#date').val()) {
            $('#date').addClass('is-invalid');
            isValid = false;
        }
        
        if (!$('#status').val()) {
            $('#status').addClass('is-invalid');
            isValid = false;
        }
        
        if (!$('#work_type').val()) {
            $('#work_type').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate break_hours
        const breakHours = $('#break_hours').val();
        if (breakHours === '' || breakHours === null || isNaN(breakHours)) {
            $('#break_hours').val('0');
        }
        
        // Time validation
        const checkIn = $('#check_in_time').val();
        const checkOut = $('#check_out_time').val();
        
        if (checkIn && checkOut && checkIn >= checkOut) {
            $('#check_out_time').addClass('is-invalid');
            $('#check_out_time').next('.invalid-feedback').text('Check out time must be after check in time').show();
            isValid = false;
        }
        
        if (!isValid) {
            iziToast.error({
                title: 'Validation Error',
                message: 'Please fix the errors in the form.',
                position: 'topRight'
            });
            return;
        }
        
        // Check if this is a minimal submission (draft-like)
        const hasMinimalData = $('#user_id').val() && $('#date').val() && $('#status').val() && $('#work_type').val();
        if (!hasMinimalData) {
            iziToast.warning({
                title: 'Incomplete Data',
                message: 'Consider using "Save as Draft" for incomplete records.',
                position: 'topRight'
            });
        }
        
        // Show summary before submission
        showSubmissionSummary();
        
        // Submit form
        submitForm();
    });
    
    function submitForm(isDraft = false) {
        const formData = new FormData($('#attendanceEditForm')[0]);
        
        // Add draft flag if saving as draft
        if (isDraft) {
            formData.append('is_draft', '1');
        }
        
        // Handle empty break_hours - convert to 0 if empty
        const breakHours = $('#break_hours').val();
        if (breakHours === '' || breakHours === null || isNaN(breakHours)) {
            formData.set('break_hours', '0');
        }
        
        // Ensure all numeric fields have proper values
        const numericFields = ['break_hours'];
        numericFields.forEach(field => {
            const value = formData.get(field);
            if (value === '' || value === null || isNaN(value)) {
                formData.set(field, '0');
            }
        });

        // Set default expected times if not provided
        if (!formData.get('expected_check_in')) {
            formData.set('expected_check_in', '09:00');
        }
        if (!formData.get('expected_check_out')) {
            formData.set('expected_check_out', '17:00');
        }
        
        // Show loading state
        const submitBtn = $('button[type="submit"]');
        const originalText = submitBtn.html();
        const loadingText = isDraft ? '<i class="fas fa-spinner fa-spin"></i> Saving Draft...' : '<i class="fas fa-spinner fa-spin"></i> Updating...';
        submitBtn.html(loadingText).prop('disabled', true);
        
        $.ajax({
            url: '{{ route("admin.attendance.update", $attendanceRecord->id) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    const title = isDraft ? 'Draft Updated' : 'Success';
                    const message = isDraft ? 'Attendance record updated as draft. You can complete it later.' : response.message;
                    
                    iziToast.success({
                        title: title,
                        message: message,
                        position: 'topRight'
                    });
                    
                    // Redirect to show page after success
                    setTimeout(() => {
                        window.location.href = '{{ route("admin.attendance.show", $attendanceRecord->id) }}';
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
                let message = 'An error occurred while updating the attendance record.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(field => {
                        const input = $(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        input.next('.invalid-feedback').text(errors[field][0]).show();
                    });
                }
                
                iziToast.error({
                    title: 'Error',
                    message: message,
                    position: 'topRight'
                });
            },
            complete: function() {
                // Reset button state
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    }
});
</script>
@endpush
