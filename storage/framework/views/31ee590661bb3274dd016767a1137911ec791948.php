<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php echo e($news->title); ?> - Real Estate News | Randhawa Marketing</title>

    <meta name="description" content="<?php echo e($news->meta_description ?? Str::limit(strip_tags($news->content), 160)); ?>">
    <meta name="keywords" content="<?php echo e($news->meta_keywords ?? 'Real Estate News, Property Updates, Market Trends, Randhawa Marketing'); ?>">
    <meta name="author" content="Randhawa Marketing" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo e($news->title); ?>">
    <meta property="og:description" content="<?php echo e($news->meta_description ?? Str::limit(strip_tags($news->content), 160)); ?>">
    <meta property="og:url" content="<?php echo e(request()->fullurl()); ?>">
    <meta property="og:type" content="article">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($news->title); ?>">
    <meta name="twitter:description" content="<?php echo e($news->meta_description ?? Str::limit(strip_tags($news->content), 160)); ?>">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/swiper-bundle.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/news.css')); ?>" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('icons/icomoon/style.css')); ?>" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="<?php echo e(url('icons/favicon.svg')); ?>" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo e(url('icons/favicon.svg')); ?>" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="popup-loader news-detail-page">
    <!-- wrapper -->
    <div id="wrapper">

        <!-- .preload -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="<?php echo e(url('/images/logo/loading.png')); ?>" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.preload -->

        <!-- .header -->
        <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Page Title / Hero -->
        <section class="page-title-section">
            <div class="container">
                <div class="news-breadcrumb">
                    <nav class="breadcrumb-elegant">
                        <a href="<?php echo e(route('index')); ?>"><i class="fas fa-home me-1"></i>Home</a>
                        <span class="bc-sep">/</span>
                        <a href="<?php echo e(route('news.index')); ?>">News</a>
                        <span class="bc-sep">/</span>
                        <span class="bc-current"><?php echo e(Str::limit($news->title, 50)); ?></span>
                    </nav>
                </div>
                <h1 class="page-title-heading"><?php echo e($news->title); ?></h1>
                <div class="news-meta-pills">
                    <span class="meta-pill"><i class="fas fa-calendar-alt me-1"></i><?php echo e($news->formatted_posted_date); ?></span>
                    <?php if($news->featured): ?>
                        <span class="meta-pill badge-featured"><i class="fas fa-star me-1"></i>Featured</span>
                    <?php endif; ?>
                </div>
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
                                <?php if($news->youtube_video_id): ?>
                                    <div class="video-wrapper">
                                        <iframe 
                                            src="https://www.youtube.com/embed/<?php echo e($news->youtube_video_id); ?>" 
                                            title="<?php echo e($news->title); ?>"
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                <?php else: ?>
                                    <div class="video-placeholder">
                                        <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
                                        <p class="mb-0">Official Market Update by Randhawa Marketing</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- News Content -->
                            <div class="news-content">
                                <div class="content-html">
                                    <?php echo $news->content; ?>

                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="share-section">
                                <h5 class="share-title">
                                    <i class="fas fa-share-alt me-2 text-gold"></i>Share this update:
                                </h5>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" 
                                       target="_blank" class="share-btn btn-facebook" title="Share on Facebook">
                                        <i class="fab fa-facebook-f me-2"></i>Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($news->title)); ?>" 
                                       target="_blank" class="share-btn btn-twitter" title="Share on Twitter / X">
                                        <i class="fab fa-x-twitter me-2"></i>Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(request()->url())); ?>" 
                                       target="_blank" class="share-btn btn-linkedin" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in me-2"></i>LinkedIn
                                    </a>
                                    <a href="https://wa.me/?text=<?php echo e(urlencode($news->title . ' - ' . request()->url())); ?>" 
                                       target="_blank" class="share-btn btn-whatsapp" title="Share on WhatsApp">
                                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Related News -->
                        <?php if($relatedNews->count() > 0): ?>
                            <div class="related-news mt-5">
                                <div class="section-header mb-4">
                                    <h3>Related News & Market Updates</h3>
                                    <p class="text-muted">Stay informed with latest property insights from our experts</p>
                                </div>
                                <div class="row g-4">
                                    <?php $__currentLoopData = $relatedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="related-news-card">
                                                <div class="news-thumbnail">
                                                    <?php if($related->youtube_video_id): ?>
                                                        <a href="<?php echo e(route('news.show', $related->slug)); ?>">
                                                            <img src="https://img.youtube.com/vi/<?php echo e($related->youtube_video_id); ?>/mqdefault.jpg" 
                                                                 alt="<?php echo e($related->title); ?>">
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('news.show', $related->slug)); ?>" class="placeholder-thumbnail">
                                                            <i class="fas fa-newspaper fa-2x"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="news-info">
                                                    <span class="date"><i class="fas fa-calendar-alt me-1"></i><?php echo e($related->formatted_posted_date); ?></span>
                                                    <h5>
                                                        <a href="<?php echo e(route('news.show', $related->slug)); ?>">
                                                            <?php echo e(Str::limit($related->title, 60)); ?>

                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <aside class="news-sidebar">
                            <!-- Contact Form -->
                            <div class="contact-form-card">
                                <div class="card-header text-center mb-4">
                                    <h4><i class="fas fa-headset me-2 text-gold"></i>Free Consultation</h4>
                                    <p class="text-muted mb-0">Speak with our dedicated property advisory team</p>
                                </div>

                                <form id="lead-form" action="<?php echo e(route('contact.store')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control custom-input" id="name" name="name" placeholder="Your full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control custom-input" id="email" name="email" placeholder="example@domain.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control custom-input" id="phone" name="phone" placeholder="0300-1234567" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject *</label>
                                        <input type="text" class="form-control custom-input" id="subject" name="subject" required value="Inquiry via <?php echo e(Str::limit($news->title, 35)); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="interest" class="form-label">Interested In</label>
                                        <select class="form-select input-field" id="interest" name="interest">
                                            <option value="">Select Category</option>
                                            <option value="buying">Buying Property</option>
                                            <option value="selling">Selling Property</option>
                                            <option value="investment">Investment Portfolio</option>
                                            <option value="consultation">Market Advisory</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control custom-input" id="message" name="message" rows="3" placeholder="Tell us about your requirements..."></textarea>
                                    </div>
                                    <button type="submit" class="submit-btn w-100">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Inquiry
                                    </button>
                                </form>
                            </div>

                            <!-- Quick Contact Info -->
                            <div class="contact-info-card">
                                <h5><i class="fas fa-info-circle me-2 text-gold"></i>Direct Assistance</h5>
                                <div class="contact-item">
                                    <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                                    <div><small>Call or WhatsApp</small><a href="tel:03331929762"><strong>0333-1929762</strong></a></div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                    <div><small>Email Inquiries</small><a href="mailto:info@randhawamarketing.com"><strong>info@randhawamarketing.com</strong></a></div>
                                </div>
                                <div class="contact-item">
                                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                    <div><small>Office Hours</small><strong>Mon - Sat: 9:00 AM - 6:00 PM</strong></div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Scroll to Top Button -->
        <button class="scroll-to-top" id="scrollToTop" aria-label="Scroll to top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div><!-- /#wrapper -->

    <!-- Scripts -->
    <script src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/main.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            // Scroll to Top
            function toggleScrollToTop() {
                const scrollTop = $(window).scrollTop();
                const scrollToTopBtn = $('#scrollToTop');
                if (scrollTop > 400) {
                    scrollToTopBtn.addClass('visible');
                } else {
                    scrollToTopBtn.removeClass('visible');
                }
            }

            $(window).on('scroll', toggleScrollToTop);

            $('#scrollToTop').on('click', function() {
                $('html, body').animate({ scrollTop: 0 }, 500);
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\AR\Desktop\RM_MainSite\resources\views/news/show.blade.php ENDPATH**/ ?>