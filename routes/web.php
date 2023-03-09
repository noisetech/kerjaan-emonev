<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'DashbaordController@index')
            ->name('dashboard');


        // permission
        Route::get('permission', 'PermissionController@index')
            ->name('permission');
        Route::get('permission.data', 'PermissionController@data')
            ->name('permission.data');
        Route::get('permission/tambahdata', 'PermissionController@create')
            ->name('permission.create');
        Route::post('permission.store', 'PermissionController@store')
            ->name('permission.store');
        Route::get('permission/edit/{id}', 'PermissionController@edit')
            ->name('permission.edit');
        Route::post('permission.update', 'PermissionController@update')
            ->name('permission.update');
        Route::post('permission.destroy', 'PermissionController@destroy')
            ->name('permission.destroy');


        // role
        Route::get('role', 'RoleController@index')
            ->name('role');
        Route::get('role.data', 'RoleController@data')
            ->name('role.data');
        Route::get('role/tambahdata', 'RoleController@create')
            ->name('role.create');
        Route::post('role.store', 'RoleController@store')
            ->name('role.store');
        Route::get('role/edit/{id}', 'RoleController@edit')
            ->name('role.edit');
        Route::post('role.update', 'RoleController@update')
            ->name('role.update');
        Route::post('role.destroy', 'RoleController@destroy')
            ->name('role.destroy');
        Route::get('role.permissions', 'RoleController@permissions')
            ->name('role.permissions');
        Route::get('role.permissionsByRole', 'RoleController@permissionsByRole')
            ->name('role.permissionsByRole');
        Route::post('role.destroyPermissionByRole', 'RoleController@destroyPermissionByRole')
            ->name('role.destroyPermissionByRole');


        // users
        Route::get('users', 'UserController@index')
            ->name('users');
        Route::get('users.data', 'UserController@data')
            ->name('users.data');
        Route::get('users/tambahdata', 'UserController@create')
            ->name('users.create');
        Route::get('users.role', 'UserController@role')
            ->name('users.role');
        Route::get('users.roleByUser', 'UserController@roleByUser')
            ->name('user.roleByUser');
        Route::post('users.store', 'UserController@store')
            ->name('users.store');
        Route::get('users/edit/{id}', 'UserController@edit')
            ->name('user.edit');
        Route::get('users.roleByUser', 'UserController@roleByUser')
            ->name('users.roleByUser');
        Route::post('users.update', 'UserController@update')
            ->name('users.update');

        // tahun
        Route::get('tahun', 'TahunController@index')
            ->name('tahun');
        Route::get('tahun.data', 'TahunController@data')
            ->name('tahun.data');
        Route::get('/tahun/tambahdata', 'TahunController@create')
            ->name('tahun.create');
        Route::get('tahun/edit/{id}', 'TahunController@edit')
            ->name('tahun.edit');
        Route::post('tahun.store', 'TahunController@store')
            ->name('tahun.store');
        Route::post('tahun.update', 'TahunController@update')
            ->name('tahun.update');
        Route::post('tahun.destroy', 'TahunController@destroy')
            ->name('tahun.destroy');

        // bulan
        Route::get('bulan', 'BulanController@index')
            ->name('bulan');
        Route::get('bulan.data', 'BulanController@data')
            ->name('bulan.data');
        Route::post('bulan.hapus', 'BulanController@hapus')
            ->name('bulan.hapus');
        Route::get('bulanById', 'BulanController@bulanById')
            ->name('bulanById');
        Route::post('bulan.update', 'BulanController@update')
            ->name('bulan.update');
        Route::post('bulan.simpan', 'BulanController@simpan')
            ->name('bulan.simpan');

        // wilayah
        Route::get('wilayah', 'WilayahController@index')
            ->name('wilayah');
        Route::get('wilayah.data', 'WilayahController@data')
            ->name('wilayah.data');
        Route::post('wilayah-store', 'WilayahController@store')
            ->name('wilayah.store');
        Route::get('wilayahById', 'WilayahController@wilayahById')
            ->name('wilayahById');
        Route::post('wilayah.update', 'WilayahController@update')
            ->name('wilayah.update');
        Route::post('wilayah.destroy', 'WilayahController@destroy')
            ->name('wilayah.destroy');

        // dinas
        Route::get('dinas', 'DinasController@index')
            ->name('dinas');
        Route::get('dinas.data', 'DinasController@data')
            ->name('dinas.data');
        Route::get('dinas/tambah', 'DinasController@tambah')
            ->name('dinas.tambah');
        Route::get('dinas/edit/{id}', 'DinasController@edit')
            ->name('dinas.edit');
        Route::get('dinas.listWilayah', 'DinasController@listWilayah')
            ->name('dinas.list_wilayah');
        Route::get('dinas.list_user', 'DinasController@list_user')
            ->name('dinas.list_user');
        Route::post('dinas.simpan', 'DinasController@simpan')
            ->name('dinas.simpan');
        Route::get('dinas.wilayahByDinas', 'DinasController@wilayahByDinas')
            ->name('dinas.wilayahByDinas');
        Route::get('dinas.userBydinas', 'DinasController@userByDinas')
            ->name('dinas.userByDinas');
        Route::post('dinas.update', 'DinasController@update')
            ->name('dinas.update');



        // satuan
        Route::get('satuan', 'SatuanController@index')
            ->name('satuan.index');
        Route::get('satuan.data', 'SatuanController@data')
            ->name('satuan.data');
        Route::get('satuan/tambah', 'SatuanController@tambah')
            ->name('satuan_tambah');
        Route::post('satuan.simpan', 'SatuanController@simpan')
            ->name('satuan.simpan');
        Route::get('satuan/edit/{id}', 'SatuanController@edit')
            ->name('satuan.edit');
        Route::post('satuan.update', 'SatuanController@update')
            ->name('satuan.update');
        Route::post('satuan.hapus', 'SatuanController@hapus')
            ->name('satuan.hapus');



        // rekening

        // bagian akun rekening
        Route::get('rekening', 'RekeningController@index')
            ->name('rekening');
        Route::get('rekening.data', 'RekeningController@dataAkunRekening')
            ->name('rekening.data');
        Route::post('rekening.tambah', 'RekeningController@tambahAkunRekening')
            ->name('rekening.store');
        Route::get('rekeningById', 'RekeningController@akunRekeningById')
            ->name('rekeningById');
        Route::post('rekening.ubah', 'RekeningController@ubahAkunRekening')
            ->name('rekening.update');
        Route::post('rekening.hapus', 'RekeningController@hapusAkunRekening')
            ->name('rekening.destroy');

        // bagian kelompok rekening
        Route::get('kelompok_rekening', 'RekeningController@dataKelompokRekening')
            ->name('kelompokRekening.data');
        Route::post('kelompok_rekening.store', 'RekeningController@tambahKelompokRekening')
            ->name('kelompokRekening.store');
        Route::get('kelompokRekeningById', 'RekeningController@kelompokRekeningById')
            ->name('kelompokRekeningById');
        Route::post('kelompok_rekening.update', 'RekeningController@updateKelompokRekening')
            ->name('kelompok_rekening.update');
        Route::post('kelompok_rekeing.hapus', 'RekeningController@hapusKelompokRekening')
            ->name('kelompok_rekening.hapus');



        // bagian jenis rekeing
        Route::get('jenis_rekening.data_jenis_rekeing', 'RekeningController@data_jenis_rekeing')
            ->name('jenis_rekening.data_jenis_rekeing');
        Route::post('jenis_rekening.tambah', 'RekeningController@tambahJenisRekening')
            ->name('jenis_rekening.tambah');
        Route::get('jenisRekeningById', 'RekeningController@jenisRekeningById')
            ->name('jenisRekeningById');
        Route::post('jenis_rekening.update', 'RekeningController@updateJenisRekening')
            ->name('jenisRekening.update');
        Route::post('jenis_rekening.hapus', 'RekeningController@hapusJenisRekening')
            ->name('jenis_rekening.hapus');


        // bagian objek rekening
        Route::get('objek_rekening.data', 'RekeningController@data_objek_rekening')
            ->name('objek_rekening.data');
        Route::get('objekRekeningById', 'RekeningController@objekRekeningById')
            ->name('objekRekeningById');
        Route::post('objek_rekening.tambah', 'RekeningController@tambahObjekRekening')
            ->name('objek_rekening.tambah');
        Route::post('objek_rekening.update', 'RekeningController@updateObjekRekening')
            ->name('objek_rekening.update');
        Route::post('objek_rekening.hapus', 'RekeningController@hapusObjekRekening')
            ->name('objek_rekening.hapus');

        // bagian rincian objek rekening
        Route::get('rincian_objek_rekening.data', 'RekeningController@data_rincian_objek_rekening')
            ->name('rincian_objek_rekening.data');
        Route::post('rincian_objek_rekening.tambah', 'RekeningController@tambah_rincian_objek_rekening')
            ->name('rincian_objek_rekening.tambah');
        Route::get('rincianObjekRekeningById', 'RekeningController@rincianObjekRekeningById')
            ->name('rincianObjekRekeningById');
        Route::post('rincian_objek_rekening.update', 'RekeningController@updateRincianObjekRekening')
            ->name('rincian_objek_rekening.update');
        Route::post('rincian_objek_rekening.hapus', 'RekeningController@hapusRincianObjekRekening')
            ->name('rincian_objek_rekening.hapus');


        // bagian sub rincian objek rekening
        Route::get('sub_rincian_objek_rekening.data', 'RekeningController@dataSubRincianObjekRekening')
            ->name('sub_rincian_objek_rekening.data');
        Route::post('sub_rincian_objek_rekening.simpan', 'RekeningController@tambahSubRincianObjekRekening')
            ->name('sub_rincian_objek_rekening.simpan');
        Route::get('subRincianObjekRekeningBy', 'RekeningController@subRincianObjekRekeningBy')
            ->name('subRincianObjekRekeningBy');
        Route::post('sub_rincian_objek_rekening.update', 'RekeningController@updateSubRincianObjekRekening')
            ->name('sub_rincian_objek_rekening.update');
        Route::post('sub_rincian_objek_rekening.hapus', 'RekeningController@hapusSubRincianObjekRekening')
            ->name('sub_rincian_objek_rekening.hapus');


        // sumber dana
        Route::get('sumber_dana', 'SumberDanaController@index')
            ->name('sumber_dana.index');
        Route::get('sumber_dana.data', 'SumberDanaController@data')
            ->name('sumber_dana.data');
        Route::get('sumber_dana.tambah', 'SumberDanaController@tambah')
            ->name('sumber_dana.tambah');
        Route::post('sumber_dana.simpan', 'SumberDanaController@simpan')
            ->name('sumber_dana.simpan');
        Route::get('sumber_dana/edit/{id}', 'SumberDanaController@edit')
            ->name('sumber_dana.edit');
        Route::post('sumber_dana.update', 'SumberDanaController@update')
            ->name('sumber_dana.update');
        Route::post('sumber_dana.hapus', 'SumberDanaController@hapus')
            ->name('sumber_dana.hapus');


        // urusan
        Route::get('perencanaan/urusan', 'UrusanController@index')
            ->name('perencanaan');
        Route::post('urusan.simpan', 'UrusanController@simpan')
            ->name('urusan.simpan');
        Route::get('urusan.data', 'UrusanController@data')
            ->name('urusan.data');
        Route::post('urusan.hapus', 'UrusanController@hapus')
            ->name('urusan.hapus');
        Route::get('urusanById', 'UrusanController@urusanById')
            ->name('urusanById');
        Route::post('urusan.update', 'UrusanController@update')
            ->name('urusan.update');

        // bidang
        Route::get('perencanaan/bidang/{id}', 'BidangController@index')
            ->name('bidang');
        Route::get('bidang.data', 'BidangController@data')
            ->name('bidang.data');
        Route::post('bidang.simpan', 'BidangController@simpan')
            ->name('bidang.simpan');
        Route::get('bidang.listUrusan', 'BidangController@listUrusan')
            ->name('bidang.listUrusan');
        Route::post('bidang.hapus', 'BidangController@hapus')
            ->name('bidang.hapus');
        Route::get('bidangById', 'BidangController@bidangById')
            ->name('bidangById');
        Route::post('bidang.update', 'BidangController@update')
            ->name('bidang.update');

        Route::get('perencanaan/program/{id}', 'ProgramController@index')
            ->name('program');
        Route::get('program.data', 'ProgramController@data')
            ->name('program.data');
        Route::post('program.simpan', 'ProgramController@simpan')
            ->name('program.simpan');
        Route::get('programById', 'ProgramController@programById')
            ->name('programById');
        Route::post('program.update', 'ProgramController@update')
            ->name('program.update');

        // kegiatan
        Route::get('perencanaan/kegiatan/{id}', 'KegiatanController@index')
            ->name('kegiatan');
        Route::get('kegiatan.data', 'KegiatanController@data')
            ->name('kegiatan.data');
        Route::post('kegiatan.simpan', 'KegiatanController@simpan')
            ->name('kegiatan.simpan');
        Route::get('kegiatanById', 'KegiatanController@kegiatanById')
            ->name('kegiatanById');
        Route::post('kegiatan.update', 'KegiatanController@update')
            ->name('kegiatan.update');
        Route::post('kegiatan.hapus', 'KegiatanController@hapus')
            ->name('kegiatan.hapus');

        // sub kegiatan
        Route::get('perencanaan/sub_kegiatan/{id}', 'SubKegiatanController@index')
            ->name('sub_kegiatan');
        Route::get('sub_kegiatan.data', 'SubKegiatanController@data')
            ->name('sub_kegiatan.data');
        Route::get('sub_kegiatan.listSatuan', 'SubKegiatanController@listSatuan')
            ->name('sub_kegiatan.listSataun');
        Route::get('subKegiatanById', 'SubKegiatanController@subKegiatanById')
            ->name('subKegiatanById');
        Route::post('sub_kegiatan.simpan', 'SubKegiatanController@simpan')
            ->name('sub_kegiatan.simpan');
        Route::post('sub_kegiatan.hapus', 'SubKegiatanController@hapus')
            ->name('sub_kegiatan.hapus');
        Route::get('satuanBySubKegiatan', 'SubKegiatanController@satuanBySubKegiatan')
            ->name('satuanBySubKegiatan');


        // bagiaan perencanaan organisasi
        // bagian urusannya
        Route::get('perencanaan-organisasi/urusan', 'UrusanPerencanaanOrgansaisiController@index')
            ->name('perencanaan_organisasi.urusan');
        Route::get('perencanaan-organisasi.urusan-data', 'UrusanPerencanaanOrgansaisiController@data')
            ->name('perencanaan_organisasi.urusan-data');
        Route::post('perencanaan-organisasi.urusan-simpan', 'UrusanPerencanaanOrgansaisiController@simpan')
            ->name('perencanaan_organisasi.simpan');
        Route::get('perencanaan-organisasi.urusanById', 'UrusanPerencanaanOrgansaisiController@urusanById')
            ->name('perencanaan-organisasi.urusanById');
        Route::get('perencanaan-organisasi.urusan-update', 'UrusanPerencanaanOrgansaisiController@update')
            ->name('perencanaan-organisasi.urusan-update');
        Route::post('perencanaan-organisasi.urusan-hapus', 'UrusanPerencanaanOrgansaisiController@hapus')
            ->name('perencanaan-organisasi.urusan-hapus');

        // baigan bidangnya
        Route::get('perencanaan-organisasi/bidang/{id}', 'BidangPerencanaanOrganisasiController@index')
            ->name('perencanaan-organisasi.bidang');
        Route::get('perencanaan-organisasi/bidang-data', 'BidangPerencanaanOrganisasiController@data')
            ->name('perencanaan-organisasi.bidang_data');
        Route::get('perencanaan-organisasi/bidangById', 'BidangPerencanaanOrganisasiController@bidangById')
            ->name('perencanaan-organisasi.bidangById');
        Route::post('perencanaan-organisasi/bidang-update', 'BidangPerencanaanOrganisasiController@update')
            ->name('perencanaan-organisasi.bidang-update');
        Route::post('perencanaan-organisasi/bidang-hapus', 'BidangPerencanaanOrganisasiController@hapus')
            ->name('perencanaan-organisasi.bidang-hapus');

        // bagian organisasi
        Route::get('perencanaan-organisasi/organisasi/{id}', 'OrganisasiPerencanaanOrganisasiController@index')
            ->name('perencanaan-organisasi.organisasi');
        Route::get('perencanaan-organisasi/organisasi-data', 'OrganisasiPerencanaanOrganisasiController@data')
            ->name('perencanaan-organisasi.organisasi-data');
        Route::post('perencanaan-organisasi/organisasi-simpan', 'OrganisasiPerencanaanOrganisasiController@simpan')
            ->name('perencanaan-organisasi.organisasi-simpan');
        Route::get('perencanaan-organisasi/organisasiById', 'OrganisasiPerencanaanOrganisasiController@organisasiById')
            ->name('perencanaan-organisasi.organisasiById');
        Route::post('perencanaan-organisasi/organisasi-update', 'OrganisasiPerencanaanOrganisasiController@update')
            ->name('perencanaan-organisasi.organisasi-update');
        Route::post('perencanaan-organisasi/organisasi-hapus', 'OrganisasiPerencanaanOrganisasiController@hapus')
            ->name('perencanaan-organisasi.organisasi-hapus');

        // bagian unit
        Route::get('perencanaa-organisasi/unit/{id}', 'UnitPerencanaanOrganisasiController@index')
            ->name('perencanaan-organisasi.unit');
        Route::get('perencanaa-organisasi/unit-data', 'UnitPerencanaanOrganisasiController@data')
            ->name('perencanaan-organisasi.unit-data');
        Route::post('perencanaan-organisai/unit-simpan', 'UnitPerencanaanOrganisasiController@simpan')
            ->name('perencanaan-organisasi.unit-simpan');
        Route::get('perencanaan-organisasi/unitById', 'UnitPerencanaanOrganisasiController@unitById')
            ->name('perencanaan-organisasi.unitById');
        Route::post('perencanaan-organisasi/unit-update', 'UnitPerencanaanOrganisasiController@update')
            ->name('perencanaan-organisasi.unit-update');
        Route::post('perencanaan-organisasi/unit-hapus', 'UnitPerencanaanOrganisasiController@hapus')
            ->name('perencanaan-organisasi.unit-hapus');

        // module anggaran

        // dpa

        Route::get('dpa', 'DpaController@index')
            ->name('dpa');


        Route::get('dpa.listTahun', 'DpaController@listTahunDpa')
            ->name('dpa.listTahun');
        Route::get('dpa.listDinas', 'DpaController@listDinas')
            ->name('dpa.listDinas');
        Route::get('dpa.listUrusan', 'DpaController@listUrusan')
            ->name('dpa.listUrusan');
        Route::get('dpa.listBidang', 'DpaController@listBidang')
            ->name('dpa.listBidang');
        Route::get('dpa.listProgram', 'DpaController@listPorgram')
            ->name('dpa.listProgram');
        Route::get('dpa.listKegiatan', 'DpaController@listKegiatan')
            ->name('dpa.listKegiatan');
        Route::get('dpa.listOrganisasi', 'DpaController@listOrganisasi')
            ->name('dpa.listOrganisasi');
        Route::get('dpa.listUnit', 'DpaController@listUnit')
            ->name('dpa.listUnit');
        Route::post('dpa.simpan', 'DpaController@simpan')
            ->name('dpa.simpan');
        Route::get('dpa.data', 'DpaController@data')
            ->name('dpa.data');
        Route::post('dpa.hapus', 'DpaController@hapus')
            ->name('dpa.hapus');
        Route::get('dpa.contentRenacanaPenarikan', 'DpaController@formRencanaPenarikan')
            ->name('dpa.contentRencanaPenarikan');
        Route::get('dpaBydId', 'DpaController@DpaById')
            ->name('dpaById');
        Route::post('dpa.rencanaPenarikanDpaSimpan', 'DpaController@rencanaPenarikanDpaSimpan')
            ->name('dpa.rencanaPenarikanDpaSimpan');
        Route::get('dpa.formTeamAnggaranDpa', 'DpaController@formTeamAnggaranDpa')
            ->name('dpa.formTeamAnggaranDpa');
        Route::post('dpa.teamAnggaranSimpan', 'DpaController@teamAnggaranSimpan')
        ->name('dpa.teamAnggaranSimpan');

        // laporan pertahun anggaran
        Route::get('anggaran/laporan-pertahun', 'LaporanAnggaranController@laporan_pertahun')
            ->name('angaran.laporan.pertahun');

        Route::get('anggaran/laporan-perbulan', 'LaporanAnggaranController@laporan_perbulan')
            ->name('angaran.laporan.perbulan');

        Route::get('anggaran/laporan-pertriwulan', 'LaporanAnggaranController@laporan_pertriwulan')
            ->name('angaran.laporan.triwulan');
    });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
