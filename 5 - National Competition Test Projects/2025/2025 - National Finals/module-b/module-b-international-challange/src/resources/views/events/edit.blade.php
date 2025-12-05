@extends('layouts.app')

@use ('\App\Models\EventType')

@section('content')
    <div style="padding: var(--space-xl) 0;">
        <div style="max-width: 700px; margin: 0 auto;">
            <div style="margin-bottom: var(--space-lg);">
                <a href="{{ route('events.index') }}" class="back-link">
                    <i class="fa fa-arrow-left"></i>
                    Back to Events
                </a>
            </div>

            <div class="modal-content" style="position: static; transform: none; display: block;">
                <div class="modal-header">
                    <h3>Edit Event</h3>
                </div>

                @if ($errors->any())
                    <div class="status error" style="margin-bottom: var(--space-md);">
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('events.update', compact('event')) }}" class="modal-form">
                    @csrf
                    @method('PATCH')

                    <div class="form-field">
                        <label for="event_name">Event Name</label>
                        <input type="text" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}"
                            placeholder="Enter event name" required>
                    </div>

                    <div class="form-field">
                        <label for="event_category">Category</label>
                        <select name="cat_id" id="event_category" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->cat_id}}" {{ old('cat_id', $event->cat_id) == $category->cat_id ? 'selected' : '' }}>
                                    {{$category->cat_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="event_type">Event Type</label>
                        <select id="event_type" name="event_type" required>
                            @foreach (EventType::cases() as $type)
                                <option value="{{ $type->value }}" {{ old('event_type', $event->event_type->value) == $type->value ? 'selected' : '' }}>
                                    {{ ucfirst($type->value) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label for="event_city">City</label>
                        <input type="text" id="event_city" name="event_city" value="{{ old('event_city', $event->event_city) }}"
                            placeholder="Enter city" required>
                    </div>

                    <div class="form-field">
                        <label for="event_date_time">Date & Time</label>
                        <input type="datetime-local" id="event_date_time" name="event_date_time"
                            value="{{ old('event_date_time', $event->date_time->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <div class="form-field">
                        <label for="event_note">Note</label>
                        <textarea id="event_note" name="event_note" rows="2" placeholder="Optional notes">{{ old('event_note', $event->event_note) }}</textarea>
                    </div>

                    <div class="form-field">
                        <label for="event_folder_path">Folder Path</label>
                        <input type="text" id="event_folder_path" name="event_folder_path"
                            value="{{ old('event_folder_path', $event->event_folder_path) }}"
                            placeholder="Event folder path" readonly>
                        <small style="color: var(--text-subtle); font-size: 0.85rem;">Folder path cannot be changed</small>
                    </div>

                    <div class="modal-actions">
                        <a href="{{ route('events.index') }}" class="btn-secondary">
                            <i class="fa fa-times"></i>
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary">
                            <i class="fa fa-save"></i>
                            Update Event
                        </button>
                    </div>
                </form>

                <div style="margin-top: var(--space-lg); padding-top: var(--space-lg); border-top: 1px solid var(--border);">
                    <form method="POST" action="{{ route('events.destroy', compact('event')) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-delete" style="width: 100%;">
                            <i class="fa fa-trash"></i>
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
