<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['province', 'region'];

    // Relationship with posts
    public function posts()
    {
        return $this->hasMany(Post::class, 'province', 'province');
    }
}