<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'quantity',
        'total',
        'bayar',
        'kembalian'
    ];

    protected $hidden = [
        'password',
    ];
}
