@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div>
            <p class="status success">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('errors'))
        <div>
            <p>{{ session('errors')->first() }}</p>
        </div>
    @endif

    <h1>Picture Details</h1>

    <img src="{{ asset($picture->pic_path_url) }}" alt="Picture" style="max-width: 300px; max-height: 300px;" />

    {{ $picture->event?->category?->cat_name ?? 'No category' }}
    {{ $picture->event?->event_name ?? 'No event' }}

    <a href="{{ route('pictures.edit', compact('picture')) }}">Edit Picture</a>
@endsection
