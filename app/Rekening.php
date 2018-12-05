<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $fillable = [
        'nama_bank',
        'nama_rekening',
        'cabang',
        'no_rekening',
    ];
}
