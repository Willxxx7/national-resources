@extends('layouts.app')

@use ('\App\Models\EventType')

@section('content')
        <a href="{{ route('events.index') }}" class="back-link">
            <i class="fa fa-arrow-left"></i>
            Back to Events
        </a>

        @if (session('errors'))
            <div class="status error">
                <p>{{ session('errors')->first() }}</p>
            </div>
        @endif

        <div class="form-container">
            <h2>Create New Event</h2>

            <form method="POST" action="{{ route('events.store') }}" class="styled-form">
                @csrf

                <div>
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" value="{{ old('event_name') }}" required>
                </div>
                <div>
                    <label for="event_category">Category:</label>
                    <select name="cat_id" id="event_category">
                        <option value="">Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="event_type">Event Type:</label>
                    <select id="event_type" name="event_type">
                        @foreach (EventType::cases() as $type)
                            <option value="{{ $type->value }}">{{ ucfirst($type->value) }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="event_city">City:</label>
                    <input type="text" id="event_city" name="event_city" value="{{ old('event_city') }}" required>
                </div>

                <div>
                    <label for="event_date_time">Date & Time:</label>
                    <input type="datetime-local" id="event_date_time" name="event_date_time"
                        value="{{ old('event_date_time') }}" required>
                </div>

                <div>
                    <label for="event_note">Note:</label>
                    <textarea id="event_note" name="event_note">{{ old('event_note') }}</textarea>
                </div>

                <div>
                    <label for="event_folder_path">Folder Path (auto-generated if empty):</label>
                    <input type="text" id="event_folder_path" name="event_folder_path" value="{{ old('event_folder_path') }}">
                </div>

                <div class="form-actions">
                    <button type="submit" class="success">
                        <i class="fa fa-plus"></i>
                        Create Event
                    </button>
                    <a href="{{ route('events.index') }}" class="btn-secondary">
                        <i class="fa fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
@endsection
