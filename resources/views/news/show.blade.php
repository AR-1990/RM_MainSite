<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{ $news->title }} - Randhawa Marketing</title>

    <meta name="description" content="{{ $news->meta_description ?? Str::limit(strip_tags($news->content), 160) }}">
    <meta name="keywords" content="{{ $news->meta_keywords ?? 'Real Estate News, Property Updates, Market Trends, Randhawa Marketing' }}">
    <meta name="author" content="Randhawa Marketing" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{  url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/news.css') }}" /> <!-- new CSS -->

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{  url('icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{  url('icons/favicon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{  url('icons/favicon.svg') }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="popup-loader">
    <!-- wrapper -->
    <div id="wrapper">

        <!-- .preload -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="{{ url('/images/logo/loading.png') }}" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.preload -->

        <!-- .header -->
        @include('layout.header')

        <!-- Page Title -->
        <!-- <section class="page-title-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb custom-breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Article</li>
                            </ol>
                        </nav>
                        <h1 class="page-title">{{ $news->title }}</h1>
                        <div class="news-meta">
                            <span class="me-3"><i class="fas fa-calendar-alt me-2"></i>{{ $news->formatted_posted_date }}</span>
                            @if($news->featured)
                                <span class="badge featured-badge"><i class="fas fa-star me-1"></i>Featured</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
            <section class="page-title-section">
        <div class="container text-center">
            <h1 class="page-title-heading">{{ $news->title }}</h1>
            <p class="page-title-subtext">{{ $news->formatted_posted_date }}</p>
        </div>
    </section>

        <!-- News Content Section -->
        <section class="news-content-section">
            <div class="container">
                <div class="row">
                    <!-- Main Content - Left Side -->
                    <div class="col-lg-8">
                        <div class="news-article">
                            <!-- YouTube Video -->
                            <div class="news-video-container mb-4">
                                @if($news->youtube_video_id)
                                    <div class="video-wrapper">
                                        <iframe 
                                            src="https://www.youtube.com/embed/{{ $news->youtube_video_id }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @else
                                    <div class="video-placeholder">
                                        <i class="fas fa-video fa-3x mb-3"></i>
                                        <p class="mb-0">Video not available</p>
                                    </div>
                                @endif
                            </div>

                            <!-- News Content -->
                            <div class="news-content">
                                <div class="content-html">
                                    {!! $news->content !!}
                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="share-section">
                                <h5 class="share-title">
                                    <i class="fas fa-share-alt me-2 text-primary"></i>Share this article:
                                </h5>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                       target="_blank" class="btn btn-facebook">
                                        <i class="fab fa-facebook-f me-2"></i>Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                                       target="_blank" class="btn btn-twitter">
                                        <i class="fab fa-twitter me-2"></i>Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                       target="_blank" class="btn btn-linkedin">
                                        <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . request()->url()) }}" 
                                       target="_blank" class="btn btn-whatsapp">
                                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Related News -->
                        @if($relatedNews->count() > 0)
                            <div class="related-news mt-5">
                                <div class="section-header text-center mb-4">
                                    <h3><i class="fas fa-newspaper me-2 text-primary"></i>Related News</h3>
                                    <p class="text-muted">You might also be interested in these articles</p>
                                </div>
                                <div class="row">
                                    @foreach($relatedNews as $related)
                                        <div class="col-md-6 mb-4">
                                            <div class="related-news-card">
                                                <div class="news-thumbnail">
                                                    @if($related->youtube_video_id)
                                                        <img src="https://img.youtube.com/vi/{{ $related->youtube_video_id }}/mqdefault.jpg" 
                                                             alt="{{ $related->title }}">
                                                    @else
                                                        <div class="placeholder-thumbnail">
                                                            <i class="fas fa-video fa-2x"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="news-info">
                                                    <h5>
                                                        <a href="{{ route('news.show', $related->slug) }}">
                                                            {{ Str::limit($related->title, 60) }}
                                                        </a>
                                                    </h5>
                                                    <span class="date"><i class="fas fa-calendar-alt me-1"></i>{{ $related->formatted_posted_date }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Contact Form -->
                        <div class="contact-form-card">
                            <div class="card-header text-center mb-4">
                                <h4><i class="fas fa-phone-alt me-2 text-primary"></i>Get Free Consultation</h4>
                                <p class="text-muted mb-0">Fill out the form below and our experts will contact you within 24 hours</p>
                            </div>

                            <form id="lead-form" action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control custom-input" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control custom-input" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control custom-input" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <input type="text" class="form-control custom-input" id="subject" name="subject" required placeholder="What is this about?">
                                </div>
                                <div class="mb-3">
                                    <label for="interest" class="form-label">I'm interested in</label>
                                    <select class="form-select input-field" id="interest" name="interest">
                                        <option value="">Select your interest</option>
                                        <option value="buying">Buying Property</option>
                                        <option value="selling">Selling Property</option>
                                        <option value="renting">Renting Property</option>
                                        <option value="investment">Investment</option>
                                        <option value="consultation">General Consultation</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control custom-input" id="message" name="message" rows="4" placeholder="Tell us about your requirements..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 submit-btn">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>

                        <!-- Quick Contact Info -->
                        <div class="contact-info-card">
                            <h5 class="text-center"><i class="fas fa-info-circle me-2"></i>Quick Contact</h5>
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-phone"></i></div>
                                <div><small>Phone</small><strong>0333-1929762</strong></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                <div><small>Email</small><strong>info@randhawamarketing.com</strong></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                <div><small>Working Hours</small><strong>Mon - Fri: 9AM - 6PM</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layout.footer')
    </div><!-- /#wrapper -->

    <!-- Scripts -->
    <script src="{{  url('js/jquery.min.js') }}"></script>
    <script src="{{  url('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{  url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{  url('js/main.js') }}"></script>
</body>
</html>
