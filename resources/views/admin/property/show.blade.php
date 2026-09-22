<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Property Details - Admin Dashboard</title>
  <link rel="stylesheet" href="{{ url('assets-admin/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/css/components.css') }}">
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

      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Property Details</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('admin.property.table') }}">Properties</a></div>
              <div class="breadcrumb-item active">View</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ $property->title }}</h4>
                    <a href="{{ route('admin.property.edit') }}?id={{ $property->id }}" class="btn btn-warning">Edit Property</a>
                  </div>
                  <div class="card-body">
                    @if($property->primary_image)
                      <img src="{{ url($property->primary_image) }}" alt="{{ $property->title }}" class="img-fluid rounded mb-4" style="max-height: 420px; width: 100%; object-fit: cover;">
                    @endif

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <strong>Category:</strong><br>
                        {{ $property->category->name ?? 'N/A' }}
                      </div>
                      <div class="col-md-6 mb-3">
                        <strong>Purpose:</strong><br>
                        {{ ucfirst(str_replace('_', ' ', $property->property_status)) }}
                      </div>
                      <div class="col-md-6 mb-3">
                        <strong>Price:</strong><br>
                        PKR {{ number_format($property->price) }}
                      </div>
                      <div class="col-md-6 mb-3">
                        <strong>Location:</strong><br>
                        {{ $property->city }}
                      </div>
                      <div class="col-md-6 mb-3">
                        <strong>Address:</strong><br>
                        {{ $property->full_address }}
                      </div>
                      <div class="col-md-6 mb-3">
                        <strong>Size:</strong><br>
                        {{ $property->display_size }} {{ $property->size_prefix }}
                      </div>
                      <div class="col-md-3 mb-3">
                        <strong>Bedrooms:</strong><br>
                        {{ (int) $property->bedrooms }}
                      </div>
                      <div class="col-md-3 mb-3">
                        <strong>Bathrooms:</strong><br>
                        {{ (int) $property->bathrooms }}
                      </div>
                      <div class="col-md-3 mb-3">
                        <strong>Parking:</strong><br>
                        {{ (int) $property->garages }}
                      </div>
                      <div class="col-md-3 mb-3">
                        <strong>Status:</strong><br>
                        @if($property->is_deactivated)
                          <span class="badge badge-danger">Hidden</span>
                        @elseif($property->is_active)
                          <span class="badge badge-success">Approved</span>
                        @else
                          <span class="badge badge-warning">Pending</span>
                        @endif
                      </div>
                    </div>

                    @if($property->description)
                      <hr>
                      <h6>Description</h6>
                      <p class="mb-0">{{ $property->description }}</p>
                    @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Submitted By</h4>
                  </div>
                  <div class="card-body">
                    @if($property->user)
                      <div class="mb-3">
                        <strong>Name:</strong><br>
                        {{ $property->user->name }}
                      </div>
                      <div class="mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:{{ $property->user->email }}">{{ $property->user->email }}</a>
                      </div>
                      <div class="mb-3">
                        <strong>Phone:</strong><br>
                        @if($property->user->profile?->phone)
                          <a href="tel:{{ $property->user->profile->phone }}">{{ $property->user->profile->phone }}</a>
                        @else
                          <span class="text-muted">Not available</span>
                        @endif
                      </div>
                      <div class="mb-3">
                        <strong>City:</strong><br>
                        {{ $property->user->profile?->city ?: 'Not available' }}
                      </div>
                      <div class="mb-3">
                        <strong>Submission Source:</strong><br>
                        <span class="badge badge-{{ $property->user->role === 'user' ? 'primary' : 'secondary' }}">
                          {{ $property->user->role === 'user' ? 'User Portal Submission' : 'Admin Panel Entry' }}
                        </span>
                      </div>
                    @else
                      <span class="badge badge-secondary">Admin Added</span>
                    @endif
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <h4>Quick Actions</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('admin.properties.toggle-status', $property->id) }}" method="POST" class="mb-2">
                      @csrf
                      <button type="submit" class="btn btn-block btn-{{ $property->is_active ? 'success' : 'warning' }}">
                        {{ $property->is_active ? 'Approved' : 'Approve Property' }}
                      </button>
                    </form>

                    <a href="{{ route('admin.property.edit') }}?id={{ $property->id }}" class="btn btn-warning btn-block mb-2">Edit Property</a>
                    <a href="{{ route('admin.property.table') }}" class="btn btn-light btn-block">Back to List</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left"></div>
        <div class="footer-right"></div>
      </footer>
    </div>
  </div>

  <script src="{{ url('assets-admin/js/app.min.js') }}"></script>
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>
  <script src="{{ url('assets-admin/js/custom.js') }}"></script>
</body>
</html>
