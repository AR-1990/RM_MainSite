@extends('admin.layout.app')

@section('title', 'Projects Management')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Projects Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Projects</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Projects</h4>
                        </div>
                        <div class="card-body" id="total-projects">
                            {{ $stats['total'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Active Projects</h4>
                        </div>
                        <div class="card-body" id="active-projects">
                            {{ $stats['active'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Featured Projects</h4>
                        </div>
                        <div class="card-body" id="featured-projects">
                            {{ $stats['featured'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Views</h4>
                        </div>
                        <div class="card-body" id="total-views">
                            {{ $stats['views'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Projects</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Project
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
                                <select class="form-control" id="filter-featured">
                                    <option value="">All Featured</option>
                                    <option value="1">Featured</option>
                                    <option value="0">Not Featured</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="filter-type">
                                    <option value="">All Types</option>
                                    {!! $projectCategoryFilterOptions !!}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="search-input" placeholder="Search projects...">
                            </div>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary" id="bulk-activate">
                                        <i class="fas fa-check"></i> Activate
                                    </button>
                                    <button type="button" class="btn btn-outline-warning" id="bulk-deactivate">
                                        <i class="fas fa-times"></i> Deactivate
                                    </button>
                                    <button type="button" class="btn btn-outline-success" id="bulk-feature">
                                        <i class="fas fa-star"></i> Feature
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" id="bulk-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-secondary mr-2" id="clear-filters">
                                    <i class="fas fa-times"></i> Clear Filters
                                </button>
                                <button type="button" class="btn btn-info" id="export-projects">
                                    <i class="fas fa-download"></i> Export
                                </button>
                            </div>
                        </div>

                        <!-- Projects Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="projects-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Location</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="project-checkbox" value="{{ $project->id }}">
                                        </td>
                                        <td>
                                                                        @if($project->main_image)
                                <img src="{{ url('' . $project->main_image) }}" 
                                                     alt="{{ $project->title }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-building"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $project->title }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($project->short_description, 50) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $project->project_type_text }}</span>
                                        </td>
                                        <td>{{ $project->location }}</td>
                                        <td>
                                            <strong>PKR {{ number_format($project->price) }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $project->price_type }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $project->is_active == 1 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $project->is_active == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $project->is_featured == 1 ? 'badge-warning' : 'badge-secondary' }}">
                                                {{ $project->is_featured == 1 ? 'Featured' : 'No' }}
                                            </span>
                                        </td>
                                        <td>{{ $project->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.projects.show', $project->id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.projects.edit', $project->id) }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-{{ $project->is_active == 1 ? 'warning' : 'success' }} toggle-status" 
                                                        data-id="{{ $project->id }}" 
                                                        data-status="{{ $project->is_active == 1 ? 'active' : 'inactive' }}"
                                                        title="{{ $project->is_active == 1 ? 'Deactivate' : 'Activate' }}">
                                                    <i class="fas fa-{{ $project->is_active == 1 ? 'check' : 'times' }}"></i>
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-warning toggle-featured" 
                                                        data-id="{{ $project->id }}" 
                                                        data-featured="{{ $project->is_featured == 1 ? 'featured' : 'not-featured' }}"
                                                        title="{{ $project->is_featured == 1 ? 'Unmark as Featured' : 'Mark as Featured' }}">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger delete-project" 
                                                        data-id="{{ $project->id }}" 
                                                        data-title="{{ $project->title }}"
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
                            {{ $projects->links() }}
                        </div>
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
    // Initialize DataTable
    var table = $('#projects-table').DataTable({
        pageLength: 25,
        order: [[8, 'desc']], // Sort by created date descending
        columnDefs: [
            { orderable: false, targets: [0, 1, 9] } // Disable sorting for checkbox, image, and actions columns
        ]
    });

    // Search functionality
    $('#search-input').on('keyup', function() {
        applyFilters();
    });

    // Filter functionality
    $('#filter-status, #filter-featured, #filter-type').on('change', function() {
        applyFilters();
    });

    // Function to apply all filters
    function applyFilters() {
        var status = $('#filter-status').val();
        var featured = $('#filter-featured').val();
        var type = $('#filter-type').val();
        var search = $('#search-input').val();

        // Custom filtering function
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var rowStatus = data[6]; // Status column (7th column, index 6)
            var rowFeatured = data[7]; // Featured column (8th column, index 7)
            var rowType = data[3]; // Type column (4th column, index 3)
            var rowTitle = data[2]; // Title column (3rd column, index 2)

            // Status filter
            if (status && status !== '') {
                if (status === '1' && !rowStatus.includes('Active')) return false;
                if (status === '0' && !rowStatus.includes('Inactive')) return false;
            }

            // Featured filter
            if (featured && featured !== '') {
                if (featured === '1' && !rowFeatured.includes('Featured')) return false;
                if (featured === '0' && !rowFeatured.includes('No')) return false;
            }

            // Type filter
            if (type && type !== '') {
                if (!rowType.toLowerCase().includes(type.toLowerCase())) return false;
            }

            // Search filter
            if (search && search !== '') {
                if (!rowTitle.toLowerCase().includes(search.toLowerCase())) return false;
            }

            return true;
        });

        table.draw();
        
        // Remove the custom filter function after drawing
        $.fn.dataTable.ext.search.pop();
    }

    // Select all functionality
    $('#select-all').on('change', function() {
        $('.project-checkbox').prop('checked', this.checked);
        updateBulkActionButtons();
    });

    // Update select all when individual checkboxes change
    $('.project-checkbox').on('change', function() {
        updateSelectAllState();
        updateBulkActionButtons();
    });

    // Function to update select all checkbox state
    function updateSelectAllState() {
        var totalCheckboxes = $('.project-checkbox').length;
        var checkedCheckboxes = $('.project-checkbox:checked').length;
        
        if (checkedCheckboxes === 0) {
            $('#select-all').prop('indeterminate', false).prop('checked', false);
        } else if (checkedCheckboxes === totalCheckboxes) {
            $('#select-all').prop('indeterminate', false).prop('checked', true);
        } else {
            $('#select-all').prop('indeterminate', true).prop('checked', false);
        }
    }

    // Function to update bulk action buttons state
    function updateBulkActionButtons() {
        var checkedCount = $('.project-checkbox:checked').length;
        var hasSelection = checkedCount > 0;
        
        $('#bulk-activate, #bulk-deactivate, #bulk-feature, #bulk-delete').prop('disabled', !hasSelection);
        
        // Update button text to show count
        if (hasSelection) {
            $('#bulk-activate').html('<i class="fas fa-check"></i> Activate (' + checkedCount + ')');
            $('#bulk-deactivate').html('<i class="fas fa-times"></i> Deactivate (' + checkedCount + ')');
            $('#bulk-feature').html('<i class="fas fa-star"></i> Feature (' + checkedCount + ')');
            $('#bulk-delete').html('<i class="fas fa-trash"></i> Delete (' + checkedCount + ')');
        } else {
            $('#bulk-activate').html('<i class="fas fa-check"></i> Activate');
            $('#bulk-deactivate').html('<i class="fas fa-times"></i> Deactivate');
            $('#bulk-feature').html('<i class="fas fa-star"></i> Feature');
            $('#bulk-delete').html('<i class="fas fa-trash"></i> Delete');
        }
    }

    // Initialize bulk action buttons state
    updateBulkActionButtons();

    // Toggle project status
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var projectId = button.data('id');
        var currentStatus = button.data('status');
        var newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        // Show loading state
        var originalHtml = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '/admin/projects/' + projectId + '/toggle-status',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Re-enable button
                button.prop('disabled', false).html(originalHtml);
                
                if (response.success) {
                    // Update button appearance
                    button.removeClass('btn-success btn-warning').addClass(newStatus === 'active' ? 'btn-warning' : 'btn-success');
                    button.data('status', newStatus);
                    button.attr('title', newStatus === 'active' ? 'Deactivate' : 'Activate');
                    
                    // Update icon
                    button.find('i').removeClass('fa-check fa-times').addClass(newStatus === 'active' ? 'fa-check' : 'fa-times');
                    
                    // Update status badge in the same row
                    var statusBadge = button.closest('tr').find('td:nth-child(7) .badge');
                    statusBadge.removeClass('badge-success badge-danger').addClass(newStatus === 'active' ? 'badge-success' : 'badge-danger');
                    statusBadge.text(newStatus === 'active' ? 'Active' : 'Inactive');
                    
                    // Update statistics
                    updateStats();
                    
                    // Show success message
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Project status updated successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Project status updated successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to update project status.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to update project status.');
                    }
                }
            },
            error: function(xhr) {
                // Re-enable button
                button.prop('disabled', false).html(originalHtml);
                
                var errorMsg = 'An error occurred while updating project status.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: errorMsg,
                        position: 'topRight'
                    });
                } else {
                    alert(errorMsg);
                }
            }
        });
    });

    // Toggle project featured status
    $('.toggle-featured').on('click', function() {
        var button = $(this);
        var projectId = button.data('id');
        var currentFeatured = button.data('featured');
        var newFeatured = currentFeatured === 'featured' ? 'not-featured' : 'featured';

        // Show loading state
        var originalHtml = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: '/admin/projects/' + projectId + '/toggle-featured',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Re-enable button
                button.prop('disabled', false).html(originalHtml);
                
                if (response.success) {
                    // Update button data
                    button.data('featured', newFeatured);
                    button.attr('title', newFeatured === 'featured' ? 'Unmark as Featured' : 'Mark as Featured');
                    
                    // Update featured badge in the same row
                    var featuredBadge = button.closest('tr').find('td:nth-child(8) .badge');
                    featuredBadge.removeClass('badge-warning badge-secondary').addClass(newFeatured === 'featured' ? 'badge-warning' : 'badge-secondary');
                    featuredBadge.text(newFeatured === 'featured' ? 'Featured' : 'No');
                    
                    // Update statistics
                    updateStats();
                    
                    // Show success message
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Project featured status updated successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Project featured status updated successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to update project featured status.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to update project featured status.');
                    }
                }
            },
            error: function(xhr) {
                // Re-enable button
                button.prop('disabled', false).html(originalHtml);
                
                var errorMsg = 'An error occurred while updating project featured status.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: errorMsg,
                        position: 'topRight'
                    });
                } else {
                    alert(errorMsg);
                }
            }
        });
    });

    // Delete project
    $('.delete-project').on('click', function() {
        var projectId = $(this).data('id');
        var projectTitle = $(this).data('title');
        
        // Show confirmation dialog
        if (confirm('Are you sure you want to delete the project "' + projectTitle + '"?\n\nThis action cannot be undone and will permanently remove the project and all associated files.')) {
            deleteProject(projectId);
        }
    });

    // Function to delete a single project
    function deleteProject(projectId) {
        $.ajax({
            url: '/admin/projects/' + projectId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Remove row from table
                    $('#projects-table').find('tr').each(function() {
                        if ($(this).find('.project-checkbox[value="' + projectId + '"]').length) {
                            $(this).fadeOut(400, function() {
                                $(this).remove();
                                updateBulkActionButtons();
                            });
                        }
                    });
                    
                    // Update statistics
                    updateStats();
                    
                    // Show success message
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Project deleted successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Project deleted successfully!');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Failed to delete project.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to delete project.');
                    }
                }
            },
            error: function(xhr) {
                var errorMsg = 'An error occurred while deleting project.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: errorMsg,
                        position: 'topRight'
                    });
                } else {
                    alert(errorMsg);
                }
            }
        });
    }

    // Bulk actions
    $('#bulk-activate').on('click', function() {
        performBulkAction('activate');
    });

    $('#bulk-deactivate').on('click', function() {
        performBulkAction('deactivate');
    });

    $('#bulk-feature').on('click', function() {
        performBulkAction('feature');
    });

    $('#bulk-delete').on('click', function() {
        performBulkAction('delete');
    });

    function performBulkAction(action) {
        var selectedIds = [];
        $('.project-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            if (typeof iziToast !== 'undefined') {
                iziToast.warning({
                    title: 'Warning!',
                    message: 'Please select at least one project.',
                    position: 'topRight'
                });
            } else {
                alert('Please select at least one project.');
            }
            return;
        }

        var actionText = action.charAt(0).toUpperCase() + action.slice(1);
        var confirmMessage = 'Are you sure you want to ' + action + ' ' + selectedIds.length + ' selected project(s)?\n\nThis action cannot be undone.';
        
        if (!confirm(confirmMessage)) {
            return;
        }

        // Perform bulk action based on type
        switch(action) {
            case 'activate':
                bulkToggleStatus(selectedIds, true);
                break;
            case 'deactivate':
                bulkToggleStatus(selectedIds, false);
                break;
            case 'feature':
                bulkToggleFeatured(selectedIds, true);
                break;
            case 'delete':
                bulkDelete(selectedIds);
                break;
        }
    }

    function bulkToggleStatus(ids, activate) {
        // Show loading state
        var button = activate ? $('#bulk-activate') : $('#bulk-deactivate');
        var originalText = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        
        var promises = ids.map(function(id) {
            return $.ajax({
                url: '/admin/projects/' + id + '/toggle-status',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    activate: activate
                }
            });
        });

        Promise.all(promises).then(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            updateStats();
            if (typeof iziToast !== 'undefined') {
                iziToast.success({
                    title: 'Success!',
                    message: 'Bulk status update completed!',
                    position: 'topRight'
                });
            } else {
                alert('Bulk status update completed!');
            }
            // Refresh table data instead of reloading page
            refreshTableData();
        }).catch(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            if (typeof iziToast !== 'undefined') {
                iziToast.error({
                    title: 'Error!',
                    message: 'Some projects failed to update.',
                    position: 'topRight'
                });
            } else {
                alert('Some projects failed to update.');
            }
        });
    }

    function bulkToggleFeatured(ids, feature) {
        // Show loading state
        var button = $('#bulk-feature');
        var originalText = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        
        var promises = ids.map(function(id) {
            return $.ajax({
                url: '/admin/projects/' + id + '/toggle-featured',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    feature: feature
                }
            });
        });

        Promise.all(promises).then(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            updateStats();
            if (typeof iziToast !== 'undefined') {
                iziToast.success({
                    title: 'Success!',
                    message: 'Bulk featured update completed!',
                    position: 'topRight'
                });
            } else {
                    alert('Bulk featured update completed!');
                }
            // Refresh table data instead of reloading page
            refreshTableData();
        }).catch(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            if (typeof iziToast !== 'undefined') {
                iziToast.error({
                    title: 'Error!',
                    message: 'Some projects failed to update.',
                    position: 'topRight'
                });
            } else {
                alert('Some projects failed to update.');
            }
        });
    }

    function bulkDelete(ids) {
        // Show loading state
        var button = $('#bulk-delete');
        var originalText = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        
        var promises = ids.map(function(id) {
            return $.ajax({
                url: '/admin/projects/' + id,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        Promise.all(promises).then(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            updateStats();
            if (typeof iziToast !== 'undefined') {
                iziToast.success({
                    title: 'Success!',
                    message: 'Bulk delete completed!',
                    position: 'topRight'
                });
            } else {
                alert('Bulk delete completed!');
            }
            // Refresh table data instead of reloading page
            refreshTableData();
        }).catch(function() {
            // Re-enable button
            button.prop('disabled', false).html(originalText);
            
            if (typeof iziToast !== 'undefined') {
                iziToast.error({
                    title: 'Error!',
                    message: 'Some projects failed to delete.',
                    position: 'topRight'
                });
            } else {
                alert('Some projects failed to delete.');
            }
        });
    }

    // Clear filters
    $('#clear-filters').on('click', function() {
        $('#filter-status').val('');
        $('#filter-featured').val('');
        $('#filter-type').val('');
        $('#search-input').val('');
        applyFilters();
        
        if (typeof iziToast !== 'undefined') {
            iziToast.info({
                title: 'Info!',
                message: 'All filters cleared!',
                position: 'topRight'
                });
            } else {
                alert('All filters cleared!');
            }
        });

    // Export projects
    $('#export-projects').on('click', function() {
        var filters = {
            status: $('#filter-status').val(),
            featured: $('#filter-featured').val(),
            type: $('#filter-type').val(),
            search: $('#search-input').val()
        };

        var queryString = $.param(filters);
        window.location.href = '/admin/projects/export?' + queryString;
    });

    // Refresh table data
    function refreshTableData() {
        $.ajax({
            url: window.location.href,
            method: 'GET',
            success: function(response) {
                // Extract the table body from the response
                var newTableBody = $(response).find('#projects-table tbody').html();
                $('#projects-table tbody').html(newTableBody);
                
                // Re-bind event handlers for new elements
                bindEventHandlers();
                
                // Update statistics
                updateStats();
                
                // Update bulk action buttons
                updateBulkActionButtons();
            },
            error: function() {
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'Failed to refresh table data.',
                        position: 'topRight'
                    });
                } else {
                    alert('Failed to refresh table data.');
                }
            }
        });
    }

    // Function to bind event handlers to new elements
    function bindEventHandlers() {
        // Re-bind toggle status buttons
        $('.toggle-status').off('click').on('click', function() {
            var button = $(this);
            var projectId = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = currentStatus === 'active' ? 'inactive' : 'active';

            // Show loading state
            var originalHtml = button.html();
            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: '/admin/projects/' + projectId + '/toggle-status',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Re-enable button
                    button.prop('disabled', false).html(originalHtml);
                    
                    if (response.success) {
                        // Update button appearance
                        button.removeClass('btn-success btn-warning').addClass(newStatus === 'active' ? 'btn-warning' : 'btn-success');
                        button.data('status', newStatus);
                        button.attr('title', newStatus === 'active' ? 'Deactivate' : 'Activate');
                        
                        // Update icon
                        button.find('i').removeClass('fa-check fa-times').addClass(newStatus === 'active' ? 'fa-check' : 'fa-times');
                        
                        // Update status badge in the same row
                        var statusBadge = button.closest('tr').find('td:nth-child(7) .badge');
                        statusBadge.removeClass('badge-success badge-danger').addClass(newStatus === 'active' ? 'badge-success' : 'badge-danger');
                        statusBadge.text(newStatus === 'active' ? 'Active' : 'Inactive');
                        
                        // Update statistics
                        updateStats();
                        
                        // Show success message
                        if (typeof iziToast !== 'undefined') {
                            iziToast.success({
                                title: 'Success!',
                                message: 'Project status updated successfully!',
                                position: 'topRight'
                            });
                        } else {
                            alert('Project status updated successfully!');
                        }
                    } else {
                        if (typeof iziToast !== 'undefined') {
                            iziToast.error({
                                title: 'Error!',
                                message: 'Failed to update project status.',
                                position: 'topRight'
                            });
                        } else {
                            alert('Failed to update project status.');
                        }
                    }
                },
                error: function(xhr) {
                    // Re-enable button
                    button.prop('disabled', false).html(originalHtml);
                    
                    var errorMsg = 'An error occurred while updating project status.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: errorMsg,
                            position: 'topRight'
                        });
                    } else {
                        alert('Failed to update project status.');
                    }
                }
            });
        });

        // Re-bind toggle featured buttons
        $('.toggle-featured').off('click').on('click', function() {
            var button = $(this);
            var projectId = button.data('id');
            var currentFeatured = button.data('featured');
            var newFeatured = currentFeatured === 'featured' ? 'not-featured' : 'featured';

            // Show loading state
            var originalHtml = button.html();
            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: '/admin/projects/' + projectId + '/toggle-featured',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Re-enable button
                    button.prop('disabled', false).html(originalHtml);
                    
                    if (response.success) {
                        // Update button data
                        button.data('featured', newFeatured);
                        button.attr('title', newFeatured === 'featured' ? 'Unmark as Featured' : 'Mark as Featured');
                        
                        // Update featured badge in the same row
                        var featuredBadge = button.closest('tr').find('td:nth-child(8) .badge');
                        featuredBadge.removeClass('badge-warning badge-secondary').addClass(newFeatured === 'featured' ? 'badge-warning' : 'badge-secondary');
                        featuredBadge.text(newFeatured === 'featured' ? 'Featured' : 'No');
                        
                        // Update statistics
                        updateStats();
                        
                        // Show success message
                        if (typeof iziToast !== 'undefined') {
                            iziToast.success({
                                title: 'Success!',
                                message: 'Project featured status updated successfully!',
                                position: 'topRight'
                            });
                        } else {
                            alert('Project featured status updated successfully!');
                        }
                    } else {
                        if (typeof iziToast !== 'undefined') {
                            iziToast.error({
                                title: 'Error!',
                                message: 'Failed to update project featured status.',
                                position: 'topRight'
                            });
                        } else {
                            alert('Failed to update project featured status.');
                        }
                    }
                },
                error: function(xhr) {
                    // Re-enable button
                    button.prop('disabled', false).html(originalHtml);
                    
                    var errorMsg = 'An error occurred while updating project featured status.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: errorMsg,
                            position: 'topRight'
                        });
                    } else {
                        alert(errorMsg);
                    }
                }
            });
        });

        // Re-bind delete buttons
        $('.delete-project').off('click').on('click', function() {
            var projectId = $(this).data('id');
            var projectTitle = $(this).data('title');
            
            // Show confirmation dialog
            if (confirm('Are you sure you want to delete the project "' + projectTitle + '"?\n\nThis action cannot be undone and will permanently remove the project and all associated files.')) {
                deleteProject(projectId);
            }
        });

        // Re-bind checkboxes
        $('.project-checkbox').off('change').on('change', function() {
            updateSelectAllState();
            updateBulkActionButtons();
        });
    }

    // Update statistics
    function updateStats() {
        $.ajax({
            url: '/admin/projects/stats',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#total-projects').text(response.stats.total);
                    $('#active-projects').text(response.stats.active);
                    $('#featured-projects').text(response.stats.featured);
                    $('#total-views').text(response.stats.views);
                }
            }
        });
    }
});
</script>
@endpush





