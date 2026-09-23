<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title><?php echo e($property->title); ?> - Randhawa Marketing</title>
    <meta name="description" content="Property details for <?php echo e($property->title); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/swiper-bundle.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/hero-redesign.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer-modern.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/property-detail.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/icons/icomoon/style.css')); ?>" />
    <style>
        body.property-detail-page .pd-main {
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        body.property-detail-page .pd-intro {
            padding: 12px 0 18px !important;
        }
        body.property-detail-page .pd-intro-top {
            margin-bottom: 12px !important;
        }
    </style>
    <link rel="shortcut icon" href="<?php echo e(asset('/icons/favicon.svg')); ?>" />
</head>

<body class="popup-loader home-hero-redesign property-detail-page">
    <?php
        $similarProperties = \App\Models\Property::where('property_category_id', $property->property_category_id)
            ->where('id', '!=', $property->id)
            ->where('is_active', true)
            ->where('is_deactivated', false)
            ->limit(3)
            ->get();
    ?>

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

        <main class="pd-main">
            <section class="pd-intro">
                <div class="tf-container">
                    <div class="pd-intro-top">
                        <a href="<?php echo e(route('properties.index')); ?>" class="pd-back">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="19" y1="12" x2="5" y2="12"/>
                                <polyline points="12 19 5 12 12 5"/>
                            </svg>
                            Back to properties
                        </a>
                        <div class="pd-badges">
                            <span class="pd-badge <?php echo e($property->is_sold ? 'is-sold' : ''); ?>">
                                <?php echo e($property->is_sold ? 'Sold' : ucfirst(str_replace('_', ' ', $property->property_status))); ?>

                            </span>
                            <?php if($property->category): ?>
                                <span class="pd-badge is-soft"><?php echo e($property->category->name); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="pd-intro-inner">
                        <span class="pd-kicker">Property</span>
                        <h1 class="pd-title"><?php echo e($property->title); ?></h1>
                        <p class="pd-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span><?php echo e($property->full_address); ?><?php echo e($property->city ? ', ' . $property->city : ''); ?></span>
                        </p>
                        <p class="pd-price"><?php echo e($property->display_price); ?></p>
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
                                        src="<?php echo e($property->primary_image ? url($property->primary_image) : asset('/images/section/box-house.jpg')); ?>"
                                        alt="<?php echo e($property->title); ?>">
                                </div>
                                <?php if($property->images->count() > 0): ?>
                                    <div class="pd-thumbs">
                                        <?php if($property->primary_image): ?>
                                            <button type="button" class="pd-thumb is-active" data-src="<?php echo e(url($property->primary_image)); ?>">
                                                <img src="<?php echo e(url($property->primary_image)); ?>" alt="">
                                            </button>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $property->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <button type="button" class="pd-thumb" data-src="<?php echo e(url($image->image_path)); ?>">
                                                <img src="<?php echo e(url($image->image_path)); ?>" alt="">
                                            </button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <ul class="pd-features">
                                <?php if($property->bedrooms > 0): ?>
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                            <path d="M3 21h18"/>
                                            <path d="M7 11h2M15 11h2"/>
                                        </svg>
                                        <span><?php echo e($property->bedrooms); ?> bedrooms</span>
                                    </li>
                                <?php endif; ?>
                                <?php if($property->bathrooms > 0): ?>
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                            <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                        </svg>
                                        <span><?php echo e($property->bathrooms); ?> bathrooms</span>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <path d="M3 9h18M9 21V9"/>
                                    </svg>
                                    <span><?php echo e($property->display_size); ?> <?php echo e($property->size_prefix); ?></span>
                                </li>
                                <?php if($property->garages): ?>
                                    <li>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <rect x="3" y="11" width="18" height="10" rx="1"/>
                                            <path d="M3 11V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v4"/>
                                        </svg>
                                        <span><?php echo e($property->garages); ?> parking</span>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <div class="pd-panel">
                                <div class="pd-panel-head">
                                    <span class="pd-kicker">Overview</span>
                                    <h2>Description</h2>
                                </div>
                                <p class="pd-copy"><?php echo e($property->description ?: 'No description available for this property.'); ?></p>
                            </div>

                            <div class="pd-panel">
                                <div class="pd-panel-head">
                                    <span class="pd-kicker">Specs</span>
                                    <h2>Property details</h2>
                                </div>
                                <dl class="pd-specs">
                                    <?php if($property->bedrooms > 0): ?>
                                        <div><dt>Bedrooms</dt><dd><?php echo e($property->bedrooms); ?></dd></div>
                                    <?php endif; ?>
                                    <?php if($property->bathrooms > 0): ?>
                                        <div><dt>Bathrooms</dt><dd><?php echo e($property->bathrooms); ?></dd></div>
                                    <?php endif; ?>
                                    <?php if($property->rooms > 0): ?>
                                        <div><dt>Total rooms</dt><dd><?php echo e($property->rooms); ?></dd></div>
                                    <?php endif; ?>
                                    <?php if($property->garages > 0): ?>
                                        <div><dt>Parking</dt><dd><?php echo e($property->garages); ?></dd></div>
                                    <?php endif; ?>
                                    <div><dt>Size</dt><dd><?php echo e($property->display_size); ?> <?php echo e($property->size_prefix); ?></dd></div>
                                    <?php if($property->furnished_status !== 'N/A'): ?>
                                        <div><dt>Furnished</dt><dd><?php echo e($property->furnished_status); ?></dd></div>
                                    <?php endif; ?>
                                    <div><dt>1 Marla value</dt><dd><?php echo e($property->marla_value); ?></dd></div>
                                    <div><dt>Status</dt><dd><?php echo e(ucfirst(str_replace('_', ' ', $property->property_status))); ?></dd></div>
                                </dl>
                            </div>

                            <?php if($property->amenities->count() > 0): ?>
                                <div class="pd-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">Included</span>
                                        <h2>Amenities</h2>
                                    </div>
                                    <ul class="pd-amenities">
                                        <?php $__currentLoopData = $property->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                                <span><?php echo e($amenity->amenity_name); ?></span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php if($property->floors->count() > 0): ?>
                                <div class="pd-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">Layout</span>
                                        <h2>Floor details</h2>
                                    </div>
                                    <div class="pd-floors">
                                        <?php $__currentLoopData = $property->floors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $floor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <article class="pd-floor">
                                                <div class="pd-floor-top">
                                                    <h3><?php echo e($floor->floor_name); ?></h3>
                                                    <span><?php echo e($floor->price_prefix); ?> <?php echo e(number_format($floor->floor_price)); ?></span>
                                                </div>
                                                <ul class="pd-floor-meta">
                                                    <li><?php echo e($floor->floor_size); ?> <?php echo e($floor->size_postfix); ?></li>
                                                    <li><?php echo e($floor->bedrooms); ?> beds</li>
                                                    <li><?php echo e($floor->bathrooms); ?> baths</li>
                                                </ul>
                                                <?php if($floor->description): ?>
                                                    <p><?php echo e($floor->description); ?></p>
                                                <?php endif; ?>
                                                <?php if($floor->floor_image): ?>
                                                    <img src="<?php echo e(url($floor->floor_image)); ?>" alt="<?php echo e($floor->floor_name); ?>" class="pd-floor-image">
                                                <?php endif; ?>
                                            </article>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
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
                                        <img src="<?php echo e(asset('/images/avatar/account.jpg')); ?>" alt="">
                                    </div>
                                    <div>
                                        <strong><?php echo e($property->user->name ?? 'Property agent'); ?></strong>
                                        <span>Real estate agent</span>
                                    </div>
                                </div>

                                <ul class="pd-contact-list">
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                        <a href="tel:<?php echo e(preg_replace('/\s+/', '', $property->user->phone ?? '03331929762')); ?>"><?php echo e($property->user->phone ?? '0333-1929762'); ?></a>
                                    </li>
                                    <li>
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                        <a href="mailto:<?php echo e($property->user->email ?? 'info@randhawamarketing.com'); ?>"><?php echo e($property->user->email ?? 'info@randhawamarketing.com'); ?></a>
                                    </li>
                                </ul>

                                <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="pd-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="source" value="property_detail">
                                    <input type="hidden" name="subject" value="Inquiry: <?php echo e($property->title); ?>">
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

                            <?php if($similarProperties->count()): ?>
                                <div class="pd-side-panel">
                                    <div class="pd-panel-head">
                                        <span class="pd-kicker">More</span>
                                        <h2>Similar properties</h2>
                                    </div>
                                    <ul class="pd-similar">
                                        <?php $__currentLoopData = $similarProperties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(route('properties.show', $similar->id)); ?>" class="pd-similar-card">
                                                    <img src="<?php echo e($similar->primary_image ? url($similar->primary_image) : asset('/images/section/box-house.jpg')); ?>" alt="<?php echo e($similar->title); ?>">
                                                    <div>
                                                        <strong><?php echo e($similar->title); ?></strong>
                                                        <span><?php echo e($similar->display_price); ?></span>
                                                        <em><?php echo e($similar->city); ?></em>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </aside>
                    </div>
                </div>
            </section>
        </main>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/main.js')); ?>"></script>
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
<?php /**PATH /Users/mac/Documents/GitHub/RM_MainSite/resources/views/property/show.blade.php ENDPATH**/ ?>