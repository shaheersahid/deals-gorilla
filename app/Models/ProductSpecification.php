<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
        'product_id',
        'weight',
        'weight_unit',
        'length',
        'width',
        'height',
        'dimension_unit',
        'specs',
    ];

    protected $casts = [
        'weight' => 'decimal:3',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'specs' => 'array',
    ];

    /**
     * Get the product associated with this specification.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get formatted dimensions string
     */
    public function getDimensionsAttribute()
    {
        if ($this->length && $this->width && $this->height) {
            return "{$this->length} x {$this->width} x {$this->height} {$this->dimension_unit}";
        }
        return null;
    }

    /**
     * Get formatted weight string
     */
    public function getFormattedWeightAttribute()
    {
        if ($this->weight) {
            return "{$this->weight} {$this->weight_unit}";
        }
        return null;
    }
}
