<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class colocation extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)
                ->withPivot('role', 'left_at')
                ->withTimestamps();
    }
}
