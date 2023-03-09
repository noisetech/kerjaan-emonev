<?php

namespace App\Http\Controllers;

use App\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanController extends Controller
{
    public function index($id)
    {
        $active = 'kegiatan';
        $program_id = $id;


        // dd($program_id);

        return view('pages.master.kegiatan.index', [
            'active' => $active,
            'program_id' => $program_id
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Kegiatan::where('program_id', $request->program_id)->get();

            return datatables()->of($data)
                ->editColumn('kode', function($data){
                    return "<a class='text-secondary' href='".route('sub_kegiatan', $data->id)."'>".$data->kode."</a>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editKegiatan(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah kegiatan</a>';
                    $button .= '<a onclick="hapusKegiatan(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus kegiatan</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'kode'])
                ->make('true');
        }
    }

    public function kegiatanById(Request $request)
    {
        $program = Kegiatan::find($request->id);

        return response()->json($program);
    }

    public function simpan(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'program_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'program_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $kegiatan = new Kegiatan();
        $kegiatan->program_id = $request->program_id;
        $kegiatan->kode = $request->kode;
        $kegiatan->nomenklatur = $request->nomenklatur;
        $finish =  $kegiatan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan ditambah',
                'title' =>  'Berhasil'
            ]);
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'program_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'program_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $kegiatan = Kegiatan::find($request->id);
        $kegiatan->program_id = $request->program_id;
        $kegiatan->kode = $request->kode;
        $kegiatan->nomenklatur = $request->nomenklatur;
        $finish =  $kegiatan->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan diubah',
                'title' =>  'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $kegiatan = Kegiatan::find($request->id);
        $finish =  $kegiatan->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan dihapus',
                'title' =>  'Berhasil'
            ]);
        }
    }
}
