@extends('admin.layout.app')

@section('title', 'User Management')

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ url('assets-admin/bundles/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Management</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Users</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New User
                            </a>
                            <a href="{{ route('admin.users.export') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Export
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Search and Filters -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" id="search" class="form-control" placeholder="Search users...">
                            </div>
                            <div class="col-md-2">
                                <select id="role-filter" class="form-control">
                                    <option value="">All Roles</option>
                                    <option value="admin">Admin</option>
                                    <option value="agent">Agent</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="status-filter" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="department-filter" class="form-control">
                                    <option value="">All Departments</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept }}">{{ $dept }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button id="bulk-action-btn" class="btn btn-warning" style="display: none;">
                                    <i class="fas fa-tasks"></i> Bulk Actions
                                </button>
                                <button id="clear-filters" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Clear Filters
                                </button>
                            </div>
                        </div>

                        <!-- Bulk Actions Modal -->
                        <div class="modal fade" id="bulkActionModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bulk Actions</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Action:</label>
                                            <select id="bulk-action" class="form-control">
                                                <option value="">Select Action</option>
                                                <option value="activate">Activate Users</option>
                                                <option value="deactivate">Deactivate Users</option>
                                                <option value="delete">Delete Users</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Selected Users: <span id="selected-count">0</span></label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" id="execute-bulk-action" class="btn btn-primary">Execute</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped" id="users-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Portal Access</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">
                                        </td>
                                        <td>
                                            <img alt="image" src="{{ url('' . $user->profile_picture_url) }}" 
                                                 class="rounded-circle" width="35" data-toggle="tooltip" 
                                                 title="{{ $user->name }}">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                                    @if($user->profile?->employee_id)
                                                        <small class="text-muted">ID: {{ $user->profile->employee_id }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{!! $user->role_badge !!}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{ $user->designation }}</td>
                                        <td>{!! $user->status_badge !!}</td>
                                        <td>
                                            @if($user->profile?->is_portal_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.show', $user) }}" 
                                                   class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success toggle-status" 
                                                        data-user-id="{{ $user->id }}" 
                                                        data-current-status="{{ $user->is_active }}" title="Toggle Status">
                                                    <i class="fas fa-toggle-on"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary toggle-portal" 
                                                        data-user-id="{{ $user->id }}" 
                                                        data-current-portal="{{ $user->profile?->is_portal_active ?? false }}" title="Toggle Portal">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger delete-user" 
                                                        data-user-id="{{ $user->id }}" 
                                                        data-user-name="{{ $user->name }}" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ url('assets-admin/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets-admin/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#users-table').DataTable({
        "pageLength": 15,
        "order": [[2, "asc"]],
        "columnDefs": [
            { "orderable": false, "targets": [0, 1, 9] }
        ]
    });

    // Search functionality
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Role filter
    $('#role-filter').on('change', function() {
        var role = $(this).val();
        if (role) {
            table.column(4).search(role).draw();
        } else {
            table.column(4).search('').draw();
        }
    });

    // Status filter
    $('#status-filter').on('change', function() {
        var status = $(this).val();
        if (status) {
            var searchTerm = status === 'active' ? 'Active' : 'Inactive';
            table.column(7).search(searchTerm).draw();
        } else {
            table.column(7).search('').draw();
        }
    });

    // Department filter
    $('#department-filter').on('change', function() {
        var dept = $(this).val();
        if (dept) {
            table.column(5).search(dept).draw();
        } else {
            table.column(5).search('').draw();
        }
    });

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#search').val('');
        $('#role-filter').val('');
        $('#status-filter').val('');
        $('#department-filter').val('');
        table.search('').columns().search('').draw();
    });

    // Select all functionality
    $('#select-all').on('change', function() {
        $('.user-checkbox').prop('checked', this.checked);
        updateBulkActionButton();
    });

    // Individual checkbox change
    $('.user-checkbox').on('change', function() {
        updateBulkActionButton();
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
    });

    function updateBulkActionButton() {
        var checkedCount = $('.user-checkbox:checked').length;
        if (checkedCount > 0) {
            $('#bulk-action-btn').show();
            $('#selected-count').text(checkedCount);
        } else {
            $('#bulk-action-btn').hide();
        }
    }

    // Bulk action button
    $('#bulk-action-btn').on('click', function() {
        $('#bulkActionModal').modal('show');
    });

    // Execute bulk action
    $('#execute-bulk-action').on('click', function() {
        var action = $('#bulk-action').val();
        var selectedUsers = $('.user-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (!action) {
            alert('Please select an action');
            return;
        }

        if (selectedUsers.length === 0) {
            alert('Please select users');
            return;
        }

        if (action === 'delete' && !confirm('Are you sure you want to delete the selected users? This action cannot be undone.')) {
            return;
        }

        $.ajax({
            url: '{{ route("admin.users.bulk-action") }}',
            method: 'POST',
            data: {
                action: action,
                user_ids: selectedUsers
            },
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            error: function(xhr) {
                var message = 'An error occurred';
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

        $('#bulkActionModal').modal('hide');
    });

    // Toggle user status
    $('.toggle-status').on('click', function() {
        var userId = $(this).data('user-id');
        var currentStatus = $(this).data('current-status');
        var button = $(this);

        $.ajax({
            url: '{{ url("admin/users") }}/' + userId + '/toggle-status',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });
                    
                    // Update button data and icon
                    button.data('current-status', response.is_active);
                    if (response.is_active) {
                        button.removeClass('btn-success').addClass('btn-warning');
                        button.find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
                    } else {
                        button.removeClass('btn-warning').addClass('btn-success');
                        button.find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
                    }
                    
                    // Update status badge
                    var statusCell = button.closest('tr').find('td:eq(7)');
                    if (response.is_active) {
                        statusCell.html('<span class="badge badge-success">Active</span>');
                    } else {
                        statusCell.html('<span class="badge badge-danger">Inactive</span>');
                    }
                }
            },
            error: function(xhr) {
                var message = 'An error occurred';
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
    });

    // Toggle portal access
    $('.toggle-portal').on('click', function() {
        var userId = $(this).data('user-id');
        var currentPortal = $(this).data('current-portal');
        var button = $(this);

        $.ajax({
            url: '{{ url("admin/users") }}/' + userId + '/toggle-portal-access',
            method: 'POST',
            success: function(response) {
                if (response.success) {
                    iziToast.success({
                        title: 'Success',
                        message: response.message,
                        position: 'topRight'
                    });
                    
                    // Update button data
                    button.data('current-portal', response.is_portal_active);
                    
                    // Update portal access badge
                    var portalCell = button.closest('tr').find('td:eq(8)');
                    if (response.is_portal_active) {
                        portalCell.html('<span class="badge badge-success">Active</span>');
                    } else {
                        portalCell.html('<span class="badge badge-danger">Inactive</span>');
                    }
                }
            },
            error: function(xhr) {
                var message = 'An error occurred';
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
    });

    // Delete user
    $('.delete-user').on('click', function() {
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');

        if (confirm('Are you sure you want to delete user "' + userName + '"? This action cannot be undone.')) {
            $.ajax({
                url: '{{ url("admin/users") }}/' + userId,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    iziToast.success({
                        title: 'Success',
                        message: 'User deleted successfully!',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
                error: function(xhr) {
                    var message = 'An error occurred';
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
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
