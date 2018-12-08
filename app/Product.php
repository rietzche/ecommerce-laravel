<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'id_category', 'description', 'price', 'weight',
    ];

    function FKProduct(){
    	return $this->belongsTo(Category::class);
    }

    function PKProduct1() {
    	return $this->hasMany(Picture::class);
    }

    function PKProduct2() {
    	return $this->hasMany(Stock::class);
    }

    function PKProduct3() {
    	return $this->hasMany(Cart::class);
    }

    function PKProduct4() {
    	return $this->hasMany(Order::class);
    }

    function PKProduct5() {
    	return $this->hasMany(Rating::class);
    }
}
