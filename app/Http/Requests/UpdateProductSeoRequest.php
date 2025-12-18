<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductSeoRequest extends FormRequest
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
            // Meta Tags
            'meta_fields.canonical' => 'nullable|string|max:255',
            'meta_fields.robots' => 'nullable|string|max:255',
            'meta_fields.keywords' => 'nullable|string|max:255',
            'meta_fields.description' => 'nullable|string',

            // Open Graph
            'open_graph_fields.title' => 'nullable|string|max:255',
            'open_graph_fields.type' => 'nullable|string|max:255',
            'open_graph_fields.image' => 'nullable|string|max:255',
            'open_graph_fields.url' => 'nullable|url|max:255',

            // Twitter Cards
            'twitter_cards.card' => 'nullable|string|max:255',
            'twitter_cards.site' => 'nullable|string|max:255',
            'twitter_cards.title' => 'nullable|string|max:255',
            'twitter_cards.description' => 'nullable|string',
            'twitter_cards.image' => 'nullable|string|max:255',

            // Schema
            'schemas' => 'nullable|string',
        ];
    }
}