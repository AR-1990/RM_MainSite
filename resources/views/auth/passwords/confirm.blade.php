@extends('layouts.app')

@section('content')
<div class="auth-login-container">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card card">
                    <div class="card-header">
                        <h2>{{ __('Randhawa Marketing - Confirm Password') }}</h2>
                    </div>

                    <div class="card-body">
                        <div class="text-center mb-4">
                            <p>{{ __('Please confirm your password before continuing.') }}</p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>

                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
