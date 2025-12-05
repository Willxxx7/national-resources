@extends('layouts.app')

@section('content')
    <div class="public-events-page">
        <div class="public-events-header">
            <h1 class="public-events-title">Public Events</h1>
            <p class="public-events-subtitle">Browse our public photography events</p>
            <a href="{{ route('login') }}" class="back-to-login">
                <i class="fa fa-arrow-left"></i>
                Back to Login
            </a>
        </div>

        @if ($events->isEmpty())
            <div class="no-events-message">
                <i class="fa fa-calendar-times"></i>
                <p>No public events available at the moment.</p>
                <p class="subtitle">Check back soon for upcoming events!</p>
            </div>
        @else
            <div class="public-events-grid">
                @foreach ($events as $event)
                    <div class="public-event-card">
                        <div class="event-card-header">
                            <h3 class="event-card-title">{{ $event->event_name }}</h3>
                            <span class="event-category-badge">{{ $event->category->cat_name }}</span>
                        </div>

                        <div class="event-card-body">
                            <div class="event-info-row">
                                <i class="fa fa-map-marker-alt"></i>
                                <span>{{ $event->event_city }}</span>
                            </div>

                            <div class="event-info-row">
                                <i class="fa fa-calendar"></i>
                                <span>{{ $event->date_time->isoFormat('LL') }}</span>
                            </div>

                            <div class="event-info-row">
                                <i class="fa fa-clock"></i>
                                <span>{{ $event->date_time->isoFormat('LT') }}</span>
                            </div>

                            @if ($event->event_note)
                                <div class="event-note">
                                    <i class="fa fa-info-circle"></i>
                                    <p>{{ $event->event_note }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="event-card-footer">
                            <a href="{{ route('events.show', ['path' => $event->event_folder_path]) }}"
                                class="view-event-btn">
                                <i class="fa fa-eye"></i>
                                View Event Photos
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
