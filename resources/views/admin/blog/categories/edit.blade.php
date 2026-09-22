<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Edit Blog Category - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/css/components.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ url('assets-admin/img/favicon.ico') }}' />
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
            <h1>Edit Blog Category</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.blog-categories.index') }}">Blog Categories</a></div>
              <div class="breadcrumb-item">Edit: {{ $blogCategory->name }}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-md-8 offset-md-2">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit: {{ $blogCategory->name }}</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                      </a>
                      <a href="{{ route('blog.category', $blogCategory->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt"></i> View on Website
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

                    <form action="{{ route('admin.blog-categories.update', $blogCategory) }}" method="POST">
                      @csrf
                      @method('PUT')
                      
                      <!-- Name -->
                      <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $blogCategory->name) }}" required>
                      </div>

                      <!-- Description -->
                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $blogCategory->description) }}</textarea>
                        <small class="form-text text-muted">Brief description of this category</small>
                      </div>

                      <!-- Color -->
                      <div class="form-group">
                        <label>Color <span class="text-danger">*</span></label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="color" name="color" class="form-control" value="{{ old('color', $blogCategory->color) }}" required>
                          </div>
                          <div class="col-md-6">
                            <div class="mt-2">
                              <div style="width: 30px; height: 30px; background-color: {{ $blogCategory->color }}; border-radius: 50%; border: 2px solid #ddd; display: inline-block;"></div>
                              <small class="ml-2 text-muted">Current color</small>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Status -->
                      <div class="form-group">
                        <div class="form-check">
                          <input type="checkbox" name="is_active" class="form-check-input" id="is_active" 
                                 value="1" {{ old('is_active', $blogCategory->is_active) ? 'checked' : '' }}>
                          <label class="form-check-label" for="is_active">
                            Active
                          </label>
                          <small class="form-text text-muted">Inactive categories will not be visible on the website</small>
                        </div>
                      </div>

                      <!-- Category Stats -->
                      <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Category Statistics</h6>
                        <small>
                          <strong>Slug:</strong> {{ $blogCategory->slug }}<br>
                          <strong>Blog Posts:</strong> {{ $blogCategory->blogs_count ?? 0 }}<br>
                          <strong>Created:</strong> {{ $blogCategory->created_at->format('M d, Y H:i') }}<br>
                          <strong>Updated:</strong> {{ $blogCategory->updated_at->format('M d, Y H:i') }}
                        </small>
                      </div>

                      <!-- Submit Button -->
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                          <i class="fas fa-save"></i> Update Category
                        </button>
                        <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary ml-2">
                          Cancel
                        </a>
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
  <!-- Template JS File -->
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ url('assets-admin/js/style.js') }}"></script>
</body>
</html>
