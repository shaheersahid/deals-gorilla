<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'meta_fields',
        'open_graph_fields',
        'twitter_cards',
        'schemas',
    ];

    protected $casts = [
        'meta_fields' => 'array',
        'open_graph_fields' => 'array',
        'twitter_cards' => 'array',
        'schemas' => 'array',
    ];

    /**
     * Get the owning seoable model.
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}