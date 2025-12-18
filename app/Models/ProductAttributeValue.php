<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_id',
        'attribute_option_id',
        'custom_value',
    ];

    /**
     * Get the product associated with this value.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
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

    /**
     * Get the display value
     */
    public function getValueAttribute()
    {
        if ($this->option) {
            return $this->option->label;
        }
        return $this->custom_value;
    }
}