@extends('admin.layout.app')

@section('title', 'Subscription Management')

@push('css')
<link rel="stylesheet" href="{{ url('assets-admin/bundles/ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ url('assets-admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<style>
.card-statistic-1 {
    margin-bottom: 1.5rem;
}

.empty-state {
    text-align: center;
    padding: 2rem;
}

.empty-state img {
    max-width: 100px;
    margin-bottom: 1rem;
}

.table th {
    background-color: #f8f9fa;
    border-top: none;
}

.btn-group .btn {
    margin-right: 0.25rem;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.form-inline .form-group {
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .form-inline {
        flex-direction: column;
        align-items: stretch;
    }
    
    .form-inline .form-group {
        margin-right: 0;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Subscription Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Subscriptions</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="ion-ios-mail"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Subscriptions</h4>
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
                        <i class="ion-ios-checkmark-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Active</h4>
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
                        <i class="ion-ios-calendar"></i>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="ion-ios-calendar-outline"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>This Week</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['this_week'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Subscriptions</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">
                                <i class="ion-plus"></i> Add Subscription
                            </a>
                            <div class="dropdown d-inline">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="ion-ios-download"></i> Export
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.subscriptions.export') }}">Export All</a>
                                    <a class="dropdown-item" href="{{ route('admin.subscriptions.export') }}?status=active">Export Active</a>
                                    <a class="dropdown-item" href="{{ route('admin.subscriptions.export') }}?status=inactive">Export Inactive</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <div class="form-group mr-2">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search subscriptions...">
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="statusFilter" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="sourceFilter" class="form-control">
                                            <option value="">All Sources</option>
                                            @foreach($sources as $source)
                                                <option value="{{ $source }}">{{ ucfirst($source) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <input type="date" id="dateFromFilter" class="form-control" placeholder="From Date">
                                    </div>
                                    <div class="form-group mr-2">
                                        <input type="date" id="dateToFilter" class="form-control" placeholder="To Date">
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="clearFilters" class="btn btn-secondary">Clear Filters</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bulk Actions -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <form id="bulkActionForm" method="POST" action="{{ route('admin.subscriptions.bulk-action') }}">
                                    @csrf
                                    <div class="form-inline">
                                        <select name="action" class="form-control mr-2" required>
                                            <option value="">Select Action</option>
                                            <option value="activate">Activate</option>
                                            <option value="deactivate">Deactivate</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <button type="submit" class="btn btn-warning" id="bulkActionBtn" disabled>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Subscriptions Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="subscriptionsTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Source</th>
                                        <th>Subscribed At</th>
                                        <th>Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subscriptions as $subscription)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="subscription-checkbox" value="{{ $subscription->id }}">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm mr-2">
                                                    <i class="ion-ios-mail text-primary"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold">{{ $subscription->email }}</div>
                                                    <small class="text-muted">ID: {{ $subscription->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $subscription->status_badge_class }}">
                                                {{ $subscription->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ ucfirst($subscription->source) }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="font-weight-bold">{{ $subscription->subscribed_at->format('M d, Y') }}</div>
                                                <small class="text-muted">{{ $subscription->subscribed_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($subscription->notes)
                                                <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $subscription->notes }}">
                                                    {{ $subscription->notes }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="ion-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="ion-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.subscriptions.toggle-status', $subscription) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm {{ $subscription->is_active ? 'btn-secondary' : 'btn-success' }}" title="{{ $subscription->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i class="ion-{{ $subscription->is_active ? 'close' : 'checkmark' }}"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.subscriptions.destroy', $subscription) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this subscription?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="ion-trash-a"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="empty-state">
                                                <img src="{{ url('assets-admin/img/empty-state.svg') }}" alt="Empty State">
                                                <h4>No subscriptions found</h4>
                                                <p>Start by adding your first subscription or check your filters.</p>
                                                <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">Add Subscription</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $subscriptions->links() }}
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
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const sourceFilter = document.getElementById('sourceFilter');
    const dateFromFilter = document.getElementById('dateFromFilter');
    const dateToFilter = document.getElementById('dateToFilter');
    const clearFiltersBtn = document.getElementById('clearFilters');

    function applyFilters() {
        const params = new URLSearchParams(window.location.search);
        
        if (searchInput.value) params.set('search', searchInput.value);
        if (statusFilter.value) params.set('status', statusFilter.value);
        if (sourceFilter.value) params.set('source', sourceFilter.value);
        if (dateFromFilter.value) params.set('date_from', dateFromFilter.value);
        if (dateToFilter.value) params.set('date_to', dateToFilter.value);

        window.location.search = params.toString();
    }

    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });

    statusFilter.addEventListener('change', applyFilters);
    sourceFilter.addEventListener('change', applyFilters);
    dateFromFilter.addEventListener('change', applyFilters);
    dateToFilter.addEventListener('change', applyFilters);

    clearFiltersBtn.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        sourceFilter.value = '';
        dateFromFilter.value = '';
        dateToFilter.value = '';
        window.location.search = '';
    });

    // Bulk actions
    const selectAllCheckbox = document.getElementById('selectAll');
    const subscriptionCheckboxes = document.querySelectorAll('.subscription-checkbox');
    const bulkActionBtn = document.getElementById('bulkActionBtn');

    function updateBulkActionButton() {
        const checkedBoxes = document.querySelectorAll('.subscription-checkbox:checked');
        bulkActionBtn.disabled = checkedBoxes.length === 0;
    }

    selectAllCheckbox.addEventListener('change', function() {
        subscriptionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActionButton();
    });

    subscriptionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActionButton);
    });

    // Bulk action form submission
    document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
        const checkedBoxes = document.querySelectorAll('.subscription-checkbox:checked');
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            alert('Please select at least one subscription.');
            return;
        }

        // Add selected subscriptions to form
        checkedBoxes.forEach(function(checkbox) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'subscriptions[]';
            input.value = checkbox.value;
            this.appendChild(input);
        }.bind(this));
    });
});
</script>
@endpush
