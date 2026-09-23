@once
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/header-modern.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
@endonce

        <!-- .header -->
        <header id="header-main" class="header header-fixed">
            <div class="header-inner">
                <div class="tf-container xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="header-inner-wrap">
                                <div class="header-logo">
                                    <a href="{{ route('index') }}" class="site-logo">
                                        <img id="logo_header" alt="Randhawa Marketing" src="{{ asset('/images/logo/logo@2x.png') }}">
                                    </a>
                                </div>
                                <nav class="main-menu">
                                    <ul class="navigation ">
                                        <li class="{{ request()->routeIs('index') ? 'current-menu' : '' }}">
                                            <a href="{{ route('index') }}">Home</a>
                                        </li>
                                        <li class="{{ request()->routeIs('about') ? 'current-menu' : '' }}">
                                            <a href="{{ route('about') }}">About</a>
                                        </li>
                                        <li class="{{ request()->routeIs('projects.*') ? 'current-menu' : '' }}">
                                            <a href="{{ route('projects.index') }}">Projects</a>
                                        </li>
                                        <li class="{{ request()->routeIs('properties.*') ? 'current-menu' : '' }}">
                                            <a href="{{ route('properties.index') }}">Properties</a>
                                        </li>
                                        <li class="{{ request()->routeIs('news.*') ? 'current-menu' : '' }}">
                                            <a href="{{ route('news.index') }}">News</a>
                                        </li>
                                        <li class="{{ request()->routeIs('blog.*') ? 'current-menu' : '' }}">
                                            <a href="{{ route('blog.index') }}">Blog</a>
                                        </li>
                                        <li class="{{ request()->routeIs('contact') ? 'current-menu' : '' }}">
                                            <a href="{{ route('contact') }}">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="header-right">
                                    <div class="btn-add">
                                        @auth
                                            @if(auth()->user()->role === 'user')
                                                <a class="tf-btn style-border pd-23" href="{{ route('myProperty') }}">My Properties</a>
                                            @else
                                                <a class="tf-btn style-border pd-23" href="{{ route('admin.index') }}">Admin Panel</a>
                                            @endif
                                        @else
                                            <div class="d-flex align-items-center" style="gap: 12px; flex-wrap: wrap;">
                                                <a href="{{ route('user.login') }}" class="tf-btn style-border pd-23">Login</a>
                                                <a href="{{ route('user.register') }}" class="tf-btn bg-color-primary pd-23">Register</a>
                                            </div>
                                        @endauth
                                    </div>

                                    @auth
                                        <div class="btn-add">
                                            @if(auth()->user()->role === 'user')
                                                <a class="tf-btn bg-color-primary pd-23" href="{{ route('property.add') }}">Add Property</a>
                                            @else
                                                <form action="{{ route('admin.logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="tf-btn bg-color-primary pd-23" style="border: 0;">Logout</button>
                                                </form>
                                            @endif
                                        </div>

                                        <div class="btn-add">
                                            @if(auth()->user()->role === 'user')
                                                <form action="{{ route('user.logout') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="tf-btn style-border pd-23" style="border: 0;">Logout</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endauth

                                    <div class="mobile-button" data-bs-toggle="offcanvas" data-bs-target="#menu-mobile"
                                        aria-controls="menu-mobile">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" aria-hidden="true">
                                            <path d="M4 7H20"></path>
                                            <path d="M4 12H20"></path>
                                            <path d="M4 17H20"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /.header -->

@once
<script>
(function () {
    function initSiteHeader() {
        var header = document.getElementById('header-main');
        if (!header || header.dataset.navFloatReady === '1') return;
        header.dataset.navFloatReady = '1';

        var syncing = false;
        var syncNav = function () {
            if (syncing) return;
            syncing = true;
            header.classList.remove('is-fixed', 'is-small');
            if (window.scrollY > 16) {
                header.classList.add('is-nav-float');
            } else {
                header.classList.remove('is-nav-float');
            }
            syncing = false;
        };

        window.addEventListener('scroll', syncNav, { passive: true });
        new MutationObserver(function () {
            if (header.classList.contains('is-fixed') || header.classList.contains('is-small')) {
                syncNav();
            }
        }).observe(header, {
            attributes: true,
            attributeFilter: ['class']
        });
        syncNav();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSiteHeader);
    } else {
        initSiteHeader();
    }
})();
</script>
@endonce
