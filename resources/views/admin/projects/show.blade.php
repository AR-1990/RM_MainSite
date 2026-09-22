@extends('admin.layout.app')

@section('title', 'Project Details')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>🏗️ Project Details</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></div>
                <div class="breadcrumb-item">{{ $project->title }}</div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Project Header Card -->
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="mb-2">{{ $project->title }}</h2>
                                <div class="mb-3">
                                    <span class="badge badge-info me-2">🏠 {{ $project->project_type_text }}</span>
                                    <span class="badge {{ $project->is_active ? 'badge-success' : 'badge-danger' }} me-2">
                                        {{ $project->is_active ? '✅ Active' : '❌ Inactive' }}
                                    </span>
                                    @if($project->is_featured)
                                        <span class="badge badge-warning">⭐ Featured</span>
                                    @endif
                                </div>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $project->location }}
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="h3 text-primary mb-1">PKR {{ number_format($project->price) }}</div>
                                <small class="text-muted">{{ ucfirst($project->price_type) }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Images -->
                @if($project->main_image || ($project->gallery_images && count($project->gallery_images) > 0))
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-images me-2"></i>Project Images</h4>
                    </div>
                    <div class="card-body">
                        @if($project->main_image)
                        <div class="mb-4">
                            <h6>Main Image</h6>
                            <img src="{{ url('' . $project->main_image) }}" 
                                 alt="Main Image" 
                                 class="img-fluid rounded" 
                                 style="max-height: 300px;">
                        </div>
                        @endif

                        @if($project->gallery_images && count($project->gallery_images) > 0)
                        <div>
                            <h6>Gallery Images ({{ count($project->gallery_images) }})</h6>
                            <div class="row">
                                @foreach($project->gallery_images as $image)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ url('' . $image) }}" 
                                         alt="Gallery Image" 
                                         class="img-fluid rounded" 
                                         style="height: 150px; width: 100%; object-fit: cover;">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Project Description -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-align-left me-2"></i>Description</h4>
                    </div>
                    <div class="card-body">
                        @if($project->short_description)
                        <div class="mb-4">
                            <h6>Short Description</h6>
                            <p class="text-muted">{{ $project->short_description }}</p>
                        </div>
                        @endif

                        <div>
                            <h6>Full Description</h6>
                            <div class="project-description">
                                {!! $project->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Details -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-info-circle me-2"></i>Project Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Area:</td>
                                        <td>{{ number_format($project->area) }} {{ ucfirst($project->area_unit) }}</td>
                                    </tr>
                                    @if($project->bedrooms)
                                    <tr>
                                        <td class="fw-bold">Bedrooms:</td>
                                        <td>{{ $project->bedrooms }}</td>
                                    </tr>
                                    @endif
                                    @if($project->bathrooms)
                                    <tr>
                                        <td class="fw-bold">Bathrooms:</td>
                                        <td>{{ $project->bathrooms }}</td>
                                    </tr>
                                    @endif
                                    @if($project->parking)
                                    <tr>
                                        <td class="fw-bold">Parking:</td>
                                        <td>{{ $project->parking }} spaces</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Status:</td>
                                        <td><span class="badge badge-info">{{ ucwords(str_replace('_', ' ', $project->status)) }}</span></td>
                                    </tr>
                                    @if($project->completion_date)
                                    <tr>
                                        <td class="fw-bold">Completion Date:</td>
                                        <td>{{ $project->completion_date->format('M d, Y') }}</td>
                                    </tr>
                                    @endif
                                    @if($project->developer)
                                    <tr>
                                        <td class="fw-bold">Developer:</td>
                                        <td>{{ $project->developer }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="fw-bold">Created:</td>
                                        <td>{{ $project->created_at->format('M d, Y \a\t H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Updated:</td>
                                        <td>{{ $project->updated_at->format('M d, Y \a\t H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities and Features -->
                @if(($project->amenities && count($project->amenities) > 0) || ($project->features && count($project->features) > 0))
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-star me-2"></i>Amenities & Features</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($project->amenities && count($project->amenities) > 0)
                            <div class="col-md-6">
                                <h6>Amenities</h6>
                                <div class="row">
                                    @foreach($project->amenities as $amenity)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            <span>{{ ucwords(str_replace('_', ' ', $amenity)) }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($project->features && count($project->features) > 0)
                            <div class="col-md-6">
                                <h6>Features</h6>
                                <div class="row">
                                    @foreach($project->features as $feature)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            <span>{{ ucwords(str_replace('_', ' ', $feature)) }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Contact Information -->
                @if($project->contact_person || $project->contact_phone || $project->contact_email)
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-address-book me-2"></i>Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($project->contact_person)
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-user text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted">Contact Person</small>
                                        <div class="fw-bold">{{ $project->contact_person }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($project->contact_phone)
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-phone text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted">Phone</small>
                                        <div class="fw-bold">{{ $project->contact_phone }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($project->contact_email)
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-envelope text-primary me-3"></i>
                                    <div>
                                        <small class="text-muted">Email</small>
                                        <div class="fw-bold">{{ $project->contact_email }}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Coordinates -->
                @if($project->latitude && $project->longitude)
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-map-pin me-2"></i>Location Coordinates</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Latitude:</strong> {{ $project->latitude }}
                            </div>
                            <div class="col-md-6">
                                <strong>Longitude:</strong> {{ $project->longitude }}
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="https://www.google.com/maps?q={{ $project->latitude }},{{ $project->longitude }}" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-2"></i>View on Google Maps
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- SEO Information -->
                @if($project->meta_description || $project->meta_keywords)
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-search me-2"></i>SEO Information</h4>
                    </div>
                    <div class="card-body">
                        @if($project->meta_description)
                        <div class="mb-3">
                            <label class="fw-bold">Meta Description:</label>
                            <p class="text-muted">{{ $project->meta_description }}</p>
                        </div>
                        @endif

                        @if($project->meta_keywords)
                        <div>
                            <label class="fw-bold">Meta Keywords:</label>
                            <p class="text-muted">{{ $project->meta_keywords }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Actions -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h4><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" 
                               class="btn btn-primary btn-lg">
                                <i class="fas fa-edit me-2"></i>Edit Project
                            </a>
                            
                            <button type="button" 
                                    class="btn btn-{{ $project->is_active ? 'warning' : 'success' }} btn-lg toggle-status" 
                                    data-id="{{ $project->id }}" 
                                    data-status="{{ $project->is_active ? 'active' : 'inactive' }}">
                                <i class="fas fa-{{ $project->is_active ? 'times' : 'check' }} me-2"></i>
                                {{ $project->is_active ? 'Deactivate' : 'Activate' }} Project
                            </button>

                            <button type="button" 
                                    class="btn btn-{{ $project->is_featured ? 'secondary' : 'warning' }} btn-lg toggle-featured" 
                                    data-id="{{ $project->id }}" 
                                    data-featured="{{ $project->is_featured ? 'featured' : 'not-featured' }}">
                                <i class="fas fa-star me-2"></i>
                                {{ $project->is_featured ? 'Unmark as Featured' : 'Mark as Featured' }}
                            </button>

                            <a href="{{ route('admin.projects.index') }}" 
                               class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Project Statistics -->
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-chart-bar me-2"></i>Project Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="h4 text-primary mb-1">{{ $project->area }}</div>
                                <small class="text-muted">{{ ucfirst($project->area_unit) }}</small>
                            </div>
                            <div class="col-6">
                                <div class="h4 text-success mb-1">PKR {{ number_format($project->price / 1000, 1) }}K</div>
                                <small class="text-muted">Price</small>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            @if($project->bedrooms)
                            <div class="col-4">
                                <div class="h5 text-info mb-1">{{ $project->bedrooms }}</div>
                                <small class="text-muted">Bedrooms</small>
                            </div>
                            @endif
                            @if($project->bathrooms)
                            <div class="col-4">
                                <div class="h5 text-info mb-1">{{ $project->bathrooms }}</div>
                                <small class="text-muted">Bathrooms</small>
                            </div>
                            @endif
                            @if($project->parking)
                            <div class="col-4">
                                <div class="h5 text-info mb-1">{{ $project->parking }}</div>
                                <small class="text-muted">Parking</small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Files Information -->
                @if($project->floor_plans || $project->brochure)
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-file me-2"></i>Files</h4>
                    </div>
                    <div class="card-body">
                        @if($project->floor_plans && count($project->floor_plans) > 0)
                        <div class="mb-3">
                            <h6>Floor Plans ({{ count($project->floor_plans) }})</h6>
                            <div class="row">
                                @foreach($project->floor_plans as $plan)
                                <div class="col-6 mb-2">
                                    <a href="{{ url('' . $plan) }}" target="_blank" class="btn btn-outline-info btn-sm w-100">
                                        <i class="fas fa-file-image me-1"></i>View
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($project->brochure)
                        <div>
                            <h6>Brochure</h6>
                            <a href="{{ url('' . $project->brochure) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-file-pdf me-1"></i>Download Brochure
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the project "<span id="project-title"></span>"? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.project-description {
    line-height: 1.6;
}
.project-description img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 10px 0;
}

.card {
    margin-bottom: 1.5rem;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

.table-borderless td {
    padding: 0.5rem 0;
    border: none;
}

.fw-bold {
    font-weight: 600 !important;
}

@media (max-width: 768px) {
    .section-header h1 {
        font-size: 1.5rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle project status
    $('.toggle-status').on('click', function() {
        var button = $(this);
        var projectId = button.data('id');
        var currentStatus = button.data('status');
        var newStatus = currentStatus === 'active' ? 'inactive' : 'active';

        $.ajax({
            url: '/admin/projects/' + projectId + '/toggle-status',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Update button appearance
                    button.removeClass('btn-success btn-warning').addClass(newStatus === 'active' ? 'btn-warning' : 'btn-success');
                    button.data('status', newStatus);
                    button.html('<i class="fas fa-' + (newStatus === 'active' ? 'times' : 'check') + ' me-2"></i>' + 
                               (newStatus === 'active' ? 'Deactivate' : 'Activate') + ' Project');
                    
                    // Update status badge in header
                    var statusBadge = $('.badge-info').next('.badge');
                    statusBadge.removeClass('badge-success badge-danger').addClass(newStatus === 'active' ? 'badge-success' : 'badge-danger');
                    statusBadge.html(newStatus === 'active' ? '✅ Active' : '❌ Inactive');
                    
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
            error: function() {
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'An error occurred while updating project status.',
                        position: 'topRight'
                    });
                } else {
                    alert('An error occurred while updating project status.');
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

        $.ajax({
            url: '/admin/projects/' + projectId + '/toggle-featured',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Update button appearance
                    button.removeClass('btn-secondary btn-warning').addClass(newFeatured === 'featured' ? 'btn-secondary' : 'btn-warning');
                    button.data('featured', newFeatured);
                    button.html('<i class="fas fa-star me-2"></i>' + 
                               (newFeatured === 'featured' ? 'Unmark as Featured' : 'Mark as Featured'));
                    
                    // Update featured badge in header
                    var featuredBadge = $('.badge-success').next('.badge');
                    if (newFeatured === 'featured') {
                        if (featuredBadge.length === 0) {
                            $('.badge-success').after('<span class="badge badge-warning">⭐ Featured</span>');
                        }
                    } else {
                        featuredBadge.remove();
                    }
                    
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
            error: function() {
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'An error occurred while updating project featured status.',
                        position: 'topRight'
                    });
                } else {
                    alert('An error occurred while updating project featured status.');
                }
            }
        });
    });

    // Delete project
    $('.delete-project').on('click', function() {
        var projectId = $(this).data('id');
        var projectTitle = $(this).data('title');
        
        $('#project-title').text(projectTitle);
        $('#confirm-delete').data('id', projectId);
        $('#deleteModal').modal('show');
    });

    // Confirm delete
    $('#confirm-delete').on('click', function() {
        var projectId = $(this).data('id');
        
        $.ajax({
            url: '/admin/projects/' + projectId,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.success({
                            title: 'Success!',
                            message: 'Project deleted successfully!',
                            position: 'topRight'
                        });
                    } else {
                        alert('Project deleted successfully!');
                    }
                    setTimeout(function() {
                        window.location.href = '{{ route("admin.projects.index") }}';
                    }, 1500);
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
            error: function() {
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: 'An error occurred while deleting project.',
                        position: 'topRight'
                    });
                } else {
                    alert('An error occurred while deleting project.');
                }
            }
        });
    });
});
</script>
@endpush
