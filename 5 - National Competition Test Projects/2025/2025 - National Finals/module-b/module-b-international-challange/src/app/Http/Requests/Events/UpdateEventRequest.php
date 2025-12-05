<?php

namespace App\Http\Requests\Events;

use App\Models\EventType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
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
            'event_name' => 'string|min:1|max:150',
            'event_type' => ['required', Rule::enum(EventType::class)],
            'event_city' => 'string|min:1|max:50',
            'event_date_time' => 'date',
            'event_note' => 'nullable|string|max:300',
        ];
    }
}
