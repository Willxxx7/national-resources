@extends('layouts.app')

@section('content')
    
        @if (session('success'))
            <div class="status success">{{ session('success') }}</div>
        @endif

        @if (session('errors'))
            <div class="status error">{{ session('errors')->first() }}</div>
        @endif

        <form method="POST" action="{{ route('pictures.store') }}" enctype="multipart/form-data" id="bulk-upload-form">
            @csrf

            <h2 style="margin-bottom: var(--space-md);">Bulk Picture Upload</h2>

            <div class="upload-dropzone" id="upload-dropzone">
                <input type="file" name="files[]" id="files" multiple required
                    accept="image/jpeg,image/png,image/jpg" class="visually-hidden">
                <label for="files" class="dropzone-label">
                    <span class="dropzone-icon">&#8682;</span>
                    <span class="dropzone-text">Drag &amp; drop images here or <span
                            class="dropzone-browse">browse</span></span>
                    <span class="dropzone-hint">(.jpeg, .jpg, .png, max 5MB each)</span>
                </label>
            </div>

            <div id="photos-container" class="photos-preview-grid"></div>

            <button type="submit" class="button" style="margin-top: var(--space-lg);">Upload All</button>
        </form>
    </div>

    <template id="photo-template">
        <div class="photo-preview-card">
            <img class="photo-img" alt="">
            <div class="photo-fields">
                <textarea class="photo-note" placeholder="Enter a note for this picture (optional)"></textarea>
                <div class="photo-meta-row">
                    <label class="event-label">Event:</label>
                    <select class="event-select" required>
                        <option value="">Select Event</option>
                        @foreach ($events as $event)
                            <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </template>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filesInput = document.querySelector('#files');
            const dropzone = document.getElementById('upload-dropzone');
            const photosContainer = document.getElementById('photos-container');
            let photoContainer = null;

            // Drag and drop support
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });
            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                filesInput.files = e.dataTransfer.files;
                filesInput.dispatchEvent(new Event('change'));
            });
            dropzone.addEventListener('click', function() {
                // Only trigger if the dropdown itself was clicked, not a child

                if (e.target === dropzone) {

                    filesInput.click();
                }
            });

            filesInput.addEventListener('change', function() {
                const files = filesInput.files;
                // Remove previous previews if any
                photosContainer.innerHTML = '';
                if (files.length > 0) {
                    const template = document.getElementById('photo-template');
                    Array.from(files).forEach((file, index) => {
                        const clone = template.content.cloneNode(true);
                        const img = clone.querySelector('.photo-img');
                        const noteInput = clone.querySelector('.photo-note');
                        const eventSelect = clone.querySelector('.event-select');
                        const eventLabel = clone.querySelector('.event-label');

                        // Set unique IDs and names
                        const noteId = `pic_note_${index}`;
                        const eventId = `event_id_${index}`;

                        noteInput.id = noteId;
                        noteInput.name = `pictures[${index}][pic_upload_note]`;

                        eventSelect.id = eventId;
                        eventSelect.name = `pictures[${index}][event_id]`;
                        if (eventLabel) eventLabel.setAttribute('for', eventId);

                        img.src = URL.createObjectURL(file);
                        img.alt = `Preview of ${file.name}`;

                        photosContainer.appendChild(clone);
                    });
                }
            });
        });
    </script>
@endsection
