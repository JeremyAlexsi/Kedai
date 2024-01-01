<?php

namespace Database\Seeders;

use App\Models\BarangMasuk;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        BarangMasuk::truncate();
        BarangMasuk::create([
            'nama_barang' => 'Cheetos',
            'jenis_barang' => 'Makanan',
            'quantity' => '20',
            'tanggal_masuk' => date("Y-m-d H:i:s"),
        ]);
    }
}
