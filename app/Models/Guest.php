<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
    'firstname',
    'lastname',
    'email',
    'profile_image',
    ];

    public function posts() : HasMany 
    {
        return $this->hasMany(Post::class);
    }
}
