@extends('layouts.app')

@section('content')
<div class="auth-login-container">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card card">
                    <div class="card-header">
                        <h2>{{ __('Randhawa Marketing - Verify Email') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                            <p class="mb-0">{{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                </form>
                            </p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                {{ __('Back to Login') }}
                            </a>
                        </div>
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
