<?php

namespace App\Http\Models; // Wrong namespace fix in next step if exists
// Correct namespace
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
     */
    public function imageable()
    {
        return $this->morphTo(); 
    }
}
