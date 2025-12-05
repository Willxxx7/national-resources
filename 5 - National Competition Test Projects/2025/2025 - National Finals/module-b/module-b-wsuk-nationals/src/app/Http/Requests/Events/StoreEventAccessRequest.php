<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventAccessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'access_code' => 'nullable|string|min:8|max:50|regex:/^[a-zA-Z0-9]+$/'
        ];
    }

    public function messages(): array
    {
        return [
            'access_code.min' => 'Access code must be at least 8 characters.',
            'access_code.max' => 'Access code cannot exceed 50 characters.',
            'access_code.regex' => 'Access code can only contain letters and numbers (no spaces or special characters).',
        ];
    }
}
