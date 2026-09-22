@extends('admin.layout.app')

@section('title', 'User Details: ' . $user->name)

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/chartjs/chart.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></div>
            <div class="breadcrumb-item">{{ $user->name }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- User Profile Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img alt="image" src="{{ url('' . $user->profile_picture_url) }}" 
                             class="rounded-circle" width="120" style="border: 3px solid #6777ef;">
                        <h4 class="mt-3">{{ $user->name }}</h4>
                        <p class="text-muted">{{ $user->designation }}</p>
                        
                        <div class="mb-3">
                            {!! $user->role_badge !!}
                            {!! $user->status_badge !!}
                        </div>

                        <div class="row text-center">
                            <div class="col-6">
                                <h6 class="text-primary">{{ $stats['total_leads'] }}</h6>
                                <small class="text-muted">Leads</small>
                            </div>
                            <div class="col-6">
                                <h6 class="text-success">{{ $stats['total_attendance'] }}</h6>
                                <small class="text-muted">Attendance</small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit User
                            </a>
                            <a href="{{ route('admin.users.activities', $user) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-history"></i> View Activities
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h4>Quick Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-primary">{{ $stats['total_tasks'] }}</h6>
                                    <small class="text-muted">Tasks</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h6 class="text-info">{{ $user->profile?->date_of_joining?->diffForHumans() ?? 'N/A' }}</h6>
                                    <small class="text-muted">Joined</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Details -->
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
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Phone:</td>
                                        <td>{{ $user->profile?->phone ?? 'Not provided' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Employee ID:</td>
                                        <td>{{ $user->profile?->employee_id ?? 'Not assigned' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Department:</td>
                                        <td>{{ $user->department }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Designation:</td>
                                        <td>{{ $user->designation }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Date of Joining:</td>
                                        <td>{{ $user->date_of_joining }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Portal Access:</td>
                                        <td>
                                            @if($user->profile?->is_portal_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Last Login:</td>
                                        <td>{{ $user->profile?->last_login_at?->diffForHumans() ?? 'Never' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Created:</td>
                                        <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Updated:</td>
                                        <td>{{ $user->updated_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Salary Information -->
                @if($user->profile?->basic_salary || $user->salaryPayments->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h4>Salary Information</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.accounts.salaries.index') }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($user->profile?->basic_salary)
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-primary">₹{{ number_format($user->profile->basic_salary, 2) }}</h6>
                                    <small class="text-muted">Basic Salary</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-success">₹{{ number_format($user->profile->allowances, 2) }}</h6>
                                    <small class="text-muted">Allowances</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h6 class="text-info">{{ $user->salary_formatted }}</h6>
                                    <small class="text-muted">Total Salary</small>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($user->salaryPayments->count() > 0)
                        <div class="mt-3">
                            <h6>Recent Salary Payments</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Basic</th>
                                            <th>Allowances</th>
                                            <th>Deductions</th>
                                            <th>Net Salary</th>
                                            <th>Paid On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->salaryPayments->take(5) as $payment)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $payment->month)->format('M Y') }}</td>
                                            <td>₹{{ number_format($payment->basic_salary, 2) }}</td>
                                            <td>₹{{ number_format($payment->allowances, 2) }}</td>
                                            <td>₹{{ number_format($payment->deductions, 2) }}</td>
                                            <td><strong>₹{{ number_format($payment->net_salary, 2) }}</strong></td>
                                            <td>{{ $payment->paid_on ? $payment->paid_on->format('d M Y') : 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Address Information -->
                @if($user->profile?->address || $user->profile?->city)
                <div class="card">
                    <div class="card-header">
                        <h4>Address Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Address:</strong> {{ $user->profile?->full_address ?? 'Not provided' }}</p>
                    </div>
                </div>
                @endif

                <!-- Banking Information -->
                @if($user->profile?->bank_name || $user->profile?->pan_number)
                <div class="card">
                    <div class="card-header">
                        <h4>Banking & Documents</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($user->profile?->bank_name)
                            <div class="col-md-6">
                                <p><strong>Bank:</strong> {{ $user->profile->bank_name }}</p>
                                @if($user->profile?->bank_account_number)
                                <p><strong>Account:</strong> {{ $user->profile->bank_account_number }}</p>
                                @endif
                                @if($user->profile?->ifsc_code)
                                <p><strong>IFSC:</strong> {{ $user->profile->ifsc_code }}</p>
                                @endif
                            </div>
                            @endif
                            <div class="col-md-6">
                                @if($user->profile?->pan_number)
                                <p><strong>PAN:</strong> {{ $user->profile->pan_number }}</p>
                                @endif
                                @if($user->profile?->aadhar_number)
                                <p><strong>Aadhar:</strong> {{ $user->profile->aadhar_number }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Skills & Experience -->
                @if($user->profile?->skills || $user->profile?->experience_summary)
                <div class="card">
                    <div class="card-header">
                        <h4>Skills & Experience</h4>
                    </div>
                    <div class="card-body">
                        @if($user->profile?->skills)
                        <div class="mb-3">
                            <strong>Skills:</strong>
                            <p>{{ $user->profile->skills }}</p>
                        </div>
                        @endif
                        
                        @if($user->profile?->experience_summary)
                        <div class="mb-3">
                            <strong>Experience Summary:</strong>
                            <p>{{ $user->profile->experience_summary }}</p>
                        </div>
                        @endif
                        
                        @if($user->profile?->education)
                        <div class="mb-3">
                            <strong>Education:</strong>
                            <p>{{ $user->profile->education }}</p>
                        </div>
                        @endif
                        
                        @if($user->profile?->certifications)
                        <div class="mb-3">
                            <strong>Certifications:</strong>
                            <p>{{ $user->profile->certifications }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Activities</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.users.activities', $user) }}" class="btn btn-primary btn-sm">
                                View All Activities
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($stats['recent_activities']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>IP Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stats['recent_activities'] as $activity)
                                        <tr>
                                            <td>
                                                <span class="badge badge-info">{{ $activity->activity_type }}</span>
                                                {{ $activity->activity_title }}
                                            </td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->performed_at->diffForHumans() }}</td>
                                            <td>
                                                <small class="text-muted">{{ $activity->ip_address ?? 'N/A' }}</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <p>No recent activities found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Leads, Tasks, and Attendance -->
        <div class="row">
            <!-- Assigned Leads -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Assigned Leads</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.leads.index', ['assigned_to' => $user->id]) }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($user->assignedLeads->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->assignedLeads->take(5) as $lead)
                                        <tr>
                                            <td>
                                                <strong>{{ $lead->title }}</strong>
                                                <br><small class="text-muted">{{ $lead->contact_name }}</small>
                                            </td>
                                            <td>{!! $lead->status_badge ?? '<span class="badge badge-secondary">Unknown</span>' !!}</td>
                                            <td>{!! $lead->priority_badge ?? '<span class="badge badge-secondary">Unknown</span>' !!}</td>
                                            <td>{{ $lead->value ? '₹' . number_format($lead->value, 2) : 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <p>No leads assigned yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Assigned Tasks -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Assigned Tasks</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.workload.index') }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($user->workloadTasks->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Priority</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->workloadTasks->take(5) as $task)
                                        <tr>
                                            <td>
                                                <strong>{{ $task->title }}</strong>
                                                <br><small class="text-muted">{{ Str::limit($task->description, 50) }}</small>
                                            </td>
                                            <td>{!! $task->status_badge !!}</td>
                                            <td>{!! $task->priority_badge !!}</td>
                                            <td>
                                                @if($task->is_overdue)
                                                    <span class="text-danger">{{ $task->due_date->format('d M Y') }}</span>
                                                @else
                                                    {{ $task->due_date->format('d M Y') }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <p>No tasks assigned yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Records -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Attendance</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.attendance.index', ['user_id' => $user->id]) }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($user->attendanceRecords->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Total Hours</th>
                                            <th>Work Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->attendanceRecords->take(10) as $attendance)
                                        <tr>
                                            <td>{{ $attendance->date->format('d M Y') }}</td>
                                            <td>
                                                @if($attendance->status === 'present')
                                                    <span class="badge badge-success">Present</span>
                                                @elseif($attendance->status === 'absent')
                                                    <span class="badge badge-danger">Absent</span>
                                                @elseif($attendance->status === 'late')
                                                    <span class="badge badge-warning">Late</span>
                                                @else
                                                    <span class="badge badge-info">{{ ucfirst($attendance->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $attendance->check_in_time ?? 'N/A' }}</td>
                                            <td>{{ $attendance->check_out_time ?? 'N/A' }}</td>
                                            <td>{{ $attendance->total_hours ?? 'N/A' }}</td>
                                            <td>{{ ucfirst($attendance->work_type) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <p>No attendance records found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Management -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Loan Management</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.accounts.advances.index') }}" class="btn btn-info btn-sm">View All Loans</a>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#assignLoanModal">
                                <i class="fas fa-plus"></i> Assign Loan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($user->salaryAdvances->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Progress</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->salaryAdvances as $loan)
                                        <tr>
                                            <td>
                                                <strong>{{ $loan->amount_formatted }}</strong>
                                                <br><small class="text-muted">{{ $loan->description }}</small>
                                            </td>
                                            <td>{{ $loan->advance_date->format('d M Y') }}</td>
                                            <td>{!! $loan->status_badge !!}</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $loan->progress_percentage }}%;" 
                                                         aria-valuenow="{{ $loan->progress_percentage }}" 
                                                         aria-valuemin="0" aria-valuemax="100">
                                                        {{ $loan->progress_percentage }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($loan->is_pending)
                                                    <button class="btn btn-success btn-sm" onclick="settleLoan({{ $loan->id }})">
                                                        <i class="fas fa-check"></i> Settle
                                                    </button>
                                                @endif
                                                <button class="btn btn-info btn-sm" onclick="viewLoanDetails({{ $loan->id }})">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted">
                                <p>No loans assigned yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Charts -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Monthly Activity Overview</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="activityChart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Task Completion Status</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="taskChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Assign Loan Modal -->
<div class="modal fade" id="assignLoanModal" tabindex="-1" role="dialog" aria-labelledby="assignLoanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignLoanModalLabel">Assign Loan to {{ $user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="assignLoanForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loan_amount">Loan Amount (₹)</label>
                        <input type="number" class="form-control" id="loan_amount" name="amount" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="loan_date">Loan Date</label>
                        <input type="date" class="form-control" id="loan_date" name="advance_date" required>
                    </div>
                    <div class="form-group">
                        <label for="loan_description">Description</label>
                        <textarea class="form-control" id="loan_description" name="description" rows="3" placeholder="Reason for loan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign Loan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loan Details Modal -->
<div class="modal fade" id="loanDetailsModal" tabindex="-1" role="dialog" aria-labelledby="loanDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanDetailsModalLabel">Loan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="loanDetailsContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ url('assets-admin/bundles/chartjs/chart.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Activity Chart
    var activityCtx = document.getElementById('activityChart').getContext('2d');
    var activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Activities',
                data: [12, 19, 3, 5, 2, 3],
                borderColor: '#6777ef',
                backgroundColor: 'rgba(103, 119, 239, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Task Chart
    var taskCtx = document.getElementById('taskChart').getContext('2d');
    var taskChart = new Chart(taskCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'In Progress', 'Pending'],
            datasets: [{
                data: [70, 20, 10],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
            });
    });

    // Loan Management Functions
    $('#assignLoanForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '{{ route("admin.users.assign-loan", $user) }}',
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success!',
                        message: response.message,
                        position: 'topRight'
                    });
                    $('#assignLoanModal').modal('hide');
                    location.reload();
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: response.message,
                        position: 'topRight'
                    });
                }
            },
            error: function(xhr) {
                let message = 'An error occurred while assigning the loan.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                iziToast.error({
                    title: 'Error!',
                    message: message,
                    position: 'topRight'
                });
            }
        });
    });

    function settleLoan(loanId) {
        if (confirm('Are you sure you want to mark this loan as settled?')) {
            $.ajax({
                url: '{{ route("admin.users.settle-loan", $user) }}',
                method: 'POST',
                data: { loan_id: loanId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        iziToast.success({
                            title: 'Success!',
                            message: response.message,
                            position: 'topRight'
                        });
                        location.reload();
                    } else {
                        iziToast.error({
                            title: 'Error!',
                            message: response.message,
                            position: 'topRight'
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'An error occurred while settling the loan.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    iziToast.error({
                        title: 'Error!',
                        message: message,
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function viewLoanDetails(loanId) {
        $.ajax({
            url: '{{ route("admin.users.loan-details", $user) }}',
            method: 'GET',
            data: { loan_id: loanId },
            success: function(response) {
                $('#loanDetailsContent').html(response);
                $('#loanDetailsModal').modal('show');
            },
            error: function() {
                iziToast.error({
                    title: 'Error!',
                    message: 'Failed to load loan details.',
                    position: 'topRight'
                });
            }
        });
    }
</script>
@endpush
