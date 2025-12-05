<?php

namespace App\Http\Requests\Events;

use App\Models\EventType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateEventRequest extends FormRequest
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
            'event_name' => 'required|string|min:1|max:150',
            'cat_id' => 'required|exists:categories,cat_id',
            'event_type' => ['required', Rule::enum(EventType::class)],
            'event_city' => 'required|string|min:1|max:50',
            'event_date_time' => 'required|date',
            'event_note' => 'nullable|string|max:300',
            'event_folder_path' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'cat_id.required' => 'Please select a category',
            'event_type' => 'Please select an event type'
        ];
    }
}
