@use(App\Models\EventType)

{{-- Edit Event Modal --}}
<div id="editEventModal" class="modal">
    <div class="modal-content" style="max-width: 700px;">
        <div class="modal-header">
            <h3>Edit Event</h3>
            <button type="button" class="modal-close" onclick="document.getElementById('editEventModal').style.display='none'">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <form id="editEventForm" method="POST" action="" class="modal-form">
            @csrf
            @method('PATCH')

            <div class="form-field">
                <label for="edit_event_name">Event Name</label>
                <input type="text" id="edit_event_name" name="event_name" placeholder="Enter event name" required>
            </div>

            <div class="form-field">
                <label for="edit_event_category">Category</label>
                <select name="cat_id" id="edit_event_category" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->cat_id}}">
                            {{$category->cat_name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <label for="edit_event_type">Event Type</label>
                <select id="edit_event_type" name="event_type" required>
                    @foreach (EventType::cases() as $type)
                        <option value="{{ $type->value }}">
                            {{ ucfirst($type->value) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <label for="edit_event_city">City</label>
                <input type="text" id="edit_event_city" name="event_city" placeholder="Enter city" required>
            </div>

            <div class="form-field">
                <label for="edit_event_date_time">Date & Time</label>
                <input type="datetime-local" id="edit_event_date_time" name="event_date_time" required>
            </div>

            <div class="form-field">
                <label for="edit_event_note">Note</label>
                <textarea id="edit_event_note" name="event_note" rows="2" placeholder="Optional notes"></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="document.getElementById('editEventModal').style.display='none'">
                    <i class="fa fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn-primary">
                    <i class="fa fa-save"></i>
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(event) {
    const modal = document.getElementById('editEventModal');
    const form = document.getElementById('editEventForm');

    // Set form action
    form.action = event.updateUrl;

    // Populate form fields
    document.getElementById('edit_event_name').value = event.name;
    document.getElementById('edit_event_category').value = event.categoryId;
    document.getElementById('edit_event_type').value = event.type;
    document.getElementById('edit_event_city').value = event.city;
    document.getElementById('edit_event_date_time').value = event.dateTime;
    document.getElementById('edit_event_note').value = event.note || '';

    // Show modal
    modal.style.display = 'flex';
}

// Close modal when clicking outside
window.addEventListener('click', function(e) {
    const modal = document.getElementById('editEventModal');
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('editEventModal');
        if (modal.style.display === 'flex') {
            modal.style.display = 'none';
        }
    }
});
</script>
