@extends('admin.layout.app')

@section('title', 'Contact Leads Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Contact Leads</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Contact Leads</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.contacts.export') }}" class="btn btn-primary">
                    <i class="icon-download"></i> Export CSV
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-primary">
                            <i class="icon-mail"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $stats['total'] }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Total Leads</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-warning">
                            <i class="icon-clock"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $stats['new'] }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">New Leads</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-info">
                            <i class="icon-eye"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $stats['unread'] }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Unread</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon bg-success">
                            <i class="icon-calendar"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $stats['today'] }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">
                        <h6 class="text-muted">Today</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="status">
                        <option value="">All Status</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="source">
                        <option value="">All Sources</option>
                        <option value="contact_page" {{ request('source') == 'contact_page' ? 'selected' : '' }}>Contact Page</option>
                        <option value="property_inquiry" {{ request('source') == 'property_inquiry' ? 'selected' : '' }}>Property Inquiry</option>
                        <option value="agent_inquiry" {{ request('source') == 'agent_inquiry' ? 'selected' : '' }}>Agent Inquiry</option>
                        <option value="general" {{ request('source') == 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="date_from" placeholder="From Date" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="date_to" placeholder="To Date" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="icon-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contacts Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form id="bulkActionForm" method="POST" action="{{ route('admin.contacts.bulk-action') }}">
                    @csrf
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="selectAll">
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $contact)
                            <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                <td>
                                    <input type="checkbox" name="contacts[]" value="{{ $contact->id }}" class="contact-checkbox">
                                </td>
                                <td>{{ $contact->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <div class="avatar-title rounded-circle bg-primary">
                                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $contact->name }}</h6>
                                            @if($contact->phone)
                                                <small class="text-muted">{{ $contact->phone }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $contact->subject }}">
                                        {{ $contact->subject }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $contact->source)) }}</span>
                                </td>
                                <td>
                                    @switch($contact->status)
                                        @case('new')
                                            <span class="badge bg-warning">New</span>
                                            @break
                                        @case('read')
                                            <span class="badge bg-info">Read</span>
                                            @break
                                        @case('replied')
                                            <span class="badge bg-success">Replied</span>
                                            @break
                                        @case('closed')
                                            <span class="badge bg-secondary">Closed</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div>
                                        <div>{{ $contact->created_at->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $contact->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.contacts.show', $contact->id) }}">
                                                    <i class="icon-eye"></i> View Details
                                                </a>
                                            </li>
                                            @if(!$contact->is_read)
                                            <li>
                                                <a class="dropdown-item mark-read" href="#" data-id="{{ $contact->id }}">
                                                    <i class="icon-check"></i> Mark as Read
                                                </a>
                                            </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item" href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}">
                                                    <i class="icon-mail"></i> Reply via Email
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this contact?')">
                                                        <i class="icon-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="icon-mail" style="font-size: 3rem; color: #ccc;"></i>
                                        <h5 class="mt-3">No contacts found</h5>
                                        <p class="text-muted">There are no contact leads matching your criteria.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>

            <!-- Bulk Actions -->
            @if($contacts->count() > 0)
            <div class="bulk-actions mt-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span class="text-muted">
                            <span id="selectedCount">0</span> contacts selected
                        </span>
                    </div>
                    <div class="col-md-6 text-end">
                        <select class="form-select d-inline-block w-auto me-2" id="bulkAction">
                            <option value="">Bulk Actions</option>
                            <option value="mark_read">Mark as Read</option>
                            <option value="mark_replied">Mark as Replied</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                        <button type="button" class="btn btn-primary" id="applyBulkAction" disabled>
                            Apply
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $contacts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Leads by Source</h5>
            </div>
            <div class="card-body">
                <canvas id="sourceChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Leads by Status</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All functionality
    const selectAll = document.getElementById('selectAll');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const applyBulkAction = document.getElementById('applyBulkAction');

    selectAll.addEventListener('change', function() {
        contactCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    contactCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    function updateSelectedCount() {
        const checkedCount = document.querySelectorAll('.contact-checkbox:checked').length;
        selectedCount.textContent = checkedCount;
        applyBulkAction.disabled = checkedCount === 0;
    }

    // Bulk Actions
    applyBulkAction.addEventListener('click', function() {
        const action = document.getElementById('bulkAction').value;
        if (!action) {
            alert('Please select an action');
            return;
        }

        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('Please select contacts to perform this action');
            return;
        }

        if (action === 'delete' && !confirm('Are you sure you want to delete the selected contacts?')) {
            return;
        }

        document.getElementById('bulkActionForm').submit();
    });

    // Mark as Read functionality
    document.querySelectorAll('.mark-read').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const contactId = this.dataset.id;
            
            fetch(`/admin/contacts/${contactId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: 'read'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        });
    });

    // Charts
    const sourceCtx = document.getElementById('sourceChart').getContext('2d');
    const statusCtx = document.getElementById('statusChart').getContext('2d');

    // Source Chart
    new Chart(sourceCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($sources->pluck('source')) !!},
            datasets: [{
                data: {!! json_encode($sources->pluck('count')) !!},
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ]
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

    // Status Chart
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($statuses->pluck('status')) !!},
            datasets: [{
                label: 'Count',
                data: {!! json_encode($statuses->pluck('count')) !!},
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#4BC0C0',
                    '#9966FF'
                ]
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
});
</script>
@endpush

@push('styles')
<style>
.empty-state {
    text-align: center;
    padding: 2rem;
}

.empty-state i {
    opacity: 0.5;
}

.bulk-actions {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
}

.avatar {
    width: 32px;
    height: 32px;
}

.avatar-title {
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.table-warning {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.badge {
    font-size: 0.75rem;
}

.dropdown-item {
    padding: 0.5rem 1rem;
}

.dropdown-item i {
    margin-right: 0.5rem;
    width: 16px;
}
</style>
@endpush
