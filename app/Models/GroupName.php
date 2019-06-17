<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupName extends Model
{
    protected $fillable = ['id', 'group_id', 'group_name', 'alias'];

    public function user()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }
}

?>