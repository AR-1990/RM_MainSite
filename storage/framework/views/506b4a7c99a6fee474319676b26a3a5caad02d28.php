<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title><?php echo e($blog->title); ?> - Real Estate Blog | Randhawa Marketing</title>
    <meta name="description" content="<?php echo e(strip_tags($blog->description)); ?>">
    <meta name="keywords" content="RealEstate, Blog, <?php echo e($blog->category->name ?? 'Real Estate'); ?>, Property News">
    <meta name="author" content="<?php echo e($blog->author); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo e($blog->title); ?>">
    <meta property="og:description" content="<?php echo e(strip_tags($blog->description)); ?>">
    <meta property="og:image" content="<?php echo e($blog->featured_image ? url('' . $blog->featured_image) : url('images/logo/logo.png')); ?>">
    <meta property="og:url" content="<?php echo e(request()->fullurl()); ?>">
    <meta property="og:type" content="article">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($blog->title); ?>">
    <meta name="twitter:description" content="<?php echo e(strip_tags($blog->description)); ?>">
    <meta name="twitter:image" content="<?php echo e($blog->featured_image ? url('' . $blog->featured_image) : url('images/logo/logo.png')); ?>">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/blog.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('icons/icomoon/style.css')); ?>" />
    <link rel="shortcut icon" href="<?php echo e(url('icons/favicon.svg')); ?>" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="popup-loader blog-detail-page">
    <div id="wrapper">
        <!-- Reading Progress Bar -->
        <div class="reading-progress" id="reading-progress"></div>

        <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Blog Hero Section -->
        <section class="blog-hero">
            <div class="blog-hero-content">
                <div class="container">
                    <div class="blog-breadcrumb">
                        <nav class="breadcrumb-elegant">
                            <a href="<?php echo e(route('index')); ?>"><i class="fas fa-home me-1"></i>Home</a>
                            <span class="bc-sep">/</span>
                            <a href="<?php echo e(route('blog.index')); ?>">Blog</a>
                            <?php if($blog->category): ?>
                                <span class="bc-sep">/</span>
                                <a href="<?php echo e(route('blog.category', $blog->category->slug)); ?>"><?php echo e($blog->category->name); ?></a>
                            <?php endif; ?>
                            <span class="bc-sep">/</span>
                            <span class="bc-current"><?php echo e(\Str::limit($blog->title, 45)); ?></span>
                        </nav>
                    </div>

                    <?php if($blog->category): ?>
                        <a href="<?php echo e(route('blog.category', $blog->category->slug)); ?>" class="blog-hero-category">
                            <i class="fas fa-tag me-1"></i> <?php echo e($blog->category->name); ?>

                        </a>
                    <?php endif; ?>

                    <h1 class="blog-hero-title"><?php echo e($blog->title); ?></h1>

                    <div class="hero-meta">
                        <div class="hero-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span><?php echo e($blog->formatted_published_date); ?></span>
                        </div>
                        <div class="hero-meta-item">
                            <i class="fas fa-user-circle"></i>
                            <span><?php echo e($blog->author); ?></span>
                        </div>
                        <div class="hero-meta-item">
                            <i class="fas fa-eye"></i>
                            <span><?php echo e(number_format($blog->views_count)); ?> Views</span>
                        </div>
                        <div class="hero-meta-item">
                            <i class="fas fa-clock"></i>
                            <span><?php echo e($blog->reading_time); ?> min read</span>
                        </div>
                        <?php if($blog->is_featured): ?>
                            <div class="hero-meta-item featured-badge">
                                <i class="fas fa-star"></i>
                                <span>Featured</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if($blog->description): ?>
                        <p class="blog-hero-lead"><?php echo strip_tags($blog->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="blog-detail-content">
            <div class="container">
                <div class="row">
                    <!-- Article Content -->
                    <div class="col-lg-8">
                        <article class="blog-article">
                            <!-- Featured Image -->
                            <?php if($blog->featured_image): ?>
                                <div class="blog-featured-image">
                                    <img src="<?php echo e(url('' . $blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>">
                                </div>
                            <?php endif; ?>

                            <!-- Article Meta Bar -->
                            <div class="article-meta-bar">
                                <div class="author-section">
                                    <div class="author-avatar">
                                        <?php echo e(strtoupper(substr($blog->author, 0, 1))); ?>

                                    </div>
                                    <div class="author-info">
                                        <h4><?php echo e($blog->author); ?></h4>
                                        <p>Published on <?php echo e($blog->formatted_published_date); ?></p>
                                    </div>
                                </div>
                                <div class="article-stats">
                                    <div class="stat-item">
                                        <i class="fas fa-eye"></i>
                                        <span><?php echo e(number_format($blog->views_count)); ?> views</span>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo e($blog->reading_time); ?>m read</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog Content -->
                            <div class="blog-content-wrapper">
                                <div class="blog-content">
                                    <?php echo $blog->content; ?>

                                </div>
                            </div>

                            <!-- Footer Section -->
                            <div class="blog-footer-section">
                                <div class="blog-tags-share">
                                    <!-- Tags -->
                                    <div class="blog-tags">
                                        <span class="tags-label"><i class="fas fa-tags me-1"></i>Tags:</span>
                                        <?php if($blog->category): ?>
                                            <a href="<?php echo e(route('blog.category', $blog->category->slug)); ?>" class="tag-item">
                                                <?php echo e($blog->category->name); ?>

                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('blog.index')); ?>?search=real+estate" class="tag-item">Real Estate</a>
                                        <a href="<?php echo e(route('blog.index')); ?>?search=property" class="tag-item">Property</a>
                                        <a href="<?php echo e(route('blog.index')); ?>?search=investment" class="tag-item">Investment</a>
                                    </div>

                                    <!-- Share Buttons -->
                                    <div class="share-section">
                                        <span class="share-label">Share:</span>
                                        <div class="share-buttons">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullurl())); ?>" 
                                               target="_blank" class="share-btn facebook" title="Share on Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->fullurl())); ?>&text=<?php echo e(urlencode($blog->title)); ?>" 
                                               target="_blank" class="share-btn twitter" title="Share on Twitter / X">
                                                <i class="fab fa-x-twitter"></i>
                                            </a>
                                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo e(urlencode(request()->fullurl())); ?>&title=<?php echo e(urlencode($blog->title)); ?>" 
                                               target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                            <a href="https://wa.me/?text=<?php echo e(urlencode($blog->title . ' ' . request()->fullurl())); ?>" 
                                               target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Related Posts -->
                        <?php if($relatedBlogs->count() > 0): ?>
                            <div class="related-posts">
                                <div class="section-title">
                                    <h2>Related Articles</h2>
                                    <p>Discover more insights and expert guidance on real estate in Pakistan</p>
                                </div>
                                <div class="row g-4">
                                    <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="related-post-card">
                                                <div class="related-post-image">
                                                    <a href="<?php echo e(route('blog.show', $related->slug)); ?>">
                                                        <?php if($related->featured_image): ?>
                                                            <img src="<?php echo e(url('' . $related->featured_image)); ?>" alt="<?php echo e($related->title); ?>">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(url('images/section/agencies-1.jpg')); ?>" alt="<?php echo e($related->title); ?>">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="related-post-content">
                                                    <div class="related-post-meta">
                                                        <span><i class="fas fa-calendar-alt me-1"></i><?php echo e($related->formatted_published_date); ?></span>
                                                        <span>•</span>
                                                        <span><i class="fas fa-clock me-1"></i><?php echo e($related->reading_time); ?>m read</span>
                                                    </div>
                                                    <h3 class="related-post-title">
                                                        <a href="<?php echo e(route('blog.show', $related->slug)); ?>"><?php echo e($related->title); ?></a>
                                                    </h3>
                                                    <div class="related-post-excerpt">
                                                        <?php echo e(\Str::limit(strip_tags($related->description), 100)); ?>

                                                    </div>
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
                        <aside class="blog-sidebar">
                            <!-- Categories Widget -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-title">Categories</h3>
                                <ul class="category-list">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="category-item">
                                            <a href="<?php echo e(route('blog.category', $category->slug)); ?>" class="category-link">
                                                <span class="category-name"><i class="fas fa-folder me-2 text-muted"></i><?php echo e($category->name); ?></span>
                                                <span class="category-count"><?php echo e($category->blogs_count ?? 0); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                            <!-- Recent Posts Widget -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-title">Recent Articles</h3>
                                <ul class="recent-list">
                                    <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="recent-item">
                                            <a href="<?php echo e(route('blog.show', $recent->slug)); ?>" class="recent-link">
                                                <span class="recent-title"><?php echo e(\Str::limit($recent->title, 55)); ?></span>
                                                <span class="recent-date">
                                                    <i class="fas fa-calendar-alt me-1"></i><?php echo e($recent->formatted_published_date); ?>

                                                </span>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                            <!-- Consultation Widget -->
                            <div class="sidebar-cta">
                                <div class="cta-icon"><i class="fas fa-headset"></i></div>
                                <h4>Expert Consultation</h4>
                                <p>Looking for verified property investment advice in Pakistan? Connect with our seasoned consultants today.</p>
                                <a href="tel:03331929762" class="btn-gold"><i class="fas fa-phone-alt me-2"></i>0333-1929762</a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Scroll to Top Button -->
        <button class="scroll-to-top" id="scrollToTop" aria-label="Scroll to top">
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>

    <!-- Javascript -->
    <script src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/jquery.nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('js/swiper.js')); ?>"></script>
    <script src="<?php echo e(url('js/plugin.js')); ?>"></script>
    <script src="<?php echo e(url('js/jquery.fancybox.js')); ?>"></script>
    <script src="<?php echo e(url('js/main.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            // Reading Progress Bar
            function updateReadingProgress() {
                const article = $('.blog-content-wrapper');
                if (article.length) {
                    const articleTop = article.offset().top;
                    const articleHeight = article.outerHeight();
                    const windowTop = $(window).scrollTop();
                    const windowHeight = $(window).height();
                    
                    const progress = Math.max(0, Math.min(100, 
                        ((windowTop + windowHeight - articleTop) / articleHeight) * 100
                    ));
                    
                    $('#reading-progress').css('width', progress + '%');
                }
            }

            // Scroll to Top Button
            function toggleScrollToTop() {
                const scrollTop = $(window).scrollTop();
                const scrollToTopBtn = $('#scrollToTop');
                
                if (scrollTop > 400) {
                    scrollToTopBtn.addClass('visible');
                } else {
                    scrollToTopBtn.removeClass('visible');
                }
            }

            // Event Listeners
            $(window).on('scroll', function() {
                updateReadingProgress();
                toggleScrollToTop();
            });

            $('#scrollToTop').on('click', function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            });

            // Initialize
            updateReadingProgress();
            toggleScrollToTop();
        });
    </script>
</body>
</html><?php /**PATH /Users/mac/Documents/GitHub/RM_MainSite/resources/views/blog-detail.blade.php ENDPATH**/ ?>