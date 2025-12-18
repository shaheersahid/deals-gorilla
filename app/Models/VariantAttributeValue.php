<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantAttributeValue extends Model
{
    protected $fillable = [
        'variant_id',
        'attribute_id',
        'attribute_option_id',
    ];

    /**
     * Get the variant associated with this value.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    /**
     * Get the attribute associated with this value.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Get the option associated with this value.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AttributeOption::class, 'attribute_option_id');
    }
}