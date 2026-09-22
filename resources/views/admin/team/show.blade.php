@extends('admin.layout.app')

@section('title', 'Team Member Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Team Member Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></div>
                <div class="breadcrumb-item">{{ $teamMember->name }}</div>
            </div>
        </div>

        <div class="row">
            <!-- Profile Information -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile Information</h4>
                    </div>
                    <div class="card-body text-center">
                        @if($teamMember->image)
                            <img src="{{ url('' . $teamMember->image) }}" 
                                 alt="{{ $teamMember->name }}" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                 style="width: 150px; height: 150px;">
                                <i class="fas fa-user fa-4x"></i>
                            </div>
                        @endif
                        
                        <h5 class="card-title">{{ $teamMember->name }}</h5>
                        <p class="text-muted">{{ $teamMember->position }}</p>
                        
                        <div class="badge {{ $teamMember->is_active ? 'badge-success' : 'badge-danger' }} mb-3">
                            {{ $teamMember->is_active ? 'Active' : 'Inactive' }}
                        </div>
                        
                        @if($teamMember->experience_years)
                            <p class="text-info">
                                <i class="fas fa-clock"></i> {{ $teamMember->experience_years }} years experience
                            </p>
                        @endif
                        
                        @if($teamMember->sort_order !== null)
                            <p class="text-muted">
                                <i class="fas fa-sort"></i> Display Order: {{ $teamMember->sort_order }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <div class="card-header">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="card-body">
                        @if($teamMember->email)
                            <div class="mb-3">
                                <strong><i class="fas fa-envelope text-primary"></i> Email:</strong>
                                <br>
                                <a href="mailto:{{ $teamMember->email }}">{{ $teamMember->email }}</a>
                            </div>
                        @endif
                        
                        @if($teamMember->phone)
                            <div class="mb-3">
                                <strong><i class="fas fa-phone text-success"></i> Phone:</strong>
                                <br>
                                <a href="tel:{{ $teamMember->phone }}">{{ $teamMember->phone }}</a>
                            </div>
                        @endif
                        
                        @if($teamMember->linkedin || $teamMember->twitter || $teamMember->facebook || $teamMember->instagram)
                            <div class="mb-3">
                                <strong>Social Media:</strong>
                                <div class="mt-2">
                                    @if($teamMember->linkedin)
                                        <a href="{{ $teamMember->linkedin }}" target="_blank" class="btn btn-sm btn-outline-info mr-2">
                                            <i class="fab fa-linkedin"></i> LinkedIn
                                        </a>
                                    @endif
                                    @if($teamMember->twitter)
                                        <a href="{{ $teamMember->twitter }}" target="_blank" class="btn btn-sm btn-outline-info mr-2">
                                            <i class="fab fa-twitter"></i> Twitter
                                        </a>
                                    @endif
                                    @if($teamMember->facebook)
                                        <a href="{{ $teamMember->facebook }}" target="_blank" class="btn btn-sm btn-outline-primary mr-2">
                                            <i class="fab fa-facebook"></i> Facebook
                                        </a>
                                    @endif
                                    @if($teamMember->instagram)
                                        <a href="{{ $teamMember->instagram }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="fab fa-instagram"></i> Instagram
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detailed Information -->
            <div class="col-md-8">
                <!-- Bio -->
                @if($teamMember->bio)
                <div class="card">
                    <div class="card-header">
                        <h4>Biography</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ $teamMember->bio }}</p>
                    </div>
                </div>
                @endif

                <!-- Education -->
                @if($teamMember->education)
                <div class="card">
                    <div class="card-header">
                        <h4>Education</h4>
                    </div>
                    <div class="card-body">
                        <p>{{ $teamMember->education }}</p>
                    </div>
                </div>
                @endif

                <!-- Expertise -->
                @if($teamMember->expertise && count($teamMember->expertise) > 0)
                <div class="card">
                    <div class="card-header">
                        <h4>Areas of Expertise</h4>
                    </div>
                    <div class="card-body">
                        @foreach($teamMember->expertise as $expertise)
                            <span class="badge badge-info mr-2 mb-2">{{ $expertise }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Certifications -->
                @if($teamMember->certifications && count($teamMember->certifications) > 0)
                <div class="card">
                    <div class="card-header">
                        <h4>Certifications</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($teamMember->certifications as $certification)
                                <li><i class="fas fa-certificate text-warning mr-2"></i>{{ $certification }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Achievements -->
                @if($teamMember->achievements && count($teamMember->achievements) > 0)
                <div class="card">
                    <div class="card-header">
                        <h4>Achievements</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($teamMember->achievements as $achievement)
                                <li><i class="fas fa-trophy text-success mr-2"></i>{{ $achievement }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- System Information -->
                <div class="card">
                    <div class="card-header">
                        <h4>System Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Created:</strong> {{ $teamMember->created_at->format('M d, Y \a\t g:i A') }}</p>
                                <p><strong>Last Updated:</strong> {{ $teamMember->updated_at->format('M d, Y \a\t g:i A') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Member ID:</strong> #{{ $teamMember->id }}</p>
                                <p><strong>Status:</strong> 
                                    <span class="badge {{ $teamMember->is_active ? 'badge-success' : 'badge-danger' }}">
                                        {{ $teamMember->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{ route('admin.team.edit', $teamMember->id) }}" class="btn btn-primary btn-lg mr-3">
                    <i class="fas fa-edit"></i> Edit Member
                </a>
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary btn-lg mr-3">
                    <i class="fas fa-arrow-left"></i> Back to Team
                </a>
                <button type="button" class="btn btn-{{ $teamMember->is_active ? 'warning' : 'success' }} btn-lg mr-3 toggle-status" 
                        data-id="{{ $teamMember->id }}" 
                        data-status="{{ $teamMember->is_active ? 'active' : 'inactive' }}">
                    <i class="fas fa-' + (newStatus === 'active' ? 'check' : 'times') + '"></i> 
                    {{ $teamMember->is_active ? 'Deactivate' : 'Activate' }}
                </button>
                <button type="button" class="btn btn-danger btn-lg delete-member" 
                        data-id="{{ $teamMember->id }}" 
                        data-name="{{ $teamMember->name }}">
                    <i class="fas fa-trash"></i> Delete Member
                </button>
            </div>
        </div>
    </section>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Toggle member status
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var memberId = button.data('id');
        var currentStatus = button.data('status');
        var newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        var originalHtml = button.html();
        button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');

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
                    button.html('<i class="fas fa-' + (newStatus === 'active' ? 'check' : 'times') + '"></i> ' + (newStatus === 'active' ? 'Deactivate' : 'Activate'));
                    
                    // Update status badge
                    $('.badge').removeClass('badge-success badge-danger').addClass(newStatus === 'active' ? 'badge-success' : 'badge-danger').text(newStatus === 'active' ? 'Active' : 'Inactive');
                    
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
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Team member deleted successfully!',
                            position: 'topRight',
                            onClosed: function() {
                                window.location.href = '{{ route("admin.team.index") }}';
                            }
                        });
                    } else {
                        alert('Team member deleted successfully!');
                        window.location.href = '{{ route("admin.team.index") }}';
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
});
</script>
@endpush

@push('css')
<style>
.card {
    margin-bottom: 1.5rem;
}

.badge {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

.list-unstyled li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.list-unstyled li:last-child {
    border-bottom: none;
}
</style>
@endpush
