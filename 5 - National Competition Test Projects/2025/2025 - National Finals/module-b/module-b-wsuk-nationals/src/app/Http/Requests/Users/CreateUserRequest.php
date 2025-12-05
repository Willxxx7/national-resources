<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
        // At least 8 characters, at least one uppercase letter, at least one lowercase letter, at least one number
        $passwordRules = Password::min(8)->letters()->mixedCase()->numbers();

        return [
          'name' => 'required|string',
          'email' => 'required|email',
          'password' => ['required', 'confirmed', $passwordRules],
        ];
    }
}
