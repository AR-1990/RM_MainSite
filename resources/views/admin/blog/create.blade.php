<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Create Blog Post - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/css/components.css') }}">
  <!-- Summernote CSS -->
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/summernote/summernote-bs4.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ url('assets-admin/img/favicon.ico') }}' />
  <!-- Rich Editor CSS -->
  <style>
    .note-editor {
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .note-editor .note-toolbar {
      background-color: #f8f9fa;
      border-bottom: 1px solid #ddd;
    }
    .note-editor .note-editing-area {
      background-color: #fff;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>      
      @include('admin.layout.header')
      @include('admin.layout.sidebar')
      
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Create Blog Post</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blog Posts</a></div>
              <div class="breadcrumb-item">Create</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>New Blog Post</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    @if($errors->any())
                      <div class="alert alert-danger">
                        <ul class="mb-0">
                          @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      
                      <div class="row">
                        <div class="col-md-8">
                          <!-- Title -->
                          <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                          </div>

                          <!-- Description -->
                          <div class="form-group">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                            <small class="form-text text-muted">Brief description or excerpt of the blog post</small>
                          </div>

                          <!-- Content -->
                          <div class="form-group">
                            <label>Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control" rows="15" required>{{ old('content') }}</textarea>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <!-- Featured Image -->
                          <div class="form-group">
                            <label>Featured Image</label>
                            <input type="file" name="featured_image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Recommended size: 800x600px</small>
                          </div>

                          <!-- Category -->
                          <div class="form-group">
                            <label>Category <span class="text-danger">*</span></label>
                            <select name="blog_category_id" class="form-control" required>
                              <option value="">Select Category</option>
                              @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>
                                  {{ $category->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <!-- Author -->
                          <div class="form-group">
                            <label>Author <span class="text-danger">*</span></label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                          </div>

                          <!-- Published Date -->
                          <div class="form-group">
                            <label>Published Date</label>
                            <input type="datetime-local" name="published_at" class="form-control" 
                                   value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            <small class="form-text text-muted">Leave empty for current date/time</small>
                          </div>

                          <!-- Status -->
                          <div class="form-group">
                            <div class="form-check">
                              <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                                     value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                              <label class="form-check-label" for="is_active">
                                Publish immediately
                              </label>
                            </div>
                          </div>

                          <!-- Featured -->
                          <div class="form-group">
                            <div class="form-check">
                              <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" 
                                     value="1" {{ old('is_featured') ? 'checked' : '' }}>
                              <label class="form-check-label" for="is_featured">
                                Mark as featured
                              </label>
                            </div>
                          </div>

                          <!-- Submit Button -->
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                              <i class="fas fa-save"></i> Create Blog Post
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          <a href="#">Property Management System</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ url('assets-admin/js/app.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ url('assets-admin/bundles/summernote/summernote-bs4.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>

  <script>
    $(document).ready(function() {
      // Initialize Summernote for Description with basic toolbar
      $('#description').summernote({
        height: 150,
        toolbar: [
          ['style', ['bold', 'italic', 'underline']],
          ['para', ['ul', 'ol']],
          ['insert', ['link']],
          ['view', ['codeview']]
        ],
        callbacks: {
          onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
          }
        }
      });

      // Initialize Summernote for Content with full toolbar
      $('#content').summernote({
        height: 400,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video', 'hr']],
          ['view', ['fullscreen', 'codeview']]
        ],
        callbacks: {
          onImageUpload: function(files) {
            // Handle image upload if needed
            console.log('Image upload:', files);
          }
        }
      });

      // Form submission handling
      $('form').on('submit', function() {
        // Summernote automatically updates the textarea content
        return true;
      });
    });
  </script>
</body>
</html>
