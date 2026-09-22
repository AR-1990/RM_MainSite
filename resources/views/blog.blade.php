<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Blog - Randhawa Marketing</title>
    <meta name="description" content="Stay updated with the latest real estate news, market trends, and property insights.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/blog.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign blog-page">
    <div id="wrapper">
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="{{ asset('/images/logo/loading.png') }}" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layout.header')

        <main class="blog-main">
            <section class="blog-intro">
                <div class="tf-container">
                    <div class="blog-intro-inner">
                        <span class="blog-kicker">Blog</span>
                        <h1 class="blog-title">
                            @isset($category)
                                {{ $category->name }}
                            @else
                                Insights &amp; updates
                            @endisset
                        </h1>
                        <p class="blog-lead">Market trends, property tips, and local updates from Randhawa Marketing.</p>
                    </div>
                </div>
            </section>

            <section class="blog-search-section">
                <div class="tf-container">
                    <form action="{{ route('blog.index') }}" method="GET" class="blog-search-shell">
                        <div class="blog-search-grid">
                            <div class="blog-field blog-field-grow">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" placeholder="Search articles…" value="{{ request('search') }}">
                            </div>
                            <div class="blog-field">
                                <label for="category">Category</label>
                                <select id="category" name="category">
                                    <option value="">All categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="blog-field blog-field-action">
                                <label class="blog-field-spacer" aria-hidden="true">&nbsp;</label>
                                <button type="submit" class="blog-search-btn">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <circle cx="11" cy="11" r="8"/>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    </svg>
                                    <span>Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section class="blog-grid-section">
                <div class="tf-container">
                    <div class="blog-layout">
                        <div class="blog-content">
                            <div class="blog-results-head">
                                <div>
                                    <span class="blog-kicker">Articles</span>
                                    <h2>{{ $blogs->total() }} posts</h2>
                                    @if(request('search'))
                                        <p>Results for “{{ request('search') }}”</p>
                                    @endif
                                </div>
                            </div>

                            <div class="blog-grid">
                                @forelse($blogs as $blog)
                                    <article class="blog-card">
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-media" aria-label="{{ $blog->title }}">
                                            <img
                                                src="{{ $blog->featured_image ? url($blog->featured_image) : asset('/images/section/agencies-1.jpg') }}"
                                                alt="{{ $blog->title }}"
                                                loading="lazy">
                                            @if($blog->is_featured)
                                                <span class="blog-featured">Featured</span>
                                            @endif
                                        </a>

                                        <div class="blog-card-body">
                                            <div class="blog-card-meta">
                                                @if($blog->category)
                                                    <a href="{{ route('blog.category', $blog->category->slug) }}" class="blog-tag">{{ $blog->category->name }}</a>
                                                @endif
                                                <span class="blog-date">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                                    </svg>
                                                    {{ $blog->formatted_published_date }}
                                                </span>
                                            </div>

                                            <h3 class="blog-card-title">
                                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h3>

                                            <p class="blog-excerpt">{{ Str::limit(strip_tags($blog->description), 120) }}</p>

                                            <div class="blog-card-foot">
                                                <span class="blog-meta-soft">{{ $blog->author }} · {{ $blog->reading_time }}m read</span>
                                                <a href="{{ route('blog.show', $blog->slug) }}" class="blog-card-cta">Read more</a>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div class="blog-empty">
                                        <span class="blog-empty-icon" aria-hidden="true">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                                <path d="M18 14h-8M15 18h-5M10 6h8v4h-8V6Z"/>
                                            </svg>
                                        </span>
                                        <h3>No blog posts found</h3>
                                        <p>{{ request('search') ? 'No posts match your search.' : 'New articles will appear here soon.' }}</p>
                                        <a href="{{ route('blog.index') }}" class="blog-card-cta">View all posts</a>
                                    </div>
                                @endforelse
                            </div>

                            @if($blogs->hasPages())
                                <div class="blog-pagination">
                                    {{ $blogs->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>

                        <aside class="blog-sidebar">
                            <div class="blog-side-panel">
                                <div class="blog-side-head">
                                    <span class="blog-kicker">Browse</span>
                                    <h2>Categories</h2>
                                </div>
                                <ul class="blog-side-list">
                                    @foreach($categories as $cat)
                                        <li>
                                            <a href="{{ route('blog.category', $cat->slug) }}">{{ $cat->name }}</a>
                                            <span>{{ $cat->blogs_count ?? 0 }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            @if(isset($featuredBlogs) && $featuredBlogs->count())
                                <div class="blog-side-panel">
                                    <div class="blog-side-head">
                                        <span class="blog-kicker">Featured</span>
                                        <h2>Highlights</h2>
                                    </div>
                                    <ul class="blog-side-list is-posts">
                                        @foreach($featuredBlogs as $item)
                                            <li>
                                                <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                                                <span>{{ $item->formatted_published_date }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif(isset($recentBlogs) && $recentBlogs->count())
                                <div class="blog-side-panel">
                                    <div class="blog-side-head">
                                        <span class="blog-kicker">Recent</span>
                                        <h2>Latest posts</h2>
                                    </div>
                                    <ul class="blog-side-list is-posts">
                                        @foreach($recentBlogs as $item)
                                            <li>
                                                <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                                                <span>{{ $item->formatted_published_date }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </aside>
                    </div>
                </div>
            </section>
        </main>

        @include('layout.footer')
    </div>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
