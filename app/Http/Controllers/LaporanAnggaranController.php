<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanAnggaranController extends Controller
{
    public function laporan_pertahun(){
        return view('pages.anggaran.laporan.laporan_pertahun');
    }

    public function laporan_perbulan(){
        return view('pages.anggaran.laporan.laporan_perbulan');
    }

    public function laporan_pertriwulan(){
        return view('pages.anggaran.laporan.laporan_pertriwulan');
    }
}
