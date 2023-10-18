<?php

namespace App\Http\Requests\Products;

class ProductUpdateRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'image' => ['nullable', 'mimes:jpeg,png,jpg,PNG'],
        ];
    }
}
