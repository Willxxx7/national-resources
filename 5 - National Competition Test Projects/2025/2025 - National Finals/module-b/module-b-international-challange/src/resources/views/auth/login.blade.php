@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="login-container">
            {{-- Admin Login Card --}}
            <div class="login-card">
                <div class="login-header">
                    <h2 class="login-title">Admin Login</h2>
                    <p class="login-subtitle">Sign in to manage your events</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-info">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                @if ($errors->has('email'))
                    <div class="alert alert-error">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                @endif

                <form method="post" action="{{ route('auth.login') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="email">
                            Email
                            <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                            autocomplete="username"
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Password
                            <span class="required">*</span>
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fa fa-sign-in-alt"></i>
                        Login to Admin Panel
                    </button>
                </form>
            </div>

            {{-- Guest Access Card --}}
            <div class="login-card guest-card">
                <div class="login-header">
                    <h2 class="login-title">Guest Access</h2>
                    <p class="login-subtitle">View events without signing in</p>
                </div>

                @if ($errors->has('access_code'))
                    <div class="alert alert-error">
                        <p>{{ $errors->first('access_code') }}</p>
                    </div>
                @endif

                {{-- Public Events Button --}}
                <a href="{{ route('events.public') }}" class="guest-button public-events-btn">
                    <i class="fa fa-calendar-alt"></i>
                    <span>View Public Events</span>
                </a>

                <div class="divider">
                    <span>OR</span>
                </div>

                {{-- Access Code Form --}}
                <form method="GET" action="{{ route('events.access.verify') }}" class="access-code-form">
                    <div class="form-group">
                        <label for="access_code">
                            Have an Access Code?
                        </label>
                        <input
                            type="text"
                            id="access_code"
                            name="access_code"
                            placeholder="Enter your access code"
                            value="{{ old('access_code') }}"
                            required
                        >
                    </div>
                    <button type="submit" class="guest-button access-code-btn">
                        <i class="fa fa-unlock"></i>
                        <span>Access Private Event</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
