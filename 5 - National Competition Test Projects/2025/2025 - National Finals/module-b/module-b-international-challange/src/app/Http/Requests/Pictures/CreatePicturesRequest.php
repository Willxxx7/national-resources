<?php

namespace App\Http\Requests\Pictures;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePicturesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::hasUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pictures' => 'required|array',
            'pictures.*' => 'required|array',
            'pictures.*.event_id' => 'required|integer|exists:events,event_id',
            'pictures.*.pic_upload_note' => 'nullable|string|max:300',
            'files.*' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
