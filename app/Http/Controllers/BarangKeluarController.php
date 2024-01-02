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

    public function kurang(Request $request, $id)
    {


        $barang = Barang::find($id);

        if ($barang) {
            if ($barang->quantity >= $request->kurangStock && $request->kurangStock > 0) {
                BarangKeluar::create([
                    'nama_barang' => $request->nama_barang,
                    'jenis_barang' => $request->jenis_barang,
                    'quantity' => $request->kurangStock,
                    'harga' => $request->harga
                ]);
                $barang->quantity -= $request->kurangStock;
                $barang->save();
                return redirect()->back()->with(['success' => 'Barang Telah Dikurang']);
            } elseif ($barang->quantity < $request->kurangStock) {
                return redirect()->back()->with(['error' => 'Pengurangan Barang Melebihi Stock']);
            } else {
                return redirect()->back()->with(['error' => 'Pengurangan Barang Tidak Valid']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Barang Tidak Ditemukan']);
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
