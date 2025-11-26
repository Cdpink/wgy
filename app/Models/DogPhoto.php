<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogPhoto extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
    ];

    // optional pero highly recommended
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
