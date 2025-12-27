<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCollection extends Component
{
    public $slug;
    public $type;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($slug, $type = 'grid', $title = null)
    {
        $this->slug = $slug;
        $this->type = $type;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $collection = \App\Models\Collection::where('slug', $this->slug)
            ->where('is_active', true)
            ->with(['products' => function($query) {
                $query->where('is_active', true);
            }])
            ->first();

        $products = $collection ? $collection->products : collect();

        return view('components.product-collection', [
            'products' => $products,
            'title' => $this->title ?: ($collection ? $collection->name : ''),
            'type' => $this->type,
        ]);
    }
}
