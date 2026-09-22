<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>View Blog Post - Admin Dashboard</title>
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
            <h1>View Blog Post</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blog Posts</a></div>
              <div class="breadcrumb-item">{{ $blog->title }}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ $blog->title }}</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                      </a>
                      <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt"></i> View on Website
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8">
                        <!-- Featured Image -->
                        @if($blog->featured_image)
                          <div class="mb-4">
                            <img src="{{ url('' . $blog->featured_image) }}" alt="{{ $blog->title }}" 
                                 class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                          </div>
                        @endif

                        <!-- Blog Content -->
                        <div class="blog-content">
                          <h2>{{ $blog->title }}</h2>
                          
                          <div class="text-muted mb-3">
                            <small>
                              <i class="fas fa-user"></i> By {{ $blog->author }} | 
                              <i class="fas fa-calendar"></i> {{ $blog->formatted_published_date }} |
                              <i class="fas fa-eye"></i> {{ $blog->views_count }} views |
                              <i class="fas fa-clock"></i> {{ $blog->reading_time }} min read
                            </small>
                          </div>

                          <div class="mb-3">
                            <span class="badge" style="background-color: {{ $blog->category->color }}; color: white; font-size: 0.9rem;">
                              {{ $blog->category->name }}
                            </span>
                            @if($blog->is_featured)
                              <span class="badge badge-warning ml-2">
                                <i class="fas fa-star"></i> Featured
                              </span>
                            @endif
                            <span class="badge badge-{{ $blog->is_active ? 'success' : 'danger' }} ml-2">
                              {{ $blog->is_active ? 'Published' : 'Draft' }}
                            </span>
                          </div>

                          <div class="alert alert-light">
                            <strong>Description:</strong><br>
                            <div>{!! $blog->description !!}</div>
                          </div>

                          <div class="content">
                            {!! $blog->content !!}
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <!-- Blog Details -->
                        <div class="card">
                          <div class="card-header">
                            <h5>Blog Details</h5>
                          </div>
                          <div class="card-body">
                            <table class="table table-sm">
                              <tr>
                                <td><strong>ID:</strong></td>
                                <td>{{ $blog->id }}</td>
                              </tr>
                              <tr>
                                <td><strong>Slug:</strong></td>
                                <td><code>{{ $blog->slug }}</code></td>
                              </tr>
                              <tr>
                                <td><strong>Category:</strong></td>
                                <td>
                                  <span class="badge" style="background-color: {{ $blog->category->color }}; color: white;">
                                    {{ $blog->category->name }}
                                  </span>
                                </td>
                              </tr>
                              <tr>
                                <td><strong>Author:</strong></td>
                                <td>{{ $blog->author }}</td>
                              </tr>
                              <tr>
                                <td><strong>Created By:</strong></td>
                                <td>{{ $blog->user->name ?? 'Unknown' }}</td>
                              </tr>
                              <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                  <span class="badge badge-{{ $blog->is_active ? 'success' : 'danger' }}">
                                    {{ $blog->is_active ? 'Published' : 'Draft' }}
                                  </span>
                                </td>
                              </tr>
                              <tr>
                                <td><strong>Featured:</strong></td>
                                <td>
                                  @if($blog->is_featured)
                                    <span class="badge badge-warning">
                                      <i class="fas fa-star"></i> Yes
                                    </span>
                                  @else
                                    <span class="badge badge-light">No</span>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td><strong>Views:</strong></td>
                                <td>{{ $blog->views_count }}</td>
                              </tr>
                              <tr>
                                <td><strong>Reading Time:</strong></td>
                                <td>{{ $blog->reading_time }} minutes</td>
                              </tr>
                              <tr>
                                <td><strong>Published:</strong></td>
                                <td>{{ $blog->formatted_published_date }}</td>
                              </tr>
                              <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $blog->created_at->format('M d, Y H:i') }}</td>
                              </tr>
                              <tr>
                                <td><strong>Updated:</strong></td>
                                <td>{{ $blog->updated_at->format('M d, Y H:i') }}</td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                          <div class="card-header">
                            <h5>Quick Actions</h5>
                          </div>
                          <div class="card-body">
                            <!-- Toggle Status -->
                            <form action="{{ route('admin.blogs.toggle-status', $blog) }}" method="POST" class="mb-2">
                              @csrf
                              <button type="submit" class="btn btn-{{ $blog->is_active ? 'warning' : 'success' }} btn-block">
                                <i class="fas fa-toggle-{{ $blog->is_active ? 'off' : 'on' }}"></i>
                                {{ $blog->is_active ? 'Unpublish' : 'Publish' }}
                              </button>
                            </form>

                            <!-- Toggle Featured -->
                            <form action="{{ route('admin.blogs.toggle-featured', $blog) }}" method="POST" class="mb-2">
                              @csrf
                              <button type="submit" class="btn btn-{{ $blog->is_featured ? 'outline-warning' : 'warning' }} btn-block">
                                <i class="fas fa-star"></i>
                                {{ $blog->is_featured ? 'Remove from Featured' : 'Mark as Featured' }}
                              </button>
                            </form>

                            <!-- Edit -->
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary btn-block mb-2">
                              <i class="fas fa-edit"></i> Edit Post
                            </a>

                            <!-- View on Website -->
                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info btn-block mb-2">
                              <i class="fas fa-external-link-alt"></i> View on Website
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-trash"></i> Delete Post
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
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

  <style>
    .blog-content {
      line-height: 1.6;
    }
    
    .blog-content h2 {
      color: #333;
      margin-bottom: 15px;
    }
    
    .content {
      font-size: 1.1rem;
      line-height: 1.8;
      margin-top: 20px;
    }
    
    /* Rich Editor Content Styling */
    .content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
      margin-top: 25px;
      margin-bottom: 15px;
      font-weight: 600;
    }
    
    .content p {
      margin-bottom: 15px;
    }
    
    .content ul, .content ol {
      margin-bottom: 15px;
      padding-left: 30px;
    }
    
    .content blockquote {
      border-left: 4px solid #007bff;
      margin: 20px 0;
      padding: 10px 20px;
      background-color: #f8f9fa;
      font-style: italic;
    }
    
    .content img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
      margin: 15px 0;
    }
    
    .content a {
      color: #007bff;
      text-decoration: none;
    }
    
    .content a:hover {
      text-decoration: underline;
    }
  </style>
</body>
</html>
