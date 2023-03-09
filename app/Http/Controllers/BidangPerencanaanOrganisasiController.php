<?php

namespace App\Http\Controllers;

use App\Bidang;
use App\Bulan;
use App\Urusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangPerencanaanOrganisasiController extends Controller
{
    public function index($id)
    {
        $active = 'bidang';
        $id_urusan = $id;
        return view('pages.master.perancanaan-organisasi.bidang.index', [
            'active' => $active,
            'id_urusan' => $id_urusan
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Bidang::where('urusan_id', $request->urusan_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editBidang(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah bidang</a>';
                    $button .= '<a onclick="hapusBidang(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus bidang</a>';
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
            'urusan_id' => 'required',
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

        $bidang = new Bidang();
        $bidang->urusan_id = $request->urusan_id;
        $bidang->kode = $request->kode;
        $bidang->nomenklatur = $request->nomenklatur;
        $finish = $bidang->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'urusan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function bidangById(Request $request)
    {
        $bidang = Bidang::find($request->id);

        return response()->json($bidang);
    }

    public function listUrusan(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Urusan::select("id", "kode", "nomenklatur")
                ->Where('kode', 'LIKE', "%$search%")
                ->orWhere('nomenklatur', 'LIKE', "%$search%")
                ->get();
        }

        return response()->json($data);
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

        $bidang = Bidang::find($request->id);
        $bidang->urusan_id = $request->urusan_id;
        $bidang->kode = $request->kode;
        $bidang->nomenklatur = $request->nomenklatur;
        $finish = $bidang->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'bidang diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $urusan = Bidang::find($request->id);
        $finish = $urusan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'bidang dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
