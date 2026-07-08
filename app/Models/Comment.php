<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'car_id',
        'body'
    ];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
