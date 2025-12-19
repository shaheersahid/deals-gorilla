<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandProduct extends Model
{
    protected $table = 'brand_product';
    
    protected $fillable = [
        'brand_id',
        'product_id'
    ];
}
