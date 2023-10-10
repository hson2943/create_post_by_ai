<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'content_by_gpt', 'user_id'];

    public function keywords(){
        return $this->hasMany(Keyword::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
