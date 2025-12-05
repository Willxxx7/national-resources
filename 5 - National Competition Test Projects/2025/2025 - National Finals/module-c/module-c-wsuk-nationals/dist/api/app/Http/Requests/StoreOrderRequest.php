<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
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
            'orderNote' => 'nullable|string|max:300',
            'orderPictures' => 'required|array',
            'orderPictures.*.picId' => 'required|exists:pictures,pic_id',
            'orderPictures.*.picSizeId' => 'required|exists:picture_sizes,pic_size_id',
            'orderPictures.*.picQty' => 'required|integer|min:1'
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
