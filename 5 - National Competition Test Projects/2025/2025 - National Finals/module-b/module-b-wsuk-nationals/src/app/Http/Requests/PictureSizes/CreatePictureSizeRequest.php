<?php

namespace App\Http\Requests\PictureSizes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePictureSizeRequest extends FormRequest
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
            'pic_size_label' => 'required|string|min:1',
            'pic_size_width' => 'required|decimal:0,2',
            'pic_size_height' => 'required|decimal:0,2',
            'pic_size_price' => 'decimal:0,2|min:0.01',
        ];
    }
}
