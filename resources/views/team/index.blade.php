<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/2000/svg" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
    <title>Our Team - Real Estate Professionals | Randhawa Marketing</title>

    <meta name="description"
        content="Meet our dedicated team of real estate professionals. Experienced agents, consultants, and developers committed to delivering exceptional service.">

    <meta name="keywords"
        content="Real Estate Team, Property Agents, Real Estate Consultants, Property Developers, Real Estate Professionals">

    <meta name="author" content="Proty Real Estate" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{  url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/team.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{  url('icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{  url('icons/favicon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{  url('icons/favicon.svg') }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body class="popup-loader">
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
                            <img src="{{  url('images/logo/loading.png') }}" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.preload -->

        <!-- .header -->
        @include('layout.header')

        <!-- Page Header -->
        <section class="page-header-section">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-header-content text-center">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb">
                                    <li><a href="{{  url('') }}">Home</a></li>
                                    <li class="active">Our Team</li>
                                </ul>
                            </div>
                            <h1 class="page-title">Meet Our Team</h1>
                            <p class="page-subtitle">Dedicated professionals committed to delivering exceptional real estate services</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="tf-container">
                @if($teamMembers->count() > 0)
                    <!-- Team Grid -->
                    <div class="row">
                        @foreach($teamMembers as $member)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="team-card">
                                <div class="team-card-image">
                                    @if($member->image)
                                        <img src="{{  url('' . $member->image) }}" 
                                             alt="{{ $member->name }}" 
                                             class="img-fluid">
                                    @else
                                        <div class="default-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                    <div class="team-card-overlay">
                                        <div class="team-social-links">
                                            @if($member->linkedin)
                                                <a href="{{ $member->linkedin }}" target="_blank" class="social-link linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            @endif
                                            @if($member->twitter)
                                                <a href="{{ $member->twitter }}" target="_blank" class="social-link twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            @endif
                                            @if($member->facebook)
                                                <a href="{{ $member->facebook }}" target="_blank" class="social-link facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            @endif
                                            @if($member->instagram)
                                                <a href="{{ $member->instagram }}" target="_blank" class="social-link instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="team-card-body">
                                    <h4 class="team-member-name">{{ $member->name }}</h4>
                                    <p class="team-member-position">{{ $member->position }}</p>
                                    
                                    @if($member->experience_years)
                                        <div class="team-member-experience">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $member->experience_years }} years experience</span>
                                        </div>
                                    @endif
                                    
                                    @if($member->bio)
                                        <p class="team-member-bio">{{ Str::limit($member->bio, 120) }}</p>
                                    @endif
                                    
                                    @if($member->expertise && count($member->expertise) > 0)
                                        <div class="team-member-expertise">
                                            @foreach(array_slice($member->expertise, 0, 3) as $expertise)
                                                <span class="expertise-tag">{{ $expertise }}</span>
                                            @endforeach
                                            @if(count($member->expertise) > 3)
                                                <span class="expertise-tag more">+{{ count($member->expertise) - 3 }} more</span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    @if($member->email || $member->phone)
                                        <div class="team-member-contact">
                                            @if($member->email)
                                                <a href="mailto:{{ $member->email }}" class="contact-link">
                                                    <i class="fas fa-envelope"></i>
                                                    <span>{{ $member->email }}</span>
                                                </a>
                                            @endif
                                            @if($member->phone)
                                                <a href="tel:{{ $member->phone }}" class="contact-link">
                                                    <i class="fas fa-phone"></i>
                                                    <span>{{ $member->phone }}</span>
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- No Team Members -->
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h3>No Team Members Yet</h3>
                            <p>Our team information will be displayed here soon.</p>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- Call to Action Section -->
        <!-- <section class="cta-section">
            <div class="tf-container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <h3>Ready to Work With Our Team?</h3>
                            <p>Get in touch with our experienced professionals for all your real estate needs.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-right">
                        <a href="{{ route('contact') }}" class="cta-btn">
                            <i class="fas fa-envelope"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </section> -->
            <!-- section-CTA -->
            <section class="section-CTA style-2 tf-spacing-1">
                <div class="tf-container">
                    <div class="row relative">
                        <div class="col-12">
                            <div class="content-inner">
                                <div class="content">
                                    <div class="logo">
                                        <img src="{{ url('images/logo/logo-white@2x.png') }}" alt="">
                                    </div>
                                    <div class="heading-section  mb-30">
                                        <h2 class="title text-white wow animate__fadeInUp animate__animated"
                                            data-wow-duration="1s" data-wow-delay="0s">Ready to Work With Our  <br>
                                            Team?</h2>
                                        <p class="text-1 text-white wow animate__fadeInUp animate__animated"
                                            data-wow-duration="1s" data-wow-delay="0s">Get in touch with our experienced professionals for all your <br>
                                            real estate needs.
                                        </p>
                                    </div>
                                    <a href="{{ route('contact') }}"
                                        class="tf-btn style-2 fw-6 pd-25 wow animate__fadeInUp animate__animated"
                                        data-wow-duration="1s" data-wow-delay="0s">Contact Us<i
                                            class="icon-MagnifyingGlass fw-6"></i></a>
                                </div>
                            </div>
                            <div class="person wow animate__fadeInRight animate__animated" data-wow-duration="1s"
                                data-wow-delay="0s">
                                <img src="{{ url('images/section/person-2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /section-CTA -->
        <!-- Footer -->
        @include('layout.footer')

    </div><!-- /#wrapper -->

    <!-- .prograss -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div> <!-- /.prograss -->

    <!-- Javascript -->
    <script type="text/javascript" src="{{  url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/rangle-slider.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/simpleParallaxVanilla.umd.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/Splitetext.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/gsap.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/ScrollTrigger.min.js') }}"></script>
    <script type="text/javascript" src="{{  url('js/main.js') }}"></script>
    <script defer src="../../../sibforms.com/forms/end-form/build/main.js"></script>

    <!-- Custom Team Page Styles -->

    <!-- Custom Team Page JavaScript -->
    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links
            $('a[href*="#"]').on('click', function(event) {
                if (this.hash !== '') {
                    event.preventDefault();
                    const hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800);
                }
            });
            
            // Add intersection observer for animation
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, {
                    threshold: 0.1
                });
                
                document.querySelectorAll('.team-card').forEach(card => {
                    observer.observe(card);
                });
            }
            
            // Add hover effect for social links
            $('.social-link').hover(
                function() {
                    $(this).addClass('animated pulse');
                },
                function() {
                    $(this).removeClass('animated pulse');
                }
            );

            // Enhanced card interactions
            $('.team-card').hover(
                function() {
                    $(this).addClass('card-hovered');
                },
                function() {
                    $(this).removeClass('card-hovered');
                }
            );

            // Initialize WOW.js for animations
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }

            // Add loading state for images
            $('.team-card-image img').on('load', function() {
                $(this).parent().addClass('image-loaded');
            });

            // Smooth reveal animation for cards
            setTimeout(function() {
                $('.team-card').each(function(index) {
                    var card = $(this);
                    setTimeout(function() {
                        card.addClass('reveal');
                    }, index * 100);
                });
            }, 300);
        });
    </script>
</body>
</html>
