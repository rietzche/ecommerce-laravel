<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'id_product', 'stock', 'terjual'
    ];

    function FKStock(){
    	return $this->belongsTo(Product::class);
    }
}
