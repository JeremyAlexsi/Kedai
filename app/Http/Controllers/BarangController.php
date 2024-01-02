<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    //
    public function index()
    {
        $data = array(
            'title' => 'List Barang',
            'barang' => Barang::all()
        );
        return view('list', $data);
    }

    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/barang', $foto->hashName());
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'quantity' => $request->quantity,
            'harga' => $request->harga,
            'foto' => $foto->hashName()
        ]);

        BarangMasuk::create([
            'nama_barang' => $request->nama_barang,
            'jenis_barang' => $request->jenis_barang,
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with(['success' => 'Barang Telah Diinput']);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        // Periksa apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/barang', $foto->hashName());

            // Hapus foto lama jika sudah ada
            if ($barang->foto) {
                // Hapus foto lama dari penyimpanan
                Storage::delete('public/barang/' . $barang->foto);
            }

            // Update data barang termasuk nama file foto yang baru
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'quantity' => $request->quantity,
                'harga' => $request->harga,
                'foto' => $foto->hashName()
            ]);
            return redirect()->back()->with(['success' => 'Barang Telah Diupdate']);
        } else {
            // Jika tidak ada file foto yang diunggah, hanya update data barang tanpa mengubah foto
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'jenis_barang' => $request->jenis_barang,
                'quantity' => $request->quantity,
                'harga' => $request->harga,
            ]);
            return redirect()->back()->with(['success' => 'Barang Telah Diupdate']);
        }
    }

    public function hapus($id)
    {
        $barang = Barang::find($id);
        Storage::disk('local')->delete('public/barang' . $barang->foto);
        $barang->delete();

        return redirect()->back()->with(['success' => 'Barang Telah Dihapus']);
    }
}
