<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Edit Property - Admin Dashboard</title>
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
            <h1>Edit Property</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Properties</a></div>
              <div class="breadcrumb-item">Edit Property</div>
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

                    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      
                      <!-- Basic Information -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Property Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $property->title) }}" placeholder="Enter property title" required>
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
                                <option value="{{ $category->id }}" data-category-name="{{ strtolower($category->name) }}" {{ old('property_category_id', $property->property_category_id) == $category->id ? 'selected' : '' }}>
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
                              <option value="for_sale" {{ old('property_status', $property->property_status) == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                              <option value="for_rent" {{ old('property_status', $property->property_status) == 'for_rent' ? 'selected' : '' }}>For Rent</option>
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
                                   value="{{ old('price', $property->price) }}" placeholder="Enter price" step="0.01" required>
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
                              <input class="form-check-input" type="checkbox" id="use_custom_price_label" name="use_custom_price_label" value="1" {{ old('use_custom_price_label', $property->use_custom_price_label) ? 'checked' : '' }}>
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
                                   value="{{ old('custom_price_label', $property->custom_price_label) }}" placeholder="Example: 1.5 CR">
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
                                   value="{{ old('full_address', $property->full_address) }}" placeholder="Enter full address" required>
                            @error('full_address')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>City <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" 
                                   value="{{ old('city', $property->city) }}" placeholder="Enter city" required>
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
                                   value="{{ old('location', $property->location) }}" placeholder="Enter Google Map location">
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
                              <option value="Furnished" {{ old('furnished_status', $property->furnished_status) == 'Furnished' ? 'selected' : '' }}>Furnished</option>
                              <option value="Non-Furnished" {{ old('furnished_status', $property->furnished_status) == 'Non-Furnished' ? 'selected' : '' }}>Non-Furnished</option>
                              <option value="N/A" {{ old('furnished_status', $property->furnished_status) == 'N/A' ? 'selected' : '' }}>Not Applicable (Plot)</option>
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
                              <option value="Marla" {{ old('size_prefix', $property->size_prefix) == 'Marla' ? 'selected' : '' }}>Marla</option>
                              <option value="Square Feet" {{ old('size_prefix', $property->size_prefix) == 'Square Feet' ? 'selected' : '' }}>Square Feet</option>
                              <option value="Square Yards" {{ old('size_prefix', $property->size_prefix) == 'Square Yards' ? 'selected' : '' }}>Square Yards</option>
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
                                   value="{{ old('size', $property->size) }}" placeholder="Enter size e.g. 260 X 40" required>
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
                              <option value="250" {{ old('marla_value', $property->marla_value) == '250' ? 'selected' : '' }}>250</option>
                              <option value="225" {{ old('marla_value', $property->marla_value) == '225' ? 'selected' : '' }}>225</option>
                              <option value="272" {{ old('marla_value', $property->marla_value) == '272' ? 'selected' : '' }}>272</option>
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
                                   value="{{ old('rooms', $property->rooms) }}" placeholder="Enter number of rooms" required>
                            @error('rooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Bedrooms <span class="text-danger">*</span></label>
                            <input type="number" id="bedrooms" name="bedrooms" class="form-control @error('bedrooms') is-invalid @enderror"
                                   value="{{ old('bedrooms', $property->bedrooms) }}" placeholder="Enter number of bedrooms" required>
                            @error('bedrooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Bathrooms <span class="text-danger">*</span></label>
                            <input type="number" id="bathrooms" name="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror"
                                   value="{{ old('bathrooms', $property->bathrooms) }}" placeholder="Enter number of bathrooms" required>
                            @error('bathrooms')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Number of Parking</label>
                            <input type="number" id="garages" name="garages" class="form-control @error('garages') is-invalid @enderror"
                                   value="{{ old('garages', $property->garages) }}" placeholder="Enter number of garages">
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
                                  rows="4" placeholder="Write property description here...">{{ old('description', $property->description) }}</textarea>
                        @error('description')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <!-- Video URL -->
                      <div class="form-group">
                        <label>Video URL</label>
                        <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror" 
                               value="{{ old('video_url', $property->video_url) }}" placeholder="Enter video URL">
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
                          @php
                            $propertyAmenities = $property->amenities->pluck('amenity_name')->toArray();
                          @endphp
                          <div class="row">
                            <div class="col-md-4">
                              <h6>Security</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Smoke alarm" id="smoke_alarm" 
                                       {{ in_array('Smoke alarm', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="smoke_alarm">Smoke alarm</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Carbon monoxide alarm" id="carbon_alarm"
                                       {{ in_array('Carbon monoxide alarm', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="carbon_alarm">Carbon monoxide alarm</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Security cameras" id="security_cameras"
                                       {{ in_array('Security cameras', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="security_cameras">Security cameras</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <h6>Safety</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="First aid kit" id="first_aid"
                                       {{ in_array('First aid kit', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="first_aid">First aid kit</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Self check-in with lockbox" id="self_checkin"
                                       {{ in_array('Self check-in with lockbox', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="self_checkin">Self check-in with lockbox</label>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <h6>Bedroom</h6>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Hangers" id="hangers"
                                       {{ in_array('Hangers', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="hangers">Hangers</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Bed linens" id="bed_linens"
                                       {{ in_array('Bed linens', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="bed_linens">Bed linens</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Extra pillows & blankets" id="extra_pillows"
                                       {{ in_array('Extra pillows & blankets', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="extra_pillows">Extra pillows & blankets</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="Iron" id="iron"
                                       {{ in_array('Iron', $propertyAmenities) ? 'checked' : '' }}>
                                <label class="form-check-label" for="iron">Iron</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" value="TV with standard cable" id="tv"
                                       {{ in_array('TV with standard cable', $propertyAmenities) ? 'checked' : '' }}>
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
                          @if($property->primary_image)
                            <div class="form-group">
                              <label>Current Primary Image</label>
                              <img src="{{ url('' . $property->primary_image) }}" alt="Primary Image" class="img-fluid" style="max-width: 200px;">
                            </div>
                          @endif
                          <div class="form-group">
                            <label>Update Primary Image</label>
                            <input type="file" name="primary_image" class="form-control @error('primary_image') is-invalid @enderror" 
                                   accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image</small>
                            @error('primary_image')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Additional Images</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                            <small class="form-text text-muted">You can select multiple images for the property gallery</small>
                          </div>
                          
                          @if($property->images->count() > 0)
                            <div class="form-group">
                              <label>Current Images</label>
                              <div class="row">
                                @foreach($property->images as $image)
                                  <div class="col-md-3 mb-2">
                                    <img src="{{ url('' . $image->image_path) }}" alt="Property Image" class="img-fluid">
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Update Property</button>
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
  </script>
</body>
</html>
