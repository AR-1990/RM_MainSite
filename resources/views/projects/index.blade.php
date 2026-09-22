<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Real Estate Projects - Randhawa Marketing</title>
    <meta name="description"
        content="Explore our premium real estate projects including residential, commercial, and mixed-use developments. Find your dream property with Randhawa Marketing.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/projects.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign projects-page">
    @php
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
                    <form action="{{ route('projects.index') }}" method="GET" class="projects-filter-shell">
                        <div class="projects-filter-grid">
                            <div class="projects-field">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" placeholder="Search projects…" value="{{ request('search') }}">
                            </div>
                            <div class="projects-field">
                                <label for="type">Type</label>
                                <select id="type" name="type">
                                    <option value="">All types</option>
                                    @foreach ($projectTypes as $type)
                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="projects-field">
                                <label for="location">Location</label>
                                <select id="location" name="location">
                                    <option value="">All locations</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                            {{ $location }}
                                        </option>
                                    @endforeach
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
                            @if (request('search') || request('type') || request('location') || request('status'))
                                <p>{{ $projectsTotal }} matching results</p>
                            @endif
                        </div>
                        <p class="projects-results-meta">
                            Showing {{ $projectsFirstItem }}–{{ $projectsLastItem }} of {{ $projectsTotal }}
                        </p>
                    </div>

                    <div class="projects-grid">
                        @forelse($projects as $project)
                            <article class="project-card">
                                <a href="{{ route('projects.show', $project->slug) }}" class="project-card-media" aria-label="{{ $project->title }}">
                                    <img
                                        src="{{ $project->main_image ? url($project->main_image) : asset('/images/projects/default-project.jpg') }}"
                                        alt="{{ $project->title }}"
                                        loading="lazy">
                                    @if ($project->status)
                                        <span class="project-status">{{ ucwords(str_replace('_', ' ', $project->status)) }}</span>
                                    @endif
                                </a>

                                <div class="project-card-body">
                                    <div class="project-card-top">
                                        <span class="project-type">{{ $project->project_type_text }}</span>
                                        <span class="project-price">PKR {{ number_format($project->price) }}</span>
                                    </div>

                                    <h3 class="project-card-title">
                                        <a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a>
                                    </h3>

                                    <p class="project-location">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        <span>{{ $project->location }}</span>
                                    </p>

                                    @if ($project->short_description)
                                        <p class="project-excerpt">{{ Str::limit($project->short_description, 100) }}</p>
                                    @endif

                                    <ul class="project-meta">
                                        @if ($project->area)
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                    <path d="M3 9h18M9 21V9"/>
                                                </svg>
                                                <span>{{ number_format($project->area) }} {{ ucfirst($project->area_unit) }}</span>
                                            </li>
                                        @endif
                                        @if ($project->bedrooms)
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M3 21V8a2 2 0 0 1 2-2h4l2-2h4a2 2 0 0 1 2 2v15"/>
                                                    <path d="M3 21h18"/>
                                                    <path d="M7 11h2M15 11h2"/>
                                                </svg>
                                                <span>{{ $project->bedrooms }} beds</span>
                                            </li>
                                        @endif
                                        @if ($project->bathrooms)
                                            <li>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M4 12h16a1 1 0 0 1 1 1v2a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4v-2a1 1 0 0 1 1-1z"/>
                                                    <path d="M6 12V5a2 2 0 0 1 2-2h1"/>
                                                </svg>
                                                <span>{{ $project->bathrooms }} baths</span>
                                            </li>
                                        @endif
                                    </ul>

                                    <a href="{{ route('projects.show', $project->slug) }}" class="project-card-cta">View details</a>
                                </div>
                            </article>
                        @empty
                            <div class="projects-empty">
                                <span class="projects-empty-icon" aria-hidden="true">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                    </svg>
                                </span>
                                <h3>No projects found</h3>
                                <p>Try adjusting your search or browse the full portfolio.</p>
                                <a href="{{ route('projects.index') }}" class="project-card-cta">View all projects</a>
                            </div>
                        @endforelse
                    </div>

                    @if ($projectsHasPages)
                        <div class="projects-pagination">
                            <p>Up to 12 projects per page</p>
                            <div class="projects-pagination-actions">
                                @if ($projectsPreviousPageUrl)
                                    <a href="{{ $projectsPreviousPageUrl }}" class="projects-page-btn is-ghost">Previous</a>
                                @endif
                                @if ($projectsNextPageUrl)
                                    <a href="{{ $projectsNextPageUrl }}" class="projects-page-btn">Next</a>
                                @endif
                            </div>
                        </div>
                    @endif
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
