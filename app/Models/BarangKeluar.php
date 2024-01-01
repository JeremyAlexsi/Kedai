<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'quantity',
        'harga',
        'tanggal_keluar'
    ];

    protected $hidden = [
        'password',
    ];
}
