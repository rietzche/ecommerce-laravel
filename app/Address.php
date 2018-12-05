<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id_user',
        'receiver_name',
        'number_tlp',
        'zip_code',
        'province',
        'city',
        'region',
        'others',
    ];
}
