<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function masuk()
    {
        return view('masuk');
    }

    public function keluar()
    {
        return view('keluar');
    }
}
