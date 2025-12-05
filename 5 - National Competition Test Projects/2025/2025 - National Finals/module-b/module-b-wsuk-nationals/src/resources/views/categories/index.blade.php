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
            <h2>Categories</h2>
            <button type="button" class="btn-primary" onclick="document.getElementById('createCategoryModal').style.display='flex'">
                <i class="fa fa-plus"></i>
                Create New Category
            </button>
        </div>

        <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->cat_id }}</td>
                        <td>
                            <form method="POST" action={{ route('categories.update', compact('category')) }} class="inline">
                                @method('PUT')
                                @csrf

                                <label for="{{ sprintf('cat_name_%d', $category->cat_id) }}" class="sr-only">Category Name</label>
                                <input type="text" name="cat_name" id="{{ sprintf('cat_name_%d', $category->cat_id) }}"
                                    value="{{ $category->cat_name }}" placeholder="Category Name" aria-label="Category Name"/>

                                <button type="submit" id="{{ sprintf('cat_update_%d', $category->cat_id) }}" class="btn-update">
                                    <i class="fa fa-save"></i>
                                    Update
                                </button>
                            </form>
                        </td>
                        <td>
                            <div class="actions">
                                <form method="POST" action={{ route('categories.destroy', compact('category')) }}>
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" id="{{ sprintf('cat_delete_%d', $category->cat_id) }}" class="btn-delete">
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

        {{-- Create Modal --}}
        <div id="createCategoryModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Add New Category</h3>
                    <button type="button" class="modal-close" onclick="document.getElementById('createCategoryModal').style.display='none'">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <form method="POST" action={{ route('categories.store') }} class="modal-form">
                    @csrf

                    <div class="form-field">
                        <label for="cat_name_new">Category Name</label>
                        <input type="text" name="cat_name" id="cat_name_new" value=""
                            placeholder="e.g. Weddings, Sports, Events" aria-label="New Category Name" required/>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="document.getElementById('createCategoryModal').style.display='none'">
                            <i class="fa fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fa fa-plus"></i>
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Close modal when clicking outside
            window.onclick = function(event) {
                const modal = document.getElementById('createCategoryModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const modal = document.getElementById('createCategoryModal');
                    if (modal.style.display === 'flex') {
                        modal.style.display = 'none';
                    }
                }
            });
        </script>
@endsection
