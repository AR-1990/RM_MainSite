<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>{{ $property->title }} - Randhawa Marketing</title>
    <meta name="description" content="Property details for {{ $property->title }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/property-detail.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign property-detail-page">
    @php
        $similarProperties = \App\Models\Property::where('property_category_id', $property->property_category_id)
            ->where('id', '!=', $property->id)
            ->where('is_active', true)
            ->where('is_deactivated', false)
            ->limit(3)
            ->get();
    @endphp

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

        <main class="pd-main">
            <section class="pd-intro">
                <div class="tf-container">
                    <div class="pd-intro-top">
                        <a href="{{ route('properties.index') }}" class="pd-back">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="19" y1="12" x2="5" y2="12"/>
                                <polyline points="12 19 5 12 12 5"/>
                            </svg>
                            Back to properties
                        </a>
                        <div class="pd-badges">
                            <span class="pd-badge {{ $property->is_sold ? 'is-sold' : '' }}">
                                {{ $property->is_sold ? 'Sold' : ucfirst(str_replace('_', ' ', $property->property_status)) }}
                            </span>
                            @if($property->category)
                                <span class="pd-badge is-soft">{{ $property->category->name }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="pd-intro-inner">
                        <span class="pd-kicker">Property</span>
                        <h1 class="pd-title">{{ $property->title }}</h1>
                        <p class="pd-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>{{ $property->full_address }}{{ $property->city ? ', ' . $property->city : '' }}</span>
                        </p>
                        <p class="pd-price">{{ $property->display_price }}</p>
                    </div>
                </div>
            </section>

            <section class="pd-body-section">
                <div class="tf-container">
                    <div class="pd-layout">
                        <div class="pd-content">
                            <div class="pd-gallery">
                                <div class="pd-gallery-main">
                                    <img
                                        id="pd-main-image"
                                        src="{{ $property->primary_image ? url($property->primary_image) : asset('/images/section/box-house.jpg') }}"
                                        alt="{{ $property->title }}">
                                </div>
                                @if($property->images->count() > 0)
                                    <div class="pd-thumbs">
                                        @if($property->primary_image)
                                            <button type="button" class="pd-thumb is-active" data-src="{{ url($property->primary_image) }}">
                                                <img src="{{ url($property->primary_image) }}" alt="">
                                            </button>
                                        @endif
                                        @foreach($property->images as $image)
                                            <button type="button" class="pd-thumb" data-src="{{ url($image->image_path) }}">
                                                <img src="{{ url($image->image_path) }}" alt="">
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <ul class="pd-features">
                                @if($property->bedrooms > 0)
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                            <path d="M3 21h18"/>
                                            <path d="M7 11h2M15 11h2"/>
                                        </svg>
                                        <span>{{ $property->bedrooms }} bedrooms</span>
                                    </li>
                                @endif
                                @if($property->bathrooms > 0)
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                            <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                        </svg>
                                        <span>{{ $property->bathrooms }} bathrooms</span>
                                    </li>
                                @endif
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <path d="M3 9h18M9 21V9"/>
                                    </svg>
                                    <span>{{ $property->display_size }} {{ $property->size_prefix }}</span>
                                </li>
                                @if($property->garages)
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <rect x="3" y="11" width="18" height="10" rx="1"/>
                                            <path d="M3 11V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v4"/>
                                        </svg>
                                        <span>{{ $property->garages }} parking</span>
                                    </li>
                                @endif
                            </ul>

                            <div class="pd-panel">
                                <div class="pd-panel-head">
                                    <span class="pd-kicker">Overview</span>
                                    <h2>Description</h2>
                                </div>
                                <p class="pd-copy">{{ $property->description ?: 'No description available for this property.' }}</p>
                            </div>

                            <div class="pd-panel">
                                <div class="pd-panel-head">
                                    <span class="pd-kicker">Specs</span>
                                    <h2>Property details</h2>
                                </div>
                                <dl class="pd-specs">
                                    @if($property->bedrooms > 0)
                                        <div><dt>Bedrooms</dt><dd>{{ $property->bedrooms }}</dd></div>
                                    @endif
                                    @if($property->bathrooms > 0)
                                        <div><dt>Bathrooms</dt><dd>{{ $property->bathrooms }}</dd></div>
                                    @endif
                                    @if($property->rooms > 0)
                                        <div><dt>Total rooms</dt><dd>{{ $property->rooms }}</dd></div>
                                    @endif
                                    @if($property->garages > 0)
                                        <div><dt>Parking</dt><dd>{{ $property->garages }}</dd></div>
                                    @endif
                                    <div><dt>Size</dt><dd>{{ $property->display_size }} {{ $property->size_prefix }}</dd></div>
                                    @if($property->furnished_status !== 'N/A')
                                        <div><dt>Furnished</dt><dd>{{ $property->furnished_status }}</dd></div>
                                    @endif
                                    <div><dt>1 Marla value</dt><dd>{{ $property->marla_value }}</dd></div>
                                    <div><dt>Status</dt><dd>{{ ucfirst(str_replace('_', ' ', $property->property_status)) }}</dd></div>
                                </dl>
                            </div>

                            @if($property->amenities->count() > 0)
                                <div class="pd-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">Included</span>
                                        <h2>Amenities</h2>
                                    </div>
                                    <ul class="pd-amenities">
                                        @foreach($property->amenities as $amenity)
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                                <span>{{ $amenity->amenity_name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($property->floors->count() > 0)
                                <div class="pd-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">Layout</span>
                                        <h2>Floor details</h2>
                                    </div>
                                    <div class="pd-floors">
                                        @foreach($property->floors as $floor)
                                            <article class="pd-floor">
                                                <div class="pd-floor-top">
                                                    <h3>{{ $floor->floor_name }}</h3>
                                                    <span>{{ $floor->price_prefix }} {{ number_format($floor->floor_price) }}</span>
                                                </div>
                                                <ul class="pd-floor-meta">
                                                    <li>{{ $floor->floor_size }} {{ $floor->size_postfix }}</li>
                                                    <li>{{ $floor->bedrooms }} beds</li>
                                                    <li>{{ $floor->bathrooms }} baths</li>
                                                </ul>
                                                @if($floor->description)
                                                    <p>{{ $floor->description }}</p>
                                                @endif
                                                @if($floor->floor_image)
                                                    <img src="{{ url($floor->floor_image) }}" alt="{{ $floor->floor_name }}" class="pd-floor-image">
                                                @endif
                                            </article>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <aside class="pd-sidebar">
                            <div class="pd-side-panel">
                                <div class="pd-panel-head">
                                    <span class="pd-kicker">Contact</span>
                                    <h2>Ask about this home</h2>
                                    <p>Share your details and we’ll respond shortly.</p>
                                </div>

                                <div class="pd-agent">
                                    <div class="pd-agent-avatar">
                                        <img src="{{ asset('/images/avatar/account.jpg') }}" alt="">
                                    </div>
                                    <div>
                                        <strong>{{ $property->user->name ?? 'Property agent' }}</strong>
                                        <span>Real estate agent</span>
                                    </div>
                                </div>

                                <ul class="pd-contact-list">
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                        <a href="tel:{{ preg_replace('/\s+/', '', $property->user->phone ?? '03331929762') }}">{{ $property->user->phone ?? '0333-1929762' }}</a>
                                    </li>
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                        <a href="mailto:{{ $property->user->email ?? 'info@randhawamarketing.com' }}">{{ $property->user->email ?? 'info@randhawamarketing.com' }}</a>
                                    </li>
                                </ul>

                                <form action="{{ route('contact.store') }}" method="POST" class="pd-form">
                                    @csrf
                                    <input type="hidden" name="source" value="property_detail">
                                    <input type="hidden" name="subject" value="Inquiry: {{ $property->title }}">
                                    <div class="pd-field">
                                        <label for="pd-name">Full name</label>
                                        <input id="pd-name" type="text" name="name" required>
                                    </div>
                                    <div class="pd-field">
                                        <label for="pd-email">Email</label>
                                        <input id="pd-email" type="email" name="email" required>
                                    </div>
                                    <div class="pd-field">
                                        <label for="pd-phone">Phone</label>
                                        <input id="pd-phone" type="tel" name="phone">
                                    </div>
                                    <div class="pd-field">
                                        <label for="pd-message">Message</label>
                                        <textarea id="pd-message" name="message" rows="4" placeholder="I’m interested in this property…"></textarea>
                                    </div>
                                    <button type="submit" class="pd-submit">Send message</button>
                                </form>
                            </div>

                            @if($similarProperties->count())
                                <div class="pd-side-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">More</span>
                                        <h2>Similar properties</h2>
                                    </div>
                                    <ul class="pd-similar">
                                        @foreach($similarProperties as $similar)
                                            <li>
                                                <a href="{{ route('properties.show', $similar->id) }}" class="pd-similar-card">
                                                    <img src="{{ $similar->primary_image ? url($similar->primary_image) : asset('/images/section/box-house.jpg') }}" alt="{{ $similar->title }}">
                                                    <div>
                                                        <strong>{{ $similar->title }}</strong>
                                                        <span>{{ $similar->display_price }}</span>
                                                        <em>{{ $similar->city }}</em>
                                                    </div>
                                                </a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var main = document.getElementById('pd-main-image');
            var thumbs = document.querySelectorAll('.pd-thumb');
            if (!main || !thumbs.length) return;
            thumbs.forEach(function (thumb) {
                thumb.addEventListener('click', function () {
                    main.src = thumb.getAttribute('data-src');
                    thumbs.forEach(function (t) { t.classList.remove('is-active'); });
                    thumb.classList.add('is-active');
                });
            });
        });
    </script>
</body>
</html>
