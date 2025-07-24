<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(order::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
