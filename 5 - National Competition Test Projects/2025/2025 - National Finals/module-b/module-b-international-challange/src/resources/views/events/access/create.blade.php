@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="status success">
            <p> {{ session('success') }}</p>
        </div>
    @endif

    @if (session('errors'))
        <div class="status error">
            <p>{{ session('errors')->first() }}</p>
        </div>
    @endif

    <div>
        <a href="{{ route('events.index') }}" class="back-link" style="margin-bottom: 1.5rem; display: inline-flex;">
            <i class="fa fa-arrow-left"></i>
            Back to Events
        </a>
    </div>

    <div class="page-header" style="margin-bottom: 1.5rem;">
        <h2>Event Access for '{{ $event->event_name }}'</h2>
        <button type="button" class="btn-primary" onclick="document.getElementById('createAccessModal').style.display='flex'">
            <i class="fa fa-plus"></i>
            Create Access Code
        </button>
    </div>

    <div class="table-responsive">
        <table class="themed-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Access Code</th>
                    <th>Granted Date</th>
                    <th>Last Used</th>
                    <th>Times Used</th>
                    <th>Is Active?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    /**
                     * @var \App\Models\EventAccess $access
                     */
                @endphp
                @foreach ($event->eventAccesses as $idx => $access)
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>
                            {{ decrypt($access->access_code) }}
                        </td>
                        <td>{{ $access->access_granted_date->isoFormat('LL') }}</td>
                        <td>
                            @if($access->last_used_date)
                                {{ $access->last_used_date->isoFormat('LL') }}
                                <br>
                                <small style="color: var(--text-subtle);">{{ $access->last_used_date->diffForHumans() }}</small>
                            @else
                                <span style="color: var(--text-subtle);">Never used</span>
                            @endif
                        </td>
                        <td>
                            @if($access->use_count > 0)
                                <span style="font-weight: 600;">{{ $access->use_count }}</span>
                                @if($access->use_count > 10)
                                    <span style="color: var(--warning); margin-left: 0.25rem;">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            @else
                                <span style="color: var(--text-subtle);">0</span>
                            @endif
                        </td>
                        <td>
                            @if($access->is_active)
                                <span style="color: var(--success); font-weight: 600;">
                                    <i class="fa fa-check-circle"></i>
                                    Active
                                </span>
                            @else
                                <span style="color: var(--error); font-weight: 600;">
                                    <i class="fa fa-times-circle"></i>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('events.access.toggle', compact('access')) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" @class([
                                        'btn-update' => !$access->is_active,
                                        'btn-cancel' => $access->is_active,
                                    ])>
                                        @if ($access->is_active)
                                            <i class="fa fa-ban"></i>
                                            Deactivate
                                        @else
                                            <i class="fa fa-check-circle"></i>
                                            Activate
                                        @endif
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('events.access.destroy', compact('access')) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Create Access Code Modal --}}
    <div id="createAccessModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create Access Code</h3>
                <button type="button" class="modal-close" onclick="document.getElementById('createAccessModal').style.display='none'">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('events.access.store', compact('event')) }}" class="modal-form">
                @csrf

                <div class="form-field">
                    <label for="access_code">Access Code (Optional)</label>
                    <input type="text" name="access_code" id="access_code" value="{{ old('access_code') }}"
                        placeholder="Leave empty to auto-generate">

                    <div style="margin-top: var(--space-sm);">
                        <small style="color: var(--text-subtle); font-size: 0.85rem; display: block; margin-bottom: var(--space-xs);">
                            <strong>Leave empty</strong> to auto-generate a random code, or create your own custom code:
                        </small>
                        <ul style="margin: 0; padding-left: 1.5rem; color: var(--text-subtle); font-size: 0.85rem;">
                            <li>Minimum 8 characters, maximum 50</li>
                            <li>Only letters and numbers (a-z, A-Z, 0-9)</li>
                            <li>No spaces or special characters</li>
                            <li><strong>Must be unique across all events</strong></li>
                        </ul>
                    </div>

                    @error('access_code')
                        <div class="status error" style="margin-top: var(--space-sm);">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="document.getElementById('createAccessModal').style.display='none'">
                        <i class="fa fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fa fa-plus"></i>
                        Create Access Code
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('createAccessModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modal = document.getElementById('createAccessModal');
                if (modal.style.display === 'flex') {
                    modal.style.display = 'none';
                }
            }
        });

        // Show modal if there are validation errors
        @if ($errors->any())
            document.getElementById('createAccessModal').style.display = 'flex';
        @endif
    </script>
@endsection
