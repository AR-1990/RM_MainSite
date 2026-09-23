<?php if (! $__env->hasRenderedOnce('c3706961-c3c3-4b70-91a3-f2e149379162')): $__env->markAsRenderedOnce('c3706961-c3c3-4b70-91a3-f2e149379162'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/header-modern.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
<?php endif; ?>

        <!-- .header -->
        <header id="header-main" class="header header-fixed">
            <div class="header-inner">
                <div class="tf-container xl">
                    <div class="row">
                        <div class="col-12">
                            <div class="header-inner-wrap">
                                <div class="header-logo">
                                    <a href="<?php echo e(route('index')); ?>" class="site-logo">
                                        <img id="logo_header" alt="Randhawa Marketing" src="<?php echo e(asset('/images/logo/logo@2x.png')); ?>">
                                    </a>
                                </div>
                                <nav class="main-menu">
                                    <ul class="navigation ">
                                        <li class="<?php echo e(request()->routeIs('index') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('index')); ?>">Home</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('about') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('about')); ?>">About</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('projects.*') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('projects.index')); ?>">Projects</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('properties.*') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('properties.index')); ?>">Properties</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('news.*') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('news.index')); ?>">News</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('blog.*') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('blog.index')); ?>">Blog</a>
                                        </li>
                                        <li class="<?php echo e(request()->routeIs('contact') ? 'current-menu' : ''); ?>">
                                            <a href="<?php echo e(route('contact')); ?>">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="header-right">
                                    <div class="btn-add">
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <a class="tf-btn style-border pd-23" href="<?php echo e(route('myProperty')); ?>">My Properties</a>
                                            <?php else: ?>
                                                <a class="tf-btn style-border pd-23" href="<?php echo e(route('admin.index')); ?>">Admin Panel</a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="d-flex align-items-center" style="gap: 12px; flex-wrap: wrap;">
                                                <a href="<?php echo e(route('user.login')); ?>" class="tf-btn style-border pd-23">Login</a>
                                                <a href="<?php echo e(route('user.register')); ?>" class="tf-btn bg-color-primary pd-23">Register</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(auth()->guard()->check()): ?>
                                        <div class="btn-add">
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <a class="tf-btn bg-color-primary pd-23" href="<?php echo e(route('property.add')); ?>">Add Property</a>
                                            <?php else: ?>
                                                <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="tf-btn bg-color-primary pd-23" style="border: 0;">Logout</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>

                                        <div class="btn-add">
                                            <?php if(auth()->user()->role === 'user'): ?>
                                                <form action="<?php echo e(route('user.logout')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="tf-btn style-border pd-23" style="border: 0;">Logout</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

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

<?php if (! $__env->hasRenderedOnce('8b550621-b730-495b-ae22-2e97ec94cfa3')): $__env->markAsRenderedOnce('8b550621-b730-495b-ae22-2e97ec94cfa3'); ?>
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
<?php endif; ?>
<?php /**PATH C:\Users\AR\Desktop\RM_MainSite\resources\views/layout/header.blade.php ENDPATH**/ ?>