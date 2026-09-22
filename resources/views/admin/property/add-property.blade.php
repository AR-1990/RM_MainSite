<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Property - Admin Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ url('assets-admin/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets-admin/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
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
            <h1>Add New Property</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Properties</a></div>
              <div class="breadcrumb-item">Add Property</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Property Information</h4>
                  </div>
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif

                    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      
                      <!-- Basic Information -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Property Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" placeholder="Enter property title" required>
                            @error('title')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Property Category <span class="text-danger">*</span></label>
                            <select id="property_category_id" name="property_category_id" class="form-control @error('property_category_id') is-invalid @enderror" required>
                              <option value="">Select Category</option>
                              @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-category-name="{{ strtolower($category->name) }}" {{ old('property_category_id') == $category->id ? 'selected' : '' }}>
                                  {{ $category->name }}
                                </option>
                              @endforeach
                            </select>
                            @error('property_category_id')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Property Status <span class="text-danger">*</span></label>
                            <select name="property_status" class="form-control @error('property_status') is-invalid @enderror" required>
                              <option value="">Select Status</option>
                              <option value="for_sale" {{ old('property_status') == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                              <option value="for_rent" {{ old('property_status') == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                            </select>
                            @error('property_status')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Price (Digits Only) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price') }}" placeholder="Enter price" step="0.01" required>
                            @error('price')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group mb-2">
                            <label class="mb-2 d-block">Front-end Price Label</label>
                            <div class="form-check pt-2">
                              <input class="form-check-input" type="checkbox" id="use_custom_price_label" name="use_custom_price_label" value="1" {{ old('use_custom_price_label') ? 'checked' : '' }}>
                              <label class="form-check-label" for="use_custom_price_label">
                                Show custom text instead of numeric price on website
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group" id="customPriceLabelGroup">
                            <label>Front-end Price Text</label>
                            <input type="text" id="custom_price_label" name="custom_price_label" class="form-control @error('custom_price_label') is-invalid @enderror"
                                   value="{{ old('custom_price_label') }}" placeholder="Example: 1.5 CR">
                            <small class="form-text text-muted">Filters aur sorting ke liye numeric price upar wala hi use hoga.</small>
                            @error('custom_price_label')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Full Address <span class="text-danger">*</span></label>
                            <input type="text" name="full_address" class="form-control @error('full_address') is-invalid @enderror" 
                                   value="{{ old('full_address') }}" placeholder="Enter full address" required>
                            @error('full_address')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" 
                                   value="{{ old('city') }}" placeholder="Enter city" required>
                            @error('city')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Location (Google Map)</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                   value="{{ old('location') }}" placeholder="Enter Google Map location">
                            @error('location')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" id="furnishedStatusGroup">
                            <label>Furnished Status <span class="text-danger">*</span></label>
                            <select id="furnished_status" name="furnished_status" class="form-control @error('furnished_status') is-invalid @enderror" required>
                              <option value="">Select Status</option>
                              <option value="Furnished" {{ old('furnished_status') == 'Furnished' ? 'selected' : '' }}>Furnished</option>
                              <option value="Non-Furnished" {{ old('furnished_status') == 'Non-Furnished' ? 'selected' : '' }}>Non-Furnished</option>
                              <option value="N/A" {{ old('furnished_status') == 'N/A' ? 'selected' : '' }}>Not Applicable (Plot)</option>
                            </select>
                            @error('furnished_status')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <!-- Size Information -->
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Size Prefix <span class="text-danger">*</span></label>
                            <select name="size_prefix" class="form-control @error('size_prefix') is-invalid @enderror" required>
                              <option value="">Select Prefix</option>
                              <option value="Marla" {{ old('size_prefix') == 'Marla' ? 'selected' : '' }}>Marla</option>
                              <option value="Square Feet" {{ old('size_prefix') == 'Square Feet' ? 'selected' : '' }}>Square Feet</option>
                              <option value="Square Yards" {{ old('size_prefix') == 'Square Yards' ? 'selected' : '' }}>Square Yards</option>
                            </select>
                            @error('size_prefix')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Size <span class="text-danger">*</span></label>
                            <input type="text" name="size" class="form-control @error('size') is-invalid @enderror"
                                   value="{{ old('size') }}" placeholder="Enter size e.g. 260 X 40" required>
                            @error('size')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>1 Marla Value <span class="text-danger">*</span></label>
                            <select name="marla_value" class="form-control @error('marla_value') is-invalid @enderror" required>
                              <option value="">Select Value</option>
                              <option value="250" {{ old('marla_value') == '250' ? 'selected' : '' }}>250</option>
                              <option value="225" {{ old('marla_value') == '225' ? 'selected' : '' }}>225</option>
                              <option value="272" {{ old('marla_value') == '272' ? 'selected' : '' }}>272</option>
                            </select>
                            @error('marla_value')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <!-- Room Information -->
                      <div class="row" id="roomFieldsSection">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Rooms <span class="text-danger">*</span></label>
                            <input type="number" id="rooms" name="rooms" class="form-control @error('rooms') is-invalid @enderror"
                                   value="{{ old('rooms') }}" placeholder="Enter number of rooms" required>
                            @error('rooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Bedrooms <span class="text-danger">*</span></label>
                            <input type="number" id="bedrooms" name="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror"
                                   value="{{ old('bedrooms') }}" placeholder="Enter number of bedrooms" required>
                            @error('bedrooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Bathrooms <span class="text-danger">*</span></label>
                            <input type="number" id="bathrooms" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror"
                                   value="{{ old('bathrooms') }}" placeholder="Enter number of bathrooms" required>
                            @error('bathrooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Parking</label>
                            <input type="number" id="garages" name="garages" class="form-control @error('garages') is-invalid @enderror"
                                   value="{{ old('garages', 0) }}" placeholder="Enter number of garages">
                            @error('garages')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>

                      <!-- Description -->
                      <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                  rows="4" placeholder="Write property description here...">{{ old('description') }}</textarea>
                        @error('description')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Video URL -->
                      <div class="form-group">
                        <label>Video URL</label>
                        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" 
                               value="{{ old('video_url') }}" placeholder="Enter video URL">
                        @error('video_url')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Amenities Section -->
                      <div class="card">
                        <div class="card-header">
                          <h4>Amenities</h4>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-4">
                              <h6>Security</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Smoke alarm" id="smoke_alarm">
                                <label class="form-check-label" for="smoke_alarm">Smoke alarm</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Carbon monoxide alarm" id="carbon_alarm">
                                <label class="form-check-label" for="carbon_alarm">Carbon monoxide alarm</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Security cameras" id="security_cameras">
                                <label class="form-check-label" for="security_cameras">Security cameras</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <h6>Safety</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="First aid kit" id="first_aid">
                                <label class="form-check-label" for="first_aid">First aid kit</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Self check-in with lockbox" id="self_checkin">
                                <label class="form-check-label" for="self_checkin">Self check-in with lockbox</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <h6>Bedroom</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Hangers" id="hangers">
                                <label class="form-check-label" for="hangers">Hangers</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Bed linens" id="bed_linens">
                                <label class="form-check-label" for="bed_linens">Bed linens</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Extra pillows & blankets" id="extra_pillows">
                                <label class="form-check-label" for="extra_pillows">Extra pillows & blankets</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Iron" id="iron">
                                <label class="form-check-label" for="iron">Iron</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="TV with standard cable" id="tv">
                                <label class="form-check-label" for="tv">TV with standard cable</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Images Upload -->
                      <div class="card">
                        <div class="card-header">
                          <h4>Property Images</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label>Primary Image <span class="text-danger">*</span></label>
                            <input type="file" name="primary_image" class="form-control @error('primary_image') is-invalid @enderror" 
                                   accept="image/*" required>
                            <small class="form-text text-muted">This will be the main image shown on the front page</small>
                            @error('primary_image')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Additional Images</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                            <small class="form-text text-muted">You can select multiple images for the property gallery</small>
                          </div>
                        </div>
                      </div>

                      <!-- Property Documents -->
                      <div class="card">
                        <div class="card-header">
                          <h4>Property Documents</h4>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label>Upload Documents</label>
                            <input type="file" name="documents[]" class="form-control" multiple>
                            <small class="form-text text-muted">Upload property documents (PDF, DOC, etc.)</small>
                          </div>
                        </div>
                      </div>

                      <!-- Floors Section -->
                      <div class="card">
                        <div class="card-header">
                          <h4>Property Floors</h4>
                          <button type="button" class="btn btn-primary btn-sm" id="addFloor">Add Floor</button>
                        </div>
                        <div class="card-body">
                          <div id="floorsContainer">
                            <!-- Floor entries will be added here dynamically -->
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add Property</button>
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
  <script src="{{ url('assets-admin/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ url('assets-admin/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ url('assets-admin/js/custom.js') }}"></script>

  <script>
    let floorCounter = 0;

    function syncPlotFields() {
      const categorySelect = document.getElementById('property_category_id');
      const furnishedSelect = document.getElementById('furnished_status');
      const furnishedStatusGroup = document.getElementById('furnishedStatusGroup');
      const roomFieldsSection = document.getElementById('roomFieldsSection');
      const roomFieldIds = ['rooms', 'bedrooms', 'bathrooms', 'garages'];
      const resetOnUnhide = ['rooms', 'bedrooms', 'bathrooms'];
      const selectedOption = categorySelect.options[categorySelect.selectedIndex];
      const isPlot = selectedOption && selectedOption.dataset.categoryName === 'plot';
      const plotOption = furnishedSelect.querySelector('option[value="N/A"]');

      if (plotOption) {
        plotOption.hidden = !isPlot;
      }

      roomFieldsSection.style.display = isPlot ? 'none' : '';
      furnishedStatusGroup.style.display = isPlot ? 'none' : '';
      furnishedSelect.required = !isPlot;
      furnishedSelect.disabled = isPlot;

      roomFieldIds.forEach(function(fieldId) {
        const input = document.getElementById(fieldId);
        if (!input) {
          return;
        }

        if (isPlot) {
          if (!input.dataset.previousValue && input.value !== '0') {
            input.dataset.previousValue = input.value;
          }
          input.value = 0;
          return;
        }

        if (input.value === '0' && input.dataset.previousValue) {
          input.value = input.dataset.previousValue;
          return;
        }

        if (resetOnUnhide.includes(fieldId) && input.value === '0' && !input.dataset.previousValue) {
          input.value = '';
        }
      });

      if (isPlot) {
        furnishedSelect.dataset.previousValue = furnishedSelect.value;
        furnishedSelect.value = 'N/A';
      } else if (furnishedSelect.value === 'N/A') {
        furnishedSelect.value = furnishedSelect.dataset.previousValue && furnishedSelect.dataset.previousValue !== 'N/A'
          ? furnishedSelect.dataset.previousValue
          : '';
      }
    }

    function syncCustomPriceLabel() {
      const priceToggle = document.getElementById('use_custom_price_label');
      const customPriceLabelGroup = document.getElementById('customPriceLabelGroup');
      const customPriceLabelInput = document.getElementById('custom_price_label');
      const isEnabled = priceToggle.checked;

      customPriceLabelGroup.style.display = isEnabled ? '' : 'none';
      customPriceLabelInput.required = isEnabled;

      if (!isEnabled) {
        customPriceLabelInput.value = '';
      }
    }

    document.getElementById('property_category_id').addEventListener('change', syncPlotFields);
    document.getElementById('use_custom_price_label').addEventListener('change', syncCustomPriceLabel);
    syncPlotFields();
    syncCustomPriceLabel();

    document.getElementById('addFloor').addEventListener('click', function() {
      floorCounter++;
      const floorHtml = `
        <div class="floor-entry border p-3 mb-3" id="floor_${floorCounter}">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Floor ${floorCounter}</h5>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeFloor(${floorCounter})">Delete Floor ${floorCounter}</button>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Floor Name <span class="text-danger">*</span></label>
                <input type="text" name="floors[${floorCounter}][floor_name]" class="form-control" placeholder="Enter floor name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Floor Price (Only Digits) <span class="text-danger">*</span></label>
                <input type="number" name="floors[${floorCounter}][floor_price]" class="form-control" placeholder="Enter floor price" step="0.01" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Price Prefix</label>
                <input type="text" name="floors[${floorCounter}][price_prefix]" class="form-control" value="PKR" placeholder="PKR">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Floor Size (Only Digits) <span class="text-danger">*</span></label>
                <input type="number" name="floors[${floorCounter}][floor_size]" class="form-control" placeholder="Enter floor size" step="0.01" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Size Postfix</label>
                <input type="text" name="floors[${floorCounter}][size_postfix]" class="form-control" value="sq ft" placeholder="sq ft">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Bedrooms <span class="text-danger">*</span></label>
                <input type="number" name="floors[${floorCounter}][bedrooms]" class="form-control" placeholder="Enter bedrooms" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Bathrooms <span class="text-danger">*</span></label>
                <input type="number" name="floors[${floorCounter}][bathrooms]" class="form-control" placeholder="Enter bathrooms" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Floor Image</label>
                <input type="file" name="floors[${floorCounter}][floor_image]" class="form-control" accept="image/*">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="floors[${floorCounter}][description]" class="form-control" rows="2" placeholder="Enter floor description"></textarea>
          </div>
        </div>
      `;
      document.getElementById('floorsContainer').insertAdjacentHTML('beforeend', floorHtml);
    });

    function removeFloor(floorId) {
      document.getElementById(`floor_${floorId}`).remove();
    }
  </script>
</body>
</html>
