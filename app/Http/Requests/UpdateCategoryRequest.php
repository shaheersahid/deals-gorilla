<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $this->route('category')->id,
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'parent_id' => 'parent category',
        ];
    }
}
