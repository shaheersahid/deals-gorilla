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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function option()
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
