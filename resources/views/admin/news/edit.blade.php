@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit News Article</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></div>
                <div class="breadcrumb-item">Edit News</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit News Article: {{ $news->title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Title -->
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" 
                                               value="{{ old('title', $news->title) }}" placeholder="Enter news title" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Content -->
                                    <div class="form-group">
                                        <label for="content">Content <span class="text-danger">*</span></label>
                                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" 
                                                  placeholder="Enter news content" required>{{ old('content', $news->content) }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Use the rich text editor below to format your content.</small>
                                    </div>

                                    <!-- YouTube Link -->
                                    <div class="form-group">
                                        <label for="youtube_link">YouTube Link <span class="text-danger">*</span></label>
                                        <input type="url" id="youtube_link" name="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" 
                                               value="{{ old('youtube_link', $news->youtube_link) }}" placeholder="https://www.youtube.com/watch?v=..." required>
                                        @error('youtube_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Enter the full YouTube video URL. The system will automatically extract the video ID.</small>
                                        
                                        <!-- YouTube Preview -->
                                        <div id="youtube-preview" class="mt-3">
                                            @if($news->youtube_video_id)
                                                <div class="alert alert-success">
                                                    <i class="fas fa-check-circle"></i> Current YouTube video:
                                                    <br><small>Video ID: {{ $news->youtube_video_id }}</small>
                                                </div>
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" 
                                                            src="https://www.youtube.com/embed/{{ $news->youtube_video_id }}" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                            allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @else
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle"></i> YouTube video preview will appear here once you enter a valid link.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Posted Date -->
                                    <div class="form-group">
                                        <label for="posted_date">Posted Date <span class="text-danger">*</span></label>
                                        <input type="date" id="posted_date" name="posted_date" class="form-control @error('posted_date') is-invalid @enderror" 
                                               value="{{ old('posted_date', $news->posted_date->format('Y-m-d')) }}" required>
                                        @error('posted_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" 
                                                   {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Active</label>
                                        </div>
                                        <small class="form-text text-muted">Active news articles will be visible on the website.</small>
                                    </div>

                                    <!-- Featured -->
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="featured" name="featured" 
                                                   {{ old('featured', $news->featured) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="featured">Mark as Featured</label>
                                        </div>
                                        <small class="form-text text-muted">Featured news articles will be highlighted on the website.</small>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" 
                                                  placeholder="Enter meta description for SEO">{{ old('meta_description', $news->meta_description) }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Brief description for search engines (max 500 characters).</small>
                                        <div class="char-count mt-1">
                                            <small class="text-muted">{{ strlen($news->meta_description ?? '') }}/500 characters</small>
                                        </div>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" id="meta_keywords" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                               value="{{ old('meta_keywords', $news->meta_keywords) }}" placeholder="Enter meta keywords for SEO">
                                        @error('meta_keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Comma-separated keywords for search engines.</small>
                                    </div>

                                    <!-- Article Info -->
                                    <div class="form-group">
                                        <label>Article Information</label>
                                        <div class="article-info">
                                            <p><strong>Slug:</strong> <code>{{ $news->slug }}</code></p>
                                            <p><strong>Created:</strong> {{ $news->created_at->format('M j, Y g:i A') }}</p>
                                            <p><strong>Last Updated:</strong> {{ $news->updated_at->format('M j, Y g:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save"></i> Update News Article
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg ml-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <a href="{{ route('admin.news.show', $news) }}" class="btn btn-info btn-lg ml-2">
                                    <i class="fas fa-eye"></i> View Article
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- YouTube Link Validation Script -->
<!-- Load Quill.js from CDN -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const youtubeLinkInput = document.getElementById('youtube_link');
    const youtubePreview = document.getElementById('youtube-preview');
    const metaDescription = document.getElementById('meta_description');
    const charCount = document.querySelector('.char-count small');

    // YouTube link validation and preview
    youtubeLinkInput.addEventListener('input', function() {
        const link = this.value.trim();
        
        if (link) {
            // YouTube URL validation pattern
            const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
            
            if (pattern.test(link)) {
                // Extract video ID
                let videoId = '';
                if (link.includes('youtube.com/watch?v=')) {
                    videoId = link.split('v=')[1].split('&')[0];
                } else if (link.includes('youtu.be/')) {
                    videoId = link.split('youtu.be/')[1].split('?')[0];
                }
                
                if (videoId && videoId.length === 11) {
                    // Show preview
                    youtubePreview.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> Valid YouTube link detected!
                            <br><small>Video ID: ${videoId}</small>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" 
                                    src="https://www.youtube.com/embed/${videoId}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                    `;
                } else {
                    youtubePreview.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Please enter a valid YouTube video URL.
                        </div>
                    `;
                }
            } else {
                youtubePreview.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle"></i> Please enter a valid YouTube URL.
                    </div>
                `;
            }
        } else {
            youtubePreview.innerHTML = `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> YouTube video preview will appear here once you enter a valid link.
                </div>
            `;
        }
    });

            // Initialize Quill.js
        if (typeof Quill !== 'undefined') {
            // Create a hidden input to store the HTML content
            const contentInput = document.getElementById('content');
            const quillContainer = document.createElement('div');
            quillContainer.id = 'quill-editor';
            quillContainer.style.height = '400px';
            contentInput.parentNode.insertBefore(quillContainer, contentInput.nextSibling);
            
            // Make textarea invisible but still accessible for validation
            contentInput.style.position = 'absolute';
            contentInput.style.left = '-9999px';
            contentInput.style.opacity = '0';
            contentInput.style.pointerEvents = 'none';
            contentInput.style.height = '1px';
            contentInput.style.width = '1px';
        
        // Initialize Quill
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: 'Start writing your news content...'
        });
        
        // Custom image handler
        const toolbar = quill.getModule('toolbar');
        toolbar.addHandler('image', function() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();
            
            input.onchange = function() {
                const file = input.files[0];
                if (file) {
                    // Show loading indicator
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, 'image', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
                    
                    // Upload file
                    const formData = new FormData();
                    formData.append('upload', file);
                    
                    fetch('{{ route("admin.news.upload-image") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.url) {
                            // Replace placeholder with actual image
                            quill.deleteText(range.index, 1);
                            quill.insertEmbed(range.index, 'image', data.url);
                        } else {
                            // Remove placeholder and show error
                            quill.deleteText(range.index, 1);
                            alert(data.error?.message || 'Image upload failed');
                        }
                    })
                    .catch(error => {
                        // Remove placeholder and show error
                        quill.deleteText(range.index, 1);
                        alert('Image upload failed: ' + error.message);
                    });
                }
            };
        });
        
        // Set initial content if editing
        if (contentInput.value) {
            quill.root.innerHTML = contentInput.value;
        }
        
        // Update hidden input before form submission
        quill.on('text-change', function() {
            contentInput.value = quill.root.innerHTML;
        });
    }

    // Character count for meta description
    metaDescription.addEventListener('input', function() {
        const length = this.value.length;
        const maxLength = 500;
        const remaining = maxLength - length;
        
        if (remaining < 0) {
            charCount.innerHTML = `<span class="text-danger">${length}/${maxLength} characters (exceeded limit)</span>`;
        } else if (remaining <= 50) {
            charCount.innerHTML = `<span class="text-warning">${length}/${maxLength} characters</span>`;
        } else {
            charCount.innerHTML = `<span class="text-muted">${length}/${maxLength} characters</span>`;
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const youtubeLink = document.getElementById('youtube_link').value.trim();
        const postedDate = document.getElementById('posted_date').value;
        
        // Ensure Quill content is synced before validation
        if (typeof Quill !== 'undefined') {
            const quill = Quill.find(document.querySelector('#quill-editor'));
            if (quill) {
                document.getElementById('content').value = quill.root.innerHTML;
            }
        }
        
        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the news article.');
            document.getElementById('title').focus();
            return false;
        }
        
        if (!content) {
            e.preventDefault();
            alert('Please enter content for the news article.');
            // Focus the Quill editor
            const quillEditor = document.querySelector('#quill-editor');
            if (quillEditor) {
                quillEditor.focus();
            }
            return false;
        }
        
        if (!youtubeLink) {
            e.preventDefault();
            alert('Please enter a YouTube link for the news article.');
            document.getElementById('youtube_link').focus();
            return false;
        }
        
        if (!postedDate) {
            e.preventDefault();
            alert('Please select a posted date for the news article.');
            document.getElementById('posted_date').focus();
            return false;
        }
        
        // YouTube URL validation
        const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
        if (!pattern.test(youtubeLink)) {
            e.preventDefault();
            alert('Please enter a valid YouTube URL.');
            document.getElementById('youtube_link').focus();
            return false;
        }
        
        // Content is automatically updated via Quill's text-change event
        
        return true;
    });
});
</script>

<style>
.custom-switch {
    padding-left: 2.25rem;
}

.custom-switch .custom-control-label {
    padding-top: 2px;
}

.custom-switch .custom-control-label::before {
    left: -2.25rem;
    height: 1.5rem;
    width: 3rem;
    pointer-events: all;
    border-radius: 1rem;
}

.custom-switch .custom-control-label::after {
    top: calc(0.25rem + 2px);
    left: calc(-2.25rem + 2px);
    width: calc(1.5rem - 4px);
    height: calc(1.5rem - 4px);
    background-color: #adb5bd;
    border-radius: calc(1.5rem - 4px);
    transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::after {
    background-color: #fff;
    transform: translateX(1.5rem);
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #007bff;
    border-color: #007bff;
}

.embed-responsive {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.char-count {
    text-align: right;
}

.form-group label {
    font-weight: 600;
    color: #2d3748;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-lg {
    padding: 12px 30px;
    font-size: 1.1rem;
}

.alert {
    border-radius: 8px;
    border: none;
}

.alert-info {
    background-color: #e3f2fd;
    color: #0d47a1;
}

.alert-success {
    background-color: #e8f5e8;
    color: #1b5e20;
}

.alert-warning {
    background-color: #fff3e0;
    color: #e65100;
}

.alert-danger {
    background-color: #ffebee;
    color: #b71c1c;
}

.article-info {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.article-info p {
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.article-info p:last-child {
    margin-bottom: 0;
}

.article-info code {
    background: #e9ecef;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 0.85rem;
}
</style>
@endsection
