@extends('admin.layout.app')

@section('title', 'View News Article')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1 text-dark">📰 {{ $news->title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}" class="text-decoration-none">📋 News List</a></li>
                            <li class="breadcrumb-item active">👁️ View Article</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Article
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <!-- Article Header -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="badge bg-primary fs-6 px-3 py-2">
                            <i class="fas fa-newspaper me-2"></i>News Article
                        </div>
                        <div class="badge {{ $news->is_active ? 'bg-success' : 'bg-danger' }} fs-6 px-3 py-2">
                            <i class="fas fa-{{ $news->is_active ? 'check-circle' : 'times-circle' }} me-2"></i>
                            {{ $news->is_active ? 'Active' : 'Inactive' }}
                        </div>
                        @if($news->featured)
                        <div class="badge bg-warning fs-6 px-3 py-2">
                            <i class="fas fa-star me-2"></i>Featured
                        </div>
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center text-muted mb-4">
                        <div class="d-flex align-items-center me-4">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <span>Posted: <strong>{{ $news->formatted_posted_date }}</strong></span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2 text-primary"></i>
                            <span>Created: <strong>{{ $news->created_at->format('M d, Y \a\t H:i') }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Article Content -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-dark">
                        <i class="fas fa-file-alt me-2 text-primary"></i>Article Content
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="article-content">
                        {!! $news->content !!}
                    </div>
                </div>
            </div>

            <!-- YouTube Video -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0 text-dark">
                        <i class="fab fa-youtube me-2 text-danger"></i>YouTube Video
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="ratio ratio-16x9 mb-3">
                        <iframe src="{{ $news->youtube_embed_url }}" 
                                title="{{ $news->title }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="rounded shadow">
                        </iframe>
                    </div>
                    <div class="text-center">
                        <a href="{{ $news->youtube_link }}" target="_blank" class="btn btn-outline-danger btn-sm">
                            <i class="fab fa-youtube me-2"></i>View on YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Article Information -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header bg-primary text-white border-0">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Article Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">Status</label>
                            <div class="d-flex align-items-center">
                                <span class="badge {{ $news->status_badge_class }} fs-6 px-3 py-2">
                                    <i class="fas fa-{{ $news->is_active ? 'check-circle' : 'times-circle' }} me-2"></i>
                                    {{ $news->status }}
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">Featured</label>
                            <div class="d-flex align-items-center">
                                <span class="badge {{ $news->featured_badge_class }} fs-6 px-3 py-2">
                                    <i class="fas fa-star me-2"></i>
                                    {{ $news->featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">URL Slug</label>
                            <div class="bg-light p-2 rounded">
                                <code class="text-primary">{{ $news->slug }}</code>
                            </div>
                        </div>

                        @if($news->meta_description)
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">Meta Description</label>
                            <div class="bg-light p-2 rounded">
                                <small class="text-muted">{{ $news->meta_description }}</small>
                            </div>
                        </div>
                        @endif

                        @if($news->meta_keywords)
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">Meta Keywords</label>
                            <div class="bg-light p-2 rounded">
                                <small class="text-muted">{{ $news->meta_keywords }}</small>
                            </div>
                        </div>
                        @endif

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted">Last Updated</label>
                            <div class="bg-light p-2 rounded">
                                <small class="text-muted">{{ $news->updated_at->format('M d, Y \a\t H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this news article? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(newsId) {
    if (confirm('Are you sure you want to change the status of this news article?')) {
        fetch(`/admin/news/${newsId}/toggle-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status.');
        });
    }
}

function toggleFeatured(newsId) {
    if (confirm('Are you sure you want to change the featured status of this news article?')) {
        fetch(`/admin/news/${newsId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the featured status.');
        });
    }
}

function deleteNews(newsId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
    
    document.getElementById('confirmDelete').onclick = function() {
        fetch(`/admin/news/${newsId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '{{ route("admin.news.index") }}';
            } else {
                alert('Error deleting news article.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the news article.');
        });
    };
}
</script>
@endpush
