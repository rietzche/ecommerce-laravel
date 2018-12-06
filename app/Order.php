<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'id_product', 'id_user', 'status', 'quantity', 'id_address', 'bank', 'price_total',
    ];

    function FKOrder1(){
    	return $this->belongsTo(User::class);
    }

    function FKOrder2(){
    	return $this->belongsTo(Product::class);
    }
}
