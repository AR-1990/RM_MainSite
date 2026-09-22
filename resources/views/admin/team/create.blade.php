@extends('admin.layout.app')

@section('title', 'Add Team Member')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Team Member</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></div>
                <div class="breadcrumb-item">Add Member</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Team Member Information</h4>
                    </div>
                    <div class="card-body">
                        <form id="team-member-form" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Full Name *</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="position">Position *</label>
                                                <input type="text" class="form-control" id="position" name="position" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Tell us about this team member..."></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="experience_years">Years of Experience</label>
                                                <input type="number" class="form-control" id="experience_years" name="experience_years" min="0" max="50">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sort_order">Display Order</label>
                                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="education">Education</label>
                                        <textarea class="form-control" id="education" name="education" rows="3" placeholder="Educational background..."></textarea>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- Expertise -->
                                    <div class="form-group">
                                        <label>Areas of Expertise</label>
                                        <div id="expertise-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="expertise[]" placeholder="e.g., Real Estate, Property Management">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger remove-expertise" style="display: none;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-expertise">
                                            <i class="fas fa-plus"></i> Add Expertise
                                        </button>
                                    </div>

                                    <!-- Certifications -->
                                    <div class="form-group">
                                        <label>Certifications</label>
                                        <div id="certifications-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="certifications[]" placeholder="e.g., Licensed Real Estate Agent">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger remove-certification" style="display: none;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-certification">
                                            <i class="fas fa-plus"></i> Add Certification
                                        </button>
                                    </div>

                                    <!-- Achievements -->
                                    <div class="form-group">
                                        <label>Achievements</label>
                                        <div id="achievements-container">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="achievements[]" placeholder="e.g., Top Sales Agent 2023">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-danger remove-achievement" style="display: none;">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-achievement">
                                            <i class="fas fa-plus"></i> Add Achievement
                                        </button>
                                    </div>
                                </div>

                                <!-- Sidebar -->
                                <div class="col-md-4">
                                    <!-- Profile Image -->
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <div class="image-preview-container">
                                            <div class="image-preview" id="image-preview">
                                                <i class="fas fa-user fa-3x text-muted"></i>
                                                <p class="text-muted mt-2">No image selected</p>
                                            </div>
                                            <input type="file" class="form-control" id="image" name="image" accept="image/*" style="display: none;">
                                            <button type="button" class="btn btn-outline-primary btn-block mt-2" id="select-image">
                                                <i class="fas fa-upload"></i> Select Image
                                            </button>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>

                                    <!-- Social Media Links -->
                                    <div class="form-group">
                                        <label>Social Media Links</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-linkedin text-info"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="linkedin" placeholder="LinkedIn URL">
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-twitter text-info"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="twitter" placeholder="Twitter URL">
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-facebook text-primary"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="facebook" placeholder="Facebook URL">
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-instagram text-danger"></i></span>
                                            </div>
                                            <input type="url" class="form-control" name="instagram" placeholder="Instagram URL">
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                                            <label class="custom-control-label" for="is_active">Active Member</label>
                                        </div>
                                        <small class="form-text text-muted">Inactive members won't be displayed on the website</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                                    <i class="fas fa-save"></i> Create Team Member
                                </button>
                                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary btn-lg ml-2">
                                    <i class="fas fa-arrow-left"></i> Back to Team
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

@push('js')
<script>
$(document).ready(function() {
    // Image preview functionality
    $('#select-image').on('click', function() {
        $('#image').click();
    });

    $('#image').on('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').html(`
                    <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">
                    <p class="text-success mt-2">${file.name}</p>
                `);
            };
            reader.readAsDataURL(file);
        }
    });

    // Add/Remove expertise fields
    $('#add-expertise').on('click', function() {
        var newField = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="expertise[]" placeholder="e.g., Real Estate, Property Management">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-expertise">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        $('#expertise-container').append(newField);
        updateRemoveButtons();
    });

    // Add/Remove certification fields
    $('#add-certification').on('click', function() {
        var newField = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="certifications[]" placeholder="e.g., Licensed Real Estate Agent">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-certification">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        $('#certifications-container').append(newField);
        updateRemoveButtons();
    });

    // Add/Remove achievement fields
    $('#add-achievement').on('click', function() {
        var newField = `
            <div class="input-group mb-2">
                <input type="text" class="form-control" name="achievements[]" placeholder="e.g., Top Sales Agent 2023">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-achievement">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `;
        $('#achievements-container').append(newField);
        updateRemoveButtons();
    });

    // Update remove buttons visibility
    function updateRemoveButtons() {
        $('.remove-expertise').show();
        $('.remove-certification').show();
        $('.remove-achievement').show();
        
        if ($('#expertise-container .input-group').length === 1) {
            $('#expertise-container .remove-expertise').hide();
        }
        if ($('#certifications-container .input-group').length === 1) {
            $('#certifications-container .remove-certification').hide();
        }
        if ($('#achievements-container .input-group').length === 1) {
            $('#achievements-container .remove-achievement').hide();
        }
    }

    // Remove fields
    $(document).on('click', '.remove-expertise', function() {
        $(this).closest('.input-group').remove();
        updateRemoveButtons();
    });

    $(document).on('click', '.remove-certification', function() {
        $(this).closest('.input-group').remove();
        updateRemoveButtons();
    });

    $(document).on('click', '.remove-achievement', function() {
        $(this).closest('.input-group').remove();
        updateRemoveButtons();
    });

    // Initialize remove buttons
    updateRemoveButtons();

    // Form submission
    $('#team-member-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var submitBtn = $('#submit-btn');
        var originalText = submitBtn.html();
        
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').empty();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating...');
        
        $.ajax({
            url: '{{ route("admin.team.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
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
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Please check the form for errors.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Please check the form for errors.');
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) {
                        var input = $('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.siblings('.invalid-feedback').text(errors[field][0]);
                    }
                    
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Validation Error!',
                            message: 'Please fix the errors in the form.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Please fix the errors in the form.');
                    }
                } else {
                    if (typeof iziToast !== 'undefined') {
                        iziToast.error({
                            title: 'Error!',
                            message: 'Something went wrong. Please try again.',
                            position: 'topRight'
                        });
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });
});
</script>
@endpush

@push('css')
<style>
.image-preview-container {
    text-align: center;
}

.image-preview {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 20px;
    background-color: #f8f9fa;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.image-preview img {
    max-width: 100%;
    border-radius: 8px;
}

.input-group .btn-outline-danger {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.form-group label {
    font-weight: 600;
    color: #333;
}

.custom-switch .custom-control-label {
    font-weight: 600;
}
</style>
@endpush
