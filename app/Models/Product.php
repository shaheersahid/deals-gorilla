<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'short_desc',
        'description',
        'sku',
        'price',
        'compare_price',
        'cost_price',
        'video',
        'stock',
        'is_featured',
        'is_active',
        'has_variants',
        'deal_enabled',
        'deal_start',
        'deal_end',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'has_variants' => 'boolean',
        'deal_enabled' => 'boolean',
        'deal_start' => 'date',
        'deal_end' => 'date',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            
            if (empty($product->sku)) {
                $sku = Str::upper(Str::random(10));
                while (static::where('sku', $sku)->exists()) {
                    $sku = Str::upper(Str::random(10));
                }
                $product->sku = $sku;
            }
        });
    }

    /**
     * Get the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the brands for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function brands(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * Get the product's SEO meta.
     */
    public function seo()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * Get the images for the product.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'image');
    }

    public function faqs()
    {
        return $this->hasMany(ProductFaq::class);
    }

    /**
     * Get the variants for the product.
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    /**
     * Get the specification for the product.
     */
    public function specification()
    {
        return $this->hasOne(ProductSpecification::class);
    }

    /**
     * Get the attribute values for the product.
     */
    public function attributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Get all attributes with their values for this product.
     */
    public function getAttributesWithValues()
    {
        return $this->attributeValues()
            ->with(['attribute', 'option'])
            ->get()
            ->groupBy('attribute.name');
    }

    /**
     * Get the display price (lowest variant price or base price)
     */
    public function getDisplayPriceAttribute()
    {
        if ($this->has_variants && $this->variants->count() > 0) {
            return $this->variants->where('is_active', true)->min('price');
        }
        return $this->price;
    }

    /**
     * Check if product is in stock
     */
    public function getInStockAttribute()
    {
        if ($this->has_variants) {
            return $this->variants->where('is_active', true)->sum('stock') > 0;
        }
        return $this->stock > 0;
    }

    /**
     * Get total stock across all variants
     */
    public function getTotalStockAttribute()
    {
        if ($this->has_variants) {
            return $this->variants->where('is_active', true)->sum('stock');
        }
        return $this->stock;
    }
}
