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
        'deal_price',
        'display_price',
        'percentage_off',
        'is_out_of_stock',
        'sort_order',
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
        'deal_price' => 'decimal:2',
        'display_price' => 'decimal:2',
        'percentage_off' => 'decimal:2',
        'is_out_of_stock' => 'boolean',
        'sort_order' => 'integer',
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
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the product's SEO meta.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * Get the images for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'image');
    }

    /**
     * Get the FAQS for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductFaq::class);
    }

    /**
     * Get the variants for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('sort_order');
    }

    /**
     * Get the specification for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function specification(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductSpecification::class);
    }

    /**
     * Get the attribute values for the product.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributeValues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Get all attributes with their values for this product.
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getAttributesWithValues(): \Illuminate\Support\Collection
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

    /**
     * Check if product has an active deal right now
     * 
     * @return bool
     */
    public function hasActiveDeal(): bool
    {
        if (!$this->deal_enabled) {
            return false;
        }
        
        $now = now();
        
        if ($this->deal_start && $now->lt($this->deal_start)) {
            return false;
        }
        
        if ($this->deal_end && $now->gt($this->deal_end)) {
            return false;
        }
        
        return true;
    }

    /**
     * Get the effective price (considering active deals)
     */
    public function getEffectivePriceAttribute()
    {
        if ($this->hasActiveDeal() && $this->deal_price) {
            return $this->deal_price;
        }
        
        if ($this->display_price) {
            return $this->display_price;
        }
        
        return $this->price;
    }

    /**
     * Sync main product price with minimum variant price
     * Call after variant updates
     * 
     * @return void
     */
    public function syncPriceFromVariants(): void
    {
        if ($this->has_variants && $this->variants()->count() > 0) {
            $minPrice = $this->variants()->min('price');
            if ($minPrice && $this->price != $minPrice) {
                $this->price = $minPrice;
                $this->saveQuietly();
            }
        }
    }

    /**
     * Sync main product stock with total variant stock
     * Call after variant updates
     * 
     * @return void
     */
    public function syncStockFromVariants(): void
    {
        if ($this->has_variants) {
            $totalStock = $this->variants()->sum('stock');
            if ($this->stock != $totalStock) {
                $this->stock = $totalStock;
                $this->saveQuietly();
            }
        }
    }

    /**
     * Check if product is available for purchase
     * 
     * @return bool
     */
    public function isAvailable(): bool
    {
        if ($this->is_out_of_stock) {
            return false;
        }
        
        return $this->total_stock > 0;
    }
}
