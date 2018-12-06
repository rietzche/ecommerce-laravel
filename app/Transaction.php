<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'order_code',
        'id_user',
        'proof',
        'sender_name',
        'bank_from',
        'bank_for',
        'method',
        'price_total',
        'transfer_date',
    ];

    function FKTransaction(){
    	return $this->belongsTo(User::class);
    }
}
