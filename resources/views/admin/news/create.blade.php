@extends('admin.layout.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add News Article</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News</a></div>
                <div class="breadcrumb-item">Add News</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create New News Article</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Title -->
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" 
                                               value="{{ old('title') }}" placeholder="Enter news title" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Content -->
                                    <div class="form-group">
                                        <label for="content">Content <span class="text-danger">*</span></label>
                                        <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" 
                                                  placeholder="Enter news content" required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Use the rich text editor below to format your content.</small>
                                    </div>

                                    <!-- YouTube Link -->
                                    <div class="form-group">
                                        <label for="youtube_link">YouTube Link <span class="text-danger">*</span></label>
                                        <input type="url" id="youtube_link" name="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" 
                                               value="{{ old('youtube_link') }}" placeholder="https://www.youtube.com/watch?v=..." required>
                                        @error('youtube_link')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Enter the full YouTube video URL. The system will automatically extract the video ID.</small>
                                        
                                        <!-- YouTube Preview -->
                                        <div id="youtube-preview" class="mt-3" style="display: none;">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i> YouTube video preview will appear here once you enter a valid link.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Posted Date -->
                                    <div class="form-group">
                                        <label for="posted_date">Posted Date <span class="text-danger">*</span></label>
                                        <input type="date" id="posted_date" name="posted_date" class="form-control @error('posted_date') is-invalid @enderror" 
                                               value="{{ old('posted_date', date('Y-m-d')) }}" required>
                                        @error('posted_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Active</label>
                                        </div>
                                        <small class="form-text text-muted">Active news articles will be visible on the website.</small>
                                    </div>

                                    <!-- Featured -->
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="featured" name="featured" 
                                                   {{ old('featured') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="featured">Mark as Featured</label>
                                        </div>
                                        <small class="form-text text-muted">Featured news articles will be highlighted on the website.</small>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea id="meta_description" name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" 
                                                  placeholder="Enter meta description for SEO">{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Brief description for search engines (max 500 characters).</small>
                                        <div class="char-count mt-1">
                                            <small class="text-muted">0/500 characters</small>
                                        </div>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" id="meta_keywords" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                               value="{{ old('meta_keywords') }}" placeholder="Enter meta keywords for SEO">
                                        @error('meta_keywords')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Comma-separated keywords for search engines.</small>
                                    </div>
                                </div>
                            </div>

                                                         <!-- Form Actions -->
                             <div class="form-group text-center">
                                 <button type="submit" class="btn btn-primary btn-lg">
                                     <i class="fas fa-save"></i> Create News Article
                                 </button>
                                 <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg ml-2">
                                     <i class="fas fa-times"></i> Cancel
                                 </a>
                                 <button type="button" id="debug-btn" class="btn btn-warning btn-lg ml-2">
                                     <i class="fas fa-bug"></i> Debug Form
                                 </button>
                                 <button type="button" id="test-submit-btn" class="btn btn-info btn-lg ml-2">
                                     <i class="fas fa-paper-plane"></i> Test Submit
                                 </button>
                                 <button type="button" id="debug-submit-btn" class="btn btn-dark btn-lg ml-2">
                                     <i class="fas fa-eye"></i> Debug Submit
                                 </button>
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
                    youtubePreview.style.display = 'block';
                } else {
                    youtubePreview.innerHTML = `
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Please enter a valid YouTube video URL.
                        </div>
                    `;
                    youtubePreview.style.display = 'block';
                }
            } else {
                youtubePreview.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle"></i> Please enter a valid YouTube URL.
                    </div>
                `;
                youtubePreview.style.display = 'block';
            }
        } else {
            youtubePreview.style.display = 'none';
        }
    });

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

    // Auto-generate meta description from title and content
    document.getElementById('title').addEventListener('input', generateMetaDescription);
    document.getElementById('content').addEventListener('input', generateMetaDescription);

    function generateMetaDescription() {
        const title = document.getElementById('title').value;
        const content = document.getElementById('content').value;
        
        if (title && content && !metaDescription.value) {
            const combined = title + ' ' + content.replace(/<[^>]*>/g, ''); // Remove HTML tags
            const description = combined.substring(0, 500).trim();
            
            if (description.length === 500) {
                metaDescription.value = description + '...';
            } else {
                metaDescription.value = description;
            }
            
            // Trigger character count update
            metaDescription.dispatchEvent(new Event('input'));
        }
    }

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

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        console.log('=== FORM SUBMISSION STARTED ===');
        
        // Show debug info on page
        const debugDiv = document.createElement('div');
        debugDiv.id = 'debug-info';
        debugDiv.style.cssText = 'position: fixed; top: 10px; right: 10px; background: #333; color: white; padding: 15px; border-radius: 5px; z-index: 9999; max-width: 400px; font-family: monospace; font-size: 12px;';
        document.body.appendChild(debugDiv);
        
        // Add a simple test - let's see if we can submit at all
        console.log('Form action:', this.action);
        console.log('Form method:', this.method);
        console.log('Form enctype:', this.enctype);
        
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const youtubeLink = document.getElementById('youtube_link').value.trim();
        const postedDate = document.getElementById('posted_date').value;
        
        console.log('Form values:', { title, content: content.substring(0, 100), youtubeLink, postedDate });
        
        // Update debug display
        debugDiv.innerHTML = `
            <strong>Form Submission Debug:</strong><br>
            Action: ${this.action}<br>
            Method: ${this.method}<br>
            Title: ${title}<br>
            Content Length: ${content.length}<br>
            YouTube: ${youtubeLink}<br>
            Date: ${postedDate}<br>
            <hr>
            <small>Check console for more details</small>
        `;
        
        // Ensure Quill content is synced before validation
        if (typeof Quill !== 'undefined') {
            const quill = Quill.find(document.querySelector('#quill-editor'));
            if (quill) {
                const quillContent = quill.root.innerHTML;
                document.getElementById('content').value = quillContent;
                console.log('Quill content synced:', quillContent.substring(0, 100));
                
                // Update debug display with Quill content
                debugDiv.innerHTML += `<br>Quill Content: ${quillContent.substring(0, 100)}...`;
            } else {
                console.log('Quill instance not found');
                debugDiv.innerHTML += '<br><span style="color: red;">Quill instance not found!</span>';
            }
        } else {
            console.log('Quill not loaded');
            debugDiv.innerHTML += '<br><span style="color: red;">Quill not loaded!</span>';
        }
        
        // Re-get content after sync
        const finalContent = document.getElementById('content').value.trim();
        console.log('Final content length:', finalContent.length);
        
        if (!title) {
            e.preventDefault();
            alert('Please enter a title for the news article.');
            document.getElementById('title').focus();
            debugDiv.innerHTML += '<br><span style="color: red;">Validation failed: No title</span>';
            return false;
        }
        
        if (!finalContent || finalContent === '<p><br></p>' || finalContent === '<p></p>') {
            e.preventDefault();
            alert('Please enter content for the news article.');
            // Focus the Quill editor
            const quillEditor = document.querySelector('#quill-editor');
            if (quillEditor) {
                quillEditor.focus();
            }
            debugDiv.innerHTML += '<br><span style="color: red;">Validation failed: No content</span>';
            return false;
        }
        
        if (!youtubeLink) {
            e.preventDefault();
            alert('Please enter a YouTube link for the news article.');
            document.getElementById('youtube_link').focus();
            debugDiv.innerHTML += '<br><span style="color: red;">Validation failed: No YouTube link</span>';
            return false;
        }
        
        if (!postedDate) {
            e.preventDefault();
            alert('Please select a posted date for the news article.');
            document.getElementById('posted_date').focus();
            debugDiv.innerHTML += '<br><span style="color: red;">Validation failed: No date</span>';
            return false;
        }
        
        // YouTube URL validation
        const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+/;
        if (!pattern.test(youtubeLink)) {
            e.preventDefault();
            alert('Please enter a valid YouTube URL.');
            document.getElementById('youtube_link').focus();
            debugDiv.innerHTML += '<br><span style="color: red;">Validation failed: Invalid YouTube URL</span>';
            return false;
        }
        
        console.log('Form validation passed, submitting...');
        debugDiv.innerHTML += '<br><span style="color: green;">Validation passed! Form submitting...</span>';
        
        // Add a small delay to see the debug info before redirect
        setTimeout(() => {
            if (debugDiv.parentNode) {
                debugDiv.remove();
            }
        }, 3000);
        
        return true;
    });
    
    // Debug button functionality
    document.getElementById('debug-btn').addEventListener('click', function() {
        console.log('=== DEBUG FORM STATE ===');
        console.log('Title:', document.getElementById('title').value);
        console.log('Content textarea:', document.getElementById('content').value);
        
        if (typeof Quill !== 'undefined') {
            const quill = Quill.find(document.querySelector('#quill-editor'));
            if (quill) {
                console.log('Quill content:', quill.root.innerHTML);
                console.log('Quill text:', quill.getText());
            } else {
                console.log('Quill instance not found');
            }
        }
        
        console.log('YouTube Link:', document.getElementById('youtube_link').value);
        console.log('Posted Date:', document.getElementById('posted_date').value);
        console.log('Form action:', document.querySelector('form').action);
        console.log('CSRF Token:', document.querySelector('input[name="_token"]').value);
        console.log('=======================');
    });
    
    // Test submit button functionality
    document.getElementById('test-submit-btn').addEventListener('click', function() {
        console.log('=== TESTING FORM SUBMISSION ===');
        
        // Fill in some test data
        document.getElementById('title').value = 'Test News Article';
        document.getElementById('youtube_link').value = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
        document.getElementById('posted_date').value = '2025-01-20';
        
        // Set some content in Quill
        if (typeof Quill !== 'undefined') {
            const quill = Quill.find(document.querySelector('#quill-editor'));
            if (quill) {
                quill.setText('This is a test news article content.');
                console.log('Test content set in Quill');
            }
        }
        
        console.log('Test data filled, try submitting now');
    });
    
    // Debug submit button functionality (prevents actual submission)
    document.getElementById('debug-submit-btn').addEventListener('click', function() {
        console.log('=== DEBUG SUBMIT (NO ACTUAL SUBMISSION) ===');
        
        // Fill in some test data
        document.getElementById('title').value = 'Debug Test Article';
        document.getElementById('youtube_link').value = 'https://www.youtube.com/watch?v=dQw4w9WgXcQ';
        document.getElementById('posted_date').value = '2025-01-20';
        
        // Set some content in Quill
        if (typeof Quill !== 'undefined') {
            const quill = Quill.find(document.querySelector('#quill-editor'));
            if (quill) {
                quill.setText('This is a debug test content to check form validation.');
                console.log('Debug content set in Quill');
            }
        }
        
        // Trigger form validation manually without submitting
        const form = document.querySelector('form');
        const submitEvent = new Event('submit', { cancelable: true });
        form.dispatchEvent(submitEvent);
        
        console.log('Debug submit completed - check the debug panel on the right side of the page');
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
</style>
@endsection
