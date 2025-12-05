@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div>
            <p class="status success">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('errors'))
        <div>
            <p>{{ session('errors')->first() }}</p>
        </div>
    @endif

    <div>
        <a href="{{ route('pictures.index') }}" class="back-link" style="margin-bottom: 1.5rem; display: inline-flex;">
            <i class="fa fa-arrow-left"></i>
            Back to Pictures
        </a>
    </div>

    <div class="form-container">
        <h2 class="edit-page-title">Edit Picture: {{$picture->pic_locator}}</h2>

        <div class="picture-edit-layout">
            <div class="picture-preview-section">
                <img src="{{asset(sprintf('storage/%s', $picture->pic_path))}}" alt="{{$picture->pic_name}}">
            </div>

            <div class="picture-form-section">
                <form method="POST" action="{{ route('pictures.update', compact('picture')) }}" class="styled-form" id="updateForm">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="pic_is_active">Is Active:</label>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <input type="hidden" name="pic_is_active" value="0">
                            <input type="checkbox" id="pic_is_active" name="pic_is_active" value="1"
                                   style="width: auto; margin: 0;"
                                   @if ($picture->pic_is_active) checked @endif>
                            <span style="color: var(--dark-2); font-size: 0.9rem;">{{ $picture->pic_is_active ? 'Yes' : 'No' }}</span>
                        </div>
                    </div>

                    <div>
                        <label for="pic_upload_note">Note:</label>
                        <textarea name="pic_upload_note" id="pic_upload_note" rows="4">{{ $picture->pic_upload_note }}</textarea>
                    </div>

                    <div class="picture-action-buttons">
                        <button type="submit" class="btn-update">
                            <i class="fa fa-save"></i>
                            Update
                        </button>

                        <button type="button" class="btn-delete" onclick="if(confirm('Are you sure you want to delete this picture?')) document.getElementById('deleteForm').submit();">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('pictures.destroy', compact('picture')) }}" id="deleteForm" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
