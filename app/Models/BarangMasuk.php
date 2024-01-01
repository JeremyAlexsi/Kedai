<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'quantity',
        'tanggal_masuk'
    ];

    protected $hidden = [
        'password',
    ];
}
