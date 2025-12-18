<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumb_path',
        'orig_path',
        'description',
        'is_primary',
        'order',
    ];

    /**
     * Get the parent imageable model (user or product).
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo(); 
    }

    /**
     * Get the formatted image URL.
     */
    public function getUrlAttribute()
    {
        if (!$this->thumb_path) return asset('admin/assets/images/no-image.png');
        
        if (str_starts_with($this->thumb_path, 'http')) {
            return $this->thumb_path;
        }

        return asset('storage/' . $this->thumb_path);
    }
}
