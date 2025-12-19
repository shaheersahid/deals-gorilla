<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'exists:brands,id',
            'short_desc' => 'nullable|string',
            'description' => 'required|string',
            'sku' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'video' => 'nullable|string|max:255',
            'stock' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'has_variants' => 'boolean',
            'deal_enabled' => 'boolean',
            'deal_start' => 'nullable|date',
            'deal_end' => 'nullable|date|after_or_equal:deal_start',
            'deal_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $price = request()->input('price');
                    if ($value && $price && $value >= $price) {
                        $fail('Deal price must be less than the regular price.');
                    }
                },
            ],
            'display_price' => 'nullable|numeric|min:0',
            'percentage_off' => 'nullable|numeric|min:0|max:100',
            'is_out_of_stock' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            // Specifications
            'weight' => 'nullable|numeric|min:0',
            'weight_unit' => 'nullable|in:g,kg,lb,oz',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'dimension_unit' => 'nullable|in:cm,in,m',
            'specs' => 'nullable|array',
            // Variants
            'variants' => 'nullable|array',
            'variants.*.sku' => 'nullable|string|max:255',
            'variants.*.price' => 'required_with:variants|numeric|min:0',
            'variants.*.stock' => 'nullable|integer|min:0',
            'variants.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'variants.*.attributes' => 'nullable|array',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'images' => 'nullable|array|max:9',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'compare_price' => 'nullable|numeric|min:0',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'category_id' => 'category',
            'brand_ids' => 'brands',
            'short_desc' => 'short description',
            'deal_start' => 'deal start date',
            'deal_end' => 'deal end date',
            'weight_unit' => 'weight unit',
            'dimension_unit' => 'dimension unit',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'The Title field is required.',
        ];
    }
}
