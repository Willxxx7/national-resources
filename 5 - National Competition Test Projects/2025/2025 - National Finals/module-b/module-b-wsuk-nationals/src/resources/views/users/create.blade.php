@extends('layouts.app')

@section('content')
        @if (session('success'))
            <div class="status success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <a href="{{ route('users.index') }}" class="back-link">
            <i class="fa fa-arrow-left"></i>
            Back to Users
        </a>

        <div class="form-container">
            <h2>Create New User</h2>

            <form method="POST" action="{{ route('users.store') }}" class="styled-form">
                @csrf

                <div>
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        placeholder="Full Name" />
                    @error('name')
                        <div class="status error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        placeholder="Email Address" />
                    @error('email')
                        <div class="status error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required placeholder="Password"
                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                        title="Password must be at least 8 characters, include 1 uppercase, 1 lowercase, and 1 number." />
                    @error('password')
                        <div class="status error">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="Confirm Password" />
                </div>

                <div class="form-actions">
                    <button type="submit" class="success">
                        <i class="fa fa-user-plus"></i>
                        Create User
                    </button>
                    <a href="{{ route('users.index') }}" class="btn-secondary">
                        <i class="fa fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
@endsection
