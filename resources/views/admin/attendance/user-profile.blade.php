@extends('admin.layout.app')

@section('title', $user->name . ' - Attendance Profile')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $user->name }}'s Attendance Profile</h3>
                <p class="text-subtitle text-muted">Comprehensive attendance analysis and statistics</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}'s Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- User Info Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ url('images/avatar/account.jpg') }}" alt="Avatar" class="rounded-circle" width="80">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>{{ $user->name }}</h4>
                            <p class="text-muted mb-1">{{ $user->email }}</p>
                            <p class="text-muted mb-0">Employee ID: {{ $user->id }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Filter Date Range</h5>
                </div>
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ request('end_date', now()->endOfMonth()->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Apply Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="row">
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-calendar-check text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $stats['total_days'] }}</h3>
                                <span class="text-muted">Total Days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-check-circle text-success" style="font-size: 2rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $stats['present_days'] }}</h3>
                                <span class="text-muted">Present Days</span>
                                <br><small class="text-success">{{ $stats['attendance_rate'] }}% Rate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-clock text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $stats['late_days'] }}</h3>
                                <span class="text-muted">Late Days</span>
                                <br><small class="text-warning">{{ $stats['late_rate'] }}% Rate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="fas fa-hourglass-half text-info" style="font-size: 2rem;"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $stats['total_overtime_hours'] }}</h3>
                                <span class="text-muted">Total Overtime</span>
                                <br><small class="text-info">Avg: {{ $stats['avg_overtime_hours'] }}h</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Monthly Attendance Trends</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyTrendsChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Late Patterns by Hour</h5>
                </div>
                <div class="card-body">
                    <canvas id="latePatternsChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Statistics -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Status Distribution</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Present:</span>
                                <strong class="text-success">{{ $stats['present_days'] }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Absent:</span>
                                <strong class="text-danger">{{ $stats['absent_days'] }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Leave:</span>
                                <strong class="text-secondary">{{ $stats['leave_days'] }}</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Late:</span>
                                <strong class="text-warning">{{ $stats['late_days'] }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Outdoor:</span>
                                <strong class="text-primary">{{ $stats['outdoor_days'] }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Late Minutes:</span>
                                <strong class="text-warning">{{ $stats['total_late_minutes'] }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Performance Metrics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Attendance Rate</label>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $stats['attendance_rate'] }}%">
                                {{ $stats['attendance_rate'] }}%
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Late Rate</label>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: {{ $stats['late_rate'] }}%">
                                {{ $stats['late_rate'] }}%
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Average Late Minutes</label>
                        <div class="d-flex justify-content-between">
                            <span>{{ $stats['avg_late_minutes'] }} minutes</span>
                            <span class="text-muted">per late day</span>
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
                    <h5 class="card-title">Attendance Records</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Work Type</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Late Status</th>
                                    <th>Total Hours</th>
                                    <th>Overtime</th>
                                    <th>Location</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendanceRecords as $record)
                                    <tr>
                                        <td>
                                            <strong>{{ $record->formatted_date }}</strong>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No attendance records found for the selected date range.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $attendanceRecords->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Guard against null datasets to ensure charts render
const mtLabels = @json($monthlyTrends->pluck('month_name')) || [];
const mtAttendance = @json($monthlyTrends->pluck('attendance_rate')) || [];
const mtLate = @json($monthlyTrends->pluck('late_days')) || [];
// Monthly Trends Chart
const monthlyTrendsCtx = document.getElementById('monthlyTrendsChart').getContext('2d');
const monthlyTrendsChart = new Chart(monthlyTrendsCtx, {
    type: 'line',
    data: {
        labels: mtLabels.length ? mtLabels : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: 'Attendance Rate (%)',
            data: (mtAttendance.length ? mtAttendance : new Array(12).fill(0)),
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }, {
            label: 'Late Days',
            data: (mtLate.length ? mtLate : new Array(12).fill(0)),
            borderColor: 'rgb(255, 205, 86)',
            backgroundColor: 'rgba(255, 205, 86, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

// Late Patterns Chart
const latePatternsCtx = document.getElementById('latePatternsChart').getContext('2d');
const latePatternsChart = new Chart(latePatternsCtx, {
    type: 'bar',
    data: {
        labels: (@json($latePatterns->pluck('hour')) || []).map(h => (h ?? 0) + ':00'),
        datasets: [{
            label: 'Late Count',
            data: (@json($latePatterns->pluck('count')) || new Array(24).fill(0)),
            backgroundColor: 'rgba(255, 99, 132, 0.8)',
            borderColor: 'rgb(255, 99, 132)',
            borderWidth: 1
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
</script>
@endpush
