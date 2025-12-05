@extends('layouts.app')

@section('content')
        <h2>Settings</h2>
        <p style="color: var(--text-subtle); margin-top: var(--space-sm);">Manage your application settings and configurations</p>

        <nav class="sub-navigation">
            <a href="{{ route('categories.index') }}">
                <i class="fa fa-folder" style="margin-right: var(--space-sm); font-size: 1.5rem;"></i>
                Manage Categories
            </a>
            <a href="{{ route('picture-sizes.index') }}">
                <i class="fa fa-ruler-combined" style="margin-right: var(--space-sm); font-size: 1.5rem;"></i>
                Manage Picture Sizes
            </a>
            <a href="{{ route('users.index') }}">
                <i class="fa fa-users" style="margin-right: var(--space-sm); font-size: 1.5rem;"></i>
                Manage Users
            </a>
        </nav>
@endsection
