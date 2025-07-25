<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
