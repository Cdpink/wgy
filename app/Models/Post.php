<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'age',
        'breed',
        'province',
        'city',
        'interest',
        'audience',
        'message',
        'photo',
    ];
    public function getAgeFormattedAttribute()
    {
        $months = $this->age;
        $years = intdiv($months, 12);
        $remainingMonths = $months % 12;

        if ($years > 0 && $remainingMonths > 0) {
            return "{$years} years {$remainingMonths} months";
        }

        if ($years > 0) {
            return "{$years} years";
        }

        if ($remainingMonths > 0) {
            return "{$remainingMonths} months";
        }

        return "0 months";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }
}
