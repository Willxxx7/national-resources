@extends('layouts.app')

@section('content')
    <div class="event-preview-page">
        @guest
            <div style="margin-bottom: var(--space-lg);">
                <a href="{{ route('events.public') }}" class="back-to-login">
                    <i class="fa fa-arrow-left"></i>
                    Back to Public Events
                </a>
            </div>
        @endguest

        <div class="event-preview-header">
            @isset($access)
                <div class="event-access-info">
                    <i class="fa fa-check-circle"></i>
                    Access granted on {{ $access->access_granted_date->isoFormat('LLLL') }}
                </div>
            @endisset

            <div style="display: flex; align-items: center; justify-content: center; gap: var(--space-md); margin-bottom: var(--space-lg);">
                <div style="background: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); flex-shrink: 0;">
                    <span style="color: var(--primary); font-size: 1.25rem; font-weight: 700;">{{ $event->pictures->count() }}</span>
                </div>
                <h1 class="event-preview-title" style="margin: 0; text-align: left;">{{ $event->event_name }}</h1>
            </div>

            <div class="event-details-grid">
                <div class="event-detail-item">
                    <i class="fa fa-tag"></i>
                    <div class="event-detail-content">
                        <div class="event-detail-label">Category</div>
                        <div class="event-detail-value">{{ $event->category->cat_name }}</div>
                    </div>
                </div>

                <div class="event-detail-item">
                    <i class="fa fa-map-marker-alt"></i>
                    <div class="event-detail-content">
                        <div class="event-detail-label">Location</div>
                        <div class="event-detail-value">{{ $event->event_city }}</div>
                    </div>
                </div>

                <div class="event-detail-item">
                    <i class="fa fa-calendar-alt"></i>
                    <div class="event-detail-content">
                        <div class="event-detail-label">Date & Time</div>
                        <div class="event-detail-value">{{ $event->date_time->isoFormat('LLL') }}</div>
                    </div>
                </div>

                @if($event->event_note)
                    <div class="event-detail-item">
                        <i class="fa fa-info-circle"></i>
                        <div class="event-detail-content">
                            <div class="event-detail-label">Note</div>
                            <div class="event-detail-value">{{ $event->event_note }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="event-pictures-section">
            <h2 class="section-title">
                <i class="fa fa-images"></i>
                Event Photos
            </h2>

            @if($event->pictures->isEmpty())
                <div class="no-pictures-message">
                    <i class="fa fa-camera"></i>
                    <p>No photos available yet for this event.</p>
                </div>
            @else
                <div class="event-pictures-container">
                    @foreach ($event->pictures as $picture)
                        <div class="event-picture-item">
                            <img src="{{ asset(sprintf('storage/%s', $picture->pic_path)) }}" alt="{{ $picture->pic_name }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
