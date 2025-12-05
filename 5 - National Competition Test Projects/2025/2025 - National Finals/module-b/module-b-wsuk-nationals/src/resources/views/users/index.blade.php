@extends('layouts.app')

@section('content')
    
        @if (session('success'))
            <div class="status success">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="status error">
                <p>{{ $errors->first('error') }}</p>
            </div>
        @endif

        <div>
            <a href="{{ route('settings.index') }}" class="back-link" style="margin-bottom: 1.5rem; display: inline-flex;">
                <i class="fa fa-arrow-left"></i>
                Back to Settings
            </a>
        </div>

        <div class="page-header">
            <h2>Users</h2>
            <button type="button" class="btn-primary" onclick="document.getElementById('createUserModal').style.display='flex'">
                <i class="fa fa-user-plus"></i>
                Add New User
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->isSuspended())
                                <span style="color: var(--error); font-weight: 600;">Suspended</span>
                            @else
                                <span style="color: var(--success); font-weight: 600;">Active</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->id === auth()->id())
                                <span style="color: var(--text-subtle); font-style: italic;">Current User</span>
                            @else
                                <div class="actions">
                                    @if ($user->isSuspended())
                                        <form method="POST" action="{{ route('users.unsuspend', compact('user')) }}">
                                            @csrf
                                            <button type="submit" class="btn-update">
                                                <i class="fa fa-check"></i>
                                                Unsuspend
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('users.suspend', compact('user')) }}">
                                            @csrf
                                            <button type="submit" class="btn-cancel">
                                                <i class="fa fa-ban"></i>
                                                Suspend
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('users.destroy', compact('user')) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach

                @if ($users->isEmpty())
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Create User Modal --}}
        <div id="createUserModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Create New User</h3>
                    <button type="button" class="modal-close" onclick="document.getElementById('createUserModal').style.display='none'">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('users.store') }}" class="modal-form">
                    @csrf

                    <div class="form-field">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            placeholder="Full Name" />
                        @error('name')
                            <div class="status error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            placeholder="Email Address" />
                        @error('email')
                            <div class="status error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required placeholder="Password"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$"
                            title="Password must be at least 8 characters, include 1 uppercase, 1 lowercase, and 1 number." />
                        <small style="color: var(--text-subtle); font-size: 0.85rem;">At least 8 characters, 1 uppercase, 1 lowercase, and 1 number</small>
                        @error('password')
                            <div class="status error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="Confirm Password" />
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="document.getElementById('createUserModal').style.display='none'">
                            <i class="fa fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fa fa-user-plus"></i>
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('createUserModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const modal = document.getElementById('createUserModal');
                    if (modal.style.display === 'flex') {
                        modal.style.display = 'none';
                    }
                }
            });

            // Show modal if there are validation errors
            @if ($errors->any())
                document.getElementById('createUserModal').style.display = 'flex';
            @endif
        </script>
@endsection
