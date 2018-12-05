<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'id_product', 'id_user', 'rate', 'review',
    ];

    function FKRating1(){
    	return $this->belongsTo(Product::class);
    }

    function FKRating2(){
    	return $this->belongsTo(User::class);
    }
}
