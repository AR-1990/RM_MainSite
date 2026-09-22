<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blog Categories - Admin Dashboard</title>
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
            <h1>Blog Categories</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Blog Categories</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Categories</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Category
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
                            <th>Color</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Posts Count</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>                                 
                          @forelse($categories as $index => $category)
                            <tr>
                              <td class="text-center">{{ $categories->firstItem() + $index }}</td>
                              <td>
                                <div style="width: 30px; height: 30px; background-color: {{ $category->color }}; border-radius: 50%; border: 2px solid #ddd;"></div>
                              </td>
                              <td>
                                <strong>{{ $category->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $category->slug }}</small>
                              </td>
                              <td>{{ $category->description ?? 'No description' }}</td>
                              <td>
                                <span class="badge badge-info">{{ $category->blogs_count }} Posts</span>
                              </td>
                              <td>
                                <form action="{{ route('admin.blog-categories.toggle-status', $category) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm {{ $category->is_active ? 'btn-success' : 'btn-danger' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                  </button>
                                </form>
                              </td>
                              <td>{{ $category->created_at->format('M d, Y') }}</td>
                              <td>
                                <div class="btn-group" role="group">
                                  <a href="{{ route('admin.blog-categories.show', $category) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="{{ route('admin.blog-categories.edit', $category) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  @if($category->blogs_count == 0)
                                    <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" 
                                          style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                      </button>
                                    </form>
                                  @else
                                    <button type="button" class="btn btn-sm btn-secondary" 
                                            title="Cannot delete category with posts" disabled>
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  @endif
                                </div>
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="8" class="text-center">
                                <div class="py-4">
                                  <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                  <h5>No categories found</h5>
                                  <p class="text-muted">Start creating your first blog category!</p>
                                  <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add New Category
                                  </a>
                                </div>
                              </td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>

                    <!-- Pagination -->
                    @if($categories->hasPages())
                      <div class="d-flex justify-content-center">
                        {{ $categories->links() }}
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
          <a href="#">Property Management System</a>
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
