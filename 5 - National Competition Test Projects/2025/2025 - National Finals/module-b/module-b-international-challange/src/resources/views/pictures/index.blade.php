@extends('layouts.app')
@use(Carbon\Carbon)

@section('content')
    
        @if (session('success'))
            <div class="status success">
                <p> {{ session('success') }}</p>
            </div>
        @endif

        <h2>Pictures</h2>

        <a href="{{ route('pictures.create') }}" class="btn-primary" style="margin-bottom: 1.5rem;">
            <i class="fa fa-upload"></i>
            Upload New Picture
        </a>

        <div class="pictures-grid">
            @forelse ($pictures as $picture)
                <div class="picture-card">
                    <div class="picture-preview">
                        <img src="{{asset(sprintf('storage/%s', $picture->pic_path))}}" alt="{{$picture->pic_name}}">
                    </div>
                    <div class="picture-meta">
                        <div style="position: relative;">
                            <div style="position: absolute; right: 0; top: 0; display: flex; gap: 0.5rem;">
                                <a href="{{route('pictures.edit', compact('picture'))}}" class="btn-icon btn-edit" title="Edit Picture">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form method="POST" action="{{route('pictures.destroy', compact('picture'))}}" style="display: inline; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Delete Picture" onclick="return confirm('Are you sure you want to delete this picture?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <strong>ID</strong>
                            <a title="Edit Picture"
                               href="{{route('pictures.edit', compact('picture'))}}">{{$picture->pic_locator}}</a>
                        </div>
                        <div>
                            <strong>Event</strong>
                            <span>{{ $picture->event?->event_name ?? 'None' }}</span>
                        </div>
                        <div>
                            <strong>Event Category</strong>
                            <span>{{ $picture->event?->category?->cat_name ?? 'None' }}</span>
                        </div>
                        <div>
                            <strong>Status</strong>
                            @if($picture->pic_is_active)
                                <span class="picture-active-marker active">Active</span>
                            @else
                                <span class="picture-active-marker inactive">Inactive</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p>No pictures found.</p>
            @endforelse
        </div>

        <div style="margin-top: 2rem;">
            {{ $pictures->appends(request()->except('page'))->links() }}
        </div>
@endsection
