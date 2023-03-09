<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitPerencanaanOrganisasiController extends Controller
{
    public function  index($id)
    {
        $active = 'unit';
        $organisasi_id = $id;
        return view('pages.master.perancanaan-organisasi.unit.index', [
            'active' => $active,
            'organisasi_id' => $organisasi_id
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Unit::where('organisasi_id', $request->organisasi_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editUnit(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah unit</a>';
                    $button .= '<a onclick="hapusUnit(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus unit</a>';
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
            'organisasi_id' =>  'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'organisasi_id.require' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        // $unit

        $unit = new Unit();
        $unit->organisasi_id = $request->organisasi_id;
        $unit->kode = $request->kode;
        $unit->nomenklatur = $request->nomenklatur;
        $finish = $unit->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Unit ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function unitById(Request $request)
    {
        $unit = Unit::find($request->id);

        return response()->json($unit);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organisasi_id' =>  'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'organisasi_id.require' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        // $unit

        $unit = Unit::find($request->id);
        $unit->organisasi_id = $request->organisasi_id;
        $unit->kode = $request->kode;
        $unit->nomenklatur = $request->nomenklatur;
        $finish = $unit->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Unit diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $unit = Unit::find($request->id);

        $finish = $unit->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Unit dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
