<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= array(
            'title' => 'Barang Masuk',
            'history_masuk' => BarangMasuk::orderBy('tanggal_masuk', 'desc')->get(),
            'barang_masuk' => Barang::all()
        );
        return view('masuk', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function tambah(Request $request)
    {
        foreach(Barang::all() as $b){
            if($b = $request->nama_barang){
                BarangMasuk::create([
                    'nama_barang' => $request->nama_barang,
                    'jenis_barang' => $b->jenis_barang,
                    'quantity' => $b->tambahStock,
                    'tanggal_masuk' => $request->tanggalMasuk
                ]);
            }
        }

        foreach(Barang::all() as $b){
            if($b = $request->nama_barang){
        $barang = Barang::find($b->id);

        if ($barang) {
            $barang->quantity += $request->tambahStock;
            $barang->save();

            return redirect()->back()->with(['success' => 'Barang Telah Ditambah']);
        }else{
            return redirect()->back()->with(['error' => 'Barang Gagal Ditambah']);
        }
        }
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
    }
}
