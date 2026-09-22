@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>News Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">News</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total News</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['total'] }}
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
                            <h4>Active News</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['active'] }}
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
                            <h4>Featured News</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['featured'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Month</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['this_month'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All News Articles</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add News
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" id="search" class="form-control" placeholder="Search news...">
                            </div>
                            <div class="col-md-2">
                                <select id="status-filter" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="featured-filter" class="form-control">
                                    <option value="">All Featured</option>
                                    <option value="featured">Featured</option>
                                    <option value="not-featured">Not Featured</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" id="from-date" class="form-control" placeholder="From Date">
                            </div>
                            <div class="col-md-2">
                                <input type="date" id="to-date" class="form-control" placeholder="To Date">
                            </div>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="bulk-actions">
                                    <select id="bulk-action" class="form-control d-inline-block w-auto">
                                        <option value="">Bulk Actions</option>
                                        <option value="delete">Delete</option>
                                        <option value="activate">Activate</option>
                                        <option value="deactivate">Deactivate</option>
                                        <option value="feature">Mark as Featured</option>
                                        <option value="unfeature">Unmark as Featured</option>
                                    </select>
                                    <button id="apply-bulk-action" class="btn btn-secondary" disabled>Apply</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('admin.news.export') }}" class="btn btn-success">
                                    <i class="fas fa-download"></i> Export
                                </a>
                            </div>
                        </div>

                        <!-- News Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="news-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>Title</th>
                                        <th>YouTube Link</th>
                                        <th>Posted Date</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($news as $article)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="news-checkbox" value="{{ $article->id }}">
                                            </td>
                                            <td>
                                                <div class="news-title">
                                                    <strong>{{ $article->title }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($article->content, 100) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ $article->youtube_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fab fa-youtube"></i> View Video
                                                </a>
                                            </td>
                                            <td>{{ $article->formatted_posted_date }}</td>
                                                                                         <td>
                                                 <span class="badge {{ $article->is_active == 1 ? 'bg-success' : 'bg-danger' }}">
                                                     {{ $article->is_active == 1 ? 'Active' : 'Inactive' }}
                                                 </span>
                                             </td>
                                             <td>
                                                 <span class="badge {{ $article->featured == 1 ? 'bg-warning' : 'bg-secondary' }}">
                                                     {{ $article->featured == 1 ? 'Yes' : 'No' }}
                                                 </span>
                                             </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.news.show', $article) }}" class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-success toggle-status" 
                                                            data-id="{{ $article->id }}" 
                                                            data-status="{{ $article->is_active == 1 ? 'active' : 'inactive' }}"
                                                            title="{{ $article->is_active == 1 ? 'Deactivate' : 'Activate' }}">
                                                        <i class="fas fa-{{ $article->is_active == 1 ? 'check' : 'times' }}"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-warning toggle-featured" 
                                                            data-id="{{ $article->id }}" 
                                                            data-featured="{{ $article->featured == 1 ? 'featured' : 'not-featured' }}"
                                                            title="{{ $article->featured == 1 ? 'Unmark as Featured' : 'Mark as Featured' }}">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-news" 
                                                            data-id="{{ $article->id }}" 
                                                            data-title="{{ $article->title }}"
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
                            {{ $news->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the news article "<strong id="delete-news-title"></strong>"?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (Load First) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#news-table').DataTable({
        pageLength: 15,
        order: [[3, 'desc']], // Sort by posted date descending
        columnDefs: [
            { orderable: false, targets: [0, 6] } // Disable sorting for checkbox and actions columns
        ]
    });

    // Search functionality
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Status filter
    $('#status-filter').on('change', function() {
        const status = $(this).val();
        if (status) {
            table.column(4).search(status === 'active' ? 'Active' : 'Inactive').draw();
        } else {
            table.column(4).search('').draw();
        }
    });

    // Featured filter
    $('#featured-filter').on('change', function() {
        const featured = $(this).val();
        if (featured) {
            table.column(5).search(featured === 'featured' ? 'Yes' : 'No').draw();
        } else {
            table.column(5).search('').draw();
        }
    });

    // Date filters
    $('#from-date, #to-date').on('change', function() {
        const fromDate = $('#from-date').val();
        const toDate = $('#to-date').val();
        
        if (fromDate || toDate) {
            // Custom date filtering logic can be implemented here
            // For now, we'll just redraw the table
            table.draw();
        }
    });

    // Select all functionality
    $('#select-all').on('change', function() {
        $('.news-checkbox').prop('checked', this.checked);
        updateBulkActionButton();
    });

    // Individual checkbox change
    $('.news-checkbox').on('change', function() {
        updateBulkActionButton();
        
        // Update select all checkbox
        const totalCheckboxes = $('.news-checkbox').length;
        const checkedCheckboxes = $('.news-checkbox:checked').length;
        
        if (checkedCheckboxes === 0) {
            $('#select-all').prop('indeterminate', false).prop('checked', false);
        } else if (checkedCheckboxes === totalCheckboxes) {
            $('#select-all').prop('indeterminate', false).prop('checked', true);
        } else {
            $('#select-all').prop('indeterminate', true);
        }
    });

    // Update bulk action button state
    function updateBulkActionButton() {
        const checkedCount = $('.news-checkbox:checked').length;
        const bulkAction = $('#bulk-action').val();
        
        $('#apply-bulk-action').prop('disabled', checkedCount === 0 || !bulkAction);
    }

    // Bulk action change
    $('#bulk-action').on('change', updateBulkActionButton);

    // Apply bulk action
    $('#apply-bulk-action').on('click', function() {
        const action = $('#bulk-action').val();
        const newsIds = $('.news-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (newsIds.length === 0) {
            alert('Please select at least one news article.');
            return;
        }

        if (!action) {
            alert('Please select an action.');
            return;
        }

        if (confirm(`Are you sure you want to ${action} ${newsIds.length} news article(s)?`)) {
            $.ajax({
                url: '{{ route("admin.news.bulk-action") }}',
                method: 'POST',
                data: {
                    action: action,
                    news_ids: newsIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while performing the bulk action.');
                }
            });
        }
    });

    // Toggle status
    $('.toggle-status').on('click', function() {
        const button = $(this);
        const newsId = button.data('id');
        const currentStatus = button.data('status');
        const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
        const actionText = currentStatus === 'active' ? 'deactivate' : 'activate';

        if (confirm(`Are you sure you want to ${actionText} this news article?`)) {
            $.ajax({
                url: `/admin/news/${newsId}/toggle-status`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update button appearance without reload
                        button.data('status', newStatus);
                        button.attr('title', newStatus === 'active' ? 'Deactivate' : 'Activate');
                        button.find('i').attr('class', `fas fa-${newStatus === 'active' ? 'check' : 'times'}`);
                        
                        // Update status badge in the same row
                        const statusBadge = button.closest('tr').find('td:nth-child(5) .badge');
                        if (newStatus === 'active') {
                            statusBadge.removeClass('bg-danger').addClass('bg-success').text('Active');
                        } else {
                            statusBadge.removeClass('bg-success').addClass('bg-danger').text('Inactive');
                        }
                        
                        // Update statistics
                        updateStats();
                        
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while updating the status.');
                }
            });
        }
    });

    // Toggle featured
    $('.toggle-featured').on('click', function() {
        const button = $(this);
        const newsId = button.data('id');
        const currentFeatured = button.data('featured');
        const newFeatured = currentFeatured === 'featured' ? 'not-featured' : 'featured';
        const actionText = currentFeatured === 'featured' ? 'unmark as featured' : 'mark as featured';

        if (confirm(`Are you sure you want to ${actionText} this news article?`)) {
            $.ajax({
                url: `/admin/news/${newsId}/toggle-featured`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update button appearance without reload
                        button.data('featured', newFeatured);
                        button.attr('title', newFeatured === 'featured' ? 'Unmark as Featured' : 'Mark as Featured');
                        
                        // Update featured badge in the same row
                        const featuredBadge = button.closest('tr').find('td:nth-child(6) .badge');
                        if (newFeatured === 'featured') {
                            featuredBadge.removeClass('bg-secondary').addClass('bg-warning').text('Yes');
                        } else {
                            featuredBadge.removeClass('bg-warning').addClass('bg-secondary').text('No');
                        }
                        
                        // Update statistics
                        updateStats();
                        
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while updating the featured status.');
                }
            });
        }
    });

    // Delete news
    $('.delete-news').on('click', function() {
        const newsId = $(this).data('id');
        const newsTitle = $(this).data('title');
        
        $('#delete-news-title').text(newsTitle);
        
        // Show modal using Bootstrap 5
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
        
        $('#confirm-delete').off('click').on('click', function() {
            $.ajax({
                url: `/admin/news/${newsId}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Hide modal using Bootstrap 5
                    deleteModal.hide();
                    
                    // Remove the row from the table without reload
                    const row = $(`button[data-id="${newsId}"]`).closest('tr');
                    row.fadeOut(400, function() {
                        row.remove();
                        // Update statistics
                        updateStats();
                    });
                    
                    alert('News article deleted successfully!');
                },
                error: function() {
                    alert('An error occurred while deleting the news article.');
                }
            });
        });
    });

    // Function to update statistics without page reload
    function updateStats() {
        $.ajax({
            url: '{{ route("admin.news.stats") }}',
            method: 'GET',
            success: function(stats) {
                // Update statistics cards
                $('.card-statistic-1:nth-child(1) .card-body').text(stats.total);
                $('.card-statistic-1:nth-child(2) .card-body').text(stats.active);
                $('.card-statistic-1:nth-child(3) .card-body').text(stats.featured);
                $('.card-statistic-1:nth-child(4) .card-body').text(stats.this_month);
            },
            error: function() {
                console.log('Failed to update statistics');
            }
        });
    }
});
</script>
@endsection
