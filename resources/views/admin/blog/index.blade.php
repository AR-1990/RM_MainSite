<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blog Management - Admin Dashboard</title>
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
            <h1>Blog Management</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Blog Posts</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Blog Posts</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Post
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Views</th>
                            <th>Published</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>                                 
                          @forelse($blogs as $index => $blog)
                            <tr>
                              <td class="text-center">{{ $blogs->firstItem() + $index }}</td>
                              <td>
                                @if($blog->featured_image)
                                  <img src="{{ url('' . $blog->featured_image) }}" alt="{{ $blog->title }}" 
                                       class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                  <div class="bg-light d-flex align-items-center justify-content-center" 
                                       style="width: 60px; height: 60px;">
                                    <i class="fas fa-image text-muted"></i>
                                  </div>
                                @endif
                              </td>
                              <td>
                                <strong>{{ $blog->title }}</strong>
                                <br>
                                <small class="text-muted">{{ \Str::limit(strip_tags($blog->description), 50) }}</small>
                              </td>
                              <td>
                                <span class="badge" style="background-color: {{ $blog->category->color }}; color: white;">
                                  {{ $blog->category->name }}
                                </span>
                              </td>
                              <td>{{ $blog->author }}</td>
                              <td>
                                <form action="{{ route('admin.blogs.toggle-status', $blog) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm {{ $blog->is_active ? 'btn-success' : 'btn-danger' }}">
                                    {{ $blog->is_active ? 'Active' : 'Inactive' }}
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="{{ route('admin.blogs.toggle-featured', $blog) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm {{ $blog->is_featured ? 'btn-warning' : 'btn-light' }}">
                                    <i class="fas fa-star"></i>
                                  </button>
                                </form>
                              </td>
                              <td>{{ $blog->views_count }}</td>
                              <td>{{ $blog->formatted_published_date }}</td>
                              <td>
                                <div class="btn-group" role="group">
                                  <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" 
                                        style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this blog post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="10" class="text-center">
                                <div class="py-4">
                                  <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                                  <h5>No blog posts found</h5>
                                  <p class="text-muted">Start creating your first blog post!</p>
                                  <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add New Post
                                  </a>
                                </div>
                              </td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>

                    <!-- Pagination -->
                    @if($blogs->hasPages())
                      <div class="d-flex justify-content-center">
                        {{ $blogs->links() }}
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          <a href="#">Property Management System</a></a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ url('assets-admin/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ url('assets-admin/bundles/datatables/datatables.min.js') }}"></script>
  <script src="{{ url('assets-admin/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ url('assets-admin/js/page/datatables.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ url('assets-admin/js/style.js') }}"></script>
</body>
</html>
