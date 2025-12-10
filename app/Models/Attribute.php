<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'category_id',
        'is_variant',
        'is_filterable',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_variant' => 'boolean',
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($attribute) {
            if (empty($attribute->slug)) {
                $attribute->slug = Str::slug($attribute->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function options()
    {
        return $this->hasMany(AttributeOption::class)->orderBy('sort_order');
    }

    public function productValues()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
