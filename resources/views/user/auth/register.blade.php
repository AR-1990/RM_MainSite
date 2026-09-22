<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Register - Randhawa Marketing</title>
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

<body class="popup-loader home-hero-redesign auth-page is-register">
    <div id="wrapper">
        @include('layout.header')

        <main class="auth-main">
            <div class="auth-stage">
                <aside class="auth-visual" aria-hidden="true">
                    <img src="{{ asset('/images/dream-home/glass-house.jpg') }}" alt="">
                    <div class="auth-visual-shade"></div>
                    <div class="auth-visual-caption">
                        <p>List with Randhawa.</p>
                        <span>Create your account, add a property, and wait for admin approval.</span>
                    </div>
                </aside>

                <section class="auth-panel">
                    <div class="auth-panel-inner">
                        <a href="{{ route('index') }}" class="auth-brand">
                            <img src="{{ asset('/images/logo/logo@2x.png') }}" alt="Randhawa Marketing">
                        </a>

                        <h1 class="auth-heading">Create account</h1>
                        <p class="auth-sub">A few details to start listing with us.</p>

                        @if($errors->any())
                            <div class="auth-message is-error">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('user.register.submit') }}" method="POST" novalidate>
                            @csrf
                            <div class="auth-grid">
                                <div class="auth-field">
                                    <label for="register-name">Full name</label>
                                    <input id="register-name" type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required autocomplete="name">
                                </div>
                                <div class="auth-field">
                                    <label for="register-email">Email</label>
                                    <input id="register-email" type="email" name="email" value="{{ old('email') }}" placeholder="you@email.com" required autocomplete="email">
                                </div>
                                <div class="auth-field">
                                    <label for="register-phone">Phone</label>
                                    <input id="register-phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="03xx…" autocomplete="tel">
                                </div>
                                <div class="auth-field">
                                    <label for="register-city">City</label>
                                    <input id="register-city" type="text" name="city" value="{{ old('city') }}" placeholder="Islamabad" autocomplete="address-level2">
                                </div>
                                <div class="auth-field">
                                    <label for="register-password">Password</label>
                                    <input id="register-password" type="password" name="password" placeholder="••••••••" required autocomplete="new-password">
                                </div>
                                <div class="auth-field">
                                    <label for="register-password-confirmation">Confirm</label>
                                    <input id="register-password-confirmation" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password">
                                </div>
                            </div>

                            <button type="submit" class="auth-submit is-gold">Create account</button>
                        </form>

                        <p class="auth-switch">
                            Already registered?
                            <a href="{{ route('user.login') }}">Sign in</a>
                        </p>
                    </div>
                </section>
            </div>
        </main>

        @include('layout.footer')
    </div>

    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>
