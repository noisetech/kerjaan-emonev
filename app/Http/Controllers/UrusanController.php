<?php

namespace App\Http\Controllers;

use App\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrusanController extends Controller
{
    public function index()
    {
        $active  = 'urusan';
        return view('pages.master.urusan.index', [
            'active' => $active
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Urusan::orderBy('kode', 'ASC')->get();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0)" onclick="editUrusan(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah urusan</a>';
                    $button .= '<a href="javascript:void(0)" onclick="hapusUrusan(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus bulan</a>';

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
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $urusan = new Urusan();
        $urusan->kode = $request->kode;
        $urusan->nomenklatur = $request->nomenklatur;
        $finish = $urusan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'urusan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function urusanById(Request $request)
    {
        $urusan = Urusan::find($request->id);

        return response()->json($urusan);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $urusan = Urusan::find($request->id);
        $urusan->kode = $request->kode;
        $urusan->nomenklatur = $request->nomenklatur;
        $finish = $urusan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'urusan diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $urusan = Urusan::find($request->id);
        $finish = $urusan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'urusan dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
