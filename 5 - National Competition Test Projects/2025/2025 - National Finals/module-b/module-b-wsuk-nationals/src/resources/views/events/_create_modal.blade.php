@use(App\Models\EventType)

{{-- Create Event Modal --}}
<div id="createEventModal" class="modal">
    <div class="modal-content" style="max-width: 700px;">
        <div class="modal-header">
            <h3>Create New Event</h3>
            <button type="button" class="modal-close" onclick="document.getElementById('createEventModal').style.display='none'">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('events.store') }}" class="modal-form">
            @csrf

            <div class="form-field">
                <label for="event_name">Event Name</label>
                <input type="text" id="event_name" name="event_name" value="{{ old('event_name') }}"
                    placeholder="Enter event name" required>
            </div>

            <div class="form-field">
                <label for="event_category">Category</label>
                <select name="cat_id" id="event_category" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->cat_id}}" {{ old('cat_id') == $category->cat_id ? 'selected' : '' }}>
                            {{$category->cat_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <label for="event_type">Event Type</label>
                <select id="event_type" name="event_type" required>
                    @foreach (EventType::cases() as $type)
                        <option value="{{ $type->value }}" {{ old('event_type') == $type->value ? 'selected' : '' }}>
                            {{ ucfirst($type->value) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <label for="event_city">City</label>
                <input type="text" id="event_city" name="event_city" value="{{ old('event_city') }}"
                    placeholder="Enter city" required>
            </div>

            <div class="form-field">
                <label for="event_date_time">Date & Time</label>
                <input type="datetime-local" id="event_date_time" name="event_date_time"
                    value="{{ old('event_date_time') }}" required>
            </div>

            <div class="form-field">
                <label for="event_note">Note</label>
                <textarea id="event_note" name="event_note" rows="2" placeholder="Optional notes">{{ old('event_note') }}</textarea>
            </div>

            <div class="form-field">
                <label for="event_folder_path">Folder Path</label>
                <input type="text" id="event_folder_path" name="event_folder_path" value="{{ old('event_folder_path') }}"
                    placeholder="Auto-generated if empty">
                <small style="color: var(--text-subtle); font-size: 0.85rem;">Leave empty to auto-generate</small>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="document.getElementById('createEventModal').style.display='none'">
                    <i class="fa fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn-primary">
                    <i class="fa fa-plus"></i>
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('createEventModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('createEventModal');
            if (modal.style.display === 'flex') {
                modal.style.display = 'none';
            }
        }
    });

    // Show modal if there are validation errors
    @if ($errors->any())
        document.getElementById('createEventModal').style.display = 'flex';
    @endif
</script>
