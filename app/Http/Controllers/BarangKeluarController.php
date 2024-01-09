<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'title' => 'Barang Keluar',
            'history_keluar' => BarangKeluar::orderBy('tanggal_keluar', 'desc')->get(),
            'barang_keluar' => Barang::all()
        );
        return view('keluar', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function kurang(Request $request)
    {


        foreach(Barang::all() as $b){
            if($b->nama_barang == $request->nama_barang){
                if($b->quantity >= $request->kurangStock){
                BarangKeluar::create([
                    'nama_barang' => $request->nama_barang,
                    'jenis_barang' => $b->jenis_barang,
                    'harga' => $b->harga,
                    'quantity' => $request->kurangStock,
                    'tanggal_keluar' => $request->tanggalKeluar
                ]);
                }elseif ($b->quantity < $request->kurangStock) {
                    return redirect()->back()->with(['error' => 'Pengurangan Barang Melebihi Stock']);
                } else {
                    return redirect()->back()->with(['error' => 'Pengurangan Barang Tidak Valid']);
                }
            }
        }

        foreach(Barang::all() as $b){
            if($b->nama_barang == $request->nama_barang){
        $barang = Barang::find($b->id);

        if ($barang) {
            $barang->quantity -= $request->kurangStock;
            $barang->save();

            return redirect()->back()->with(['success' => 'Barang Telah Dikurang']);
        }else{
            return redirect()->back()->with(['error' => 'Barang Gagal Dikurang']);
        }
        }
        }
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
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }
}
