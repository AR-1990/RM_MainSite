<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - Randhawa Marketing</title>
    <meta name="description" content="{{ $project->meta_description ?: $project->short_description }}">
    <meta name="keywords" content="{{ $project->meta_keywords ?: 'real estate, property, ' . $project->project_type . ', ' . $project->location }}">
    
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('icons/favicon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('icons/favicon.svg') }}" />
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --light-bg: #f8f9fa;
            --dark-bg: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 24px 0 32px;
        }
        
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .hero-section .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.6);
        }
        
        .project-gallery {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .main-image {
            height: 400px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .project-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--secondary-color);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .thumbnail-gallery {
            padding: 20px;
            display: flex;
            gap: 15px;
            overflow-x: auto;
        }
        
        .thumbnail {
            width: 100px;
            height: 70px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }
        
        .thumbnail:hover {
            transform: scale(1.1);
        }
        
        .project-info {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-item {
            text-align: center;
            padding: 20px;
            background: var(--light-bg);
            border-radius: 10px;
        }
        
        .info-item i {
            font-size: 2rem;
            color: var(--accent-color);
            margin-bottom: 10px;
        }
        
        .info-item h5 {
            color: var(--primary-color);
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .info-item p {
            color: #666;
            margin: 0;
            font-size: 0.9rem;
        }
        
        .project-description {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .description-content {
            line-height: 1.8;
            color: #555;
        }
        
        .amenities-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .amenity-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: var(--light-bg);
            border-radius: 8px;
        }
        
        .amenity-item i {
            color: var(--accent-color);
            width: 20px;
        }
        
        .sidebar-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .sidebar-card h4 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 700;
            border-bottom: 3px solid var(--accent-color);
            padding-bottom: 10px;
        }
        
        .contact-form {
            background: var(--light-bg);
            padding: 25px;
            border-radius: 15px;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            transition: border-color 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .related-projects {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .related-project-card {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        
        .related-project-card:hover {
            transform: translateY(-3px);
        }
        
        .related-project-image {
            overflow: hidden;
            border-radius: 8px;
            height: 80px;
        }
        
        .related-project-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .related-project-card:hover .related-project-image img {
            transform: scale(1.1);
        }
        
        .related-project-card h6 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .related-project-card p {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .btn-view-related {
            background: var(--accent-color);
            color: white;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .btn-view-related:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .price-highlight {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #c0392b 100%);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .price-highlight h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .price-highlight p {
            opacity: 0.9;
            margin-bottom: 20px;
        }
        
        .btn-inquire {
            background: white;
            color: var(--secondary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-inquire:hover {
            background: var(--light-bg);
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .main-image {
                height: 300px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .amenities-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="popup-loader">
    @php
        $project = isset($project) ? $project : new \App\Models\Project();
        $relatedProjects = isset($relatedProjects) ? collect($relatedProjects) : collect();
        $featuredProjects = isset($featuredProjects) ? collect($featuredProjects) : collect();

        $projectGallery = data_get($project, 'gallery_images', []);
        if ($projectGallery instanceof \Illuminate\Support\Collection) {
            $projectGallery = $projectGallery->all();
        }
        if (is_string($projectGallery)) {
            $decodedProjectGallery = json_decode($projectGallery, true);
            $projectGallery = is_array($decodedProjectGallery) ? $decodedProjectGallery : [];
        }
        $projectGallery = is_array($projectGallery) ? array_values(array_filter($projectGallery, fn ($item) => filled($item))) : [];

        $projectAmenities = data_get($project, 'amenities', []);
        if ($projectAmenities instanceof \Illuminate\Support\Collection) {
            $projectAmenities = $projectAmenities->all();
        }
        if (is_string($projectAmenities)) {
            $decodedProjectAmenities = json_decode($projectAmenities, true);
            $projectAmenities = is_array($decodedProjectAmenities) ? $decodedProjectAmenities : [];
        }
        $projectAmenities = is_array($projectAmenities) ? array_values(array_filter($projectAmenities, fn ($item) => filled($item))) : [];

        $projectHasPrice = isset($project->price) && is_numeric($project->price) && (float) $project->price > 0;
        $projectHasArea = isset($project->area) && is_numeric($project->area) && (float) $project->area > 0;
        $projectCompletionText = !empty($project->completion_date)
            ? rescue(fn () => \Illuminate\Support\Carbon::parse($project->completion_date)->format('M Y'), null, false)
            : null;
    @endphp

    <!-- wrapper -->
    <div id="wrapper">

        <!-- .preload -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader">
                        </div>
                        <div class="icon">
                            <img src="{{ url('images/logo/loading.png') }}" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.preload -->

        <!-- .header -->
        @include('layout.header')
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active">{{ $project->title }}</li>
                </ol>
            </nav>
            <h1>{{ $project->title }}</h1>
            <p class="mb-0">
                <i class="fas fa-map-marker-alt me-2"></i>{{ $project->location }}
                @if($project->developer)
                    • <i class="fas fa-building me-2"></i>{{ $project->developer }}
                @endif
            </p>
        </div>
    </section>
    
    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Project Gallery -->
                    <div class="project-gallery">
                        <div class="main-image" id="main-image" style="background-image: url('{{ $project->main_image ? url('' . $project->main_image) : url('images/default-project.jpg') }}')">
                            @if($project->is_featured)
                                <span class="project-badge">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            @endif
                        </div>
                        @if(count($projectGallery) > 0)
                            <div class="thumbnail-gallery">
                                @foreach($projectGallery as $image)
                                    <div class="thumbnail" 
                                         style="background-image: url('{{ url('' . $image) }}')"
                                         onclick="changeMainImage('{{ url('' . $image) }}')">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <!-- Project Information -->
                    <div class="project-info">
                        <h3 class="mb-4">Project Information</h3>
                        <div class="info-grid">
                            @if($projectHasPrice)
                            <div class="info-item">
                                <i class="fas fa-dollar-sign"></i>
                                <h5>Price</h5>
                                <p>PKR {{ number_format($project->price) }}</p>
                                @if($project->price_type)
                                    <small class="text-muted">{{ $project->price_type == 'per_sqft' ? 'per sq ft' : 'total' }}</small>
                                @endif
                            </div>
                            @endif
                            @if($projectHasArea)
                            <div class="info-item">
                                <i class="fas fa-ruler-combined"></i>
                                <h5>Area</h5>
                                <p>
                                    {{ number_format($project->area) }}
                                    @if(!empty($project->area_unit))
                                        {{ $project->area_unit }}
                                    @endif
                                </p>
                            </div>
                            @endif
                            @if($project->bedrooms)
                                <div class="info-item">
                                    <i class="fas fa-bed"></i>
                                    <h5>Bedrooms</h5>
                                    <p>{{ $project->bedrooms }}</p>
                                </div>
                            @endif
                            @if($project->bathrooms)
                                <div class="info-item">
                                    <i class="fas fa-bath"></i>
                                    <h5>Bathrooms</h5>
                                    <p>{{ $project->bathrooms }}</p>
                                </div>
                            @endif
                            @if($project->parking)
                                <div class="info-item">
                                    <i class="fas fa-car"></i>
                                    <h5>Parking</h5>
                                    <p>{{ $project->parking }}</p>
                                </div>
                            @endif
                            <div class="info-item">
                                <i class="fas fa-building"></i>
                                <h5>Type</h5>
                                <p>{{ $project->project_type_text }}</p>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-info-circle"></i>
                                <h5>Status</h5>
                                <p>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
                            </div>
                            @if($projectCompletionText)
                                <div class="info-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <h5>Completion</h5>
                                    <p>{{ $projectCompletionText }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Project Description -->
                    <div class="project-description">
                        <h3 class="mb-4">Project Description</h3>
                        @if($project->short_description)
                            <div class="mb-4">
                                <h5>Overview</h5>
                                <p class="description-content">{{ $project->short_description }}</p>
                            </div>
                        @endif
                        @if($project->youtube_video_id)
                            <div class="mb-4">
                                <h5>Project Video</h5>
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $project->youtube_embed_url }}" title="YouTube video player" loading="lazy" referrerpolicy="origin" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                        <div class="description-content">
                            {!! $project->description !!}
                        </div>
                    </div>
                    
                    <!-- Amenities & Features -->
                    @if(count($projectAmenities) > 0)
                        <div class="amenities-section">
                            <h3 class="mb-4">Amenities & Features</h3>
                            <div class="amenities-grid">
                                @foreach($projectAmenities as $amenity)
                                    <div class="amenity-item">
                                        <i class="fas fa-check"></i>
                                        <span>{{ $amenity }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Related Projects -->
                    @if($relatedProjects->isNotEmpty())
                        <div class="related-projects">
                            <h3 class="mb-4">Related Projects</h3>
                            @foreach($relatedProjects as $relatedProject)
                                <div class="related-project-card">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="related-project-image">
                                                <img src="{{ $relatedProject->main_image ? url('' . $relatedProject->main_image) : url('images/default-project.jpg') }}" 
                                                     alt="{{ $relatedProject->title }}" 
                                                     class="img-fluid rounded">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <h6>{{ $relatedProject->title }}</h6>
                                            <p class="mb-2">
                                                <i class="fas fa-map-marker-alt me-2"></i>{{ $relatedProject->location }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                @if(!is_null($relatedProject->price) && floatval($relatedProject->price) > 0)
                                                    <strong class="text-primary">PKR {{ number_format($relatedProject->price) }}</strong>
                                                @endif
                                                <a href="{{ route('projects.show', $relatedProject->slug) }}" class="btn-view-related">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Price Highlight -->
                    @if($projectHasPrice)
                    <div class="price-highlight">
                        <h3>PKR {{ number_format($project->price) }}</h3>
                        @if($project->price_type)
                            <p>{{ $project->price_type == 'per_sqft' ? 'per square foot' : 'total price' }}</p>
                        @endif
                        <button class="btn-inquire" onclick="scrollToContact()">
                            <i class="fas fa-envelope me-2"></i>Inquire Now
                        </button>
                    </div>
                    @endif
                    
                    <!-- Contact Form -->
                    <div class="sidebar-card">
                        <h4><i class="fas fa-envelope me-2"></i>Get More Information</h4>
                        <p class="text-muted mb-3">Interested in this project? Contact us for detailed information and pricing.</p>
                        
                        <form class="contact-form" id="contact-form">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <input type="text" class="form-control" id="subject" name="subject" required value="Inquiry about {{ $project->title }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="interest" class="form-label">I'm interested in</label>
                                <select class="form-control" id="interest" name="interest">
                                    <option value="">Select Interest</option>
                                    <option value="buying">Buying</option>
                                    <option value="renting">Renting</option>
                                    <option value="investment">Investment</option>
                                    <option value="general">General Information</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Tell us about your requirements..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-submit w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                    
                    <!-- Project Details -->
                    <div class="sidebar-card">
                        <h4><i class="fas fa-info-circle me-2"></i>Quick Details</h4>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <strong>Project Type:</strong><br>
                                <span class="text-muted">{{ $project->project_type_text }}</span>
                            </div>
                            <div class="col-6 mb-3">
                                <strong>Status:</strong><br>
                                <span class="text-muted">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
                            </div>
                            <div class="col-6 mb-3">
                                <strong>Location:</strong><br>
                                <span class="text-muted">{{ $project->location }}</span>
                            </div>
                            @if($project->developer)
                                <div class="col-6 mb-3">
                                    <strong>Developer:</strong><br>
                                    <span class="text-muted">{{ $project->developer }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- .prograss -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div> <!-- /.prograss -->
    
    @include('layout.footer')
    
    </div><!-- /#wrapper -->
    
    <!-- Javascript -->
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/rangle-slider.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/simpleParallaxVanilla.umd.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/Splitetext.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/gsap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/ScrollTrigger.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>
    <script defer src="../../../sibforms.com/forms/end-form/build/main.js"></script>
    
    <script>
        // Change main image when thumbnail is clicked
        function changeMainImage(imageUrl) {
            document.getElementById('main-image').style.backgroundImage = `url('${imageUrl}')`;
        }
        
        // Scroll to contact form
        function scrollToContact() {
            document.getElementById('contact-form').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
        
        $(document).ready(function() {
            // Contact form submission
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();
                
                var formData = new FormData(this);
                var submitBtn = $(this).find('button[type="submit"]');
                var originalText = submitBtn.html();
                
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Sending...');
                submitBtn.prop('disabled', true);
                
                $.ajax({
                    url: '{{ route("contact") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert('Thank you! Your message has been sent successfully. We will get back to you soon.');
                            $('#contact-form')[0].reset();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = 'Please fix the following errors:\n';
                            for (var field in errors) {
                                errorMessage += '- ' + errors[field][0] + '\n';
                            }
                            alert(errorMessage);
                        } else {
                            alert('Something went wrong. Please try again later.');
                        }
                    },
                    complete: function() {
                        submitBtn.html(originalText);
                        submitBtn.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
