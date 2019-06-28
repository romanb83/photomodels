<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['user_id', 'name', 'weight', 'height'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
