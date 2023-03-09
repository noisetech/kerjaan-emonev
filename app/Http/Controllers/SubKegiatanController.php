<?php

namespace App\Http\Controllers;

use App\Satuan;
use App\SubKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubKegiatanController extends Controller
{
    public function index($id)
    {
        $active = 'sub kegiatan';
        $kegiatan_id = $id;

        return view('pages.master.sub-kegiatan.index', [
            'active' => $active,
            'kegiatan_id' => $kegiatan_id
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = SubKegiatan::where('kegiatan_id', $request->kegiatan_id)->get();

            return datatables()->of($data)
                ->addColumn('satuan', function ($data) {
                    return $data->satuan->satuan;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editSubKegiatan(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah sub kegiatan</a>';
                    $button .= '<a onclick="hapusSubKegiatan(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus sub kegiatan</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'satuan'])
                ->make('true');
        }
    }


    public function simpan(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'satuan_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required',
            'kinerja' => 'required',
            'indikator' => 'required',
        ], [
            'kegiatan_id.required' => 'tidak boleh kosong',
            'satuan_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
            'kinerja.required' => 'tidak boleh kosong',
            'indikator.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sub_kegiatan = new SubKegiatan();
        $sub_kegiatan->kegiatan_id = $request->kegiatan_id;
        $sub_kegiatan->satuan_id = $request->satuan_id;
        $sub_kegiatan->kode = $request->kode;
        $sub_kegiatan->nomenklatur = $request->nomenklatur;
        $sub_kegiatan->kinerja = $request->kinerja;
        $sub_kegiatan->indikator = $request->indikator;
        $finish = $sub_kegiatan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub kegiatan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function subKegiatanById(Request $request)
    {
        $sub_kegiatan =  SubKegiatan::find($request->id);

        return response()->json($sub_kegiatan);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kegiatan_id' => 'required',
            'satuan_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required',
            'kinerja' => 'required',
            'indikator' => 'required',
        ], [
            'kegiatan_id.required' => 'tidak boleh kosong',
            'satuan_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong',
            'kinerja.required' => 'tidak boleh kosong',
            'indikator.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sub_kegiatan = SubKegiatan::find($request->id);
        $sub_kegiatan->kegiatan_id = $request->kegiatan_id;
        $sub_kegiatan->satuan_id = $request->satuan_id;
        $sub_kegiatan->kode = $request->kode;
        $sub_kegiatan->nomenklatur = $request->nomenklatur;
        $sub_kegiatan->kinerja = $request->kinerja;
        $sub_kegiatan->indikator = $request->indikator;
        $finish = $sub_kegiatan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub kegiatan ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function listSatuan(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Satuan::select("id", "satuan")
                ->Where('satuan', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function satuanBySubKegiatan(Request $request)
    {
        $satuan = DB::table('sub_kegiatan')
            ->select('satuan.*')
            ->join('satuan', 'satuan.id', '=', 'sub_kegiatan.satuan_id')
            ->get();

        return response()->json($satuan);
    }

    public function hapus(Request $request)
    {
        $sub_kegiatan =  SubKegiatan::find($request->id);

        $finish = $sub_kegiatan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub kegiatan dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }
}
