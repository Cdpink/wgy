<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'city',
        'state',
        'country',
    ];

    public function dogs()
    {
        return $this->hasMany(Dog::class);
    }
}
