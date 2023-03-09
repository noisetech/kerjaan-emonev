<?php

namespace App\Http\Controllers;

use App\SumberDana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SumberDanaController extends Controller
{
    public function index()
    {
        return view('pages.master.sumber-dana.index');
    }

    public function data()
    {
        if (request()->ajax()) {

            $data = SumberDana::orderBy('sumber_dana', 'ASC')->get();

            return datatables()->of($data)
                ->editColumn('sumber_dana', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->sumber_dana . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('sumber_dana.edit', $data->id) . '" class="badge badge-info-lighten">Ubah sumber dana</a>';
                    $button .= '<a href="javascript:void(0);" data-id="' . $data->id . '"  class="mx-1 badge badge-danger-lighten hapus_sumber_dana">Hapus sumber dana</a>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'sumber_dana'])
                ->make('true');
        }
    }
    public function tambah()
    {
        return view('pages.master.sumber-dana.create');
    }

    public function simpan(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sumber_dana' => 'required',
        ], [
            'sumber_dana.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sumber_dana = new SumberDana();
        $sumber_dana->sumber_dana = $request->sumber_dana;
        $finish =   $sumber_dana->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sumber dana ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit($id)
    {
        $sumber_dana  = SumberDana::find($id);

        return view('pages.master.sumber-dana.edit', [
            'sumber_dana' => $sumber_dana
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sumber_dana' => 'required',
        ], [
            'sumber_dana.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sumber_dana  = SumberDana::find($request->id);
        $sumber_dana->sumber_dana = $request->sumber_dana;
        $finish =   $sumber_dana->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sumber dana diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $sumber_dana  = SumberDana::find($request->id);

        $finish =  $sumber_dana->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sumber dana dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
