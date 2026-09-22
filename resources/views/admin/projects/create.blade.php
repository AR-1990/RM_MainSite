@extends('admin.layout.app')

@section('title', 'Add New Project')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add New Project</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></div>
                <div class="breadcrumb-item">Add New</div>
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
                        <form id="project-form" enctype="multipart/form-data" method="POST" action="{{ route('admin.projects.store') }}">
                            @csrf
                            
                            <!-- Basic Information -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Project Title *</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
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
                                        <input type="text" class="form-control" id="location" name="location">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="developer">Developer</label>
                                        <input type="text" class="form-control" id="developer" name="developer">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">PKR</span>
                                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0">
                                            <select class="form-control" id="price_type" name="price_type">
                                                <option value="total">Total</option>
                                                <option value="per_sqft">Per Sq Ft</option>
                                                <option value="negotiable">Negotiable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area">Area</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="area" name="area" step="0.01" min="0">
                                            <select class="form-control" id="area_unit" name="area_unit">
                                                <option value="sqft">Square Feet</option>
                                                <option value="sqm">Square Meters</option>
                                                <option value="acres">Acres</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bedrooms">Bedrooms</label>
                                        <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bathrooms">Bathrooms</label>
                                        <input type="number" class="form-control" id="bathrooms" name="bathrooms" min="0" step="0.5">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="floors">Floors</label>
                                        <input type="number" class="form-control" id="floors" name="floors" min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="upcoming">Upcoming</option>
                                            <option value="under_construction">Under Construction</option>
                                            <option value="ready_to_move">Ready to Move</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="completion_date">Expected Completion Date</label>
                                        <input type="date" class="form-control" id="completion_date" name="completion_date">
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Brief description for listings"></textarea>
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
                                <textarea id="description" name="description" style="position: absolute; left: -9999px; opacity: 0; pointer-events: none; height: 1px; width: 1px;"></textarea>
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
                            </div>

                            <!-- YouTube Video URL -->
                            <div class="form-group">
                                <label for="video_url">YouTube Video URL</label>
                                <input type="url" class="form-control" id="video_url" name="video_url" placeholder="https://www.youtube.com/watch?v=...">
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
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="swimming_pool" id="amenity_pool">
                                                    <label class="form-check-label" for="amenity_pool">Swimming Pool</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="gym" id="amenity_gym">
                                                    <label class="form-check-label" for="amenity_gym">Gym</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="park" id="amenity_park">
                                                    <label class="form-check-label" for="amenity_park">Park</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="security" id="amenity_security">
                                                    <label class="form-check-label" for="amenity_security">Security</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="elevator" id="amenity_elevator">
                                                    <label class="form-check-label" for="amenity_elevator">Elevator</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="parking" id="amenity_parking">
                                                    <label class="form-check-label" for="amenity_parking">Parking</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="garden" id="amenity_garden">
                                                    <label class="form-check-label" for="amenity_garden">Garden</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="amenities[]" value="playground" id="amenity_playground">
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
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="air_conditioning" id="feature_ac">
                                                    <label class="form-check-label" for="feature_ac">Air Conditioning</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="heating" id="feature_heating">
                                                    <label class="form-check-label" for="feature_heating">Heating</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="balcony" id="feature_balcony">
                                                    <label class="form-check-label" for="feature_balcony">Balcony</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="fireplace" id="feature_fireplace">
                                                    <label class="form-check-label" for="feature_fireplace">Fireplace</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="hardwood_floors" id="feature_floors">
                                                    <label class="form-check-label" for="feature_floors">Hardwood Floors</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="walk_in_closet" id="feature_closet">
                                                    <label class="form-check-label" for="feature_closet">Walk-in Closet</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="granite_countertops" id="feature_countertops">
                                                    <label class="form-check-label" for="feature_countertops">Granite Countertops</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]" value="stainless_steel_appliances" id="feature_appliances">
                                                    <label class="form-check-label" for="feature_appliances">Stainless Steel Appliances</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_phone">Contact Phone</label>
                                        <input type="tel" class="form-control" id="contact_phone" name="contact_phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="contact_email">Contact Email</label>
                                        <input type="email" class="form-control" id="contact_email" name="contact_email">
                                    </div>
                                </div>
                            </div>

                            <!-- Coordinates -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="number" class="form-control" id="latitude" name="latitude" step="0.00000001">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="number" class="form-control" id="longitude" name="longitude" step="0.00000001">
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
                                        <small class="form-text text-muted">Recommended size: 800x600 pixels</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gallery_images">Gallery Images</label>
                                        <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                                        <small class="form-text text-muted">You can select multiple images</small>
                                    </div>
                                </div>
                            </div>

                            <!-- SEO Information -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="SEO meta title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="SEO meta keywords, comma separated">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="2" placeholder="SEO meta description"></textarea>
                            </div>

                            <!-- Additional Settings -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                            <label class="custom-control-label" for="is_featured">Featured Project</label>
                                        </div>
                                        <small class="form-text text-muted">Featured projects will be highlighted on the website</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                                            <label class="custom-control-label" for="is_active">Active Project</label>
                                        </div>
                                        <small class="form-text text-muted">Only active projects will be visible on the website</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save"></i> Create Project
                                </button>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left"></i> Cancel
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
    document.getElementById('quill-editor').innerHTML = '<textarea id="fallback-description" name="description" class="form-control" rows="10" placeholder="Write your project description here..."></textarea>';
    
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
                
                // Sync Quill content with hidden textarea
                quill.on('text-change', function() {
                    document.getElementById('description').value = quill.root.innerHTML;
                });
                
                // Store quill instance globally
                window.quill = quill;
                console.log('Quill editor initialized successfully on retry');
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

$(document).ready(function() {
    console.log('Document ready, initializing Quill...');
    console.log('jQuery version:', $.fn.jquery);
    console.log('Document ready state:', document.readyState);
    
    // Test if Quill is already available
    console.log('Quill availability check:', typeof Quill);
    
        // Functions are now defined globally above
    
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
            
            // Also try to load alternative CSS
            var link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://unpkg.com/quill@1.3.6/dist/quill.snow.css';
            document.head.appendChild(link);
            script.onload = function() {
                console.log('Alternative Quill CDN loaded, retrying initialization...');
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
                        
                        // Sync Quill content with hidden textarea
                        quill.on('text-change', function() {
                            document.getElementById('description').value = quill.root.innerHTML;
                        });
                        
                        // Hide loading state
                        document.getElementById('quill-loading').style.display = 'none';
                        
                        // Store quill instance globally
                        window.quill = quill;
                        console.log('Quill editor initialized successfully from alternative CDN');
                    } catch (error) {
                        console.error('Error initializing Quill from alternative CDN:', error);
                        window.showTextareaFallback();
                    }
                } else {
                    console.error('Alternative CDN also failed, showing textarea fallback');
                    window.showTextareaFallback();
                }
            };
            script.onerror = function() {
                console.error('Alternative CDN also failed, showing textarea fallback');
                window.showTextareaFallback();
            };
            document.head.appendChild(script);
        }
    }, 1000);
    
    // Add a longer timeout to show error if Quill still hasn't loaded
    setTimeout(function() {
        if (typeof Quill === 'undefined' && !window.quill) {
            console.error('Quill failed to load after extended timeout, showing error');
            document.getElementById('quill-loading').style.display = 'none';
            document.getElementById('quill-error').style.display = 'block';
            
            // Update error message with more details
            var errorDiv = document.getElementById('quill-error');
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Editor Loading Issue:</strong> The rich text editor failed to load after 5 seconds. 
                <br><small class="text-muted">This could be due to network issues, CDN problems, or browser compatibility.</small>
                <br><button type="button" class="btn btn-sm btn-primary ml-2 mt-2" onclick="retryQuillInit()">Retry</button>
                <button type="button" class="btn btn-sm btn-outline-secondary ml-2 mt-2" onclick="showTextareaFallback()">Use Simple Editor</button>
                <button type="button" class="btn btn-sm btn-outline-info ml-2 mt-2" onclick="checkNetworkStatus()">Check Network</button>
            `;
        }
    }, 5000);

    // Form submission
    $('#project-form').on('submit', function(e) {
        // e.preventDefault(); // Allow normal submission to let Laravel handle redirects and validation
        
        // Update description from Quill before normal submit
        if (typeof window.quill !== 'undefined' && window.quill) {
            document.getElementById('description').value = window.quill.root.innerHTML;
        } else if (document.getElementById('fallback-description')) {
            document.getElementById('description').value = document.getElementById('fallback-description').value;
        }
        
        // Let the browser submit normally
    });
});

// Debug functions
function debugForm() {
    var formData = new FormData(document.getElementById('project-form'));
    var debugOutput = document.getElementById('debug-output');
    var output = '<strong>Form Data:</strong><br>';
    
    for (var pair of formData.entries()) {
        output += pair[0] + ': ' + pair[1] + '<br>';
    }
    
    // Check Quill content
    if (typeof window.quill !== 'undefined' && window.quill) {
        output += '<br><strong>Quill Content:</strong><br>';
        output += 'HTML: ' + window.quill.root.innerHTML + '<br>';
        output += 'Text: ' + window.quill.getText() + '<br>';
    } else if (document.getElementById('fallback-description')) {
        output += '<br><strong>Fallback Textarea Content:</strong><br>';
        output += 'Text: ' + document.getElementById('fallback-description').value + '<br>';
    } else {
        output += '<br><strong>No editor content found</strong><br>';
    }
    
    debugOutput.innerHTML = output;
}

function testSubmit() {
    // Update description from Quill
    if (typeof window.quill !== 'undefined' && window.quill) {
        document.getElementById('description').value = window.quill.root.innerHTML;
    } else if (document.getElementById('fallback-description')) {
        // If using fallback textarea, get value from there
        document.getElementById('description').value = document.getElementById('fallback-description').value;
    }
    
    // Validate required fields
var requiredFields = ['title'];
var isValid = true;
var validationErrors = [];

requiredFields.forEach(function(field) {
    var value = $('#' + field).val();
    if (!value || value.trim() === '') {
        $('#' + field).addClass('is-invalid');
        validationErrors.push(field + ' is required');
        isValid = false;
    } else {
        $('#' + field).removeClass('is-invalid');
    }
});

// Description optional: clear invalid state
$('#quill-editor').removeClass('is-invalid');

    var debugOutput = document.getElementById('debug-output');
    if (isValid) {
        debugOutput.innerHTML = '<span class="text-success"><strong>✓ Validation Passed!</strong><br>Form is ready to submit.</span>';
    } else {
        debugOutput.innerHTML = '<span class="text-danger"><strong>✗ Validation Failed:</strong><br>' + validationErrors.join('<br>') + '</span>';
    }
}

function testQuillInit() {
    console.log('Manual Quill test triggered...');
    console.log('Quill type:', typeof Quill);
    console.log('Quill object:', Quill);
    console.log('jQuery version:', $.fn.jquery);
    console.log('Document ready state:', document.readyState);
    
    if (typeof Quill !== 'undefined') {
        console.log('Quill is available, trying to initialize...');
        try {
            // Clear the editor first
            document.getElementById('quill-editor').innerHTML = '';
            
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
            
            // Sync Quill content with hidden textarea
            quill.on('text-change', function() {
                document.getElementById('description').value = quill.root.innerHTML;
            });
            
            // Store quill instance globally
            window.quill = quill;
            console.log('Manual Quill initialization successful!');
            
            // Hide loading and error states
            document.getElementById('quill-loading').style.display = 'none';
            document.getElementById('quill-error').style.display = 'none';
            
            alert('Quill editor initialized successfully!');
        } catch (error) {
            console.error('Manual Quill initialization failed:', error);
            alert('Quill initialization failed: ' + error.message);
            window.showTextareaFallback();
        }
    } else {
        console.log('Quill is not available');
        alert('Quill.js is not loaded. Check console for details. You can try:\n1. Refreshing the page\n2. Using the "Retry" button\n3. Using the "Use Simple Editor" button');
    }
}
</script>
@include('admin.projects.partials.validation-script')
@endpush
