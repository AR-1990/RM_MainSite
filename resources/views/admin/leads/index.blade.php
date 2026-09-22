@extends('admin.layout.app')

@section('title', 'Lead Management')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
<!-- DEBUG: Page loaded at {{ now() }} -->
{{-- <div style="background: #ffeb3b; padding: 10px; margin: 10px; border: 2px solid #f57f17; text-align: center; font-weight: bold;">
    🚀 DEBUG: Page loaded successfully at {{ now() }} - If you see this, the page is working!
    <br><br>
    <button onclick="testDataTables()" class="btn btn-info btn-sm">Test DataTables</button>
    <button onclick="testjQuery()" class="btn btn-success btn-sm">Test jQuery</button>
    <br><br>
    <span id="jsStatus" style="color: #d32f2f; font-weight: bold;">⏳ JavaScript Status: Loading...</span>
</div> --}}

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lead Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Leads</div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="ion-ios-people"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Leads</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['total'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="ion-ios-time"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Open Leads</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['open'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="ion-ios-loop"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>In Progress</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['in_progress'] }}
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
                            <h4>Closed</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['closed'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="ion-ios-warning"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>High Priority</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['high_priority'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="ion-ios-person-add"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Unassigned</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['unassigned'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="ion-ios-calendar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Today</h4>
                        </div>
                        <div class="card-body">
                            {{ $stats['today'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
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
                        <h4>All Leads</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.leads.create') }}" class="btn btn-primary">
                                <i class="ion-plus"></i> Create Lead
                            </a>
                            <div class="dropdown d-inline">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="ion-ios-download"></i> Export
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.leads.export') }}">Export All</a>
                                    <a class="dropdown-item" href="{{ route('admin.leads.export') }}?status=open">Export Open</a>
                                    <a class="dropdown-item" href="{{ route('admin.leads.export') }}?status=in_progress">Export In Progress</a>
                                    <a class="dropdown-item" href="{{ route('admin.leads.export') }}?status=closed">Export Closed</a>
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
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search leads...">
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="statusFilter" class="form-control">
                                            <option value="">All Status</option>
                                            <option value="new">New</option>
                                            <option value="open">Open</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="closed">Closed</option>
                                            <option value="lost">Lost</option>
                                            <option value="cancel">Cancel</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="priorityFilter" class="form-control">
                                            <option value="">All Priority</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="sourceFilter" class="form-control">
                                            <option value="">All Sources</option>
                                            <option value="contact_form">Contact Form</option>
                                            <option value="website">Website</option>
                                            <option value="referral">Referral</option>
                                            <option value="social_media">Social Media</option>
                                            <option value="cold_call">Cold Call</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select id="assignedFilter" class="form-control">
                                            <option value="">All Users</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                <form id="bulkActionForm" method="POST" action="{{ route('admin.leads.bulk-action') }}">
                                    @csrf
                                    <div class="form-inline">
                                        <select name="action" class="form-control mr-2" required>
                                            <option value="">Select Action</option>
                                            <option value="assign">Assign to User</option>
                                            <option value="change_status">Change Status</option>
                                            <option value="change_priority">Change Priority</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <select name="assigned_to" class="form-control mr-2" style="display: none;" id="bulkAssignTo">
                                            <option value="">Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <select name="status" class="form-control mr-2" style="display: none;" id="bulkStatus">
                                            <option value="">Select Status</option>
                                            <option value="new">New</option>
                                            <option value="open">Open</option>
                                            <option value="in_progress">In Progress</option>
                                            <option value="closed">Closed</option>
                                            <option value="lost">Lost</option>
                                            <option value="cancel">Cancel</option>
                                        </select>
                                        <select name="priority" class="form-control mr-2" style="display: none;" id="bulkPriority">
                                            <option value="">Select Priority</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                        <button type="submit" class="btn btn-warning" id="bulkActionBtn" disabled>Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Leads Table -->
                        <div class="table-responsive">
                            <table class="table table-striped" id="leadsTable">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>Lead</th>
                                        <th>Contact</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Priority</th>
                                        <th>Value</th>
                                        <th>Assigned To</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded by DataTables -->
                                </tbody>
                            </table>
                        </div>

                        <!-- DataTables handles pagination automatically -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this lead? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
if (window.__leadsPageScriptBooted) {
    console.warn('Leads page script already booted. Skipping duplicate setup.');
} else {
window.__leadsPageScriptBooted = true;

// Global functions for HTML onclick handlers
window.deleteLead = function(leadId) {
    if (confirm('Are you sure you want to delete this lead?')) {
        $.ajax({
            url: `/admin/leads/${leadId}`,
            type: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Refresh the DataTable
                if (window.leadsTable) {
                    window.leadsTable.ajax.reload(null, false);
                }
                alert('Lead deleted successfully');
            },
            error: function() {
                alert('Error deleting lead. Please try again.');
            }
        });
    }
};

if (typeof $ !== 'undefined' && typeof $.fn.DataTable !== 'undefined' && document.getElementById('leadsTable')) {
    if ($.fn.DataTable.isDataTable('#leadsTable')) {
        window.leadsTable = $('#leadsTable').DataTable();
    } else {
        window.leadsTable = $('#leadsTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: "{{ route('admin.leads.index') }}",
            type: "GET",
            data: function(d) {
                d.search = $('#searchInput').val();
                d.status = $('#statusFilter').val();
                d.priority = $('#priorityFilter').val();
                d.source = $('#sourceFilter').val();
                d.assigned_to = $('#assignedFilter').val();
                d.date_from = $('#dateFromFilter').val();
                d.date_to = $('#dateToFilter').val();
            },
            error: function(xhr, error, thrown) {
                console.error('Leads DataTable AJAX error:', error, thrown, xhr.responseText);
            }
        },
        columns: [
            { data: 'checkbox', orderable: false, searchable: false },
            { data: 'lead' },
            { data: 'contact' },
            { data: 'source' },
            { data: 'status' },
            { data: 'priority' },
            { data: 'value' },
            { data: 'assigned_to' },
            { data: 'created' },
            { data: 'actions', orderable: false, searchable: false }
        ],
        order: [[8, 'desc']], // Default sort by created column descending
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search leads..."
        },
        initComplete: function() {
            // Activate DataTables search input
            $('#searchInput').off('.leadsTable').on('keyup.leadsTable', function() {
                window.leadsTable.search(this.value).draw();
            });

            // Activate DataTables status filter
            $('#statusFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Activate DataTables priority filter
            $('#priorityFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Activate DataTables source filter
            $('#sourceFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Activate DataTables assigned_to filter
            $('#assignedFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Activate DataTables date_from filter
            $('#dateFromFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Activate DataTables date_to filter
            $('#dateToFilter').off('.leadsTable').on('change.leadsTable', function() {
                window.leadsTable.draw();
            });

            // Clear filters button
            $('#clearFilters').off('.leadsTable').on('click.leadsTable', function() {
                $('#searchInput').val('').trigger('keyup');
                $('#statusFilter').val('').trigger('change');
                $('#priorityFilter').val('').trigger('change');
                $('#sourceFilter').val('').trigger('change');
                $('#assignedFilter').val('').trigger('change');
                $('#dateFromFilter').val('').trigger('change');
                $('#dateToFilter').val('').trigger('change');
                window.leadsTable.draw();
            });
        }
    });
    }

    // Bulk action form handling
    const actionSelect = document.querySelector('select[name="action"]');
    const bulkAssignTo = document.getElementById('bulkAssignTo');
    const bulkStatus = document.getElementById('bulkStatus');
    const bulkPriority = document.getElementById('bulkPriority');
    const bulkActionBtn = document.getElementById('bulkActionBtn');
    const selectAllCheckbox = document.getElementById('selectAll');

    // Show/hide relevant fields based on action
    actionSelect.addEventListener('change', function() {
        bulkAssignTo.style.display = 'none';
        bulkStatus.style.display = 'none';
        bulkPriority.style.display = 'none';

        switch(this.value) {
            case 'assign':
                bulkAssignTo.style.display = 'inline-block';
                break;
            case 'change_status':
                bulkStatus.style.display = 'inline-block';
                break;
            case 'change_priority':
                bulkPriority.style.display = 'inline-block';
                break;
        }
    });

    // Select all functionality for DataTable
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = window.leadsTable.$('.lead-checkbox');
        checkboxes.prop('checked', this.checked);
        updateBulkActionButton();
    });

    // Update bulk action button when checkboxes change
    function updateBulkActionButton() {
        const checkedBoxes = window.leadsTable.$('.lead-checkbox:checked');
        bulkActionBtn.disabled = checkedBoxes.length === 0;
    }

    // Delegate checkbox events for DataTable
    $(document).off('change.leadsTable', '.lead-checkbox').on('change.leadsTable', '.lead-checkbox', function() {
        updateBulkActionButton();
        
        // Update select all checkbox
        const totalCheckboxes = window.leadsTable.$('.lead-checkbox').length;
        const checkedCheckboxes = window.leadsTable.$('.lead-checkbox:checked').length;
        selectAllCheckbox.checked = checkedCheckboxes === totalCheckboxes;
        selectAllCheckbox.indeterminate = checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes;
    });

    // Bulk action form submission
    document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
        const checkedBoxes = window.leadsTable.$('.lead-checkbox:checked');
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            alert('Please select at least one lead.');
            return;
        }

        const action = actionSelect.value;
        if (!action) {
            e.preventDefault();
            alert('Please select an action.');
            return;
        }

        // Validate required fields based on action
        switch(action) {
            case 'assign':
                if (!bulkAssignTo.value) {
                    e.preventDefault();
                    alert('Please select a user to assign.');
                    return;
                }
                break;
            case 'change_status':
                if (!bulkStatus.value) {
                    e.preventDefault();
                    alert('Please select a status.');
                    return;
                }
                break;
            case 'change_priority':
                if (!bulkPriority.value) {
                    e.preventDefault();
                    alert('Please select a priority.');
                    return;
                }
                break;
        }

        // Add selected leads to form
        checkedBoxes.each(function() {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'leads[]';
            input.value = $(this).val();
            document.getElementById('bulkActionForm').appendChild(input);
        });
    });
}
}
</script>
@endpush
