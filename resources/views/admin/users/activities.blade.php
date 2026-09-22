@extends('admin.layout.app')

@section('title', 'User Activities: ' . $user->name)

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/datatables/datatables.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Activities</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></div>
            <div class="breadcrumb-item">Activities</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Activities for {{ $user->name }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-info">
                                <i class="fas fa-user"></i> Back to User
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- User Info Summary -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <img alt="image" src="{{ url('' . $user->profile_picture_url) }}" 
                                         class="rounded-circle" width="60">
                                    <h6 class="mt-2">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->designation }}</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h6 class="text-primary">{{ $activities->total() }}</h6>
                                    <small class="text-muted">Total Activities</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h6 class="text-success">{{ $activities->where('activity_type', 'lead_assigned')->count() }}</h6>
                                    <small class="text-muted">Leads Assigned</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h6 class="text-info">{{ $activities->where('activity_type', 'attendance')->count() }}</h6>
                                    <small class="text-muted">Attendance Records</small>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Filters -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select id="activity-type-filter" class="form-control">
                                    <option value="">All Activity Types</option>
                                    <option value="lead_assigned">Lead Assigned</option>
                                    <option value="attendance">Attendance</option>
                                    <option value="task_created">Task Created</option>
                                    <option value="profile_updated">Profile Updated</option>
                                    <option value="user_created">User Created</option>
                                    <option value="user_updated">User Updated</option>
                                    <option value="user_deleted">User Deleted</option>
                                    <option value="user_status_changed">Status Changed</option>
                                    <option value="portal_access_changed">Portal Access Changed</option>
                                    <option value="bulk_action">Bulk Action</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" id="date-filter" class="form-control" placeholder="Filter by date">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="search-activity" class="form-control" placeholder="Search activities...">
                            </div>
                            <div class="col-md-3">
                                <button id="clear-activity-filters" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Clear Filters
                                </button>
                            </div>
                        </div>

                        <!-- Activities Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="activities-table">
                                <thead>
                                    <tr>
                                        <th>Activity Type</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Related To</th>
                                        <th>IP Address</th>
                                        <th>Date & Time</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                    <tr>
                                        <td>
                                            <span class="badge badge-{{ getActivityBadgeColor($activity->activity_type) }}">
                                                {{ ucfirst(str_replace('_', ' ', $activity->activity_type)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>{{ $activity->activity_title }}</strong>
                                        </td>
                                        <td>
                                            @if(strlen($activity->description) > 100)
                                                {{ substr($activity->description, 0, 100) }}...
                                                <button type="button" class="btn btn-sm btn-link" 
                                                        data-toggle="tooltip" title="{{ $activity->description }}">
                                                    View More
                                                </button>
                                            @else
                                                {{ $activity->description }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($activity->related_model && $activity->related_id)
                                                <span class="badge badge-info">{{ $activity->related_model }}</span>
                                                <small class="text-muted">ID: {{ $activity->related_id }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $activity->ip_address ?? 'N/A' }}</small>
                                        </td>
                                        <td>
                                            <div>
                                                <div>{{ $activity->performed_at->format('d M Y') }}</div>
                                                <small class="text-muted">{{ $activity->performed_at->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info view-activity-details" 
                                                    data-activity="{{ json_encode($activity) }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Activity Details Modal -->
<div class="modal fade" id="activityDetailsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activity Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="activity-details-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ url('assets-admin/bundles/datatables/datatables.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#activities-table').DataTable({
        "pageLength": 25,
        "order": [[5, "desc"]],
        "columnDefs": [
            { "orderable": false, "targets": [6] }
        ]
    });

    // Activity type filter
    $('#activity-type-filter').on('change', function() {
        var type = $(this).val();
        if (type) {
            table.column(0).search(type).draw();
        } else {
            table.column(0).search('').draw();
        }
    });

    // Date filter
    $('#date-filter').on('change', function() {
        var date = $(this).val();
        if (date) {
            table.column(5).search(date).draw();
        } else {
            table.column(5).search('').draw();
        }
    });

    // Search filter
    $('#search-activity').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Clear filters
    $('#clear-activity-filters').on('click', function() {
        $('#activity-type-filter').val('');
        $('#date-filter').val('');
        $('#search-activity').val('');
        table.search('').columns().search('').draw();
    });

    // View activity details
    $('.view-activity-details').on('click', function() {
        var activity = $(this).data('activity');
        var content = `
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="font-weight-bold">Activity Type:</td>
                            <td>
                                <span class="badge badge-${getActivityBadgeColor(activity.activity_type)}">
                                    ${activity.activity_type.replace(/_/g, ' ').toUpperCase()}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Title:</td>
                            <td>${activity.activity_title}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Description:</td>
                            <td>${activity.description || 'N/A'}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Performed At:</td>
                            <td>${new Date(activity.performed_at).toLocaleString()}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td class="font-weight-bold">Related Model:</td>
                            <td>${activity.related_model || 'N/A'}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Related ID:</td>
                            <td>${activity.related_id || 'N/A'}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">IP Address:</td>
                            <td>${activity.ip_address || 'N/A'}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">User Agent:</td>
                            <td>
                                <small class="text-muted">${activity.user_agent || 'N/A'}</small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        `;
        
        $('#activity-details-content').html(content);
        $('#activityDetailsModal').modal('show');
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});

// Helper function to get badge color based on activity type
function getActivityBadgeColor(activityType) {
    const colorMap = {
        'lead_assigned': 'success',
        'attendance': 'info',
        'task_created': 'primary',
        'profile_updated': 'warning',
        'user_created': 'success',
        'user_updated': 'warning',
        'user_deleted': 'danger',
        'user_status_changed': 'info',
        'portal_access_changed': 'primary',
        'bulk_action': 'secondary'
    };
    
    return colorMap[activityType] || 'secondary';
}
</script>
@endpush

@php
function getActivityBadgeColor($activityType) {
    $colorMap = [
        'lead_assigned' => 'success',
        'attendance' => 'info',
        'task_created' => 'primary',
        'profile_updated' => 'warning',
        'user_created' => 'success',
        'user_updated' => 'warning',
        'user_deleted' => 'danger',
        'user_status_changed' => 'info',
        'portal_access_changed' => 'primary',
        'bulk_action' => 'secondary'
    ];
    
    return $colorMap[$activityType] ?? 'secondary';
}
@endphp
