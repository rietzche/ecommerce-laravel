<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'id_product', 'picture',
    ];

    function FKPicture(){
    	return $this->belongsTo(Product::class);
    }
}
