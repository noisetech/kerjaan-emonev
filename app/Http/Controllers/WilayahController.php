<?php

namespace App\Http\Controllers;

use App\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WilayahController extends Controller
{
    public function index()
    {
        return view('pages.master.wilayah.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Wilayah::orderBy('wilayah', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="btn-group mb-2">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';

                    $button .= ' <div class="dropdown-menu">
                <button class="dropdown-item" onclick="editWilayah(this, ' . $data->id . ')"><i class="uil-pen"></i><span> Ubah </span></button>';

                    $button .= '<button class="dropdown-item" onclick="hapusWilayah(this, ' . $data->id . ')"><i class="uil-trash-alt"></i><span> Hapus </span></button>
                </div>
            </div>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wilayah' => 'required',
        ], [
            'wilayah.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data = $request->all();

        $finish = Wilayah::create($data);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data wilayah ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function wilayahById(Request $request)
    {
        $wilayah = Wilayah::find($request->id);

        return response()->json($wilayah);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wilayah' => 'required',
        ], [
            'wilayah.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $wilayah = Wilayah::find($request->id);
        $data = $request->all();
        $finish =  $wilayah->update($data);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data wilayah diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $wilayah = Wilayah::find($request->id);
        $finish =  $wilayah->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data wilayah diubah',
                'title' => 'Berhasil'
            ]);
        }
    }
}
