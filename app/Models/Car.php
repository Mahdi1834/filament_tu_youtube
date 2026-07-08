<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $fillable = [
        'title',
        'body',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
