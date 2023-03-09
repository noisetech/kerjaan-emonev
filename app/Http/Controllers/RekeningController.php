<?php

namespace App\Http\Controllers;

use App\AkunRekening;
use App\JenisRekening;
use App\KelompokRekening;
use App\ObjekRekening;
use App\RincianObjekRekening;
use App\SubRincianObjekRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    public function index()
    {
        return view('pages.master.rekening.index');
    }

    public function dataAkunRekening(Request $request)
    {
        if (request()->ajax()) {

            $data = AkunRekening::orderBy('kode', 'ASC')->get();

            return datatables()->of($data)
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editAkunRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah akun rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusAkunRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus akun rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="kelompokAkunRekening(this, ' . $data->id . ')" class="badge badge-success-lighten">Kelompok rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'kode_uraian_akun', 'deskripsi_akun'])
                ->make('true');
        }
    }

    public function tambahAkunRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tambah_akun_rekening' => 'required',
            'uraian_akun_tambah_akun_rekening' => 'required',
            'deskripsi_akun_tambah_akun_rekening' => 'required',
        ], [
            'kode_tambah_akun_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_akun_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_akun_rekening.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $akun_rekening = new AkunRekening();
        $akun_rekening->kode = $request->kode_tambah_akun_rekening;
        $akun_rekening->uraian_akun = $request->uraian_akun_tambah_akun_rekening;
        $akun_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_akun_rekening;
        $finish =   $akun_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Akun rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function akunRekeningById(Request $request)
    {
        $akun_rekening = AkunRekening::find($request->id);

        return response()->json($akun_rekening);
    }

    public function ubahAkunRekening(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_edit_akun_rekening' => 'required',
            'uraian_akun_edit_akun_rekening' => 'required',
            'deskripsi_akun_edit_akun_rekening' => 'required',
        ], [
            'kode_edit_akun_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_akun_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_akun_rekening.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $akun_rekening = AkunRekening::find($request->id);

        $akun_rekening->kode = $request->kode_edit_akun_rekening;
        $akun_rekening->uraian_akun = $request->uraian_akun_edit_akun_rekening;
        $akun_rekening->deskripsi_akun = $request->deskripsi_akun_edit_akun_rekening;
        $finish =   $akun_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Akun rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusAkunRekening(Request $request)
    {
        $akun_rekening = AkunRekening::find($request->id);


        $finish =   $akun_rekening->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Akun rekening dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function dataKelompokRekening(Request $request)
    {
        if (request()->ajax()) {

            $data = KelompokRekening::orderBy('kode', 'ASC')->where('akun_rekening_id', $request->akun_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })
                ->editColumn('nomenklatur', function ($data) {
                    return "<span class='badge badge-warning-lighten' style='fontsize:14px;'>" . $data->nomenklatur . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editKelompokRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah kelompok rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusKelompokRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus kelompok rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="jenisAkunRekening(this, ' . $data->id . ')" class="badge badge-success-lighten">Jenis rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'kode_uraian_akun', 'deskripsi_akun'])
                ->make('true');
        }
    }

    public function tambahKelompokRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'akun_rekening_id_tambah_kelompok_rekening' => 'required',
            'kode_tambah_kelompok_rekening' => 'required',
            'uraian_akun_tambah_kelompok_rekening' => 'required',
            'deskripsi_akun_tambah_kelompok_rekening' => 'required',
        ], [
            'akun_rekening_id_tambah_kelompok_rekening.required' => 'tidak boleh kosong',
            'kode_tambah_kelompok_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_kelompok_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_kelompok_rekening.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $kelompok_rekening = new KelompokRekening();
        $kelompok_rekening->akun_rekening_id = $request->akun_rekening_id_tambah_kelompok_rekening;
        $kelompok_rekening->kode = $request->kode_tambah_kelompok_rekening;
        $kelompok_rekening->uraian_akun = $request->uraian_akun_tambah_kelompok_rekening;
        $kelompok_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_kelompok_rekening;
        $finish =    $kelompok_rekening->save();


        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kelompok rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function kelompokRekeningById(Request $request)
    {
        $kelompokRekening = DB::table('kelompok_rekening')
            ->select(
                'kelompok_rekening.*',
                'akun_rekening.id as akun_rekening_id',
                'akun_rekening.kode as akun_rekening_kode',
                'akun_rekening.uraian_akun as akun_rekening_uraian_akun'
            )
            ->join('akun_rekening', 'akun_rekening.id', '=', 'kelompok_rekening.akun_rekening_id')
            ->where('kelompok_rekening.id', $request->id)->first();

        return response()->json($kelompokRekening);
    }

    public function updateKelompokRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'akun_rekening_id_edit_kelompok_rekening' => 'required',
            'kode_edit_kelompok_rekening' => 'required',
            'uraian_akun_edit_kelompok_rekening' => 'required',
            'deskripsi_akun_edit_kelompok_rekening' => 'required',
        ], [
            'akun_rekening_id_edit_kelompok_rekening.required' => 'tidak boleh kosong',
            'kode_edit_kelompok_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_kelompok_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_kelompok_rekening.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        // dd($request->all());

        $kelompok_rekening = KelompokRekening::find($request->id_kelompok_rekening_edit_kelompok_rekening);
        $kelompok_rekening->akun_rekening_id = $request->akun_rekening_id_edit_kelompok_rekening;
        $kelompok_rekening->kode = $request->kode_edit_kelompok_rekening;
        $kelompok_rekening->uraian_akun = $request->uraian_akun_edit_kelompok_rekening;
        $kelompok_rekening->deskripsi_akun = $request->deskripsi_akun_edit_kelompok_rekening;
        $finish =  $kelompok_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'kelompok rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusKelompokRekening(Request $request)
    {
        $finish = KelompokRekening::where('id', $request->id)->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Kelompok rekening dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    // jenis rekening

    public function data_jenis_rekeing(Request $request)
    {
        if (request()->ajax()) {

            $data = JenisRekening::orderBy('kode', 'ASC')->where('kelompok_rekening_id', $request->kelompok_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editJenisRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah jenis rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusJenisRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus jenis rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="objekRekening(this, ' . $data->id . ')" class="badge badge-success-lighten">Objek rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'deskripsi_akun', 'kode_uraian_akun'])
                ->make('true');
        }
    }

    public function tambahJenisRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tambah_jenis_rekening' => 'required',
            'uraian_akun_tambah_jenis_rekening' => 'required',
            'deskripsi_akun_tambah_jenis_rekening' => 'required',
        ], [
            'kode_tambah_jenis_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_jenis_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_jenis_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $jenis_rekening = new JenisRekening();
        $jenis_rekening->kelompok_rekening_id = $request->kelompok_rekening_id_tambah_jenis_rekening;
        $jenis_rekening->kode = $request->kode_tambah_jenis_rekening;
        $jenis_rekening->uraian_akun = $request->uraian_akun_tambah_jenis_rekening;
        $jenis_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_jenis_rekening;
        $finish = $jenis_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Jenis rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function jenisRekeningById(Request $request)
    {
        $jenis_rekening = DB::table('jenis_rekening')
            ->select(
                'jenis_rekening.*',
                'kelompok_rekening.id as kelompok_rekening_id',
                'kelompok_rekening.kode as kelompok_rekening_kode',
                'kelompok_rekening.uraian_akun as kelompok_rekening_uraian_akun'
            )
            ->join('kelompok_rekening', 'kelompok_rekening.id', '=', 'jenis_rekening.kelompok_rekening_id')
            ->where('jenis_rekening.id', $request->id)
            ->first();

        return response()->json($jenis_rekening);
    }

    public function updateJenisRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_edit_jenis_rekening' => 'required',
            'uraian_akun_edit_jenis_rekening' => 'required',
            'deskripsi_akun_edit_jenis_rekening' => 'required',
        ], [
            'kode_edit_jenis_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_jenis_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_jenis_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $jenis_rekening = JenisRekening::find($request->id_jenis_rekening_edit_jenis_rekening);
        $jenis_rekening->kelompok_rekening_id = $request->kelompok_rekening_id_edit_jenis_rekening;
        $jenis_rekening->kode = $request->kode_edit_jenis_rekening;
        $jenis_rekening->uraian_akun = $request->uraian_akun_edit_jenis_rekening;
        $jenis_rekening->deskripsi_akun = $request->deskripsi_akun_edit_jenis_rekening;
        $finish = $jenis_rekening->save();


        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Jenis rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusJenisRekening(Request $request)
    {

        $finish = JenisRekening::where('id', $request->id)->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Jenis rekening dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }


    // bagian rincian objek rekening
    public function data_objek_rekening(Request $request)
    {
        if (request()->ajax()) {

            $data = ObjekRekening::orderBy('kode', 'ASC')->where('jenis_rekening_id', $request->jenis_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })

                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editObjekRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah objek rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusObjekRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus objek rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="rincianObjekRekening(this, ' . $data->id . ')" class="badge badge-success-lighten">Rincian objek rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'deskripsi_akun', 'kode_uraian_akun'])
                ->make('true');
        }
    }

    public function tambahObjekRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tambah_objek_rekening' => 'required',
            'uraian_akun_tambah_objek_rekening' => 'required',
            'deskripsi_akun_tambah_objek_rekening' => 'required'
        ], [
            'kode_tambah_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $objek_rekening = new ObjekRekening();
        $objek_rekening->jenis_rekening_id = $request->jenis_rekening_id_tambah_jenis_rekening;
        $objek_rekening->kode = $request->kode_tambah_objek_rekening;
        $objek_rekening->uraian_akun = $request->uraian_akun_tambah_objek_rekening;
        $objek_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_objek_rekening;
        $finish = $objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Objek rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function objekRekeningById(Request $request)
    {
        $objek_rekening = DB::table('objek_rekening')
            ->select(
                'objek_rekening.*',
                'jenis_rekening.id as jenis_rekening_id',
                'jenis_rekening.kode as jenis_rekening_kode',
                'jenis_rekening.uraian_akun as jenis_rekening_uraian_akun',
            )
            ->join('jenis_rekening', 'jenis_rekening.id', '=', 'objek_rekening.jenis_rekening_id')
            ->where('objek_rekening.id', $request->id)
            ->first();

        return response()->json($objek_rekening);
    }

    public function updateObjekRekening(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_edit_objek_rekening' => 'required',
            'uraian_akun_edit_objek_rekening' => 'required',
            'deskripsi_akun_edit_objek_rekening' => 'required'
        ], [
            'kode_edit_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $objek_rekening = ObjekRekening::find($request->id_objek_rekening_edit_objek_rekening);
        $objek_rekening->kode = $request->kode_edit_objek_rekening;
        $objek_rekening->uraian_akun = $request->uraian_akun_edit_objek_rekening;
        $objek_rekening->deskripsi_akun = $request->deskripsi_akun_edit_objek_rekening;
        $finish = $objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Objek rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusObjekRekening(Request $request)
    {
        $finsih =    ObjekRekening::where('id', $request->id)->delete();

        if ($finsih) {

            return response()->json([
                'status' => 'success',
                'message' => 'Data objek rekening dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }

    // bagian rincian objek rekening

    public function data_rincian_objek_rekening(Request $request)
    {
        if (request()->ajax()) {

            $data = RincianObjekRekening::orderBy('kode', 'ASC')->where('objek_rekening_id', $request->objek_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editRincianObjekRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah rincian objek rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusRincianObjekRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus rincian objek rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="subRincianObjekRekening(this, ' . $data->id . ')" class="badge badge-success-lighten">Sub rincian objek rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'deskripsi_akun', 'kode_uraian_akun'])
                ->make('true');
        }
    }

    public function tambah_rincian_objek_rekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_tambah_rincian_objek_rekening' => 'required',
            'uraian_akun_tambah_rincian_objek_rekening' => 'required',
            'deskripsi_akun_tambah_rincian_objek_rekening' => 'required'
        ], [
            'kode_tambah_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_rincian_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        // dd($request->all());

        $rincian_objek_rekening = new RincianObjekRekening();
        $rincian_objek_rekening->objek_rekening_id = $request->objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening;
        $rincian_objek_rekening->kode = $request->kode_tambah_rincian_objek_rekening;
        $rincian_objek_rekening->uraian_akun = $request->uraian_akun_tambah_rincian_objek_rekening;
        $rincian_objek_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_rincian_objek_rekening;
        $finish = $rincian_objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rincian objek rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function rincianObjekRekeningById(Request $request)
    {
        $rincian_objek_rekening = DB::table('rincian_objek_rekening')
            ->select(
                'rincian_objek_rekening.*',
                'objek_rekening.id as objek_rekening_id',
                'objek_rekening.kode as objek_rekening_kode',
                'objek_rekening.uraian_akun as objek_rekening_uraian_akun'
            )
            ->join('objek_rekening', 'objek_rekening.id', '=', 'rincian_objek_rekening.objek_rekening_id')
            ->where('rincian_objek_rekening.id', $request->id)
            ->first();

        return response()->json($rincian_objek_rekening);
    }

    public function updateRincianObjekRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_edit_rincian_objek_rekening' => 'required',
            'uraian_akun_edit_rincian_objek_rekening' => 'required',
            'deskripsi_akun_edit_rincian_objek_rekening' => 'required'
        ], [
            'kode_edit_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_rincian_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }



        $rincian_objek_rekening = RincianObjekRekening::find($request->id_rincian_objek_rekenig_edit_rincian_objek_rekening);
        $rincian_objek_rekening->objek_rekening_id = $request->objek_rekening_id_saat_edit_rincian_objek_jenis_rekening;
        $rincian_objek_rekening->kode = $request->kode_edit_rincian_objek_rekening;
        $rincian_objek_rekening->uraian_akun = $request->uraian_akun_edit_rincian_objek_rekening;
        $rincian_objek_rekening->deskripsi_akun = $request->deskripsi_akun_edit_rincian_objek_rekening;
        $finish = $rincian_objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rincian objek rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusRincianObjekRekening(Request $request)
    {
        $finish = RincianObjekRekening::where('id', $request->id)->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Rincian objek rekening dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }


    public function dataSubRincianObjekRekening(Request $request)
    {
        if (request()->ajax()) {

            $data = SubRincianObjekRekening::where('rincian_objek_rekening_id', $request->rincian_objek_rekening_id)->get();

            return datatables()->of($data)
                ->editColumn('deskripsi_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->deskripsi_akun . "</span>";
                })
                ->addColumn('kode_uraian_akun', function ($data) {
                    return "<span class='badge badge-secondary-lighten' style='fontsize:14px;'>" . $data->kode . ' ' . $data->uraian_akun  . "</span>";
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="javascript:void(0);" onclick="editSubRincianObjeKRekening(this, ' . $data->id . ')" class="badge badge-info-lighten">Ubah sub rincian objek rekening</a>';
                    $button .= '<a href="javascript:void(0);" onclick="hapusSubRincianObjeKRekening(this, ' . $data->id . ')" class="mx-1 badge badge-danger-lighten">Hapus sub rincian objek rekening</a>';
                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'deskripsi_akun', 'kode_uraian_akun'])
                ->make('true');
        }
    }

    public function tambahSubRincianObjekRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rincian_objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening' => 'required',
            'kode_tambah_sub_rincian_objek_rekening' => 'required',
            'uraian_akun_tambah_sub_rincian_objek_rekening' => 'required',
            'deskripsi_akun_tambah_sub_rincian_objek_rekening' => 'required'
        ], [
            'rincian_objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening.required' => 'tidak boleh kosong',
            'kode_tambah_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_tambah_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_tambah_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sub_rincian_objek_rekening = new SubRincianObjekRekening();
        $sub_rincian_objek_rekening->rincian_objek_rekening_id = $request->rincian_objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening;
        $sub_rincian_objek_rekening->kode = $request->kode_tambah_sub_rincian_objek_rekening;
        $sub_rincian_objek_rekening->uraian_akun = $request->uraian_akun_tambah_sub_rincian_objek_rekening;
        $sub_rincian_objek_rekening->deskripsi_akun = $request->deskripsi_akun_tambah_sub_rincian_objek_rekening;
        $finish = $sub_rincian_objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub rincian objek rekening ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function subRincianObjekRekeningBy(Request $request)
    {
        $sub_rincian_objek_rekening = DB::table('sub_rincian_objek_rekening')
            ->select(
                'sub_rincian_objek_rekening.*',
                'rincian_objek_rekening.id as rincian_objek_rekening_id',
                'rincian_objek_rekening.kode as rincian_objek_rekening_kode',
                'rincian_objek_rekening.uraian_akun as rincian_objek_rekening_uraian_akun',
            )
            ->join('rincian_objek_rekening', 'rincian_objek_rekening.id', '=', 'sub_rincian_objek_rekening.rincian_objek_rekening_id')
            ->where('sub_rincian_objek_rekening.id', $request->id)
            ->first();

        return response()->json($sub_rincian_objek_rekening);
    }

    public function updateSubRincianObjekRekening(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rincian_objek_rekening_id_saat_edit_rincian_objek_jenis_rekening' => 'required',
            'kode_edit_sub_rincian_objek_rekening' => 'required',
            'uraian_akun_edit_sub_rincian_objek_rekening' => 'required',
            'deskripsi_akun_edit_sub_rincian_objek_rekening' => 'required'
        ], [
            'rincian_objek_rekening_id_saat_edit_rincian_objek_jenis_rekening.required' => 'tidak boleh kosong',
            'kode_edit_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'uraian_akun_edit_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
            'deskripsi_akun_edit_sub_rincian_objek_rekening.required' => 'tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $sub_rincian_objek_rekening = SubRincianObjekRekening::find($request->id_edit_sub_rincian_objek_rekeing);
        $sub_rincian_objek_rekening->rincian_objek_rekening_id = $request->rincian_objek_rekening_id_saat_edit_rincian_objek_jenis_rekening;
        $sub_rincian_objek_rekening->kode = $request->kode_edit_sub_rincian_objek_rekening;
        $sub_rincian_objek_rekening->uraian_akun = $request->uraian_akun_edit_sub_rincian_objek_rekening;
        $sub_rincian_objek_rekening->deskripsi_akun = $request->deskripsi_akun_edit_sub_rincian_objek_rekening;
        $finish = $sub_rincian_objek_rekening->save();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sub rincian objek rekening diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapusSubRincianObjekRekening(Request $request)
    {
        $sub_rincian_objek_rekening = SubRincianObjekRekening::find($request->id);

       $finish =  $sub_rincian_objek_rekening->delete();

       if($finish){
        return response()->json([
            'status' => 'success',
            'message' => 'Sub rincian objek rekening dihapus',
            'title' => 'Berhasil'
        ]);
       }
    }
}
