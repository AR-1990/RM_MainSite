<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Login - Randhawa Marketing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/hero-redesign.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/footer-modern.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/auth.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ asset('/icons/favicon.svg') }}" />
</head>

<body class="popup-loader home-hero-redesign auth-page">
    <div id="wrapper">
        @include('layout.header')

        <main class="auth-main">
            <div class="auth-stage">
                <section class="auth-panel">
                    <div class="auth-panel-inner">
                        <a href="{{ route('index') }}" class="auth-brand">
                            <img src="{{ asset('/images/logo/logo@2x.png') }}" alt="Randhawa Marketing">
                        </a>

                        <h1 class="auth-heading">Sign in</h1>
                        <p class="auth-sub">Access your listings and track approvals.</p>

                        @if(session('success'))
                            <div class="auth-message is-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="auth-message is-error">{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="auth-message is-error">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('user.login.submit') }}" method="POST" novalidate>
                            @csrf
                            <div class="auth-field">
                                <label for="login-email">Email</label>
                                <input id="login-email" type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required autocomplete="email">
                            </div>

                            <div class="auth-field">
                                <label for="login-password">Password</label>
                                <input id="login-password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                            </div>

                            <div class="auth-row">
                                <label class="auth-check">
                                    <input type="checkbox" name="remember" value="1">
                                    Remember me
                                </label>
                            </div>

                            <button type="submit" class="auth-submit">Continue</button>
                        </form>

                        <p class="auth-switch">
                            No account yet?
                            <a href="{{ route('user.register') }}">Create one</a>
                        </p>
                    </div>
                </section>

                <aside class="auth-visual" aria-hidden="true">
                    <img src="{{ asset('/images/dream-home/coastal-house.jpg') }}" alt="">
                    <div class="auth-visual-shade"></div>
                    <div class="auth-visual-caption">
                        <p>Property management, made clear.</p>
                        <span>Submit listings and follow every approval step in one place.</span>
                    </div>
                </aside>
            </div>
        </main>

        @include('layout.footer')
    </div>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
