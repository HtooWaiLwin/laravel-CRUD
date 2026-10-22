<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'guest_id',
        'title',
        'description',
    ];

    public function guests(): BelongsTo 
    {
        return $this->belongsTo(Guest::class);
    }
}
