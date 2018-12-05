<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'code_order', 'id_user', 'proof',
    ];

    function FKTransaction(){
    	return $this->belongsTo(User::class);
    }
}
