<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function index($id)
    {
        $active = 'program';
        $bidang_id = $id;

        // dd($bidang_id);


        return view('pages.master.program.index', [
            'active' => $active,
            'bidang_id' => $bidang_id
        ]);
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = Program::where('bidang_id', $request->bidang_id)->get();

            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = '<a onclick="editProgram(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah program</a>';
                    $button .= '<a onclick="hapusProgram(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus program</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi'])
                ->make('true');
        }
    }

    public function programById(Request $request)
    {
        $program = Program::find($request->id);

        return response()->json($program);
    }

    public function simpan(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'bidang_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'bidang_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $program = new Program();
        $program->bidang_id = $request->bidang_id;
        $program->kode = $request->kode;
        $program->nomenklatur = $request->nomenklatur;
        $finish =  $program->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Program ditambah',
                'title' =>  'Berhasil'
            ]);
        }
    }

    public function update(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'bidang_id' => 'required',
            'kode' => 'required',
            'nomenklatur' => 'required'
        ], [
            'bidang_id.required' => 'tidak boleh kosong',
            'kode.required' => 'tidak boleh kosong',
            'nomenklatur.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $program = Program::find($request->id);
        $program->bidang_id = $request->bidang_id;
        $program->kode = $request->kode;
        $program->nomenklatur = $request->nomenklatur;
        $finish =  $program->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Program ditambah',
                'title' =>  'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $program = Program::find($request->id);
        $finish =  $program->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Program ditambah',
                'title' =>  'Berhasil'
            ]);
        }
    }
}
