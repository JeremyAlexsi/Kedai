<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'hari_ini' => Transaksi::whereDate('tanggal_transaksi', now()->toDateString())
                ->select(Transaksi::raw('SUM(total) as pendapatan_hari_ini'), Transaksi::raw('COUNT(*) as transaksi_hari_ini'))
                ->first(),
            'bulan_ini' => Transaksi::whereYear('tanggal_transaksi', now()->year)
                ->whereMonth('tanggal_transaksi', now()->month)
                ->select(Transaksi::raw('SUM(total) as pendapatan_bulan_ini'), Transaksi::raw('COUNT(*) as transaksi_bulan_ini'))
                ->first(),

        );

        return view('dashboard', $data);
    }

    public function chart()
{
    // Ambil tahun sekarang
    $tahunSekarang = Carbon::now()->year;

    $pendapatanPerBulan = Transaksi::select(
        DB::raw('SUM(total) as total_pendapatan'),
        DB::raw("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan")
    )
        ->whereYear('tanggal_transaksi', $tahunSekarang)
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc')
        ->get();

    // Konversi format bulan
    $formattedData = $pendapatanPerBulan->map(function ($item) {
        $date = \DateTime::createFromFormat('Y-m', $item->bulan);
        $item->bulan = $date->format('M'); // Mengubah 'YYYY-MM' menjadi 'M'
        return $item;
    });

    return response()->json($formattedData);
}

public function chartTransaksi()
{
    // Ambil tahun sekarang
    $tahunSekarang = Carbon::now()->year;

    $transaksiPerBulan = Transaksi::select(
        DB::raw('COUNT(*) as jumlah_transaksi'),
        DB::raw("DATE_FORMAT(tanggal_transaksi, '%Y-%m') as bulan")
    )
        ->whereYear('tanggal_transaksi', $tahunSekarang)
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc')
        ->get();

    // Konversi format bulan
    $formattedData = $transaksiPerBulan->map(function ($item) {
        $date = Carbon::createFromFormat('Y-m', $item->bulan);
        $item->bulan = $date->format('M'); // Mengubah 'YYYY-MM' menjadi 'M'
        return $item;
    });

    return response()->json($formattedData);
}
}
