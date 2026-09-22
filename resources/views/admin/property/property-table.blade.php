<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Property Management - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/custom.css') }}">
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
            <h1>Property Management</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Properties</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Properties</h4>
                    <div class="card-header-action">
                      <a href="{{ route('admin.property.add') }}" class="btn btn-primary">Add New Property</a>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif

                    <div class="table-responsive">
                      <table class="table table-striped" id="propertyTable">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Active</th>
                            <th>Sold</th>
                            <th>Deactivated</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($properties as $property)
                            <tr>
                              <td>{{ $property->id }}</td>
                              <td>
                                @if($property->primary_image)
                                  <img src="{{ url('' . $property->primary_image) }}" alt="Property Image" 
                                       class="img-fluid" style="max-width: 50px; max-height: 50px;">
                                @else
                                  <div class="bg-secondary text-white text-center" style="width: 50px; height: 50px; line-height: 50px;">
                                    No Image
                                  </div>
                                @endif
                              </td>
                              <td>{{ $property->title }}</td>
                              <td>
                                @if($property->user)
                                  <div>{{ $property->user->name }}</div>
                                  <small class="text-muted">{{ $property->user->email }}</small>
                                  @if($property->user->profile?->phone)
                                    <br><small class="text-muted">{{ $property->user->profile->phone }}</small>
                                  @endif
                                  <br>
                                  <span class="badge badge-{{ $property->user->role === 'user' ? 'primary' : 'secondary' }}">
                                    {{ $property->user->role === 'user' ? 'User Portal' : 'Admin Added' }}
                                  </span>
                                @else
                                  <span class="badge badge-secondary">Admin Added</span>
                                @endif
                              </td>
                              <td>{{ $property->category->name ?? 'N/A' }}</td>
                              <td>
                                <span class="badge badge-{{ $property->property_status == 'for_sale' ? 'success' : 'info' }}">
                                  {{ ucfirst(str_replace('_', ' ', $property->property_status)) }}
                                </span>
                              </td>
                              <td>PKR {{ number_format($property->price) }}</td>
                              <td>{{ $property->city }}, {{ $property->full_address }}</td>
                              <td>
                                <form action="{{ route('admin.properties.toggle-status', $property->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-{{ $property->is_active ? 'success' : 'danger' }}">
                                    {{ $property->is_active ? 'Approved' : 'Pending' }}
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="{{ route('admin.properties.toggle-sold', $property->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-{{ $property->is_sold ? 'warning' : 'secondary' }}">
                                    {{ $property->is_sold ? 'Sold' : 'Available' }}
                                  </button>
                                </form>
                              </td>
                              <td>
                                <form action="{{ route('admin.properties.toggle-deactivated', $property->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-{{ $property->is_deactivated ? 'danger' : 'success' }}">
                                    {{ $property->is_deactivated ? 'Hidden' : 'Visible' }}
                                  </button>
                                </form>
                              </td>
                              <td>
                                <div class="btn-group" role="group">
                                  <a href="{{ route('admin.properties.show', $property->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                  <a href="{{ route('admin.property.edit') }}?id={{ $property->id }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this property?')">
                                      <i class="fas fa-trash"></i>
                                    </button>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
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
          <a href="templateshub.net">Templateshub</a>
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
  <!-- Template JS File -->
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ url('assets-admin/js/custom.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('#propertyTable').DataTable({
        "pageLength": 25,
        "order": [[ 0, "desc" ]]
      });
    });
  </script>
</body>
</html>
