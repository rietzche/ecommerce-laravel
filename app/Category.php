<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    function PKCategory() {
    	return $this->hasMany(Product::class);
    }
}
