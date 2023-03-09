<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pengadaan;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashbaordController extends Controller
{
    public function index()
    {
        // $barang = Barang::count();
        // $pengadaan = Pengadaan::count();
        // $unit = Unit::count();
        // $user = User::count();

        return view('pages.dashboard');
    }


}
