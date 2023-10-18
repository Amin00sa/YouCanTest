<?php

namespace App\Http\Requests\Categories;

class CategoryUpdateRequest
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
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
        ];
    }
}