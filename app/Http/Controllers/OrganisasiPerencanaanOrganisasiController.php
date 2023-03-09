<?php

namespace App\Http\Controllers;

use App\Organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganisasiPerencanaanOrganisasiController extends Controller
{
    public function index($id)
    {
        $active = 'organisasi';
        $bidang_id = $id;
        return view('pages.master.perancanaan-organisasi.organisasi.index', [
            'active' => $active,
            'bidang_id' => $bidang_id
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Organisasi::where('bidang_id', $request->bidang_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editOrganisasi(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah organisasi</a>';
                    $button .= '<a onclick="hapusOrganisasi(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus organisasi</a>';
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
            'bidang_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'bidang_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }
        $organisasi = new Organisasi();
        $organisasi->bidang_id = $request->bidang_id;
        $organisasi->kode = $request->kode;
        $organisasi->nomenklatur = $request->nomenklatur;
        $finish =  $organisasi->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Organisasi ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function organisasiById(Request $request)
    {
        $organisasi = Organisasi::find($request->id);

        return response()->json($organisasi);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bidang_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'bidang_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $organisasi = Organisasi::find($request->id);
        $organisasi->bidang_id = $request->bidang_id;
        $organisasi->kode = $request->kode;
        $organisasi->nomenklatur = $request->nomenklatur;
        $finish =  $organisasi->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Organisasi diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request  $request)
    {
        $organisasi = Organisasi::find($request->id);
        $finish =  $organisasi->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Organisasi dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
