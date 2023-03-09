<?php

namespace App\Http\Controllers;

use App\Bidang;
use App\Kegiatan;
use App\Organisasi;
use App\Program;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DpaController extends Controller
{
    public function index()
    {
        return view('pages.anggaran.dpa.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = DB::table('dpa')
                ->select(
                    'dpa.*',
                    'tahun.tahun as tahun',
                    'dinas.dinas as dinas',
                    'urusan.kode as kode_urusan',
                    'urusan.nomenklatur as nomenklatur_urusan',
                    'bidang.kode as kode_bidang',
                    'bidang.nomenklatur as nomenklatur_bidang',
                    'program.kode as kode_program',
                    'program.nomenklatur as nomenklatur_program',
                    'kegiatan.kode as kode_kegiatan',
                    'kegiatan.nomenklatur as nomenklatur_kegiatan',
                    'organisasi.kode as kode_organisasi',
                    'organisasi.nomenklatur as nomenklatur_organisasi',
                    'unit.kode as kode_unit',
                    'unit.nomenklatur as nomenklatur_unit',
                    'capaian_program_dpa.indikator as capaian_program_dpa_indikator',
                    'capaian_program_dpa.target as capaian_program_dpa_target',
                )
                ->join('tahun', 'tahun.id', '=', 'dpa.tahun_id')
                ->join('dinas', 'dinas.id', '=', 'dpa.dinas_id')
                ->join('urusan', 'urusan.id', '=', 'dpa.urusan_id')
                ->join('bidang', 'bidang.id', '=', 'dpa.bidang_id')
                ->join('program', 'program.id', '=', 'dpa.program_id')
                ->join('kegiatan', 'kegiatan.id', '=', 'dpa.kegiatan_id')
                ->join('organisasi', 'organisasi.id', '=', 'dpa.organisasi_id')
                ->join('unit', 'unit.id', '=', 'dpa.unit_id')
                ->join('capaian_program_dpa', 'dpa.id', '=', 'capaian_program_dpa.dpa_id')
                ->get();

            return datatables()->of($data)
                ->addColumn('tahun', function ($data) {
                    return $data->tahun;
                })
                ->addColumn('urusan', function ($data) {
                    return $data->kode_urusan . ' ' . Str::ucfirst($data->nomenklatur_urusan);
                })
                ->addColumn('bidang', function ($data) {
                    return $data->kode_bidang . ' ' . Str::ucfirst($data->nomenklatur_bidang);
                })
                ->addColumn('program', function ($data) {
                    return $data->kode_program . ' ' . Str::ucfirst($data->nomenklatur_program);
                })
                ->addColumn('kegiatan', function ($data) {
                    return $data->kode_kegiatan . ' ' . Str::ucfirst($data->nomenklatur_kegiatan);
                })
                ->addColumn('organisasi', function ($data) {
                    return $data->kode_organisasi . ' ' . Str::ucfirst($data->nomenklatur_organisasi);
                })
                ->addColumn('unit', function ($data) {
                    return $data->kode_unit . ' ' . Str::ucfirst($data->nomenklatur_unit);
                })
                ->addColumn('sasaran_prgoram', function ($data) {
                    return $data->sasaran_prgoram != null ?  $data->sasaran_prgoram : '-';
                })
                ->addColumn('capaian_program', function ($data) {
                    $html = '<div class="row mt-2">
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <span>Indikator: ' . $data->capaian_program_dpa_indikator . '<span>
                        </div>
                    <div><div class="row mt-2">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <span>Taget: ' . $data->capaian_program_dpa_target . '<span>
                    </div>
                <div>';

                    return $html;
                })
                ->addColumn('indikator_tola_ukur_kinjer_kegiatan_dpa', function ($data) {
                    $bahan_indikator_tola_ukur_kinjer_kegiatan_dpa = DB::table('dpa')
                        ->select(
                            'dpa.*',
                            'indikator_tola_ukur_kinjer_kegiatan_dpa.indikator as indikator',
                            'indikator_tola_ukur_kinjer_kegiatan_dpa.tolak_ukur_kinerja as tolak_ukur_kinerja',
                            'indikator_tola_ukur_kinjer_kegiatan_dpa.target_kinerja as target_kinerja',
                        )
                        ->join('indikator_tola_ukur_kinjer_kegiatan_dpa', 'dpa.id', '=', 'indikator_tola_ukur_kinjer_kegiatan_dpa.dpa_id')
                        ->where('dpa.id', $data->id)
                        ->get();

                    $html = '<div class="table-responsive tabel-indikator_tolak_ukur_kinerja">';
                    $html .= '<table class="table table-boreder">';
                    $html .= '<tr>
                            <th>Indikator</th>
                            <th>Tolak Ukur</th>
                            <th>Target</th>
                            <th>Aksi</th>
                        </tr>';
                    foreach ($bahan_indikator_tola_ukur_kinjer_kegiatan_dpa as $ad) :

                        $html .= '<tr>
                                <td>' . $ad->indikator . '</td>
                                <td>' . $ad->tolak_ukur_kinerja . '</td>
                                <td>' . $ad->target_kinerja . '</td>
                                <td><a href="' . route('satuan.edit', $data->id) . '" class="badge badge-warning-lighten"><i class="uil-edit-alt"></i></a>
                                <a href="' . route('satuan.edit', $data->id) . '" class="badge badge-danger-lighten"><i class="uil-trash-alt"></i></a>
                            </tr>';

                    endforeach;
                    $html .= '</div><table>';
                    return $html;
                })
                ->addColumn('alokasi_tahun', function ($data) {
                    $bahan_alokasi_tahun_dpa = DB::table('dpa')
                        ->select(
                            'dpa.*',
                            'alokasi_tahun_dpa.tahun as tahun_alokasi',
                            'alokasi_tahun_dpa.nominal as nominal_alokasi',

                        )
                        ->join('alokasi_tahun_dpa', 'dpa.id', '=', 'alokasi_tahun_dpa.dpa_id')
                        ->where('dpa.id', $data->id)
                        ->get();

                    $html = '<div class="table-responsive tabel-alokasi_tahun">';
                    $html .= '<table class="table table-boreder">';
                    $html .= '<tr>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>';
                    foreach ($bahan_alokasi_tahun_dpa as $ald) :

                        $html .= '<tr>
                                <td>' . $ald->tahun_alokasi . '</td>
                                <td>' . $ald->nominal_alokasi . '</td>
                                <td><a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Ubah alokasi tahun</a>
                                <a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Hapus alokasi tahun</a>
                                </td>

                            </tr>';

                    endforeach;
                    $html .= '</div><table>';
                    return $html;
                })
                ->addColumn('team_anggaran', function ($data) {
                    $bahan_team_anggaran = DB::table('dpa')
                        ->select(
                            'dpa.*',
                            'team_anggaran_dpa.nama as nama_team_anggaran',
                            'team_anggaran_dpa.nip as nip_team_anggaran',
                            'team_anggaran_dpa.jabatan as jabatan_team_anggaran',

                        )
                        ->join('team_anggaran_dpa', 'dpa.id', '=', 'team_anggaran_dpa.dpa_id')
                        ->where('dpa.id', $data->id)
                        ->get();

                    $html = '<div class="table-responsive tabel-alokasi_tahun">';
                    $html .= '<table class="table table-boreder">';
                    $html .= '<tr>
                            <th>Nama</th>
                            <th>Nip</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>';
                    foreach ($bahan_team_anggaran as $bta) :

                        $html .= '<tr>
                                <td>' . $bta->nama_team_anggaran . '</td>
                                <td>' . $bta->nip_team_anggaran . '</td>
                                <td>' . $bta->jabatan_team_anggaran . '</td>
                                <td><a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Ubah alokasi tahun</a>
                                <a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Hapus alokasi tahun</a>
                                </td>

                            </tr>';

                    endforeach;
                    $html .= '</div><table>';
                    return $html;
                })
                ->addColumn('rencana_penarikan', function ($data) {
                    $bahan_rencana_penarikan = DB::table('dpa')
                        ->select(
                            'dpa.*',
                            'rencana_penarikan_dpa.bulan as bulan_rencana_penarikan_dpa',
                            'rencana_penarikan_dpa.nominal as nominal_rencana_penarikan_dpa',


                        )
                        ->join('rencana_penarikan_dpa', 'dpa.id', '=', 'rencana_penarikan_dpa.dpa_id')
                        ->where('dpa.id', $data->id)
                        ->get();

                    $html = '<div class="table-responsive tabel-alokasi_tahun">';
                    $html .= '<table class="table table-boreder">';
                    $html .= '<tr>
                            <th>Bulan</th>
                            <th>Nominal</th>

                            <th>Aksi</th>
                        </tr>';
                    foreach ($bahan_rencana_penarikan as $bp) :

                        $html .= '<tr>
                                <td>' . $bp->bulan_rencana_penarikan_dpa . '</td>
                                <td>' . number_format($bp->nominal_rencana_penarikan_dpa, 0, '.', '.') . '</td>
                                <td><a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Ubah alokasi tahun</a>
                                <a href="' . route('satuan.edit', $data->id) . '" class="badge badge-secondary-lighten">Hapus alokasi tahun</a>
                                </td>

                            </tr>';

                    endforeach;
                    $html .= '</div><table>';
                    return $html;
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('satuan.edit', $data->id) . '" class="badge badge-info-lighten">Ubah</a>';
                    $button .= '<a onclick="renanaPenarikan(this, ' . $data->id . ')" class="badge badge-info-lighten mx-1">Sub Kegiatan</a>';
                    $button .= '<a onclick="renanaPenarikan(this, ' . $data->id . ')" class="badge badge-info-lighten">Rencana Penarikan</a>';
                    $button .= '<a onclick="teamAnggaran(this, ' . $data->id . ')" class="badge badge-info-lighten mx-1">Team Anggaran</a>';
                    $button .= '<a class="badge badge-info-lighten mx-1" onclick="hapusDpa(this, ' . $data->id . ')"><span> Hapus </span></a>';

                    return $button;
                })
                ->rawColumns([
                    'aksi', 'tahun', 'urusan', 'bidang', 'program', 'kegiatan', 'organisasi', 'unit',
                    'sasaran_program', 'kelompok_sasaran_kegiatan', 'capaian_program', 'indikator_tola_ukur_kinjer_kegiatan_dpa',
                    'alokasi_tahun', 'team_anggaran', 'rencana_penarikan'
                ])
                ->make('true');
        }
    }


    public function simpan(Request $request)
    {
        $data_dpa = [
            'no_dpa' => $request->no_dpa,
            'tahun_id' => $request->tahun_id,
            'dinas_id' => $request->dinas_id,
            'urusan_id' => $request->urusan_id,
            'bidang_id' => $request->bidang_id,
            'program_id' => $request->program_id,
            'kegiatan_id' => $request->kegiatan_id,
            'organisasi_id' => $request->organisasi_id,
            'unit_id' => $request->unit_id,
        ];

        $dpa =   DB::table('dpa')->insertGetId($data_dpa);

        $data_capaian_program_dpa = [
            'dpa_id' => $dpa,
            'indikator' => $request->indikator_capaian_program,
            'target' => $request->target_capain_program
        ];

        DB::table('capaian_program_dpa')->insert($data_capaian_program_dpa);

        $data_indikator_tola_ukur_kinjer_kegiatan_dpa = array();

        foreach ($request->indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan as $key => $value) {
            $data_indikator_tola_ukur_kinjer_kegiatan_dpa[] = [
                'dpa_id' => $dpa,
                'indikator' => $value,
                'tolak_ukur_kinerja' => $request->tolak_ukur_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[$key],
                'target_kinerja' => $request->kinjer_indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[$key]
            ];
        }

        DB::table('indikator_tola_ukur_kinjer_kegiatan_dpa')->insert($data_indikator_tola_ukur_kinjer_kegiatan_dpa);

        $data_alokasi_tahun = array();

        foreach ($request->tahun_alokasi as $key_tahun_alokasi => $value_tahun_alokasi) {
            $data_alokasi_tahun[] = [
                'dpa_id' => $dpa,
                'tahun' => $value_tahun_alokasi,
                'nominal' => $request->nominal_alokasi[$key_tahun_alokasi],
            ];
        }

        $finish =    DB::table('alokasi_tahun_dpa')->insert($data_alokasi_tahun);



        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dpa ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function rencanaPenarikanDpaSimpan(Request $request)
    {
        $data_rencana_penarikan = array();

        foreach ($request->bulan_rencana_penarikan as $key_bulan_rencana_penarikan => $value_bulan_rencana_penarikan) {
            $data_rencana_penarikan[] = [
                'dpa_id' => $request->dpa_id,
                'bulan' => $value_bulan_rencana_penarikan,
                'nominal' => $request->nominal_rencana_penarikan[$key_bulan_rencana_penarikan],
            ];
        }

        $finish =  DB::table('rencana_penarikan_dpa')->insert($data_rencana_penarikan);

        return response()->json([
            'status' => 'success',
            'message' => 'Rencana penarikan ditambah',
            'title' => 'Berhasil'
        ]);
    }

    public function teamAnggaranDpaSimpan(Request $request)
    {
        $data_team_anggaran = array();


        foreach ($request->nama_team_anggaran as $key_nama_team_anggaran => $value_nama_team_anggaran) {
            $data_team_anggaran[] = [
                'dpa_id' => $request->dpa_id,
                'nama' => $value_nama_team_anggaran,
                'nip' => $request->nip_team_anggaran[$key_nama_team_anggaran],
                'jabatan' => $request->jabatan_team_anggaran[$key_nama_team_anggaran],
            ];
        }

        $finish = DB::table('team_anggaran_dpa')->insert($data_team_anggaran);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Team anggaran ditambah',
                'title' => 'Success'
            ]);
        }
    }

    public function DpaById(Request $request)
    {
        $dpa = DB::table('dpa')->select('dpa.*')->where('id', $request->dpa_id)->first();

        return response()->json($dpa);
    }

    public function listTahunDpa(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = DB::table('tahun')
                ->select('tahun.*')
                ->Where('tahun', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listDinas(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = DB::table('dinas')
                ->select('dinas.*')
                ->Where('dinas', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listUrusan(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = DB::table('urusan')
                ->select('urusan.*')
                ->Where('kode', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function listBidang(Request $request)
    {

        $data = Bidang::where('urusan_id', $request->urusan_id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listPorgram(Request $request)
    {
        $data = Program::where('bidang_id', $request->bidang_id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listKegiatan(Request $request)
    {
        $data = Kegiatan::where('program_id', $request->program_id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listOrganisasi(Request $request)
    {
        $data = Organisasi::where('bidang_id', $request->bidang_id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function listUnit(Request $request)
    {
        $data = Unit::where('organisasi_id', $request->organisasi_id)->where('kode', 'LIKE', '%' . request('q') . '%')->get();

        return response()->json($data);
    }

    public function formRencanaPenarikan(Request $request)
    {
        $bulan = DB::table('bulan')->select('bulan.*')->get();

        $html = '<div class="row mb-2">';
        $html .= '<input name="dpa_id" class="dpa_id form-control" type="text">';
        foreach ($bulan as  $b) :
            $html .= '<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <label class="form-label mt-2">Bulan</label>
                        <input name="bulan_rencana_penarikan[]" readonly class="form-control" value="' . $b->nama_bulan . '">
                    </div>';

            $html .= '<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <label class="form-label mt-2">Nominal</label>
                    <input name="nominal_rencana_penarikan[]" class="form-control">
                </div>';
        endforeach;
        $html .= '<div>';

        return response()->json($html);
    }

    public function formTeamAnggaranDpa(Request $request)
    {
        $html = '<div class="row mb-2">
        <input name="dpa_id" class="dpa_id_team_anggaran form-control" type="hidden">
        <div class="d-flex justify-content-between aling-item-center">
            <label for="" class="form-label">Team Anggaran:</label>

            <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                onclick="TambahTeamAnggaran()">
                <i class="uil-plus"></i>
            </a>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 pb-3">
            <input type="text" name="nama_team_anggaran[]" class="form-control"
                placeholder="Nama Pada Team Anggaran">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
            <input type="text" name="nip_team_anggaran[]" class="form-control"
                placeholder="Nip Pada Team Anggaran">
        </div>

        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
            <input type="text" name="jabatan_team_anggaran[]" class="form-control"
                placeholder="Jabatan Pada Team Anggaran">
        </div>
    </div>

    <div id="contentDyanmmicTeamAnggaran">

    </div>';

        return response()->json($html);
    }

    public function hapus(Request $request)
    {
        $finish = DB::table('dpa')->where('id', $request->id)->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dpa dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }


    // bagian sub dpa
}
