@extends('admin.layout.app')

@section('title', 'Team Management')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Team Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Team</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Team Members</h4>
                        </div>
                        <div class="card-body" id="total-members">
                            {{ $stats['total'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Active Members</h4>
                        </div>
                        <div class="card-body" id="active-members">
                            {{ $stats['active'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Inactive Members</h4>
                        </div>
                        <div class="card-body" id="inactive-members">
                            {{ $stats['inactive'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Team Members</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Member
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" id="filter-status">
                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="search-input" placeholder="Search members...">
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2" id="clear-filters">
                                    <i class="fas fa-times"></i> Clear Filters
                                </button>
                                <button type="button" class="btn btn-info" id="save-order">
                                    <i class="fas fa-save"></i> Save Order
                                </button>
                            </div>
                        </div>

                        <!-- Team Members Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="team-table">
                                <thead>
                                    <tr>
                                        <th width="50">Order</th>
                                        <th width="80">Image</th>
                                        <th>Name & Position</th>
                                        <th>Contact Info</th>
                                        <th>Expertise</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable-tbody">
                                    @foreach($teamMembers as $member)
                                    <tr data-id="{{ $member->id }}">
                                        <td>
                                            <div class="drag-handle">
                                                <i class="fas fa-grip-vertical text-muted"></i>
                                                <input type="hidden" class="sort-order" value="{{ $member->sort_order }}">
                                            </div>
                                        </td>
                                        <td>
                                            @if($member->image)
                                                <img src="{{ url('' . $member->image) }}" 
                                                     alt="{{ $member->name }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $member->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $member->position }}</small>
                                            @if($member->experience_years)
                                                <br>
                                                <small class="text-info">{{ $member->experience_years }} years experience</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($member->email)
                                                <div><i class="fas fa-envelope text-primary"></i> {{ $member->email }}</div>
                                            @endif
                                            @if($member->phone)
                                                <div><i class="fas fa-phone text-success"></i> {{ $member->phone }}</div>
                                            @endif
                                            <div class="social-links mt-1">
                                                @if($member->linkedin)
                                                    <a href="{{ $member->linkedin }}" target="_blank" class="text-info mr-2">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                @endif
                                                @if($member->twitter)
                                                    <a href="{{ $member->twitter }}" target="_blank" class="text-info mr-2">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                @endif
                                                @if($member->facebook)
                                                    <a href="{{ $member->facebook }}" target="_blank" class="text-info mr-2">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                @endif
                                                @if($member->instagram)
                                                    <a href="{{ $member->instagram }}" target="_blank" class="text-info">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if($member->expertise && count($member->expertise) > 0)
                                                @foreach(array_slice($member->expertise, 0, 3) as $expertise)
                                                    <span class="badge badge-info mr-1">{{ $expertise }}</span>
                                                @endforeach
                                                @if(count($member->expertise) > 3)
                                                    <small class="text-muted">+{{ count($member->expertise) - 3 }} more</small>
                                                @endif
                                            @else
                                                <span class="text-muted">Not specified</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $member->is_active == 1 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $member->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $member->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.team.show', $member->id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.attendance.user-profile', $member->id) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="View Attendance Profile">
                                                    <i class="fas fa-clock"></i>
                                                </a>
                                                <a href="{{ route('admin.team.edit', $member->id) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-{{ $member->is_active == 1 ? 'warning' : 'success' }} toggle-status" 
                                                        data-id="{{ $member->id }}" 
                                                        data-status="{{ $member->is_active == 1 ? 'active' : 'inactive' }}"
                                                        title="{{ $member->is_active == 1 ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $member->is_active == 1 ? 'check' : 'times' }}"></i>
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger delete-member" 
                                                        data-id="{{ $member->id }}" 
                                                        data-name="{{ $member->name }}"
                                                        title="Delete">
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
                            {{ $teamMembers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Sortable
    var sortable = new Sortable(document.getElementById('sortable-tbody'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function() {
            updateSortOrder();
        }
    });

    // Update sort order
    function updateSortOrder() {
        var orderData = [];
        $('#sortable-tbody tr').each(function(index) {
            var id = $(this).data('id');
            orderData.push({
                id: id,
                sort_order: index
            });
        });
        
        // Update hidden inputs
        $('#sortable-tbody tr').each(function(index) {
            $(this).find('.sort-order').val(index);
        });
    }

    // Save order
    $('#save-order').on('click', function() {
        var orderData = [];
        $('#sortable-tbody tr').each(function(index) {
            var id = $(this).data('id');
            orderData.push({
                id: id,
                sort_order: index
            });
        });

        var button = $(this);
        var originalText = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: '{{ route("admin.team.update-order") }}',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                order: orderData
            },
            success: function(response) {
                button.prop('disabled', false).html(originalText);
                
                if (response.success) {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Team member order updated successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Team member order updated successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to update order.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to update order.');
                    }
                }
            },
            error: function() {
                button.prop('disabled', false).html(originalText);
                
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Failed to update order.',
                        position: 'topRight'
                    });
                } else {
                    alert('Failed to update order.');
                }
            }
        });
    });

    // Search functionality
    $('#search-input').on('keyup', function() {
        var searchTerm = $(this).val().toLowerCase();
        
        $('#sortable-tbody tr').each(function() {
            var name = $(this).find('td:nth-child(3) strong').text().toLowerCase();
            var position = $(this).find('td:nth-child(3) small').text().toLowerCase();
            var expertise = $(this).find('td:nth-child(5)').text().toLowerCase();
            
            if (name.includes(searchTerm) || position.includes(searchTerm) || expertise.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Filter functionality
    $('#filter-status').on('change', function() {
        var status = $(this).val();
        
        $('#sortable-tbody tr').each(function() {
            var rowStatus = $(this).find('td:nth-child(6) .badge').text().toLowerCase();
            
            if (status === '' || 
                (status === '1' && rowStatus === 'active') || 
                (status === '0' && rowStatus === 'inactive')) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#filter-status').val('');
        $('#search-input').val('');
        $('#sortable-tbody tr').show();
        
        if (typeof iziToast !== 'undefined') {
            iziToast.info({
                title: 'Info!',
                message: 'All filters cleared!',
                position: 'topRight'
            });
        }
    });

    // Toggle member status
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var memberId = button.data('id');
        var currentStatus = button.data('status');
        var newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        var originalHtml = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '/admin/team/' + memberId + '/toggle-status',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                button.prop('disabled', false).html(originalHtml);
                
                if (response.success) {
                    button.removeClass('btn-success btn-warning').addClass(newStatus === 'active' ? 'btn-warning' : 'btn-success');
                    button.data('status', newStatus);
                    button.attr('title', newStatus === 'active' ? 'Deactivate' : 'Activate');
                    
                    button.find('i').removeClass('fa-check fa-times').addClass(newStatus === 'active' ? 'fa-check' : 'fa-times');
                    
                    var statusBadge = button.closest('tr').find('td:nth-child(6) .badge');
                    statusBadge.removeClass('badge-success badge-danger').addClass(newStatus === 'active' ? 'badge-success' : 'badge-danger');
                    statusBadge.text(newStatus === 'active' ? 'Active' : 'Inactive');
                    
                    updateStats();
                    
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Team member status updated successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Team member status updated successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to update status.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to update status.');
                    }
                }
            },
            error: function() {
                button.prop('disabled', false).html(originalHtml);
                
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Failed to update status.',
                        position: 'topRight'
                    });
                } else {
                    alert('Failed to update status.');
                }
            }
        });
    });

    // Delete member
    $('.delete-member').on('click', function() {
        var memberId = $(this).data('id');
        var memberName = $(this).data('name');
        
        if (confirm('Are you sure you want to delete "' + memberName + '"?\n\nThis action cannot be undone.')) {
            deleteMember(memberId);
        }
    });

    function deleteMember(memberId) {
        $.ajax({
            url: '/admin/team/' + memberId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#sortable-tbody').find('tr[data-id="' + memberId + '"]').fadeOut(400, function() {
                        $(this).remove();
                        updateStats();
                    });
                    
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Team member deleted successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Team member deleted successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to delete member.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to delete member.');
                    }
                }
            },
            error: function() {
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Failed to delete member.',
                        position: 'topRight'
                    });
                } else {
                    alert('Failed to delete member.');
                }
            }
        });
    }

    // Update statistics
    function updateStats() {
        $.ajax({
            url: '{{ route("admin.team.stats") }}',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#total-members').text(response.stats.total);
                    $('#active-members').text(response.stats.active);
                    $('#inactive-members').text(response.stats.inactive);
                }
            }
        });
    }
});
</script>
@endpush

@push('css')
<style>
.drag-handle {
    cursor: move;
    text-align: center;
    padding: 5px;
}

.drag-handle:hover {
    background-color: #f8f9fa;
    border-radius: 4px;
}

.social-links a {
    font-size: 14px;
}

.social-links a:hover {
    opacity: 0.8;
}

#sortable-tbody tr {
    transition: all 0.3s ease;
}

#sortable-tbody tr:hover {
    background-color: #f8f9fa;
}

.sortable-ghost {
    opacity: 0.5;
    background-color: #e9ecef !important;
}

.sortable-chosen {
    background-color: #fff3cd !important;
}
</style>
@endpush
