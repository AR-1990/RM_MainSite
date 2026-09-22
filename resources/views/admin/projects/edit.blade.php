@extends('admin.layout.app')

@section('title', 'Edit Project')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Project</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></div>
                <div class="breadcrumb-item">{{ $project->title }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Project Information</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.projects.partials.validation-alert')
                        <form id="project-form" enctype="multipart/form-data" method="POST" action="{{ route('admin.projects.update', $project) }}">
                            @csrf
                            @method('PUT')
                            
                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Project Title *</label>
                                        <input type="text" class="form-control" id="title" name="title" required value="{{ $project->title }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="project_type">Project Type</label>
                                        <select class="form-control" id="project_type" name="project_type">
                                            {!! $projectCategoryOptions !!}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ $project->location }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="developer">Developer</label>
                                        <input type="text" class="form-control" id="developer" name="developer" value="{{ $project->developer }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">PKR</span>
                                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ $project->price }}">
                                            <select class="form-control" id="price_type" name="price_type">
                                                <option value="total" {{ $project->price_type == 'total' ? 'selected' : '' }}>Total</option>
                                                <option value="per_sqft" {{ $project->price_type == 'per_sqft' ? 'selected' : '' }}>Per Sq Ft</option>
                                                <option value="negotiable" {{ $project->price_type == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="area" name="area" step="0.01" min="0" value="{{ $project->area }}">
                                            <select class="form-control" id="area_unit" name="area_unit">
                                                <option value="sqft" {{ $project->area_unit == 'sqft' ? 'selected' : '' }}>Square Feet</option>
                                                <option value="sqm" {{ $project->area_unit == 'sqm' ? 'selected' : '' }}>Square Meters</option>
                                                <option value="acres" {{ $project->area_unit == 'acres' ? 'selected' : '' }}>Acres</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bedrooms">Bedrooms</label>
                                        <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0" value="{{ $project->bedrooms }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bathrooms">Bathrooms</label>
                                        <input type="number" class="form-control" id="bathrooms" name="bathrooms" min="0" step="0.5" value="{{ $project->bathrooms }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floors">Floors</label>
                                        <input type="number" class="form-control" id="floors" name="floors" min="1" value="{{ $project->floors }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="upcoming" {{ $project->status == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                            <option value="under_construction" {{ $project->status == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                                            <option value="ready_to_move" {{ $project->status == 'ready_to_move' ? 'selected' : '' }}>Ready to Move</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="completion_date">Expected Completion Date</label>
                                        <input type="date" class="form-control" id="completion_date" name="completion_date" value="{{ $project->completion_date ? $project->completion_date->format('Y-m-d') : '' }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Short Description</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Brief description for listings">{{ $project->short_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="description">Full Description</label>
                                <div id="quill-editor" style="height: 300px; border: 1px solid #ccc; border-radius: 4px; background: white;">
                                    <div id="quill-loading" style="text-align: center; padding: 100px 20px; color: #666;">
                                        <i class="fas fa-spinner fa-spin fa-2x mb-3"></i><br>
                                        Loading rich editor...<br>
                                        <small class="text-muted" id="loading-status">Initializing...</small>
                                    </div>
                                </div>
                                <textarea id="description" name="description" style="position: absolute; left: -9999px; opacity: 0; pointer-events: none; height: 1px; width: 1px;">{!! $project->description !!}</textarea>
                                <small class="form-text text-muted">Use the rich editor above to format your project description with text, images, and styling.</small>
                                <div id="quill-error" class="alert alert-warning mt-2" style="display: none;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Editor Loading Issue:</strong> The rich text editor failed to load. 
                                    <button type="button" class="btn btn-sm btn-primary ml-2" onclick="retryQuillInit()">Retry</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary ml-2" onclick="showTextareaFallback()">Use Simple Editor</button>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="testQuillInit()">Test Quill Init</button>
                                <button type="button" class="btn btn-sm btn-outline-info mt-2 ml-2" onclick="checkNetworkStatus()">Check Network</button>
                                <button type="button" class="btn btn-sm btn-outline-warning mt-2 ml-2" onclick="loadQuillManually()">Load from Alternative CDN</button>
                                <button type="button" class="btn btn-sm btn-outline-success mt-2 ml-2" onclick="debugContent()">Debug Content</button>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2 ml-2" onclick="forceLoadContent()">Force Load Content</button>
                            </div>

                            <!-- YouTube Video URL -->
                            <div class="form-group">
                                <label for="video_url">YouTube Video URL</label>
                                <input type="url" class="form-control" id="video_url" name="video_url" value="{{ old('video_url', $project->video_url) }}" placeholder="https://www.youtube.com/watch?v=...">
                                <small class="form-text text-muted">Paste a full YouTube link. The video will appear on the project page (no autoplay).</small>
                            </div>

                            <!-- Amenities and Features -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amenities</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="swimming_pool" id="amenity_pool" {{ in_array('swimming_pool', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_pool">Swimming Pool</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="gym" id="amenity_gym" {{ in_array('gym', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_gym">Gym</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="park" id="amenity_park" {{ in_array('park', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_park">Park</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="security" id="amenity_security" {{ in_array('security', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_security">Security</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="elevator" id="amenity_elevator" {{ in_array('elevator', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_elevator">Elevator</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="parking" id="amenity_parking" {{ in_array('parking', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_parking">Parking</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="garden" id="amenity_garden" {{ in_array('garden', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_garden">Garden</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="playground" id="amenity_playground" {{ in_array('playground', $project->amenities ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="amenity_playground">Playground</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Features</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="air_conditioning" id="feature_ac" {{ in_array('air_conditioning', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_ac">Air Conditioning</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="heating" id="feature_heating" {{ in_array('heating', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_heating">Heating</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="balcony" id="feature_balcony" {{ in_array('balcony', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_balcony">Balcony</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="fireplace" id="feature_fireplace" {{ in_array('fireplace', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_fireplace">Fireplace</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="hardwood_floors" id="feature_floors" {{ in_array('hardwood_floors', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_floors">Hardwood Floors</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="walk_in_closet" id="feature_closet" {{ in_array('walk_in_closet', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_closet">Walk-in Closet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="granite_countertops" id="feature_countertops" {{ in_array('granite_countertops', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_countertops">Granite Countertops</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="central_heating" id="feature_central_heating" {{ in_array('central_heating', $project->features ?? []) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="feature_central_heating">Central Heating</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project Images -->
                            <div class="form-group">
                                <label>Project Images</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="main_image">Main Image</label>
                                        <input type="file" class="form-control" id="main_image" name="main_image" accept="image/*">
                                        @if($project->main_image)
                                            <div class="current-file mt-2">
                                                <strong>Current Image:</strong><br>
                                                <img src="{{ url('' . $project->main_image) }}" alt="Current main image" style="max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 4px;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gallery_images">Gallery Images</label>
                                        <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                                        @if($project->gallery_images && count($project->gallery_images) > 0)
                                            <div class="current-files mt-2">
                                                <strong>Current Gallery Images:</strong><br>
                                                <div class="row mt-2">
                                                    @foreach($project->gallery_images as $image)
                                                        <div class="col-md-4 mb-2">
                                                            <img src="{{ url('' . $image) }}" alt="Gallery image" style="width: 100%; height: 80px; object-fit: cover; border-radius: 4px;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Information -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $project->meta_title }}" placeholder="SEO meta title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{ $project->meta_keywords }}" placeholder="SEO meta keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="2" placeholder="SEO meta description">{{ $project->meta_description }}</textarea>
                            </div>

                            <!-- Additional Settings -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" {{ $project->is_featured ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_featured">Featured Project</label>
                                        </div>
                                        <small class="form-text text-muted">Featured projects will be highlighted on the website</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $project->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active">Active Project</label>
                                        </div>
                                        <small class="form-text text-muted">Only active projects will be visible on the website</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                    <i class="fas fa-save"></i> Update Project
                                </button>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-info btn-lg ml-2">
                                    <i class="fas fa-eye"></i> View Project
                                </a>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-lg ml-2">
                                    <i class="fas fa-arrow-left"></i> Back to Projects
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" onerror="console.error('Failed to load Quill CSS from primary CDN')" onload="console.log('Quill CSS loaded successfully from primary CDN')">
<style>
.ql-editor {
    min-height: 250px;
}
#quill-editor {
    border: 1px solid #ccc;
    border-radius: 4px;
    background: white;
}
.ql-toolbar {
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-bottom: none;
    border-radius: 4px 4px 0 0;
}
.ql-container {
    border-bottom: 1px solid #ccc;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 4px 4px;
}
.current-file, .current-files {
    margin-top: 10px;
}
</style>
@endpush

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js" onerror="console.error('Failed to load Quill.js from CDN')" onload="console.log('Quill.js loaded successfully from CDN')"></script>
<script>
// Make functions globally available
window.showTextareaFallback = function() {
    console.log('Showing textarea fallback...');
    document.getElementById('quill-loading').style.display = 'none';
    document.getElementById('quill-error').style.display = 'block';
    document.getElementById('quill-editor').innerHTML = '<textarea id="fallback-description" name="description" class="form-control" rows="10" placeholder="Write your project description here...">' + document.getElementById('description').value + '</textarea>';
    
    // Update the hidden textarea to sync with fallback
    document.getElementById('fallback-description').addEventListener('input', function() {
        document.getElementById('description').value = this.value;
    });
};

window.retryQuillInit = function() {
    console.log('Retrying Quill initialization...');
    document.getElementById('quill-error').style.display = 'none';
    document.getElementById('quill-loading').style.display = 'block';
    
    // Clear the editor container
    document.getElementById('quill-editor').innerHTML = '<div id="quill-loading" style="text-align: center; padding: 100px 20px; color: #666;"><i class="fas fa-spinner fa-spin fa-2x mb-3"></i><br>Loading rich editor...</div>';
    
    // Try to initialize again
    setTimeout(function() {
        if (typeof Quill !== 'undefined') {
            try {
                var quill = new Quill('#quill-editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    },
                    placeholder: 'Write your project description here...'
                });
                
                // Set initial content from hidden textarea
                var initialContent = document.getElementById('description').value;
                if (initialContent && initialContent.trim() !== '') {
                    quill.root.innerHTML = initialContent.trim();
                }
                
                // Sync Quill content with hidden textarea
                quill.on('text-change', function() {
                    document.getElementById('description').value = quill.root.innerHTML;
                });
                
                // Store quill instance globally
                window.quill = quill;
                console.log('Quill editor initialized successfully on retry');
                
                // Hide loading state
                document.getElementById('quill-loading').style.display = 'none';
            } catch (error) {
                console.error('Error initializing Quill editor on retry:', error);
                window.showTextareaFallback();
            }
        } else {
            console.error('Quill still not available on retry');
            window.showTextareaFallback();
        }
    }, 1000);
};

// Function to check network status and CDN availability
window.checkNetworkStatus = function() {
    console.log('Checking network status...');
    
    // Test primary CDN
    var testScript = document.createElement('script');
    testScript.src = 'https://cdn.quilljs.com/1.3.6/quill.min.js';
    testScript.onload = function() {
        console.log('✓ Primary CDN (cdn.quilljs.com) is accessible');
        testScript.remove();
    };
    testScript.onerror = function() {
        console.error('✗ Primary CDN (cdn.quilljs.com) is not accessible');
        testScript.remove();
    };
    document.head.appendChild(testScript);
    
    // Test alternative CDN
    var testScript2 = document.createElement('script');
    testScript2.src = 'https://unpkg.com/quill@1.3.6/dist/quill.min.js';
    testScript2.onload = function() {
        console.log('✓ Alternative CDN (unpkg.com) is accessible');
        testScript2.remove();
    };
    testScript2.onerror = function() {
        console.error('✗ Alternative CDN (unpkg.com) is not accessible');
        testScript2.remove();
    };
    document.head.appendChild(testScript2);
    
    // Check if we're online
    if (navigator.onLine) {
        console.log('✓ Browser reports online status');
    } else {
        console.log('✗ Browser reports offline status');
    }
    
    // Log additional debugging info
    console.log('=== Debug Information ===');
    console.log('User Agent:', navigator.userAgent);
    console.log('Platform:', navigator.platform);
    console.log('Language:', navigator.language);
    console.log('Cookie Enabled:', navigator.cookieEnabled);
    console.log('Do Not Track:', navigator.doNotTrack);
    console.log('Document Ready State:', document.readyState);
    console.log('jQuery Version:', $.fn.jquery);
    console.log('Quill Global:', typeof Quill);
    console.log('Quill Instance:', window.quill);
    console.log('Current Time:', new Date().toISOString());
    console.log('=======================');
};

// Function to manually load Quill from a different source
window.loadQuillManually = function() {
    console.log('Manually loading Quill...');
    
    // Try jsDelivr CDN
    var script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js';
    script.onload = function() {
        console.log('✓ jsDelivr CDN loaded successfully');
        if (typeof Quill !== 'undefined') {
            retryQuillInit();
        }
    };
    script.onerror = function() {
        console.error('✗ jsDelivr CDN failed');
        alert('All CDN sources failed. Please check your internet connection or try refreshing the page.');
    };
    document.head.appendChild(script);
    
    // Also load CSS from jsDelivr
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css';
    document.head.appendChild(link);
};

// Debug content function
window.debugContent = function() {
    console.log('=== DEBUG CONTENT ===');
    console.log('Hidden textarea value:', document.getElementById('description').value);
    console.log('Quill instance:', window.quill);
    
    if (window.quill) {
        console.log('Quill root HTML:', window.quill.root.innerHTML);
        console.log('Quill text content:', window.quill.getText());
    }
    
    // Show content in alert for easy viewing
    var content = document.getElementById('description').value;
    if (content) {
        alert('Current content:\n\n' + content.substring(0, 500) + (content.length > 500 ? '...' : ''));
    } else {
        alert('No content found in hidden textarea');
    }
};

// Force load content into Quill
window.forceLoadContent = function() {
    if (window.quill) {
        var content = document.getElementById('description').value;
        if (content && content.trim() !== '') {
            var cleanContent = content.trim();
            if (cleanContent !== '<p><br></p>' && cleanContent !== '<p></p>') {
                window.quill.root.innerHTML = cleanContent;
                console.log('Content forced loaded:', cleanContent);
                alert('Content loaded successfully!');
            } else {
                alert('No valid content to load');
            }
        } else {
            alert('No content found in hidden textarea');
        }
    } else {
        alert('Quill editor not initialized');
    }
};

// Test Quill initialization
window.testQuillInit = function() {
    console.log('Manual Quill test triggered...');
    console.log('Quill type:', typeof Quill);
    console.log('Quill object:', Quill);
    
    if (typeof Quill !== 'undefined') {
        console.log('Quill is available, trying to initialize...');
        try {
            var quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image'],
                        ['clean']
                    ]
                },
                placeholder: 'Write your project description here...'
            });
            
            // Set initial content
            var initialContent = document.getElementById('description').value;
            if (initialContent && initialContent.trim() !== '') {
                quill.root.innerHTML = initialContent.trim();
            }
            
            // Sync Quill content with hidden textarea
            quill.on('text-change', function() {
                document.getElementById('description').value = quill.root.innerHTML;
            });
            
            // Store quill instance globally
            window.quill = quill;
            console.log('Manual Quill initialization successful!');
            alert('Quill editor initialized successfully!');
            
            // Hide loading state
            document.getElementById('quill-loading').style.display = 'none';
        } catch (error) {
            console.error('Manual Quill initialization failed:', error);
            alert('Quill initialization failed: ' + error.message);
        }
    } else {
        console.log('Quill is not available');
        alert('Quill.js is not loaded. Check console for details.');
    }
};

$(document).ready(function() {
    console.log('Document ready, initializing Quill...');
    console.log('jQuery version:', $.fn.jquery);
    console.log('Document ready state:', document.readyState);
    
    // Test if Quill is already available
    console.log('Quill availability check:', typeof Quill);
    
    // Function to update loading status
    function updateLoadingStatus(message) {
        var statusElement = document.getElementById('loading-status');
        if (statusElement) {
            statusElement.textContent = message;
        }
    }
    
    // Wait a bit for Quill to load
    setTimeout(function() {
        updateLoadingStatus('Checking Quill availability...');
        console.log('Timeout executed, checking Quill availability...');
        console.log('Quill type:', typeof Quill);
        console.log('Quill object:', Quill);
        
        // Initialize Quill.js
        if (typeof Quill !== 'undefined') {
            updateLoadingStatus('Quill loaded, initializing editor...');
            console.log('Quill loaded, initializing editor...');
            try {
                var quill = new Quill('#quill-editor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'align': [] }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    },
                    placeholder: 'Write your project description here...'
                });

                // Set initial content from hidden textarea
                var initialContent = document.getElementById('description').value;
                console.log('Setting initial content:', initialContent);
                if (initialContent && initialContent.trim() !== '') {
                    quill.root.innerHTML = initialContent.trim();
                    console.log('Content set successfully');
                }

                // Sync Quill content with hidden textarea
                quill.on('text-change', function() {
                    document.getElementById('description').value = quill.root.innerHTML;
                });

                // Custom image handler
                var toolbar = quill.getModule('toolbar');
                toolbar.addHandler('image', function() {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = function() {
                        var file = input.files[0];
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('_token', document.querySelector('input[name="_token"]').value);

                        $.ajax({
                            url: '/admin/projects/upload-image',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response.success) {
                                    var range = quill.getSelection();
                                    quill.insertEmbed(range.index, 'image', response.url);
                                } else {
                                    alert('Failed to upload image: ' + response.message);
                                }
                            },
                            error: function() {
                                alert('Failed to upload image. Please try again.');
                            }
                        });
                    };
                });
                
                console.log('Quill editor initialized successfully');
                
                // Hide loading state
                document.getElementById('quill-loading').style.display = 'none';
                
                // Store quill instance globally for other functions
                window.quill = quill;
            } catch (error) {
                console.error('Error initializing Quill editor:', error);
                window.showTextareaFallback();
            }
        } else {
            updateLoadingStatus('Quill not loaded, trying alternative CDN...');
            console.error('Quill not loaded, trying alternative CDN...');
            // Try alternative CDN
            var script = document.createElement('script');
            script.src = 'https://unpkg.com/quill@1.3.6/dist/quill.min.js';
            script.onload = function() {
                console.log('Alternative CDN loaded, retrying initialization...');
                if (typeof Quill !== 'undefined') {
                    try {
                        var quill = new Quill('#quill-editor', {
                            theme: 'snow',
                            modules: {
                                toolbar: [
                                    [{ 'header': [1, 2, 3, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    [{ 'color': [] }, { 'background': [] }],
                                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                    [{ 'align': [] }],
                                    ['link', 'image'],
                                    ['clean']
                                ]
                            },
                            placeholder: 'Write your project description here...'
                        });
                        
                        // Set initial content from hidden textarea
                        var initialContent = document.getElementById('description').value;
                        if (initialContent && initialContent.trim() !== '') {
                            quill.root.innerHTML = initialContent.trim();
                        }
                        
                        // Sync Quill content with hidden textarea
                        quill.on('text-change', function() {
                            document.getElementById('description').value = quill.root.innerHTML;
                        });
                        
                        // Store quill instance globally
                        window.quill = quill;
                        console.log('Quill editor initialized successfully from alternative CDN');
                        
                        // Hide loading state
                        document.getElementById('quill-loading').style.display = 'none';
                    } catch (error) {
                        console.error('Error initializing Quill from alternative CDN:', error);
                        window.showTextareaFallback();
                    }
                } else {
                    console.error('Alternative CDN also failed');
                    window.showTextareaFallback();
                }
            };
            script.onerror = function() {
                console.error('Alternative CDN also failed');
                window.showTextareaFallback();
            };
            document.head.appendChild(script);
        }
    }, 1000);
    
    // Form submission
    $('#project-form').on('submit', function(e) {
        // e.preventDefault(); // Allow normal submission
        
        // Update description from Quill before normal submit
        if (typeof window.quill !== 'undefined' && window.quill) {
            document.getElementById('description').value = window.quill.root.innerHTML;
        } else if (document.getElementById('fallback-description')) {
            document.getElementById('description').value = document.getElementById('fallback-description').value;
        }
        
        // Let the browser submit normally
    });
});

// Validate form
function validateForm() {
    var isValid = true;
    
    // Clear previous validation errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    
    // Required fields validation
    var requiredFields = ['title'];
    requiredFields.forEach(function(field) {
        var input = $('#' + field);
        if (!input.val().trim()) {
            input.addClass('is-invalid');
            input.after('<div class="invalid-feedback">This field is required.</div>');
            isValid = false;
        }
    });
    
    // Description validation
    var description = '';
    if (typeof window.quill !== 'undefined') {
        description = window.quill.root.innerHTML;
    } else if (document.getElementById('fallback-description')) {
        description = document.getElementById('fallback-description').value;
    } else {
        description = document.getElementById('description').value;
    }
    
    // Description is optional; no validation needed
    $('#quill-editor').removeClass('is-invalid');
    
    return isValid;
}

// Submit form
function submitForm() {
    var submitBtn = $('#submit-btn');
    var originalText = submitBtn.html();
    
    // Update description from Quill or fallback
    if (typeof window.quill !== 'undefined') {
        document.getElementById('description').value = window.quill.root.innerHTML;
    } else if (document.getElementById('fallback-description')) {
        document.getElementById('description').value = document.getElementById('fallback-description').value;
    }
    
    // Disable submit button
    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
    
    // Get form data
    var formData = new FormData(document.getElementById('project-form'));
    
    // Submit via AJAX
    $.ajax({
        url: '{{ route("admin.projects.update", $project->id) }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                // Show success message
                if (typeof iziToast !== 'undefined') {
                    iziToast.success({
                        title: 'Success!',
                        message: response.message,
                        position: 'topRight',
                        onClosed: function() {
                            window.location.href = response.redirect;
                        }
                    });
                } else {
                    alert(response.message);
                    window.location.href = response.redirect;
                }
            } else {
                // Show error message
                if (typeof iziToast !== 'undefined') {
                    iziToast.error({
                        title: 'Error!',
                        message: response.message || 'Failed to update project.',
                        position: 'topRight'
                    });
                } else {
                    alert(response.message || 'Failed to update project.');
                }
            }
        },
        error: function(xhr) {
            var errorMessage = 'An error occurred while updating the project.';
            
            if (xhr.status === 422) {
                var errors = xhr.responseJSON.errors;
                var errorList = [];
                for (var field in errors) {
                    errorList.push(errors[field][0]);
                }
                errorMessage = 'Validation errors:\n' + errorList.join('\n');
            }
            
            if (typeof iziToast !== 'undefined') {
                iziToast.error({
                    title: 'Error!',
                    message: errorMessage,
                    position: 'topRight'
                });
            } else {
                alert(errorMessage);
            }
        },
        complete: function() {
            // Re-enable submit button
            submitBtn.prop('disabled', false).html(originalText);
        }
    });
}
</script>
@include('admin.projects.partials.validation-script')
@endpush
