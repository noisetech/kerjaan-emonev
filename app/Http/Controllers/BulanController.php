<?php

namespace App\Http\Controllers;

use App\Bulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BulanController extends Controller
{
    public function index()
    {
        return view('pages.master.bulan.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Bulan::orderBy('nama_bulan', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editBulan(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah bulan</a>';
                    $button .= '<a onclick="hapusBulan(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus bulan</a>';


                    return $button;
                })

                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bulan' => 'required'
        ], [
            'nama_bulan.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $bulan = new Bulan();
        $bulan->nama_bulan = $request->nama_bulan;
        $finish =  $bulan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Bulan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function bulanById(Request $request)
    {
        $bulan = Bulan::find($request->id);

        return response()->json($bulan);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bulan' => 'required'
        ], [
            'nama_bulan.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $bulan = Bulan::find($request->id);
        $bulan->nama_bulan = $request->nama_bulan;
        $finish =  $bulan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Bulan diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $bulan = Bulan::find($request->id);

        $finish =  $bulan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Bulan dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
