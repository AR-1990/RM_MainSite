<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Properties - Randhawa Marketing</title>
    <meta name="description" content="Search and find your perfect property from our extensive collection">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/properties.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign properties-page">
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

        <main class="properties-main">
            <section class="properties-intro">
                <div class="tf-container">
                    <div class="properties-intro-inner">
                        <span class="properties-kicker">Properties</span>
                        <h1 class="properties-title">Find your next property</h1>
                        <p class="properties-lead">Browse homes for sale and rent with clear filters, pricing, and details.</p>
                    </div>
                </div>
            </section>

            <section class="properties-search-section">
                <div class="tf-container">
                    <form action="{{ route('properties.index') }}" method="GET" id="main-search-form" class="properties-search-shell">
                        <div class="properties-search-grid">
                            <div class="properties-field">
                                <label for="search-status">Status</label>
                                <select name="status" id="search-status">
                                    <option value="for_sale" {{ request('status', 'for_sale') == 'for_sale' ? 'selected' : '' }}>For sale</option>
                                    <option value="for_rent" {{ request('status') == 'for_rent' ? 'selected' : '' }}>For rent</option>
                                </select>
                            </div>
                            <div class="properties-field properties-field-grow">
                                <label for="search">Location</label>
                                <input type="text" id="search" name="search" placeholder="Place, neighborhood, city…" value="{{ request('search') }}">
                            </div>
                            <div class="properties-field properties-field-action">
                                <label class="properties-field-spacer" aria-hidden="true">&nbsp;</label>
                                <button type="submit" class="properties-search-btn">
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

            <section class="properties-grid-section">
                <div class="tf-container">
                    <div class="properties-layout">
                        <aside class="properties-filters">
                            <form action="{{ route('properties.index') }}" method="GET" id="filter-form" class="properties-filter-shell">
                                <div class="properties-filter-head">
                                    <span class="properties-kicker">Filters</span>
                                    <h2>Refine results</h2>
                                    <p>{{ $properties->total() }} properties found</p>
                                </div>

                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <input type="hidden" name="status" value="{{ request('status', 'for_sale') }}">

                                <div class="properties-filter-group">
                                    <h3>Property type</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }}>
                                            <span>All types</span>
                                        </label>
                                        @foreach($categories as $category)
                                            <label class="properties-check">
                                                <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Price range (PKR)</h3>
                                    <div class="properties-price-row">
                                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                                        <span>to</span>
                                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Bedrooms</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="bedrooms" value="" {{ !request('bedrooms') ? 'checked' : '' }}>
                                            <span>Any</span>
                                        </label>
                                        @for($i = 1; $i <= 5; $i++)
                                            <label class="properties-check">
                                                <input type="radio" name="bedrooms" value="{{ $i }}" {{ request('bedrooms') == $i ? 'checked' : '' }}>
                                                <span>{{ $i }}+</span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Bathrooms</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="bathrooms" value="" {{ !request('bathrooms') ? 'checked' : '' }}>
                                            <span>Any</span>
                                        </label>
                                        @for($i = 1; $i <= 4; $i++)
                                            <label class="properties-check">
                                                <input type="radio" name="bathrooms" value="{{ $i }}" {{ request('bathrooms') == $i ? 'checked' : '' }}>
                                                <span>{{ $i }}+</span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>City</h3>
                                    <input type="text" name="city" placeholder="Enter city…" value="{{ request('city') }}" class="properties-filter-input">
                                </div>

                                @php
                                    $amenities = \App\Models\PropertyAmenity::select('amenity_name')
                                        ->distinct()
                                        ->pluck('amenity_name')
                                        ->filter()
                                        ->take(8);
                                @endphp
                                @if($amenities->count() > 0)
                                    <div class="properties-filter-group">
                                        <h3>Amenities</h3>
                                        <div class="properties-filter-options">
                                            @foreach($amenities as $amenity)
                                                <label class="properties-check">
                                                    <input type="checkbox" name="amenities[]" value="{{ $amenity }}" {{ in_array($amenity, (array) request('amenities', [])) ? 'checked' : '' }}>
                                                    <span>{{ $amenity }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="properties-filter-actions">
                                    <button type="submit" class="properties-search-btn properties-btn-block">Apply filters</button>
                                    <a href="{{ route('properties.index') }}" class="properties-btn-ghost">Clear all</a>
                                </div>
                            </form>
                        </aside>

                        <div class="properties-content">
                            <div class="properties-results-head">
                                <div>
                                    <span class="properties-kicker">Listings</span>
                                    <h2>{{ $properties->total() }} properties found</h2>
                                    @if(request('search'))
                                        <p>Results for “{{ request('search') }}”</p>
                                    @endif
                                </div>
                                <div class="properties-field properties-sort">
                                    <label for="sort">Sort</label>
                                    <select name="sort" id="sort" form="filter-form" onchange="document.getElementById('filter-form').submit()">
                                        <option value="">Default</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: low to high</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: high to low</option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest first</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest first</option>
                                    </select>
                                </div>
                            </div>

                            <div class="properties-grid">
                                @forelse($properties as $property)
                                    <article class="property-card">
                                        <a href="{{ route('properties.show', $property->id) }}" class="property-card-media" aria-label="{{ $property->title }}">
                                            <img
                                                src="{{ $property->primary_image ? url($property->primary_image) : asset('/images/section/box-house.jpg') }}"
                                                alt="{{ $property->title }}"
                                                loading="lazy">
                                            <span class="property-status {{ $property->is_sold ? 'is-sold' : '' }}">
                                                {{ $property->is_sold ? 'Sold' : ucfirst(str_replace('_', ' ', $property->property_status)) }}
                                            </span>
                                        </a>

                                        <div class="property-card-body">
                                            <h3 class="property-card-title">
                                                <a href="{{ route('properties.show', $property->id) }}">{{ $property->title }}</a>
                                            </h3>

                                            <p class="property-location">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                                    <circle cx="12" cy="10" r="3"/>
                                                </svg>
                                                <span>{{ $property->city }}{{ $property->full_address ? ', ' . $property->full_address : '' }}</span>
                                            </p>

                                            <ul class="property-meta">
                                                @if($property->bedrooms > 0)
                                                    <li>
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                                            <path d="M3 21h18"/>
                                                            <path d="M7 11h2M15 11h2"/>
                                                        </svg>
                                                        <span>{{ $property->bedrooms }} beds</span>
                                                    </li>
                                                @endif
                                                @if($property->bathrooms > 0)
                                                    <li>
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                                            <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                                        </svg>
                                                        <span>{{ $property->bathrooms }} baths</span>
                                                    </li>
                                                @endif
                                                <li>
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                        <path d="M3 9h18M9 21V9"/>
                                                    </svg>
                                                    <span>{{ $property->display_size }} {{ $property->size_prefix }}</span>
                                                </li>
                                            </ul>

                                            <div class="property-card-foot">
                                                <span class="property-price">{{ $property->display_price }}</span>
                                                <a href="{{ route('properties.show', $property->id) }}" class="property-card-cta">Details</a>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <div class="properties-empty">
                                        <span class="properties-empty-icon" aria-hidden="true">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8"/>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                            </svg>
                                        </span>
                                        <h3>No properties found</h3>
                                        <p>Try adjusting your search or filters to see more listings.</p>
                                        <a href="{{ route('properties.index') }}" class="property-card-cta">View all properties</a>
                                    </div>
                                @endforelse
                            </div>

                            @if($properties->hasPages())
                                <div class="properties-pagination">
                                    {{ $properties->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var filterForm = document.getElementById('filter-form');
            if (!filterForm) return;
            filterForm.querySelectorAll('input[type="radio"]').forEach(function (input) {
                input.addEventListener('change', function () {
                    setTimeout(function () { filterForm.submit(); }, 80);
                });
            });
        });
    </script>
</body>
</html>
