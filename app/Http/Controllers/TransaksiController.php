<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Transaksi;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'title' => 'Transaksi',
            'barang' => Barang::all(),
            'keranjang' => Keranjang::all()
        );
        return view('transaksi', $data);
        //
    }

    // public function keranjang(Request $request)
    // {

    //     $barang = Barang::all();
    //     $i = 1;
    //     foreach ($barang as $b) {
    //         if($request->input('jumlah' . $i) > 0 && $request->input('jumlah' . $i) <= $b->quantity){
    //         Keranjang::create([
    //             'nama_barang' => $request->input('nama_barang' . $i),
    //             'harga' => $request->input('harga' . $i),
    //             'jenis_barang'=> $request->input('jenis_barang' . $i),
    //             'quantity' => $request->input('jumlah' . $i),
    //             'subtotal' => $request->input('harga' . $i) *  $request->input('jumlah' . $i)
    //         ]);
    //     }
    //     $i++;
    //     }

    //     return redirect()->back();
    // }

    public function keranjang(Request $request)
    {
        $barang = Barang::all();
        $i = 1;

        foreach ($barang as $b) {
            if ($request->input('jumlah' . $i) > 0 && $request->input('jumlah' . $i) <= $b->quantity) {
                $keranjang = new Keranjang(); // Membuat instance model Keranjang

                $keranjang->nama_barang = $request->input('nama_barang' . $i);
                $keranjang->harga = $request->input('harga' . $i);
                $keranjang->jenis_barang = $request->input('jenis_barang' . $i);
                $keranjang->quantity = $request->input('jumlah' . $i);
                $keranjang->subtotal = $request->input('harga' . $i) * $request->input('jumlah' . $i);

                $keranjang->save(); // Simpan data ke dalam database
            }
            $i++;
        }
        return redirect()->back()->with('keranjang', 'Berhasil masuk keranjang');

        // Setelah data disimpan, Anda bisa melakukan redirect atau tindakan lainnya
    }

    public function simpan(Request $request)
    {
        if($request->kembalian >= 0){
        Transaksi::create([
            'quantity' => $request->quantity,
            'total' => $request->total,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
        ]);

        $keranjang = Keranjang::all();
        $i = 1;
        foreach ($keranjang as $k) {
                $keluar = new BarangKeluar(); // Membuat instance model Keranjang

                $barang = Barang::where('nama_barang', $k->nama_barang)->first();

        if ($barang) {
            // Update the quantity in the Barang model
            $barang->update([
                'quantity' => $barang->quantity - $k->quantity
            ]);
        }

                $keluar->nama_barang = $k->nama_barang;
                $keluar->harga = $k->harga;
                $keluar->jenis_barang = $k->jenis_barang;
                $keluar->quantity = $k->quantity;

                $keluar->save(); // Simpan data ke dalam database

            $i++;
        }

        Keranjang::truncate();
        return redirect()->back()->with('success', 'Transaksi Berhasil');
    }else{
        return redirect()->back()->with('error', 'Uang Tidak Cukup');
    }

    }

    public function history()
    {
        $data = array(
            'title' => 'History Transaksi',
            'transaksi' => Transaksi::orderBy('tanggal_transaksi', 'desc')->get()
        );
        return view('historyTransaksi', $data);
        //
    }

    public function hapus($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->delete();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
