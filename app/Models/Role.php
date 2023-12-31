<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public function roles(){
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }
}
