@extends('admin.layout.app')

@section('title', 'Contact Details & Lead Management')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Contact Details & Lead Management</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></div>
                <div class="breadcrumb-item">Contact #{{ $contact->id }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Information</h4>
                            <div class="card-header-action">
                                <span class="badge badge-{{ $contact->status === 'new' ? 'danger' : ($contact->status === 'read' ? 'warning' : ($contact->status === 'replied' ? 'success' : 'secondary')) }}">
                                    {{ ucfirst($contact->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Name:</strong></label>
                                        <p>{{ $contact->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Email:</strong></label>
                                        <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Phone:</strong></label>
                                        <p>{{ $contact->phone ?: 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Subject:</strong></label>
                                        <p>{{ $contact->subject }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>Message:</strong></label>
                                <div class="alert alert-info">
                                    {{ $contact->message }}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Source:</strong></label>
                                        <p>{{ ucfirst(str_replace('_', ' ', $contact->source)) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Received:</strong></label>
                                        <p>{{ $contact->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($contact->property)
                            <div class="form-group">
                                <label><strong>Related Property:</strong></label>
                                <p><a href="{{ route('admin.properties.show', $contact->property->id) }}">{{ $contact->property->title }}</a></p>
                            </div>
                            @endif
                            
                            @if($contact->agent)
                            <div class="form-group">
                                <label><strong>Related Agent:</strong></label>
                                <p>{{ $contact->agent->name }}</p>
                            </div>
                            @endif
                            
                            @if($contact->notes)
                            <div class="form-group">
                                <label><strong>Admin Notes:</strong></label>
                                <div class="alert alert-warning">
                                    {{ $contact->notes }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Lead Management Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Lead Management</h4>
                            <div class="card-header-action">
                                {!! $contact->lead_status_badge !!}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Lead Status:</strong></label>
                                        <p>{!! $contact->lead_status_badge !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Lead Value:</strong></label>
                                        <p>{{ $contact->formatted_value }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Assigned To:</strong></label>
                                        <p>
                                            @if($contact->assignedUser)
                                                <span class="badge badge-info">{{ $contact->assignedUser->name }}</span>
                                                {!! $contact->assignedUser->role_badge !!}
                                            @else
                                                <span class="badge badge-secondary">Unassigned</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Expected Close Date:</strong></label>
                                        <p>{{ $contact->expected_close_date ? $contact->expected_close_date->format('M d, Y') : 'Not set' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($contact->lead_tags && !empty($contact->lead_tags))
                            <div class="form-group">
                                <label><strong>Tags:</strong></label>
                                <p>{!! $contact->tags_display !!}</p>
                            </div>
                            @endif
                            
                            @if($contact->lead_notes)
                            <div class="form-group">
                                <label><strong>Lead Notes:</strong></label>
                                <div class="alert alert-info">
                                    {{ $contact->lead_notes }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Comments & Activity</h4>
                        </div>
                        <div class="card-body">
                            <!-- Add Comment Form -->
                            <form action="{{ route('admin.contacts.add-comment', $contact->id) }}" method="POST" class="mb-4">
                                @csrf
                                <div class="form-group">
                                    <label>Add Comment</label>
                                    <textarea name="comment" class="form-control" rows="3" placeholder="Add a comment or note about this lead..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-comment"></i> Add Comment
                                </button>
                            </form>

                            <!-- Comments List -->
                            <div class="comments-section">
                                @forelse($contact->comments as $comment)
                                <div class="comment-item mb-3 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <strong>{{ $comment->user->name }}</strong>
                                            <span class="badge badge-light ml-2">{!! $comment->user->role_badge !!}</span>
                                        </div>
                                        <div class="text-muted small">
                                            {{ $comment->formatted_date }}
                                            <br>
                                            <small>{{ $comment->time_ago }}</small>
                                        </div>
                                    </div>
                                    <div class="comment-text">
                                        {{ $comment->comment }}
                                    </div>
                                    @if($comment->user_id === auth()->id() || auth()->user()->role === 'admin')
                                    <div class="mt-2">
                                        <form action="{{ route('admin.contacts.comments.destroy', [$contact->id, $comment->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
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

                <!-- Contact Actions & Lead Management -->
                <div class="col-lg-4">
                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Quick Actions</h4>
                        </div>
                        <div class="card-body">
                            <!-- Contact Status Update -->
                            <form action="{{ route('admin.contacts.update-status', $contact->id) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Update Contact Status</label>
                                    <select name="status" class="form-control">
                                        <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>Read</option>
                                        <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>Replied</option>
                                        <option value="closed" {{ $contact->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Add Notes</label>
                                    <textarea name="notes" class="form-control" rows="3" placeholder="Add internal notes...">{{ $contact->notes }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                            </form>

                            <!-- Lead Status Update -->
                            <form action="{{ route('admin.contacts.update-lead-status', $contact->id) }}" method="POST" class="mb-3">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Update Lead Status</label>
                                    <select name="lead_status" class="form-control">
                                        <option value="new" {{ $contact->lead_status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="open" {{ $contact->lead_status === 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ $contact->lead_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="closed" {{ $contact->lead_status === 'closed' ? 'selected' : '' }}>Closed</option>
                                        <option value="lost" {{ $contact->lead_status === 'lost' ? 'selected' : '' }}>Lost</option>
                                        <option value="cancel" {{ $contact->lead_status === 'cancel' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lead Value</label>
                                    <div class="input-group">
                                        <input type="number" name="lead_value" class="form-control" placeholder="0.00" step="0.01" min="0" value="{{ $contact->lead_value }}">
                                        <select name="lead_currency" class="form-control" style="max-width: 80px;">
                                            <option value="USD" {{ $contact->lead_currency === 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ $contact->lead_currency === 'EUR' ? 'selected' : '' }}>EUR</option>
                                            <option value="GBP" {{ $contact->lead_currency === 'GBP' ? 'selected' : '' }}>GBP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Expected Close Date</label>
                                    <input type="date" name="expected_close_date" class="form-control" value="{{ $contact->expected_close_date ? $contact->expected_close_date->format('Y-m-d') : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Tags (comma separated)</label>
                                    <input type="text" name="lead_tags" class="form-control" placeholder="tag1, tag2, tag3" value="{{ $contact->lead_tags ? implode(', ', $contact->lead_tags) : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Lead Notes</label>
                                    <textarea name="lead_notes" class="form-control" rows="3" placeholder="Add lead-specific notes...">{{ $contact->lead_notes }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-warning btn-block">Update Lead Status</button>
                            </form>

                            <!-- Lead Assignment -->
                            <form action="{{ route('admin.contacts.assign-lead', $contact->id) }}" method="POST" class="mb-3">
                                @csrf
                                <div class="form-group">
                                    <label>Assign Lead To</label>
                                    <select name="assigned_to" class="form-control">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ $contact->assigned_to === $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} ({!! $user->role_badge !!})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fas fa-user-plus"></i> Assign Lead
                                </button>
                            </form>

                            <!-- Contact Actions -->
                            <div class="btn-group-vertical btn-block">
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-info mb-2">
                                    <i class="fas fa-reply"></i> Reply via Email
                                </a>
                                
                                @if($contact->phone)
                                <a href="tel:{{ $contact->phone }}" class="btn btn-success mb-2">
                                    <i class="fas fa-phone"></i> Call Contact
                                </a>
                                @endif
                                
                                <button type="button" class="btn btn-warning mb-2" onclick="copyContactInfo()">
                                    <i class="fas fa-copy"></i> Copy Contact Info
                                </button>
                                
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fas fa-trash"></i> Delete Contact
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Statistics -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Contact Details</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <strong>IP Address:</strong><br>
                                    <small class="text-muted">{{ $contact->ip_address ?: 'Not recorded' }}</small>
                                </li>
                                <li class="mb-2">
                                    <strong>User Agent:</strong><br>
                                    <small class="text-muted">{{ Str::limit($contact->user_agent, 50) ?: 'Not recorded' }}</small>
                                </li>
                                @if($contact->read_at)
                                <li class="mb-2">
                                    <strong>Read At:</strong><br>
                                    <small class="text-muted">{{ $contact->read_at->format('M d, Y \a\t g:i A') }}</small>
                                </li>
                                @endif
                                @if($contact->replied_at)
                                <li class="mb-2">
                                    <strong>Replied At:</strong><br>
                                    <small class="text-muted">{{ $contact->replied_at->format('M d, Y \a\t g:i A') }}</small>
                                </li>
                                @endif
                                @if($contact->lead_created_at)
                                <li class="mb-2">
                                    <strong>Lead Created:</strong><br>
                                    <small class="text-muted">{{ $contact->lead_created_at->format('M d, Y \a\t g:i A') }}</small>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.comment-item {
    background-color: #f8f9fa;
    border-left: 4px solid #007bff !important;
}

.comment-item:hover {
    background-color: #e9ecef;
}

.comment-text {
    line-height: 1.6;
    color: #495057;
}

.comments-section {
    max-height: 500px;
    overflow-y: auto;
}

.badge {
    font-size: 0.75em;
}

.form-group label {
    font-weight: 600;
    color: #495057;
}

.card-header h4 {
    margin-bottom: 0;
    color: #495057;
}

.btn-group-vertical .btn {
    text-align: left;
}

.input-group .form-control {
    border-right: 0;
}

.input-group select {
    border-left: 0;
}
</style>

<script>
function copyContactInfo() {
    const contactInfo = `Name: ${@json($contact->name)}
Email: ${@json($contact->email)}
Phone: ${@json($contact->phone ?: 'Not provided')}
Subject: ${@json($contact->subject)}
Message: ${@json($contact->message)}`;
    
    navigator.clipboard.writeText(contactInfo).then(function() {
        // Show success message
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.classList.remove('btn-warning');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-warning');
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        alert('Failed to copy contact information');
    });
}

// Auto-resize textareas
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
</script>
@endsection
