<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'User Portal') - Randhawa Marketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Randhawa Marketing user property portal." />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jqueryui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />

    <style>
        .page-layout {
            align-items: flex-start;
            min-height: calc(100vh - 78px);
        }

        .page-layout .main-content {
            width: 100%;
            min-height: calc(100vh - 78px);
            display: flex;
            flex-direction: column;
        }

        .page-layout .main-content-inner {
            flex: 1 1 auto;
            padding-bottom: 32px;
        }

        .portal-alert {
            border-radius: 16px;
            padding: 16px 18px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .portal-alert-success {
            background: rgba(34, 197, 94, 0.12);
            color: #166534;
        }

        .portal-alert-error {
            background: rgba(239, 68, 68, 0.12);
            color: #991b1b;
        }

        .portal-user-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        }

        .portal-user-card .name {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .portal-user-card .meta {
            color: #6b7280;
            margin-bottom: 18px;
        }

        .portal-logout-btn {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            padding: 0;
            color: inherit;
        }

        .portal-logout-btn:hover {
            color: #f1913d;
        }

        .portal-footer {
            margin-left: 56px;
            margin-right: 56px;
            margin-bottom: 32px;
            padding: 22px 28px;
            border-radius: 22px;
            background: #fff;
            border: 1px solid rgba(17, 24, 39, 0.06);
            box-shadow: 0 14px 40px rgba(17, 24, 39, 0.05);
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .portal-footer p {
            margin: 0;
            color: #4b5563;
            font-weight: 600;
        }

        .portal-footer .portal-footer-links {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .portal-footer .portal-footer-links a {
            color: #6b7280;
            font-weight: 600;
        }

        .portal-footer .portal-footer-links a:hover {
            color: #f1913d;
        }

        @media (max-width: 991px) {
            .page-layout .main-content {
                min-height: auto;
            }

            .portal-footer {
                margin-left: 15px;
                margin-right: 15px;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-dashboard">
    <div id="wrapper" class="bg-4">
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

        <div class="page-layout">
            <div class="wrap-sidebar">
                <div class="sidebar-menu-dashboard">
                    <div class="menu-box">
                        <div class="portal-user-card">
                            <div class="name">{{ auth()->user()->name }}</div>
                            <div class="meta">{{ auth()->user()->email }}</div>
                        </div>

                        <ul class="box-menu-dashboard" style="margin-top: 20px;">
                            <li class="nav-menu-item {{ request()->routeIs('myProperty') ? 'active' : '' }}">
                                <a class="nav-menu-link" href="{{ route('myProperty') }}">My Properties</a>
                            </li>
                            <li class="nav-menu-item {{ request()->routeIs('property.add') ? 'active' : '' }}">
                                <a class="nav-menu-link" href="{{ route('property.add') }}">Add Property</a>
                            </li>
                            <li class="nav-menu-item">
                                <form action="{{ route('user.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-menu-link portal-logout-btn">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="main-content w-100">
                <div class="main-content-inner">
                    <div class="button-show-hide show-mb">
                        <span class="body-1">Show Dashboard</span>
                    </div>

                    @if(session('success'))
                        <div class="portal-alert portal-alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="portal-alert portal-alert-error">{{ session('error') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="portal-alert portal-alert-error">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @yield('content')
                </div>

                <div class="portal-footer">
                    <p>Randhawa Marketing User Portal</p>
                    <div class="portal-footer-links">
                        <a href="{{ route('index') }}">Website</a>
                        <a href="{{ route('property.add') }}">Add Property</a>
                        <a href="{{ route('contact') }}">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>
