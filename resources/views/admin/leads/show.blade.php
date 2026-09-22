@extends('admin.layout.app')

@section('title', 'Lead Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lead Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a></div>
                <div class="breadcrumb-item">Details</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Lead Information -->
                <div class="col-lg-6">
                    <div class="card main-lead-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">{{ $lead->title }}</h4>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="actionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cog"></i> Actions
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actionDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.leads.edit', $lead->id) }}">
                                            <i class="fas fa-edit"></i> Edit Lead
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="changeStatus()">
                                            <i class="fas fa-exchange-alt"></i> Change Status
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="assignLead()">
                                            <i class="fas fa-user-plus"></i> Assign Lead
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#" onclick="deleteLead()">
                                            <i class="fas fa-trash"></i> Delete Lead
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Status Badge -->
                            <div class="status-section mb-4">
                                <span class="badge badge-{{ $lead->status == 'open' ? 'info' : ($lead->status == 'in_progress' ? 'warning' : 'success') }} badge-lg">
                                    {{ ucfirst(str_replace('_', ' ', $lead->status)) }}
                                </span>
                                <span class="badge badge-{{ $lead->priority == 'low' ? 'secondary' : ($lead->priority == 'medium' ? 'info' : ($lead->priority == 'high' ? 'warning' : 'danger')) }} badge-lg ml-2">
                                    {{ ucfirst($lead->priority) }} Priority
                                </span>
                            </div>

                            <!-- Description -->
                            @if($lead->description)
                            <div class="info-section mb-4">
                                <h6 class="section-title"><i class="fas fa-align-left text-primary"></i> Description</h6>
                                <p class="text-muted mb-0">{{ $lead->description }}</p>
                            </div>
                            @endif

                            <!-- Contact Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="section-title"><i class="fas fa-address-book text-success"></i> Contact Information</h6>
                                        <div class="info-item">
                                            <span class="info-label">Name:</span>
                                            <span class="info-value">{{ $lead->contact_name }}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Email:</span>
                                            <span class="info-value"><a href="mailto:{{ $lead->contact_email }}">{{ $lead->contact_email }}</a></span>
                                        </div>
                                        @if($lead->contact_phone)
                                        <div class="info-item">
                                            <span class="info-label">Phone:</span>
                                            <span class="info-value"><a href="tel:{{ $lead->contact_phone }}">{{ $lead->contact_phone }}</a></span>
                                        </div>
                                        @endif
                                        @if($lead->company)
                                        <div class="info-item">
                                            <span class="info-label">Company:</span>
                                            <span class="info-value">{{ $lead->company }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h6 class="section-title"><i class="fas fa-info-circle text-info"></i> Lead Details</h6>
                                        <div class="info-item">
                                            <span class="info-label">Source:</span>
                                            <span class="info-value">{!! $lead->source_badge !!}</span>
                                        </div>
                                        <div class="info-item">
                                            <span class="info-label">Created:</span>
                                            <span class="info-value">{{ $lead->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                        @if($lead->expected_close_date)
                                        <div class="info-item">
                                            <span class="info-label">Expected Close:</span>
                                            <span class="info-value">{{ $lead->expected_close_date->format('M d, Y') }}</span>
                                        </div>
                                        @endif
                                        @if($lead->value)
                                        <div class="info-item">
                                            <span class="info-label">Value:</span>
                                            <span class="info-value text-success font-weight-bold">{{ $lead->currency }} {{ number_format($lead->value, 2) }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Assignment Information -->
                            <div class="info-section mb-4">
                                <h6 class="section-title"><i class="fas fa-user-check text-warning"></i> Assignment</h6>
                                @if($lead->assigned_to)
                                    <div class="info-item">
                                        <span class="info-label">Assigned To:</span>
                                        <span class="info-value">
                                            <span class="badge badge-info">{{ $lead->assignedUser->name ?? 'Unknown User' }}</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="info-item">
                                        <span class="info-label">Status:</span>
                                        <span class="info-value">
                                            <span class="badge badge-secondary">Unassigned</span>
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Notes -->
                            @if($lead->notes)
                            <div class="info-section mb-4">
                                <h6 class="section-title"><i class="fas fa-sticky-note text-warning"></i> Notes</h6>
                                <p class="text-muted mb-0">{{ $lead->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-comments text-primary"></i> Comments & Activity</h4>
                        </div>
                        <div class="card-body">
                            <!-- Add Comment Form -->
                            <form action="{{ route('admin.leads.comments.store', $lead->id) }}" method="POST" class="comment-form mb-4">
                                @csrf
                                <div class="form-group">
                                    <label for="comment">Add Comment</label>
                                    <textarea id="comment" name="comment" rows="3" class="form-control @error('comment') is-invalid @enderror" 
                                              placeholder="Add your comment here..." required></textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-comment"></i> Add Comment
                                </button>
                            </form>

                            <!-- Comments List -->
                            <div class="comments-list">
                                @forelse($lead->comments()->orderBy('created_at', 'desc')->get() as $comment)
                                <div class="comment-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-2">
                                                <strong class="mr-2">{{ $comment->user->name }}</strong>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0">{{ $comment->comment }}</p>
                                        </div>
                                        @if(auth()->user()->id == $comment->user_id || auth()->user()->is_admin)
                                        <div class="ml-2">
                                            <button class="btn btn-sm btn-outline-danger" onclick="deleteComment({{ $comment->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-comments fa-3x mb-3"></i>
                                    <p>No comments yet. Be the first to add a comment!</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-3">
                    <!-- Status Change Card -->
                    <div class="card sidebar-card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-exchange-alt text-primary"></i> Change Status</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.leads.update-status', $lead->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                                        <option value="open" {{ $lead->status == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ $lead->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                        <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
                                        <option value="cancel" {{ $lead->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Assignment Card -->
                    <div class="card sidebar-card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-user-plus text-success"></i> Assign Lead</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.leads.assign', $lead->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="assigned_to">Assign To</label>
                                    <select id="assigned_to" name="assigned_to" class="form-control">
                                        <option value="">Unassigned</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $lead->assigned_to == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-user-plus"></i> Assign Lead
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="card sidebar-card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-history text-info"></i> Activity Timeline</h4>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Lead Created</h6>
                                        <p class="timeline-text">{{ $lead->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                @if($lead->assigned_to)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Assigned to {{ $lead->assignedUser->name ?? 'User' }}</h6>
                                        <p class="timeline-text">{{ $lead->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                @endif
                                @foreach($lead->comments()->orderBy('created_at', 'desc')->take(3)->get() as $comment)
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <h6 class="timeline-title">Comment by {{ $comment->user->name }}</h6>
                                        <p class="timeline-text">{{ $comment->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Change Lead Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.leads.update-status', $lead->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="modal_status">Status</label>
                        <select id="modal_status" name="status" class="form-control">
                            <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="open" {{ $lead->status == 'open' ? 'selected' : '' }}>Open</option>
                            <option value="in_progress" {{ $lead->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="lost" {{ $lead->status == 'lost' ? 'selected' : '' }}>Lost</option>
                            <option value="cancel" {{ $lead->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assignment Modal -->
<div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="assignmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignmentModalLabel">Assign Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.leads.assign', $lead->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="modal_assigned_to">Assign To</label>
                        <select id="modal_assigned_to" name="assigned_to" class="form-control">
                            <option value="">Unassigned</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $lead->assigned_to == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Assign Lead</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
/* Match property page alignment */
.main-content {
    padding: 0;
    margin-top: 0;
}

.section {
    padding: 1.5rem 0;
    margin-top: 0;
}

.section-header {
    padding: 1rem 0;
    margin-bottom: 1rem;
}

.section-header h1 {
    font-size: 1.7rem;
    margin-bottom: 0.4rem;
}

.section-header-breadcrumb {
    margin-bottom: 0;
}

.section-body {
    padding: 0;
}

/* Content layout */
.main-lead-card {
    margin-bottom: 1rem;
}

.sidebar-card {
    margin-bottom: 1rem;
}

/* Information sections */
.info-section {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 3px solid #007bff;
}

.section-title {
    color: #495057;
    margin-bottom: 0.75rem;
    font-weight: 600;
    font-size: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 600;
    color: #495057;
    min-width: 120px;
}

.info-value {
    color: #6c757d;
    text-align: right;
    flex: 1;
}

/* Status section */
.status-section {
    background: #f8f9fa;
    padding: 0.75rem;
    border-radius: 8px;
    text-align: center;
}

/* Comments section */
.comment-form {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
}

.comment-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
}

.comment-item:last-child {
    border-bottom: none;
}

/* Timeline styling */
.timeline {
    position: relative;
    padding-left: 20px;
}

.timeline-item {
    position: relative;
    padding-bottom: 15px;
}

.timeline-marker {
    position: absolute;
    left: -30px;
    top: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-content {
    margin-left: 10px;
}

.timeline-title {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}

.timeline-text {
    margin: 0;
    font-size: 12px;
    color: #6c757d;
}

/* Responsive design */
@media (max-width: 768px) {
    .section-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }
    
    .info-label {
        min-width: auto;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        text-align: left;
        width: 100%;
    }
}

/* Card improvements */
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 8px;
}

.card-header {
    background: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
}

.card-body {
    padding: 1rem;
}

/* Form improvements */
.form-control {
    border-radius: 6px;
    border: 1px solid #d1d3e2;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Button improvements */
.btn {
    border-radius: 6px;
    font-weight: 500;
}

.btn-block {
    width: 100%;
}

/* Match property page navbar alignment */
@media (min-width: 992px) {
    .main-content {
        margin-left: 260px;
        transition: margin-left 0.3s ease;
    }
    
    .main-content.navbar-collapsed {
        margin-left: 0;
        width: 100%;
    }
}

body {
    padding-top: 0;
}

.navbar-fixed-top + .main-content {
    margin-top: 60px;
}
</style>
@endpush

@push('scripts')
<script>
// Simple navbar detection
function adjustLayoutForNavbar() {
    const mainContent = document.querySelector('.main-content');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebar && window.getComputedStyle(sidebar).display === 'none') {
        mainContent.classList.add('navbar-collapsed');
    } else {
        mainContent.classList.remove('navbar-collapsed');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    adjustLayoutForNavbar();
    
    const sidebarToggle = document.querySelector('[data-toggle="sidebar"]');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            setTimeout(adjustLayoutForNavbar, 300);
        });
    }
    
    window.addEventListener('resize', adjustLayoutForNavbar);
});

function changeStatus() {
    $('#statusModal').modal('show');
}

function assignLead() {
    $('#assignmentModal').modal('show');
}

function deleteLead() {
    if (confirm('Are you sure you want to delete this lead? This action cannot be undone.')) {
        window.location.href = '{{ route("admin.leads.destroy", $lead->id) }}';
    }
}

function deleteComment(commentId) {
    if (confirm('Are you sure you want to delete this comment?')) {
        fetch(`/admin/leads/{{ $lead->id }}/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }
}

// Auto-resize textarea
document.getElementById('comment').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});

// Initialize tooltips
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush
