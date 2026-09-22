@extends('admin.layout.app')

@section('title', 'Audit Logs')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Audit Logs</h3>
                <p class="text-subtitle text-muted">Complete history of all changes made to workload tasks</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.workload.index') }}">Workload Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Audit Logs</li>
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
                    <h4 class="card-title">Audit Trail</h4>
                    <p class="card-subtitle">Track all modifications, assignments, and activities</p>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="action" class="form-label">Action Type</label>
                            <select class="form-select" id="action" name="action">
                                <option value="">All Actions</option>
                                @foreach($actions as $action)
                                    <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $action)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-select" id="user_id" name="user_id">
                                <option value="">All Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="date_from" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" 
                                   value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="date_to" class="form-label">To Date</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" 
                                   value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="button" class="btn btn-primary" onclick="applyFilters()">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <a href="{{ route('admin.workload.audit-logs') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Logs Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Date/Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Task</th>
                                    <th>Details</th>
                                    <th>Changes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($auditLogs as $log)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ $log->created_at->format('M d, Y') }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $log->created_at->format('H:i:s') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm me-2">
                                                    <img src="{{ url('' . $log->user->profile_photo_url) ?? url('assets-admin/img/avatar.png') }}" 
                                                         alt="{{ $log->user->name }}" class="rounded-circle">
                                                </div>
                                                <div>
                                                    <strong>{{ $log->user->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $log->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $log->action === 'created' ? 'success' : ($log->action === 'updated' ? 'info' : 'warning') }}">
                                                {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($log->task)
                                                <a href="{{ route('admin.workload.show', $log->task->id) }}" 
                                                   class="text-decoration-none">
                                                    <strong>{{ $log->task->title }}</strong>
                                                </a>
                                                <br>
                                                <small class="text-muted">ID: {{ $log->task->id }}</small>
                                            @else
                                                <span class="text-muted">Task Deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $log->description }}</small>
                                        </td>
                                        <td>
                                            @if($log->field_name && $log->old_value !== null && $log->new_value !== null)
                                                <div class="small">
                                                    <strong>{{ ucfirst($log->field_name) }}:</strong>
                                                    <br>
                                                    <span class="text-danger">{{ $log->old_value }}</span>
                                                    <i class="bi bi-arrow-right mx-1"></i>
                                                    <span class="text-success">{{ $log->new_value }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">No field changes</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                                No audit logs found
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $auditLogs->appends(request()->query())->links() }}
                    </div>

                    <!-- Summary -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $auditLogs->total() }}</h4>
                                    <small>Total Logs</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $auditLogs->where('action', 'created')->count() }}</h4>
                                    <small>Tasks Created</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $auditLogs->where('action', 'updated')->count() }}</h4>
                                    <small>Tasks Updated</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $auditLogs->where('action', 'status_changed')->count() }}</h4>
                                    <small>Status Changes</small>
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
function applyFilters() {
    const action = $('#action').val();
    const userId = $('#user_id').val();
    const dateFrom = $('#date_from').val();
    const dateTo = $('#date_to').val();
    
    let url = '{{ route("admin.workload.audit-logs") }}?';
    const params = [];
    
    if (action) params.push(`action=${action}`);
    if (userId) params.push(`user_id=${userId}`);
    if (dateFrom) params.push(`date_from=${dateFrom}`);
    if (dateTo) params.push(`date_to=${dateTo}`);
    
    if (params.length > 0) {
        url += params.join('&');
    }
    
    window.location.href = url;
}

// Auto-submit filters on change
$('#action, #user_id').on('change', function() {
    applyFilters();
});

// Date filters with delay
let dateTimeout;
$('#date_from, #date_to').on('change', function() {
    clearTimeout(dateTimeout);
    dateTimeout = setTimeout(applyFilters, 500);
});
</script>
@endpush
