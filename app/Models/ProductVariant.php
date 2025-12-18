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

    /**
     * Get the product that owns this variant.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the attribute values for this variant.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeValues(): \Illuminate\Database\Eloquent\Relations\HasMany
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

    /**
     * Get the formatted image URL.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) return asset('admin/assets/images/no-image.png');
        
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}