@extends('layouts.app')

@section('content')
<div class="auth-login-container">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card card">
                    <div class="card-header">
                        <h2>{{ __('Randhawa Marketing - Reset Password') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <p>{{ __('Enter your email address and we will send you a password reset link.') }}</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Send Reset Link') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('login') }}" class="btn btn-link">
                                    {{ __('Back to Login') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Decorative elements -->
    <div class="auth-decoration"></div>
    <div class="auth-decoration-2"></div>
    <div class="auth-decoration-3"></div>
    <div class="auth-decoration-4"></div>
</div>
@endsection
