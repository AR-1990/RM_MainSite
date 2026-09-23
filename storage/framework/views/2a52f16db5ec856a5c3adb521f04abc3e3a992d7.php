<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Properties - Randhawa Marketing</title>
    <meta name="description" content="Search and find your perfect property from our extensive collection">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/swiper-bundle.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/hero-redesign.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer-modern.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/properties.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/icons/icomoon/style.css')); ?>" />
    <link rel="shortcut icon" href="<?php echo e(asset('/icons/favicon.svg')); ?>" />
</head>

<body class="popup-loader home-hero-redesign properties-page">
    <div id="wrapper">
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="<?php echo e(asset('/images/logo/loading.png')); ?>" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                    <form action="<?php echo e(route('properties.index')); ?>" method="GET" id="main-search-form" class="properties-search-shell">
                        <div class="properties-search-grid">
                            <div class="properties-field">
                                <label for="search-status">Status</label>
                                <select name="status" id="search-status">
                                    <option value="for_sale" <?php echo e(request('status', 'for_sale') == 'for_sale' ? 'selected' : ''); ?>>For sale</option>
                                    <option value="for_rent" <?php echo e(request('status') == 'for_rent' ? 'selected' : ''); ?>>For rent</option>
                                </select>
                            </div>
                            <div class="properties-field properties-field-grow">
                                <label for="search">Location</label>
                                <input type="text" id="search" name="search" placeholder="Place, neighborhood, city…" value="<?php echo e(request('search')); ?>">
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
                            <form action="<?php echo e(route('properties.index')); ?>" method="GET" id="filter-form" class="properties-filter-shell">
                                <div class="properties-filter-head">
                                    <span class="properties-kicker">Filters</span>
                                    <h2>Refine results</h2>
                                    <p><?php echo e($properties->total()); ?> properties found</p>
                                </div>

                                <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                                <input type="hidden" name="status" value="<?php echo e(request('status', 'for_sale')); ?>">

                                <div class="properties-filter-group">
                                    <h3>Property type</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="category" value="" <?php echo e(!request('category') ? 'checked' : ''); ?>>
                                            <span>All types</span>
                                        </label>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="properties-check">
                                                <input type="radio" name="category" value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'checked' : ''); ?>>
                                                <span><?php echo e($category->name); ?></span>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Price range (PKR)</h3>
                                    <div class="properties-price-row">
                                        <input type="number" name="min_price" placeholder="Min" value="<?php echo e(request('min_price')); ?>">
                                        <span>to</span>
                                        <input type="number" name="max_price" placeholder="Max" value="<?php echo e(request('max_price')); ?>">
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Bedrooms</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="bedrooms" value="" <?php echo e(!request('bedrooms') ? 'checked' : ''); ?>>
                                            <span>Any</span>
                                        </label>
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <label class="properties-check">
                                                <input type="radio" name="bedrooms" value="<?php echo e($i); ?>" <?php echo e(request('bedrooms') == $i ? 'checked' : ''); ?>>
                                                <span><?php echo e($i); ?>+</span>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>Bathrooms</h3>
                                    <div class="properties-filter-options">
                                        <label class="properties-check">
                                            <input type="radio" name="bathrooms" value="" <?php echo e(!request('bathrooms') ? 'checked' : ''); ?>>
                                            <span>Any</span>
                                        </label>
                                        <?php for($i = 1; $i <= 4; $i++): ?>
                                            <label class="properties-check">
                                                <input type="radio" name="bathrooms" value="<?php echo e($i); ?>" <?php echo e(request('bathrooms') == $i ? 'checked' : ''); ?>>
                                                <span><?php echo e($i); ?>+</span>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <div class="properties-filter-group">
                                    <h3>City</h3>
                                    <input type="text" name="city" placeholder="Enter city…" value="<?php echo e(request('city')); ?>" class="properties-filter-input">
                                </div>

                                <?php
                                    $amenities = \App\Models\PropertyAmenity::select('amenity_name')
                                        ->distinct()
                                        ->pluck('amenity_name')
                                        ->filter()
                                        ->take(8);
                                ?>
                                <?php if($amenities->count() > 0): ?>
                                    <div class="properties-filter-group">
                                        <h3>Amenities</h3>
                                        <div class="properties-filter-options">
                                            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="properties-check">
                                                    <input type="checkbox" name="amenities[]" value="<?php echo e($amenity); ?>" <?php echo e(in_array($amenity, (array) request('amenities', [])) ? 'checked' : ''); ?>>
                                                    <span><?php echo e($amenity); ?></span>
                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="properties-filter-actions">
                                    <button type="submit" class="properties-search-btn properties-btn-block">Apply filters</button>
                                    <a href="<?php echo e(route('properties.index')); ?>" class="properties-btn-ghost">Clear all</a>
                                </div>
                            </form>
                        </aside>

                        <div class="properties-content">
                            <div class="properties-results-head">
                                <div>
                                    <span class="properties-kicker">Listings</span>
                                    <h2><?php echo e($properties->total()); ?> properties found</h2>
                                    <?php if(request('search')): ?>
                                        <p>Results for “<?php echo e(request('search')); ?>”</p>
                                    <?php endif; ?>
                                </div>
                                <div class="properties-field properties-sort">
                                    <label for="sort">Sort</label>
                                    <select name="sort" id="sort" form="filter-form" onchange="document.getElementById('filter-form').submit()">
                                        <option value="">Default</option>
                                        <option value="price_low" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>>Price: low to high</option>
                                        <option value="price_high" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>>Price: high to low</option>
                                        <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest first</option>
                                        <option value="oldest" <?php echo e(request('sort') == 'oldest' ? 'selected' : ''); ?>>Oldest first</option>
                                    </select>
                                </div>
                            </div>

                            <div class="properties-grid">
                                <?php $__empty_1 = true; $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <article class="property-card">
                                        <a href="<?php echo e(route('properties.show', $property->id)); ?>" class="property-card-media" aria-label="<?php echo e($property->title); ?>">
                                            <img
                                                src="<?php echo e($property->primary_image ? url($property->primary_image) : asset('/images/section/box-house.jpg')); ?>"
                                                alt="<?php echo e($property->title); ?>"
                                                loading="lazy">
                                            <span class="property-status <?php echo e($property->is_sold ? 'is-sold' : ''); ?>">
                                                <?php echo e($property->is_sold ? 'Sold' : ucfirst(str_replace('_', ' ', $property->property_status))); ?>

                                            </span>
                                        </a>

                                        <div class="property-card-body">
                                            <h3 class="property-card-title">
                                                <a href="<?php echo e(route('properties.show', $property->id)); ?>"><?php echo e($property->title); ?></a>
                                            </h3>

                                            <p class="property-location">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                                    <circle cx="12" cy="10" r="3"/>
                                                </svg>
                                                <span><?php echo e($property->city); ?><?php echo e($property->full_address ? ', ' . $property->full_address : ''); ?></span>
                                            </p>

                                            <ul class="property-meta">
                                                <?php if($property->bedrooms > 0): ?>
                                                    <li>
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                                            <path d="M3 21h18"/>
                                                            <path d="M7 11h2M15 11h2"/>
                                                        </svg>
                                                        <span><?php echo e($property->bedrooms); ?> beds</span>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if($property->bathrooms > 0): ?>
                                                    <li>
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                                            <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                                        </svg>
                                                        <span><?php echo e($property->bathrooms); ?> baths</span>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                        <path d="M3 9h18M9 21V9"/>
                                                    </svg>
                                                    <span><?php echo e($property->display_size); ?> <?php echo e($property->size_prefix); ?></span>
                                                </li>
                                            </ul>

                                            <div class="property-card-foot">
                                                <span class="property-price"><?php echo e($property->display_price); ?></span>
                                                <a href="<?php echo e(route('properties.show', $property->id)); ?>" class="property-card-cta">Details</a>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="properties-empty">
                                        <span class="properties-empty-icon" aria-hidden="true">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8"/>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                            </svg>
                                        </span>
                                        <h3>No properties found</h3>
                                        <p>Try adjusting your search or filters to see more listings.</p>
                                        <a href="<?php echo e(route('properties.index')); ?>" class="property-card-cta">View all properties</a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if($properties->hasPages()): ?>
                                <div class="properties-pagination">
                                    <?php echo e($properties->appends(request()->query())->links()); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/main.js')); ?>"></script>
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
<?php /**PATH C:\Users\AR\Desktop\RM_MainSite\resources\views/property/index.blade.php ENDPATH**/ ?>