<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>{{ $blog->title }} - Real Estate Blog</title>
    <meta name="description" content="{{ strip_tags($blog->description) }}">
    <meta name="keywords" content="RealEstate, Blog, {{ $blog->category->name }}, Property News">
    <meta name="author" content="{{ $blog->author }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description" content="{{ strip_tags($blog->description) }}">
    <meta property="og:image" content="{{ $blog->featured_image ?  url('' . $blog->featured_image) :  url('images/logo/logo.png') }}">
    <meta property="og:url" content="{{ request()->fullurl() }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description" content="{{ strip_tags($blog->description) }}">
    <meta name="twitter:image" content="{{ $blog->featured_image ?  url('' . $blog->featured_image) :  url('images/logo/logo.png') }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{  url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/blog.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{  url('icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{  url('icons/favicon.svg') }}" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    

</head>

<body>
    <div id="wrapper">
        <!-- Reading Progress Bar -->
        <div class="reading-progress" id="reading-progress"></div>

        @include('layout.header')

        <!-- Blog Hero Section -->
        <!-- <section class="blog-detail-hero">
            <div class="hero-content">
                <div class="container">
                    <div class="blog-breadcrumb">
                        <nav class="breadcrumb-elegant">
                            <a href="{{ route('index') }}">Home</a> / 
                            <a href="{{ route('blog.index') }}">Blog</a> / 
                            <a href="{{ route('blog.category', $blog->category->slug) }}">{{ $blog->category->name }}</a> / 
                            <span>{{ \Str::limit($blog->title, 50) }}</span>
                        </nav>
                    </div>

                    <a href="{{ route('blog.category', $blog->category->slug) }}" 
                       class="blog-category-hero" 
                       style="background-color: {{ $blog->category->color }};">
                        <i class="icon-tag"></i>
                        {{ $blog->category->name }}
                    </a>

                    <div class="hero-meta">
                        <div class="hero-meta-item">
                            <i class="icon-calendar"></i>
                            {{ $blog->formatted_published_date }}
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-user"></i>
                            {{ $blog->author }}
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-eye"></i>
                            {{ number_format($blog->views_count) }} Views
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-clock"></i>
                            {{ $blog->reading_time }} min read
                        </div>
                        @if($blog->is_featured)
                            <div class="hero-meta-item">
                                <i class="icon-star"></i>
                                Featured Article
                            </div>
                        @endif
                    </div>

                    <h1 class="blog-hero-title"></h1>

                    <div class="blog-hero-excerpt">
                        {!! $blog->description !!}
                    </div>
                </div>
            </div>
        </section> -->
        <section class="blog-hero">
            <div class="blog-hero-content">
                <div class="container">
                    <div class="blog-breadcrumb">
                        <nav class="breadcrumb-elegant">
                            <a href="{{ route('index') }}">Home</a> / 
                            <a href="{{ route('blog.index') }}">Blog</a> / 
                            <a href="{{ route('blog.category', $blog->category->slug) }}">{{ $blog->category->name }}</a> / 
                            <span>{{ \Str::limit($blog->title, 50) }}</span>
                        </nav>
                    </div>
                    <h1>{{ $blog->title }}</h1>
                    <div class="hero-meta">
                        <div class="hero-meta-item">
                            <i class="icon-calendar"></i>
                            {{ $blog->formatted_published_date }}
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-user"></i>
                            {{ $blog->author }}
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-eye"></i>
                            {{ number_format($blog->views_count) }} Views
                        </div>
                        <div class="hero-meta-item">
                            <i class="icon-clock"></i>
                            {{ $blog->reading_time }} min read
                        </div>
                        @if($blog->is_featured)
                            <div class="hero-meta-item">
                                <i class="icon-star"></i>
                                Featured Article
                            </div>
                        @endif
                    </div>
                    <p>{!! $blog->description !!}</p>
<!--                     
                    <div class="blog-search-section">
                        <form action="{{ route('blog.index') }}" method="GET" class="blog-search-form">
                            <input type="text" name="search" placeholder="Search articles, topics, tips..." 
                                   value="{{ request('search') }}" class="blog-search-input">
                            <button type="submit" class="blog-search-btn">
                                <i class="icon-MagnifyingGlass"></i>
                            </button>
                        </form>
                    </div> -->
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
                            @if($blog->featured_image)
                                <div class="blog-featured-image">
                                    <img src="{{  url('' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                                </div>
                            @endif

                            <!-- Article Meta Bar -->
                            <div class="article-meta-bar">
                                <div class="author-section">
                                    <div class="author-avatar">
                                        {{ strtoupper(substr($blog->author, 0, 1)) }}
                                    </div>
                                    <div class="author-info">
                                        <h4>{{ $blog->author }}</h4>
                                        <p>Published {{ $blog->formatted_published_date }}</p>
                                    </div>
                                </div>
                                <div class="article-stats">
                                    <div class="stat-item">
                                        <i class="icon-eye"></i>
                                        {{ number_format($blog->views_count) }} views
                                    </div>
                                    <div class="stat-item">
                                        <i class="icon-clock"></i>
                                        {{ $blog->reading_time }} min read
                                    </div>
                                    <div class="stat-item">
                                        <i class="icon-heart"></i>
                                        {{ rand(10, 100) }} likes
                                    </div>
                                </div>
                            </div>

                            <!-- Blog Content -->
                            <div class="blog-content-wrapper">
                                <div class="blog-content">
                                    {!! $blog->content !!}
                                </div>
                            </div>

                            <!-- Footer Section -->
                            <div class="blog-footer-section">
                                <div class="blog-tags-share">
                                    <!-- Tags -->
                                    <div class="blog-tags">
                                        <span class="tags-label">Tags:</span>
                                        <a href="{{ route('blog.category', $blog->category->slug) }}" class="tag-item">
                                            {{ $blog->category->name }}
                                        </a>
                                        <a href="{{ route('blog.index') }}?search=real estate" class="tag-item">Real Estate</a>
                                        <a href="{{ route('blog.index') }}?search=property" class="tag-item">Property</a>
                                        <a href="{{ route('blog.index') }}?search=investment" class="tag-item">Investment</a>
                                    </div>

                                    <!-- Share Buttons -->
                                    <div class="share-section">
                                        <span class="share-label">Share:</span>
                                        <div class="share-buttons">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullurl()) }}" 
                                               target="_blank" class="share-btn facebook" title="Share on Facebook">
                                                <i class="icon-fb"></i>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullurl()) }}&text={{ urlencode($blog->title) }}" 
                                               target="_blank" class="share-btn twitter" title="Share on Twitter">
                                                <i class="icon-X"></i>
                                            </a>
                                            <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(request()->fullurl()) }}&title={{ urlencode($blog->title) }}" 
                                               target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                                <i class="icon-linked"></i>
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->fullurl()) }}" 
                                               target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                                <i class="icon-ins"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Related Posts -->
                        @if($relatedBlogs->count() > 0)
                            <div class="related-posts">
                                <div class="section-title">
                                    <h2>Related Articles</h2>
                                    <p>Discover more insights and expert advice on real estate</p>
                                </div>
                                <div class="row">
                                    @foreach($relatedBlogs as $related)
                                        <div class="col-md-6">
                                            <div class="related-post-card">
                                                <div class="related-post-image">
                                                    <a href="{{ route('blog.show', $related->slug) }}">
                                                        @if($related->featured_image)
                                                            <img src="{{  url('' . $related->featured_image) }}" alt="{{ $related->title }}">
                                                        @else
                                                            <img src="{{  url('images/section/agencies-1.jpg') }}" alt="{{ $related->title }}">
                                                        @endif
                                                    </a>
                                                    <div class="related-post-overlay"></div>
                                                </div>
                                                <div class="related-post-content">
                                                    <div class="related-post-meta">
                                                        {{ $related->formatted_published_date }} • {{ $related->author }} • {{ $related->reading_time }}m read
                                                    </div>
                                                    <h3 class="related-post-title">
                                                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                                    </h3>
                                                    <div class="related-post-excerpt">
                                                        {{ \Str::limit(strip_tags($related->description), 100) }}
                                                    </div>
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
                        <aside class="blog-sidebar">
                            <!-- Categories Widget -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-title">Categories</h3>
                                <ul class="category-list">
                                    @foreach($categories as $category)
                                        <li class="category-item">
                                            <a href="{{ route('blog.category', $category->slug) }}" class="category-link">
                                                <span class="category-name">{{ $category->name }}</span>
                                                <span class="category-count">{{ $category->blogs_count ?? 0 }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Recent Posts Widget -->
                            <div class="sidebar-widget">
                                <h3 class="sidebar-title">Recent Posts</h3>
                                <ul class="recent-list">
                                    @foreach($recentBlogs as $recent)
                                        <li class="recent-item">
                                            <a href="{{ route('blog.show', $recent->slug) }}" class="recent-link">
                                                <span class="recent-title">{{ \Str::limit($recent->title, 45) }}</span>
                                                <span class="recent-date">{{ $recent->views_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('layout.footer')

        <!-- Scroll to Top Button -->
        <button class="scroll-to-top" id="scrollToTop">
            <i class="icon-arrow-up"></i>
        </button>
    </div>

    <!-- Javascript -->
    <script src="{{  url('js/jquery.min.js') }}"></script>
    <script src="{{  url('js/bootstrap.min.js') }}"></script>
    <script src="{{  url('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{  url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{  url('js/swiper.js') }}"></script>
    <script src="{{  url('js/plugin.js') }}"></script>
    <script src="{{  url('js/jquery.fancybox.js') }}"></script>
    <script src="{{  url('js/main.js') }}"></script>

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
                
                if (scrollTop > 500) {
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
                }, 600);
            });

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 600);
                }
            });

            // Initialize
            updateReadingProgress();
            toggleScrollToTop();

            // Copy to clipboard for share urls
            $('.share-btn').on('click', function(e) {
                const btn = $(this);
                btn.addClass('shared');
                setTimeout(() => btn.removeClass('shared'), 1000);
            });
        });
    </script>
</body>
</html>