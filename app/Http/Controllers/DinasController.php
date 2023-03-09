<?php

namespace App\Http\Controllers;

use App\Dinas;
use App\User;
use App\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DinasController extends Controller
{
    public function index()
    {
        return view('pages.master.dinas.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $data = DB::table('dinas')
                ->select('dinas.*', 'wilayah.id as wilayah_id', 'wilayah.wilayah as wilayah_nama_wilayah')
                ->join('wilayah', 'wilayah.id', '=', 'dinas.wilayah_id')
                ->orderBy('dinas.dinas', 'ASC')
                ->get();

            return datatables()->of($data)
                ->editColumn('foto', function ($data) {
                    return $data->foto ? '<img src="' . Storage::url($data->foto) . '" width="50" class="img-thumbnail"/>' : 2;
                })
                ->editColumn('icon', function ($data) {
                    return $data->icon ? '<img src="' . Storage::url($data->icon) . '" width="50" class="img-thumbnail"/>' : 2;
                })

                ->addColumn('wilayah', function ($data) {
                    return Str::ucfirst($data->wilayah_nama_wilayah);
                })
                ->addColumn('akun', function ($data) {
                    $akun_dinas = DB::table('dinas')
                        ->select('dinas.*', 'users.id as users_id', 'users.email as users_email',)
                        ->join('dinas_users', 'dinas_users.dinas_id', '=', 'dinas.id')
                        ->join('users', 'dinas_users.users_id', '=', 'users.id')
                        ->where('dinas.id', $data->id)
                        ->get();

                    if (!empty($akun_dinas)) {
                        $html =  "<ul>";
                        foreach ($akun_dinas as $ad) :
                            $html .= "<li>" . $ad->users_email . "</li>";
                        endforeach;
                        $html .= "</ul>";

                        return $html;
                    } else {
                        return 'Tidak ada akun yang dimiliki';
                    }
                })
                ->addColumn('aksi', function ($data) {
                    $button = '<a href="' . route('dinas.edit', $data->id) . '" class="badge badge-info-lighten">Ubah dinas</a>';
                    $button .= '<a href="javascript:void(0);" data-id="' . $data->id . '"  class="mx-1 badge badge-danger-lighten hapus_sumber_dana">Hapus Dinas dana</a>';

                    return $button;
                })
                ->addIndexColumn()
                ->rawColumns(['aksi', 'akun', 'foto', 'icon'])
                ->make('true');
        }
    }

    public function tambah()
    {
        return view('pages.master.dinas.create');
    }

    public function list_user(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;

            $data = DB::table('users')
                ->select('users.id', 'users.email')
                ->Where('email', 'LIKE', "%$search%")
                ->whereNotIn('name', ['admin', 'super_admin'])
                ->get();
        }
        return response()->json($data);
    }

    public function listWilayah(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('wilayah')
                ->select('wilayah.id', 'wilayah.wilayah')
                ->Where('wilayah', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'icon' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'dinas' => 'required',
            'wilayah_id' => 'required',
            'users_id' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $data_dinas = [
            'wilayah_id' => $request->wilayah_id,
            'dinas' => $request->dinas,
            'foto' => $request->file('foto')->store('assets/foto-dinas', 'public'),
            'icon' => $request->file('foto')->store('assets/icon-dinas', 'public'),
        ];


        $dinas =  DB::table('dinas')->insertGetId($data_dinas);

        $data_dinas_users = array();

        foreach ($request->users_id as $key_users_id => $value_users_id) {
            $data_dinas_users[] = [
                'dinas_id' => $dinas,
                'users_id' => $value_users_id
            ];
        }

        $finish = DB::table('dinas_users')->insert($data_dinas_users);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dinas ditambah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function edit($id)
    {
        $dinas = DB::table('dinas')->where('id', $id)->first();
        return view('pages.master.dinas.edit', [
            'dinas' => $dinas
        ]);
    }

    public function update(Request $request)
    {


        if (empty($request->foto) && empty($request->icon)) {
            $data = [
                'wilayah_id' => $request->id,
                'dinas' => $request->dinas,
            ];
        } elseif (empty($request->foto)) {
            $data = [
                'wilayah_id' => $request->id,
                'dinas' => $request->dinas,
                'icon' => $request->file('foto')->store('assets/icon-dinas', 'public'),
            ];
        } elseif (empty($request->icon)) {
            $data = [
                'wilayah_id' => $request->id,
                'dinas' => $request->dinas,
                'foto' => $request->file('foto')->store('assets/foto-dinas', 'public'),
            ];
        } else {
            $data = [
                'wilayah_id' => $request->id,
                'dinas' => $request->dinas,
                'foto' => $request->file('foto')->store('assets/foto-dinas', 'public'),
                'icon' => $request->file('foto')->store('assets/icon-dinas', 'public'),
            ];
        }

        $dinas =  Dinas::find($request->id);

        $dinas->update($data);


        $finish = $dinas->users()->sync($request->users_id);

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message'  => 'Dinas diubah',
                'title' => 'Berhasil'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $finish = Dinas::where('id', $request->id)->delete();

        if ($finish) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dinas dihapus',
                'title' => 'Berhasil'
            ]);
        }
    }


    public function userByDinas(Request $request)
    {
        $dinas = DB::table('dinas')->select(
            'dinas.id as id_dinas',
            'dinas.dinas as nama_dinas',
            'users.id as  users_id',
            'users.email as users_email'
        )
            ->join('dinas_users', 'dinas_users.dinas_id', '=', 'dinas.id')
            ->join('users', 'dinas_users.users_id', '=', 'users.id')
            ->where('dinas.id', $request->id)
            ->get();

        return response()->json($dinas);
    }

    public function wilayahByDinas(Request $request)
    {
        $wilayahByDinas = DB::table('dinas')
            ->select('dinas.*', 'wilayah.id as wilayah_id', 'wilayah.wilayah as nama_wilayah')
            ->join('wilayah', 'wilayah.id', '=', 'dinas.wilayah_id')
            ->where('dinas.id', $request->id)
            ->get();

        return response()->json($wilayahByDinas);
    }
}
