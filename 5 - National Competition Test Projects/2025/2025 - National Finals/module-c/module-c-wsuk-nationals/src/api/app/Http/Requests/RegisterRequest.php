<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerFirstname' => 'required|string|max:75',
            'customerLastname' => 'required|string|max:75',
            'customerEmail' => 'required|email|max:150|unique:customers,cust_email',
            'customerPhone' => 'required|string|max:15',
            'customerAddressFirst' => 'required|string|max:50',
            'customerAddressSecond' => 'nullable|string|max:50',
            'customerPostcode' => 'required|string|max:8',
            'customerPassword' => 'required|string|min:4'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => collect($validator->getMessageBag()->getMessages())->values()->flatten()
        ], 422));
    }
}
