<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'no_rekening', 'no_tlp', 'address_1', 'address_2', 'zipcode', 'email', 'password', 'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function PKUser1() {
        return $this->hasMany(Cart::class);
    }
    
    function PKUser2() {
        return $this->hasMany(Order::class);
    }
    
    function PKUser3() {
        return $this->hasMany(Rating::class);
    }
    
    function PKUser4() {
        return $this->hasMany(Transaction::class);
    }
}
