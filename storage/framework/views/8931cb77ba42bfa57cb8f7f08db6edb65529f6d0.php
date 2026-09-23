<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Real Estate Projects - Randhawa Marketing</title>
    <meta name="description"
        content="Explore our premium real estate projects including residential, commercial, and mixed-use developments. Find your dream property with Randhawa Marketing.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/swiper-bundle.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/hero-redesign.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer-modern.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/projects.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/icons/icomoon/style.css')); ?>" />
    <link rel="shortcut icon" href="<?php echo e(asset('/icons/favicon.svg')); ?>" />
</head>

<body class="popup-loader home-hero-redesign projects-page">
    <?php
        $projects = isset($projects) ? $projects : collect();
        $projectTypes = isset($projectTypes) ? $projectTypes : collect();
        $statuses = isset($statuses) ? $statuses : collect();
        $locations = isset($locations) ? $locations : collect();
        $featuredProjects = isset($featuredProjects) ? $featuredProjects : collect();

        $projectsTotal = isset($projects) && method_exists($projects, 'total')
            ? $projects->total()
            : $projects->count();

        $projectsFirstItem = isset($projects) && method_exists($projects, 'firstItem')
            ? ($projects->firstItem() ?? 0)
            : ($projects->isEmpty() ? 0 : 1);

        $projectsLastItem = isset($projects) && method_exists($projects, 'lastItem')
            ? ($projects->lastItem() ?? 0)
            : $projects->count();

        $projectsHasPages = isset($projects) && method_exists($projects, 'hasPages')
            ? $projects->hasPages()
            : false;

        $projectsPreviousPageUrl = isset($projects) && method_exists($projects, 'previousPageUrl')
            ? $projects->previousPageUrl()
            : null;

        $projectsNextPageUrl = isset($projects) && method_exists($projects, 'nextPageUrl')
            ? $projects->nextPageUrl()
            : null;
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

        <main class="projects-main">
            <section class="projects-intro">
                <div class="tf-container">
                    <div class="projects-intro-inner">
                        <span class="projects-kicker">Projects</span>
                        <h1 class="projects-title">Discover premium projects</h1>
                        <p class="projects-lead">Browse residential, commercial, and mixed-use developments with clear details and pricing.</p>
                    </div>
                </div>
            </section>

            <section class="projects-filter-section">
                <div class="tf-container">
                    <form action="<?php echo e(route('projects.index')); ?>" method="GET" class="projects-filter-shell">
                        <div class="projects-filter-grid">
                            <div class="projects-field">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" placeholder="Search projects…" value="<?php echo e(request('search')); ?>">
                            </div>
                            <div class="projects-field">
                                <label for="type">Type</label>
                                <select id="type" name="type">
                                    <option value="">All types</option>
                                    <?php $__currentLoopData = $projectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type); ?>" <?php echo e(request('type') == $type ? 'selected' : ''); ?>>
                                            <?php echo e(ucfirst($type)); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="projects-field">
                                <label for="location">Location</label>
                                <select id="location" name="location">
                                    <option value="">All locations</option>
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($location); ?>" <?php echo e(request('location') == $location ? 'selected' : ''); ?>>
                                            <?php echo e($location); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="projects-field projects-field-action">
                                <label class="projects-field-spacer" aria-hidden="true">&nbsp;</label>
                                <button type="submit" class="projects-search-btn">
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

            <section class="projects-grid-section">
                <div class="tf-container">
                    <div class="projects-results-head">
                        <div>
                            <span class="projects-kicker">Portfolio</span>
                            <h2>Available projects</h2>
                            <?php if(request('search') || request('type') || request('location') || request('status')): ?>
                                <p><?php echo e($projectsTotal); ?> matching results</p>
                            <?php endif; ?>
                        </div>
                        <p class="projects-results-meta">
                            Showing <?php echo e($projectsFirstItem); ?>–<?php echo e($projectsLastItem); ?> of <?php echo e($projectsTotal); ?>

                        </p>
                    </div>

                    <div class="projects-grid">
                        <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <article class="project-card">
                                <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="project-card-media" aria-label="<?php echo e($project->title); ?>">
                                    <img
                                        src="<?php echo e($project->main_image ? url($project->main_image) : asset('/images/projects/default-project.jpg')); ?>"
                                        alt="<?php echo e($project->title); ?>"
                                        loading="lazy">
                                    <?php if($project->status): ?>
                                        <span class="project-status"><?php echo e(ucwords(str_replace('_', ' ', $project->status))); ?></span>
                                    <?php endif; ?>
                                </a>

                                <div class="project-card-body">
                                    <div class="project-card-top">
                                        <span class="project-type"><?php echo e($project->project_type_text); ?></span>
                                        <span class="project-price">PKR <?php echo e(number_format($project->price)); ?></span>
                                    </div>

                                    <h3 class="project-card-title">
                                        <a href="<?php echo e(route('projects.show', $project->slug)); ?>"><?php echo e($project->title); ?></a>
                                    </h3>

                                    <p class="project-location">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        <span><?php echo e($project->location); ?></span>
                                    </p>

                                    <?php if($project->short_description): ?>
                                        <p class="project-excerpt"><?php echo e(Str::limit($project->short_description, 100)); ?></p>
                                    <?php endif; ?>

                                    <ul class="project-meta">
                                        <?php if($project->area): ?>
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <path d="M3 9h18M9 21V9"/>
                                                </svg>
                                                <span><?php echo e(number_format($project->area)); ?> <?php echo e(ucfirst($project->area_unit)); ?></span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($project->bedrooms): ?>
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                                    <path d="M3 21h18"/>
                                                    <path d="M7 11h2M15 11h2"/>
                                                </svg>
                                                <span><?php echo e($project->bedrooms); ?> beds</span>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($project->bathrooms): ?>
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                                    <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                                </svg>
                                                <span><?php echo e($project->bathrooms); ?> baths</span>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                    <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="project-card-cta">View details</a>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="projects-empty">
                                <span class="projects-empty-icon" aria-hidden="true">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    </svg>
                                </span>
                                <h3>No projects found</h3>
                                <p>Try adjusting your search or browse the full portfolio.</p>
                                <a href="<?php echo e(route('projects.index')); ?>" class="project-card-cta">View all projects</a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if($projectsHasPages): ?>
                        <div class="projects-pagination">
                            <p>Up to 12 projects per page</p>
                            <div class="projects-pagination-actions">
                                <?php if($projectsPreviousPageUrl): ?>
                                    <a href="<?php echo e($projectsPreviousPageUrl); ?>" class="projects-page-btn is-ghost">Previous</a>
                                <?php endif; ?>
                                <?php if($projectsNextPageUrl): ?>
                                    <a href="<?php echo e($projectsNextPageUrl); ?>" class="projects-page-btn">Next</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH /Users/mac/Documents/GitHub/RM_MainSite/resources/views/projects/index.blade.php ENDPATH**/ ?>