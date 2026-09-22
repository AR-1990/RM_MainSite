<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Latest News - Randhawa Marketing</title>
    <meta name="description" content="Stay updated with the latest real estate insights and market trends from Randhawa Marketing.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/news.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign news-page">
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

        <main class="news-main">
            <section class="news-intro">
                <div class="tf-container">
                    <div class="news-intro-inner">
                        <span class="news-kicker">News</span>
                        <h1 class="news-title">Latest news & updates</h1>
                        <p class="news-lead">Real estate insights, market trends, and local updates from Randhawa Marketing.</p>
                    </div>
                </div>
            </section>

            <section class="news-search-section">
                <div class="tf-container">
                    <form action="{{ route('news.index') }}" method="GET" class="news-search-shell">
                        <div class="news-search-grid">
                            <div class="news-field news-field-grow">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" placeholder="Search news articles…" value="{{ request('search') }}">
                            </div>
                            <div class="news-field">
                                <label for="category">Filter</label>
                                <select id="category" name="category">
                                    <option value="">All articles</option>
                                    <option value="featured" {{ request('category') == 'featured' ? 'selected' : '' }}>Featured</option>
                                </select>
                            </div>
                            <div class="news-field news-field-action">
                                <label class="news-field-spacer" aria-hidden="true">&nbsp;</label>
                                <button type="submit" class="news-search-btn">
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

            <section class="news-grid-section">
                <div class="tf-container">
                    <div class="news-layout">
                        <div class="news-content">
                            <div class="news-results-head">
                                <div>
                                    <span class="news-kicker">Articles</span>
                                    <h2>{{ $news->total() }} articles</h2>
                                    @if(request('search'))
                                        <p>Results for “{{ request('search') }}”</p>
                                    @endif
                                </div>
                            </div>

                            <div class="news-list">
                                @forelse($news as $article)
                                    <article class="news-card">
                                        <a href="{{ route('news.show', $article->slug) }}" class="news-card-media" aria-label="{{ $article->title }}">
                                            @if($article->youtube_video_id)
                                                <img src="https://img.youtube.com/vi/{{ $article->youtube_video_id }}/hqdefault.jpg" alt="{{ $article->title }}" loading="lazy">
                                                <span class="news-play" aria-hidden="true">
                                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M8 5v14l11-7z"/>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="news-media-fallback" aria-hidden="true">
                                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                                        <path d="M18 14h-8M15 18h-5M10 6h8v4h-8V6Z"/>
                                                    </svg>
                                                </span>
                                            @endif
                                        </a>

                                        <div class="news-card-body">
                                            <div class="news-card-meta">
                                                <span class="news-tag">{{ $article->featured ? 'Featured' : 'News' }}</span>
                                                <span class="news-date">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                                    </svg>
                                                    {{ $article->formatted_posted_date }}
                                                </span>
                                            </div>

                                            <h3 class="news-card-title">
                                                <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                            </h3>

                                            <p class="news-excerpt">{{ Str::limit(strip_tags($article->content), 150) }}</p>

                                            <div class="news-card-actions">
                                                <a href="{{ route('news.show', $article->slug) }}" class="news-card-cta">Read more</a>
                                                @if($article->youtube_link)
                                                    <a href="{{ $article->youtube_link }}" target="_blank" rel="noopener" class="news-card-link">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <polygon points="5 3 19 12 5 21 5 3"/>
                                                        </svg>
                                                        Watch video
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div class="news-empty">
                                        <span class="news-empty-icon" aria-hidden="true">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                                <path d="M18 14h-8M15 18h-5M10 6h8v4h-8V6Z"/>
                                            </svg>
                                        </span>
                                        <h3>No news articles found</h3>
                                        <p>Check back later for the latest updates.</p>
                                        <a href="{{ route('news.index') }}" class="news-card-cta">View all news</a>
                                    </div>
                                @endforelse
                            </div>

                            @if($news->hasPages())
                                <div class="news-pagination">
                                    {{ $news->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>

                        <aside class="news-sidebar">
                            @if(isset($featuredNews) && $featuredNews->count())
                                <div class="news-side-panel">
                                    <div class="news-side-head">
                                        <span class="news-kicker">Featured</span>
                                        <h2>Highlights</h2>
                                    </div>
                                    <ul class="news-side-list">
                                        @foreach($featuredNews as $item)
                                            <li>
                                                <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                                                <span>{{ $item->formatted_posted_date }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="news-side-panel">
                                <div class="news-side-head">
                                    <span class="news-kicker">Contact</span>
                                    <h2>Free consultation</h2>
                                    <p>Share your details and we’ll respond within 24 hours.</p>
                                </div>

                                <form id="lead-form" action="{{ route('contact.store') }}" method="POST" class="news-lead-form">
                                    @csrf
                                    <input type="hidden" name="source" value="news_page">
                                    <div class="news-field">
                                        <label for="name">Full name</label>
                                        <input type="text" id="name" name="name" required>
                                    </div>
                                    <div class="news-field">
                                        <label for="email">Email address</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    <div class="news-field">
                                        <label for="phone">Phone number</label>
                                        <input type="tel" id="phone" name="phone">
                                    </div>
                                    <div class="news-field">
                                        <label for="subject">Subject</label>
                                        <input type="text" id="subject" name="subject" required placeholder="What is this about?">
                                    </div>
                                    <div class="news-field">
                                        <label for="interest">I'm interested in</label>
                                        <select id="interest" name="interest">
                                            <option value="">Select your interest</option>
                                            <option value="buying">Buying property</option>
                                            <option value="selling">Selling property</option>
                                            <option value="renting">Renting property</option>
                                            <option value="investment">Investment</option>
                                            <option value="consultation">General consultation</option>
                                        </select>
                                    </div>
                                    <div class="news-field">
                                        <label for="message">Message</label>
                                        <textarea id="message" name="message" rows="4" placeholder="Tell us about your requirements…"></textarea>
                                    </div>
                                    <button type="submit" class="news-search-btn news-btn-block">Send message</button>
                                </form>
                            </div>

                            <div class="news-side-panel news-quick-contact">
                                <div class="news-side-head">
                                    <span class="news-kicker">Reach us</span>
                                    <h2>Quick contact</h2>
                                </div>
                                <ul class="news-contact-list">
                                    <li>
                                        <span class="news-contact-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <span>Phone</span>
                                            <a href="tel:03331929762">0333-1929762</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="news-contact-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                                <polyline points="22,6 12,13 2,6"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <span>Email</span>
                                            <a href="mailto:info@randhawamarketing.com">info@randhawamarketing.com</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="news-contact-icon" aria-hidden="true">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <polyline points="12 6 12 12 16 14"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <span>Working hours</span>
                                            <strong>Mon – Fri, 9 AM – 6 PM</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </section>
        </main>

        @include('layout.footer')
    </div>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
