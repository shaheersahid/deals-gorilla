<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'compare_price',
        'cost_price',
        'stock',
        'barcode',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeValues()
    {
        return $this->hasMany(VariantAttributeValue::class, 'variant_id');
    }

    /**
     * Get the variant title based on attribute values
     */
    public function getTitleAttribute()
    {
        $values = $this->attributeValues()
            ->with('option')
            ->get()
            ->pluck('option.label')
            ->filter()
            ->implode(' / ');

        return $values ?: 'Default';
    }

    /**
     * Check if variant is in stock
     */
    public function getInStockAttribute()
    {
        return $this->stock > 0;
    }
}
