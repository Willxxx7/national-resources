@extends('layouts.app')

@section('content')
    
        @if (session('success'))
            <div class="status success">
                <p> {{ session('success') }}</p>
            </div>
        @endif

        <div>
            <a href="{{ route('settings.index') }}" class="back-link" style="margin-bottom: 1.5rem; display: inline-flex;">
                <i class="fa fa-arrow-left"></i>
                Back to Settings
            </a>
        </div>

        <div class="page-header">
            <h2>Picture Sizes</h2>
            <button type="button" class="btn-primary" onclick="document.getElementById('createModal').style.display='flex'">
                <i class="fa fa-plus"></i>
                Create New Size
            </button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Width (inches)</th>
                    <th>Height (inches)</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->pic_size_id }}</td>

                        {{-- Update --}}
                        <td>
                            <form method="POST" action={{ route('picture-sizes.update', ['picture_size' => $size]) }}
                                class="inline">
                                @method('PUT')
                                @csrf

                                <label for="{{ sprintf('pic_size_label_%d', $size->pic_size_id) }}" class="sr-only">Picture Size Label</label>
                                <input type="text" name="pic_size_label"
                                    id="{{ sprintf('pic_size_label_%d', $size->pic_size_id) }}"
                                    value="{{ $size->pic_size_label }}" placeholder="Label" aria-label="Picture Size Label"/>
                        </td>

                        <td>
                                <label for="{{ sprintf('pic_size_width_%d', $size->pic_size_id) }}" class="sr-only">Width</label>
                                <input type="number" name="pic_size_width"
                                    id="{{ sprintf('pic_size_width_%d', $size->pic_size_id) }}"
                                    value="{{ $size->pic_size_width }}" placeholder="Width" aria-label="Width" min="0.1" step="0.1"/>
                        </td>

                        <td>
                                <label for="{{ sprintf('pic_size_height_%d', $size->pic_size_id) }}" class="sr-only">Height</label>
                                <input type="number" name="pic_size_height"
                                    id="{{ sprintf('pic_size_height_%d', $size->pic_size_id) }}"
                                    value="{{ $size->pic_size_height }}" placeholder="Height" aria-label="Height" min="0.1" step="0.1"/>
                        </td>

                        <td>
                                <div class="price-input-wrapper">
                                    <span class="currency-symbol">£</span>
                                    <label for="{{ sprintf('pic_size_price_%d', $size->pic_size_id) }}" class="sr-only">Price</label>
                                    <input type="number" name="pic_size_price"
                                        id="{{ sprintf('pic_size_price_%d', $size->pic_size_id) }}"
                                        value="{{ number_format($size->pic_size_price, 2, '.', '') }}" min="0.01" step="0.01"
                                        placeholder="0.00" aria-label="Price"/>
                                </div>
                        </td>

                        {{-- Delete --}}
                        <td>
                            <div class="actions">
                                <button type="submit" id="{{ sprintf('pic_size_update_%d', $size->pic_size_id) }}" class="btn-update">
                                    <i class="fa fa-save"></i>
                                    Update
                                </button>
                            </form>

                                <form method="POST"
                                    action={{ route('picture-sizes.destroy', ['picture_size' => $size]) }}>
                                    @method('DELETE')
                                    @csrf

                                    <button id="{{ sprintf('pic_size_delete_%d', $size->pic_size_id) }}" class="btn-delete">
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

        {{-- Create Modal --}}
        <div id="createModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Picture Size</h3>
                    <button type="button" class="modal-close" onclick="document.getElementById('createModal').style.display='none'">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('picture-sizes.store') }}" class="modal-form">
                    @csrf

                    <div class="form-field">
                        <label for="pic_size_label_new">Label</label>
                        <input type="text" name="pic_size_label" id="pic_size_label_new" value=""
                            placeholder="e.g. 4x6, 8x10" aria-label="New Picture Size Label" required/>
                    </div>

                    <div class="form-field">
                        <label for="pic_size_width_new">Width (inches)</label>
                        <input type="number" name="pic_size_width" id="pic_size_width_new" value=""
                            placeholder="Width" aria-label="Width" min="0.1" step="0.1" required/>
                    </div>

                    <div class="form-field">
                        <label for="pic_size_height_new">Height (inches)</label>
                        <input type="number" name="pic_size_height" id="pic_size_height_new" value=""
                            placeholder="Height" aria-label="Height" min="0.1" step="0.1" required/>
                    </div>

                    <div class="form-field">
                        <label for="pic_size_price_new">Price</label>
                        <div class="price-input-wrapper">
                            <span class="currency-symbol">£</span>
                            <input type="number" name="pic_size_price" id="pic_size_price_new" value="0.01" min="0.01"
                                step="0.01" placeholder="0.00" aria-label="Price" required/>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="document.getElementById('createModal').style.display='none'">
                            <i class="fa fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fa fa-plus"></i>
                            Create Size
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('createModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    document.getElementById('createModal').style.display = 'none';
                }
            });
        </script>
@endsection
