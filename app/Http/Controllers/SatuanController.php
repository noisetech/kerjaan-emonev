<?php

namespace App\Http\Controllers;

use App\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    public function index()
    {
        return view('pages.master.satuan.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Satuan::orderBy('satuan', 'ASC')->get();

            return datatables()->of($data)

                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('satuan.edit', $data->id) . '" class="badge badge-info-lighten">Ubah satuan</a>';
                    $button .= '<a href="javascript:void(0);" data-id="' . $data->id . '"  class="mx-1 badge badge-danger-lighten hapus-satuan">Hapus satuan</a>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function tambah()
    {
        return view('pages.master.satuan.create');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'satuan' => 'required',
        ], [
            'satuan.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $satuan = new Satuan();
        $satuan->satuan = $request->satuan;
        $finish = $satuan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Satuan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit($id)
    {
        $satuan = Satuan::find($id);

        return view('pages.master.satuan.edit', [
            'satuan' => $satuan
        ]);
    }

    public function update(Request $request)
    {
        $satuan = Satuan::find($request->id);
        $satuan->satuan = $request->satuan;
        $finish = $satuan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Satuan diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $satuan = Satuan::find($request->id);
        $finish =  $satuan->delete();
        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Satuan dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
