<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'note',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(orderdetail::class);
    }
    
}
