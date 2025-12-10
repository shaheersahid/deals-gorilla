<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:attributes,slug',
            'type' => 'required|in:select,text,number,color',
            'category_id' => 'nullable|exists:categories,id',
            'is_variant' => 'boolean',
            'is_filterable' => 'boolean',
            'is_visible' => 'boolean',
            'options' => 'nullable|array',
            'options.*.value' => 'required_with:options|string|max:255',
            'options.*.label' => 'nullable|string|max:255',
            'options.*.color_code' => 'nullable|string|max:10',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'category',
            'options.*.value' => 'option value',
            'options.*.label' => 'option label',
            'options.*.color_code' => 'color code',
        ];
    }
}
