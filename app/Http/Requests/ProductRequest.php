<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'information' => ['required', 'string','max:2000'],
            'price' => ['required','integer'],
            'sort_order' => ['nullable','integer'],
            'quantity' => ['required','integer','between:0,99'],
            'shop_id' => ['required','exists:shops,id'],
            'category' => ['required','exists:secondary_categories,id'],
            'image1' => ['nullable','exists:images,id'],
            'image2' => ['nullable','exists:images,id'],
            'image3' => ['nullable','exists:images,id'],
            'image4' => ['nullable','exists:images,id'],
            'image5' => ['nullable','exists:images,id'],
            'is_selling' => ['required','boolean']
        ];
    }
}
