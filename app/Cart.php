<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id_product', 'id_user', 'quantity',
    ];

    function FKCart(){
    	return $this->belongsTo(User::class);
    }
}
