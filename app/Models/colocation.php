<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{   
    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->belongsToMany(User::class)
                ->withPivot('role', 'left_at')
                ->withTimestamps();
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
