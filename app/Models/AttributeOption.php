<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    protected $fillable = [
        'attribute_id',
        'value',
        'label',
        'color_code',
        'image',
        'sort_order',
    ];

    /**
     * Get the attribute that owns this option.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Get the product attribute values for this option.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productAttributeValues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Get the variant attribute values for this option.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variantAttributeValues(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VariantAttributeValue::class);
    }

    /**
     * Get display label (fallback to value if no label)
     */
    public function getLabelAttribute($value)
    {
        return $value ?: $this->value;
    }
}
