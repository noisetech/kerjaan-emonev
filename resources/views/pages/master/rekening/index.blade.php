@extends('layouts.admin')

@section('title', 'Rekening')
@section('content')
    <style>
        .previous {
            font-size: 14px !important;
        }

        .next {
            font-size: 14px !important;
        }
    </style>

    <div class="container-fluid mt-3">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rekening</li>
                        </ol>
                    </div>
                    <h4 class="page-title">List Rekening</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    <button type="button" class="btn btn badge bg-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#modal_tambah_akun_rekening">Tambah Rekening</button>
                </div>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table dt-responsive nowrap w-100" style="width: 100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode & Uraian</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->


        {{-- modal tambah akun rekening --}}
        <div class="modal fade" id="modal_tambah_akun_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Akun Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahAkunRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_akun_rekening" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_akun_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_akun_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uaraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_akun_rekening" class="form-control"
                                    style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_tambah_akun_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_akun_rekening" class="form-control"
                                    style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_tambah_akun_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahAkunRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-akun-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal tambah akun rekening --}}


        {{-- modal edit akun rekening --}}

        <div class="modal fade" id="modal_edit_akun_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Ubah Akun Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasEditAkunRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_akun_rekening" method="POST">
                            @csrf

                            <input type="hidden" name="id"
                                class="id_akun_rekening_saat_edit_akun_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_akun_rekening" class="form-control"
                                    id="kode_akun_rekening_saat_edit_akun_rekening">
                                <span class="text-danger error-text kode_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uaraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_akun_rekening" class="form-control"
                                    id="uraian_akun_edit_akun_rekening" style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_edit_akun_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_akun_rekening" class="form-control"
                                    id="deskripsi_akun_edit_akun_rekening" style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_edit_akun_rekening_error"></span>
                            </div>


                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-dark mx-1"
                                    onclick="closeBawahEditAkunRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-edit-akun-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        {{-- akhir modal edit akun rekening --}}


        {{-- modal kelompok rekening --}}
        <div class="modal fade" id="modal_kelompok_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">List Kelompok Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasModalKelompokRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn badge bg-primary btn_tambah_kelompok_rekening text-white"
                                        type="button" onclick="tambahKelompokRekening(this)"
                                        id="idAkunRekeningPadaButtonTambahKelompokRekening">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableKelompokRekening" class="table dt-responsive nowrap w-100"
                                        style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode & Uraian Akun</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal kelompok rekening --}}


        {{-- modal tambah kelompok rekening --}}
        <div class="modal fade" id="modal_tambah_kelompok_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Kelompok Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahKelompokRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_kelompok_rekening" method="POST">
                            @csrf

                            <input type="text" name="akun_rekening_id_tambah_kelompok_rekening"
                                class="akun_rekening_id_tambah_kelompok_rekening form-control">


                            <div class="mb-2">
                                <label for="" class="form-label">Akun Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="akun_rekening_tambah_kelompok_rekening form-control"
                                    readonly>
                                <span class="text-danger error-text kode_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_kelompok_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_kelompok_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uaraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_kelompok_rekening" class="form-control"
                                    style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_tambah_kelompok_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_kelompok_rekening" class="form-control"
                                    style="height: 200px
                                 !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_tambah_kelompok_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahKelompokRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-kelompok-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- modal akhir tambah kelompok rekening --}}

        {{-- modal edit kelompok rekening --}}
        <div class="modal fade" id="modal_edit_kelompok_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Ubah Kelompok Rekening </h5>
                        <button type="button" class="btn-close" onclick="closeAtasUbahKelompokRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_kelompok_rekening" method="POST">
                            @csrf

                            <input type="hidden" name="id_kelompok_rekening_edit_kelompok_rekening"
                                class="id_kelompok_rekening_edit_kelompok_rekening form-control">

                            <input type="hidden" name="akun_rekening_id_edit_kelompok_rekening"
                                class="akun_rekening_id_edit_kelompok_rekening form-control">


                            <div class="mb-2">
                                <label for="" class="form-label">Akun Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode"
                                    class="akun_rekening_edit_kelompok_rekening form-control" readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_kelompok_rekening"
                                    class="kode_edit_kelompok_rekening form-control ">
                                <span class="text-danger error-text kode_edit_kelompok_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_kelompok_rekening"
                                    class="uraian_akun_edit_kelompok_rekening form-control"
                                    style="height: 200px
                             !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_edit_kelompok_rekening_error"></span>
                            </div>


                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_kelompok_rekening"
                                    class="deskripsi_akun_edit_kelompok_rekening form-control"
                                    style="height: 200px
                             !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_edit_kelompok_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahUbahKelompokRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-update-kelompok-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal edit kelompok rekening --}}


        {{-- modal jenis rekening --}}
        <div class="modal fade" id="modal_jenis_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">List Jenis Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasJenisRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn badge bg-primary btn_tambah_jenis_rekening text-white"
                                        type="button" onclick="tambahJenisRekening(this)"
                                        id="idJenisRekeningTambahJenisRekening">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableJenisRekening" class="table dt-responsive nowrap w-100"
                                        style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode & Uraian Akun</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal jenis rekening --}}


        {{-- modal tambah jenis rekening --}}
        <div class="modal fade" id="modal_tambah_jenis_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Jenis Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahJenisRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_jenis_rekening" method="POST">
                            @csrf

                            <input type="text" name="kelompok_rekening_id_tambah_jenis_rekening"
                                class="kelompok_rekening_id_saat_tambah_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Kelompok Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="kelompok_rekening_saat_tambah_jenis_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_jenis_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_jenis_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_jenis_rekening" class="form-control"
                                    style="height: 200px
                             !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_tambah_jenis_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_jenis_rekening" class="form-control"
                                    style="height: 200px
                             !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_tambah_jenis_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahKelompokRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-jenis-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal jenis rekening --}}

        {{-- modal edit jenis rekening --}}
        <div class="modal fade" id="modal_edit_jenis_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Ubah Jenis Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasEditJenisRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_jenis_rekening" method="POST">
                            @csrf

                            <input type="text" name="id_jenis_rekening_edit_jenis_rekening"
                                class=" id_jenis_rekening_edit_jenis_rekening form-control">

                            <input type="text" name="kelompok_rekening_id_edit_jenis_rekening"
                                class="kelompok_rekening_id_saat_edit_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Kelompok Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="kelompok_rekening_saat_edit_jenis_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_jenis_rekening"
                                    class="kode_edit_jenis_rekening form-control">
                                <span class="text-danger error-text kode_tambah_jenis_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_jenis_rekening" class="nomenklatur_edit_jenis_rekening form-control"
                                    style="height: 200px
                         !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_edit_jenis_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_jenis_rekening" class="deskripsi_edit_jenis_rekening form-control"
                                    style="height: 200px
                         !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_edit_jenis_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahEditJenisRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-ubah-jenis-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal edit jenis rekening --}}


        {{-- modal objek rekening --}}
        <div class="modal fade" id="modal_objek_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">List Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn badge bg-primary btn_tambah_objek_rekening text-white"
                                        type="button" onclick="tambahObjekRekening(this)"
                                        id="idJenisRekeningTambahJenisRekening">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableObjekRekening" class="table dt-responsive nowrap w-100"
                                        style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode & Uraian Akun</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- modal objek rekening --}}


        {{-- modal tambah objek rekening rekening --}}
        <div class="modal fade" id="modal_tambah_objek_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_objek_rekening" method="POST">
                            @csrf

                            <input type="text" name="jenis_rekening_id_tambah_jenis_rekening"
                                class="jenis_rekening_id_saat_tambah_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Jenis Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="jenis_rekening_saat_tambah_jenis_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_objek_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_objek_rekening" class="form-control"
                                    style="height: 200px
                             !important;"></textarea>``
                                <span class="text-danger error-text uraian_akun_tambah_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_objek_rekening" class="form-control"
                                    style="height: 200px
                             !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_tambah_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal tambah objek rekening --}}


        {{-- modal edit objek rekening --}}
        <div class="modal fade" id="modal_edit_objek_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Edit Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasEditObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_objek_rekening" method="POST">
                            @csrf


                            <input type="text" name="id_objek_rekening_edit_objek_rekening"
                                class="id_objek_rekening_edit_objek_rekening form-control">

                            <input type="text" name="jenis_rekening_id_edit_jenis_rekening"
                                class="jenis_rekening_id_saat_edit_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Jenis Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="jenis_rekening_saat_edit_jenis_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_objek_rekening"
                                    class="kode_edit_objek_rekening form-control">
                                <span class="text-danger error-text kode_edit_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_objek_rekening" class="nomenklatur_edit_objek_rekening form-control"
                                    style="height: 200px
                         !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_edit_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_objek_rekening" class="deskripsi_edit_objek_rekening form-control"
                                    style="height: 200px
                         !important;"></textarea>
                                <span class="text-danger error-text deskripsi_akun_edit_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahEditObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-ubah-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal edit objek rekening --}}


        {{-- modal rincian objek rekening --}}
        <div class="modal fade" id="modal_rincian_objek_rekening" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">List Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn badge bg-primary btn_tambah_rincian_objek_rekening text-white"
                                        type="button" onclick="tambahRincianObjekRekening(this)"
                                        id="idObjekRekeningTambahJenisRekening">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTableRincianObjekRekening" class="table dt-responsive nowrap w-100"
                                        style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode & Uraian Akun</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal rincian objek rekening --}}

        {{-- modal tambah rincian objek rekening --}}
        <div class="modal fade" id="modal_tambah_rincian_objek_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close"
                            onclick="closeAtasTambahRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_rincian_objek_rekening" method="POST">
                            @csrf

                            <input type="text" name="objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening"
                                class="objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Objek Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text"
                                    class="objek_rekening_saat_tambah_rincian_objek_rekening form-control" readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_rincian_objek_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_rincian_objek_rekening" class="form-control"
                                    style="height: 200px
                           !important;"></textarea>
                                <span
                                    class="text-danger error-text uraian_akun_tambah_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_rincian_objek_rekening" class="form-control"
                                    style="height: 200px
                           !important;"></textarea>
                                <span
                                    class="text-danger error-text deskripsi_akun_tambah_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahRincianObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-rincian-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal tambah rincian objek rekening --}}

        {{-- modal edit rincian objek rekening --}}
        <div class="modal fade" id="modal_edit_rincian_objek_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Ubah Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasEditRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_rincian_objek_rekening" method="POST">
                            @csrf

                            <input type="hidden" name="id_rincian_objek_rekenig_edit_rincian_objek_rekening"
                                id="id_rincian_objek_rekenig_edit_rincian_objek_rekening">

                            <input type="hidden" name="objek_rekening_id_saat_edit_rincian_objek_jenis_rekening"
                                class="objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Objek Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" class="objek_rekening_saat_edit_rincian_objek_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_rincian_objek_rekening"
                                    class="kode_edit_rincian_objek_rekening form-control">
                                <span class="text-danger error-text kode_edit_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_rincian_objek_rekening"
                                    class="uraian_akun_edit_rincian_objek_rekening form-control"
                                    style="height: 200px
                       !important;"></textarea>
                                <span class="text-danger error-text uraian_akun_edit_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_rincian_objek_rekening"
                                    class="deskripsi_akun_edit_rincian_objek_rekening form-control"
                                    style="height: 200px
                       !important;"></textarea>
                                <span
                                    class="text-danger error-text deskripsi_akun_edit_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahEditRincianObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-edit-rincian-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal edit rincian objek rekening --}}


        {{-- modal sub rincian objek rekening --}}
        <div class="modal fade" id="modal_sub_rincian_objek_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-full-width" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">List Sub Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close" onclick="closeAtasSubRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn badge bg-primary btn_tambah_sub_rincian_objek_rekening text-white"
                                        type="button" onclick="tambahSubRincianObjekRekening(this)"
                                        id="idSubRincianObjekRekening">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableSubRincianObjekRekening" class="table dt-responsive nowrap w-100"
                                        style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode & Uraian Akun</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal sub rincian objek rekening --}}


        {{-- modal tambah sub rincian rekening --}}
        <div class="modal fade" id="modal_tambah_sub_rincian_objek_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Sub Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close"
                            onclick="closeAtasTambahSubRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_sub_rincian_objek_rekening" method="POST">
                            @csrf

                            <input type="text"
                                name="rincian_objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening"
                                class="rincian_objek_rekening_id_saat_tambah_sub_rincian_objek_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Rincian Obejk Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text"
                                    class="rincian_objek_rekening_saat_tambah_rincian_objek_rekening form-control"
                                    readonly>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_tambah_sub_rincian_objek_rekening" class="form-control">
                                <span class="text-danger error-text kode_tambah_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_tambah_sub_rincian_objek_rekening" class="form-control"
                                    style="height: 200px
                       !important;"></textarea>
                                <span
                                    class="text-danger error-text uraian_akun_tambah_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_tambah_sub_rincian_objek_rekening" class="form-control"
                                    style="height: 200px
                       !important;"></textarea>
                                <span
                                    class="text-danger error-text deskripsi_akun_tambah_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahTambahSubRincianObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-simpan-sub-rincian-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- modal tambah sub rincian rekening --}}


        {{-- modal edit sub rincian rekening --}}
        <div class="modal fade" id="modal_edit_sub_rincian_rekening" tabindex="-1"
            aria-labelledby="scrollableModalTitle" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Edit Sub Rincian Objek Rekening</h5>
                        <button type="button" class="btn-close"
                            onclick="closeAtasEditSubRincianObjekRekening()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_edit_sub_rincian_objek_rekening" method="POST">
                            @csrf

                            <input type="hidden" name="id_edit_sub_rincian_objek_rekeing"
                                class="id_edit_sub_rincian_objek_rekeing form-control">

                            <input type="hidden" name="rincian_objek_rekening_id_saat_edit_rincian_objek_jenis_rekening"
                                class="rincian_objek_rekening_id_saat_edit_sub_rincian_objek_jenis_rekening form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Rincian Obejk Rekening:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea style="height: 200px !important;"
                                    class="rincian_objek_rekening_saat_edit_rincian_objek_rekening form-control" readonly cols="30"
                                    rows="10"> </textarea>

                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Kode:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="kode_edit_sub_rincian_objek_rekening"
                                    class="kode_edit_sub_rincian_objek_rekening form-control">
                                <span class="text-danger error-text kode_edit_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Uraian Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="uraian_akun_edit_sub_rincian_objek_rekening"
                                    class="uraian_akun_edit_sub_rincian_objek_rekening form-control"
                                    style="height: 200px
                   !important;"></textarea>
                                <span
                                    class="text-danger error-text uraian_akun_edit_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">Deskripsi Akun:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <textarea type="text" name="deskripsi_akun_edit_sub_rincian_objek_rekening"
                                    class="deskripsi_akun_edit_sub_rincian_objek_rekening form-control"
                                    style="height: 200px
                   !important;"></textarea>
                                <span
                                    class="text-danger error-text deskripsi_akun_edit_sub_rincian_objek_rekening_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn badge bg-secondary text-white mx-1"
                                    onclick="closeBawahEditSubRincianObjekRekening()">Batal</button>
                                <button type="submit" class="btn badge bg-primary text-white"
                                    id="btn-edit-sub-rincian-objek-rekening">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal edit sub rincian rekening --}}
    </div>
@endsection

@push('script')
    <script>
        // awal bagian akun rekening
        $(document).ready(function() {
            $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('rekening.data') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });



        function closeAtasTambahAkunRekening() {
            $("#modal_tambah_akun_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_akun_rekening')[0].reset();
            $("#btn-simpan-akun-rekening").text('Simpan');

        }

        function closeBawahTambahAkunRekening() {
            $("#modal_tambah_akun_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_akun_rekening')[0].reset();
            $("#btn-simpan-akun-rekening").text('Simpan');

        }

        $('#modal_tambah_akun_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_akun_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_akun_rekening')[0].reset();
            $("#btn-simpan-akun-rekening").text('Simpan');

        })

        $('#modal_edit_akun_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_akun_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_akun_rekening')[0].reset();
            $("#btn-edit-akun-rekening").text('Simpan');

        })

        function closeAtasEditAkunRekening() {
            $("#edit-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_wilayah')[0].reset();
            $("#btn_edit_wilayah").text('Simpan');

        }

        function closeBawahEditAkunRekening() {
            $("#modal_edit_akun_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_akun_rekening')[0].reset();
            $("#btn-edit-akun-rekening").text('Simpan');

        }

        $("#form_tambah_akun_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rekening.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_akun_rekening").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_akun_rekening')[0].reset();
                        $("#btn-simpan-akun-rekening").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        $("#form_update_akun_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_akun_rekening").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_update_akun_rekening')[0].reset();
                        $("#btn-edit-akun-rekening").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });


        function editAkunRekening(data, bahanIdAkunRekeningEdit) {

            $('#modal_edit_akun_rekening').modal('show');

            $.ajax({
                url: '{{ route('rekeningById') }}',
                method: 'get',
                data: {
                    id: bahanIdAkunRekeningEdit,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.id_akun_rekening_saat_edit_akun_rekening').val(response.id);
                    $('#kode_akun_rekening_saat_edit_akun_rekening').val(response.kode);
                    $('#uraian_akun_edit_akun_rekening').val(response.uraian_akun);
                    $('#deskripsi_akun_edit_akun_rekening').val(response.deskripsi_akun);
                }
            });


        }

        function hapusAkunRekening(data, bahanAkunRekeningIdHapusRekening) {
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('rekening.destroy') }}",
                        data: {
                            id: bahanAkunRekeningIdHapusRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#datatable').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }

        // akhir bagian akun rekening
        function closeAtasModalKelompokRekening() {
            $('#modal_kelompok_rekening').modal('hide');
        }


        function kelompokAkunRekening(data, bahanIdAkunRekeningDataTableAkunRekening) {

            $('#modal_kelompok_rekening').modal('show');

            $('.btn_tambah_kelompok_rekening').attr('id', bahanIdAkunRekeningDataTableAkunRekening);

            $('#datatableKelompokRekening').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('kelompokRekening.data') }}",
                    data: {
                        akun_rekening_id: bahanIdAkunRekeningDataTableAkunRekening
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        }

        function closeAtasTambahKelompokRekening() {
            $("#modal_tambah_kelompok_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_kelompok_rekening')[0].reset();
            $("#btn-simpan-kelompok-rekening").text('Simpan');

        }

        function closeBawahTambahKelompokRekening() {
            $("#modal_tambah_kelompok_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_kelompok_rekening')[0].reset();
            $("#btn-simpan-kelompok-rekening").text('Simpan');

        }


        $('#modal_tambah_kelompok_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_kelompok_rekening").modal('hide');
            $('#form_tambah_kelompok_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-kelompok-rekening").text('Simpan');
        })


        function tambahKelompokRekening(data) {
            $('#modal_kelompok_rekening').modal('hide');
            $('#modal_tambah_kelompok_rekening').modal('show');

            $.ajax({
                url: '{{ route('rekeningById') }}',
                method: 'get',
                data: {
                    id: data.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.akun_rekening_id_tambah_kelompok_rekening').val(response.id);
                    $('.akun_rekening_tambah_kelompok_rekening').val(response.kode + ' ' + response
                        .uraian_akun);
                }
            });
        }

        $("#form_tambah_kelompok_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('kelompokRekening.store') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_kelompok_rekening").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_kelompok_rekening')[0].reset();
                        $("#btn-simpan-kelompok-rekening").text('Simpan');
                        $('#datatableKelompokRekening').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function closeAtasUbahKelompokRekening() {
            $('#modal_edit_kelompok_rekening').modal('hide');
        }

        function closeBawahUbahKelompokRekening() {

        }

        function editKelompokRekening(data, bahanIdKelompokRekeningBuatEditKelompokRekening) {
            $('#modal_kelompok_rekening').modal('hide');
            $('#modal_edit_kelompok_rekening').modal('show');

            $.ajax({
                url: '{{ route('kelompokRekeningById') }}',
                method: 'get',
                data: {
                    id: bahanIdKelompokRekeningBuatEditKelompokRekening,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {


                    $('.id_kelompok_rekening_edit_kelompok_rekening').val(response.id);
                    $('.akun_rekening_id_edit_kelompok_rekening').val(response.akun_rekening_id);
                    $('.akun_rekening_edit_kelompok_rekening').val(response.akun_rekening_kode + ' ' + response
                        .akun_rekening_uraian_akun);
                    $('.kode_edit_kelompok_rekening').val(response.kode)
                    $('.uraian_akun_edit_kelompok_rekening').val(response.uraian_akun)
                    $('.deskripsi_akun_edit_kelompok_rekening').val(response.deskripsi_akun)
                }
            });
        }

        $("#form_update_kelompok_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('kelompok_rekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_kelompok_rekening").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_update_kelompok_rekening')[0].reset();
                        $("#btn-update-kelompok-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function closeAtasUbahKelompokRekening() {
            $("#modal_edit_kelompok_rekening").modal('hide');
            $('#form_update_kelompok_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-update-kelompok-rekening").text('Simpan');

        }

        function closeBawahUbahKelompokRekening() {
            $("#modal_edit_kelompok_rekening").modal('hide');
            $('#form_update_kelompok_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-update-kelompok-rekening").text('Simpan');

        }


        $('#modal_edit_kelompok_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_kelompok_rekening").modal('hide');
            $('#form_update_kelompok_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-update-kelompok-rekening").text('Simpan');
        })




        function hapusKelompokRekening(data, bahanIdKelompokRekeningBuatHapusKelompokRekening) {
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('kelompok_rekening.hapus') }}",
                        data: {
                            id: bahanIdKelompokRekeningBuatHapusKelompokRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#datatableKelompokRekening').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }

        // bagian jenis rekening
        function jenisAkunRekening(data, bahanIdKelompokRekeningUntukJenisRekening) {

            $('#modal_kelompok_rekening').modal('hide');
            $('#modal_jenis_rekening').modal('show');

            $('#dataTableJenisRekening').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('jenis_rekening.data_jenis_rekeing') }}",
                    data: {
                        kelompok_rekening_id: bahanIdKelompokRekeningUntukJenisRekening
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });

            $('.btn_tambah_jenis_rekening').attr('id', bahanIdKelompokRekeningUntukJenisRekening);
        }


        function closeAtasJenisRekening() {
            $('#modal_jenis_rekening').modal('hide');
        }

        $('#modal_jenis_rekening').on('hidden.bs.modal', function(e) {
            $('#modal_jenis_rekening').modal('hide');
        })



        function tambahJenisRekening(data) {


            $('#modal_tambah_jenis_rekening').modal('show');
            $('#modal_jenis_rekening').modal('hide');

            $.ajax({
                url: '{{ route('kelompokRekeningById') }}',
                method: 'get',
                data: {
                    id: data.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('.kelompok_rekening_id_saat_tambah_jenis_rekening').val(response.id);
                    $('.kelompok_rekening_saat_tambah_jenis_rekening').val(response.kode + ' ' + response
                        .uraian_akun);
                }
            });
        }


        function closeAtasTambahJenisRekening() {
            $("#modal_tambah_jenis_rekening").modal('hide');
            $('#form_tambah_jenis_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-jenis-rekening").text('Simpan');

        }

        function closeBawahTambahJenisRekening() {
            $("#modal_tambah_jenis_rekening").modal('hide');
            $('#form_tambah_jenis_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-jenis-rekening").text('Simpan');

        }

        $('#modal_tambah_jenis_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_jenis_rekening").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_jenis_rekening')[0].reset();
            $("#btn-simpan-jenis-rekening").text('Simpan');

        })

        $("#form_tambah_jenis_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('jenis_rekening.tambah') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_jenis_rekening").modal('hide');
                        $('#form_tambah_jenis_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-simpan-jenis-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editJenisRekening(data, idJenisRekeningBuatEditJenisRekening) {
            $('#modal_edit_jenis_rekening').modal('show');
            $('#modal_jenis_rekening').modal('hide');

            $.ajax({
                url: '{{ route('jenisRekeningById') }}',
                method: 'get',
                data: {
                    id: idJenisRekeningBuatEditJenisRekening,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.id_jenis_rekening_edit_jenis_rekening').val(response.id);
                    $('.kelompok_rekening_id_saat_edit_jenis_rekening').val(response.kelompok_rekening_id);
                    $('.kelompok_rekening_saat_edit_jenis_rekening').val(response.kelompok_rekening_kode + ' ' +
                        response.uraian_akun);
                    $('.kode_edit_jenis_rekening').val(response.kode);
                    $('.nomenklatur_edit_jenis_rekening').val(response.uraian_akun);
                    $('.deskripsi_edit_jenis_rekening').val(response.deskripsi_akun);

                }
            });
        }


        function closeAtasEditJenisRekening() {
            $("#modal_edit_jenis_rekening").modal('hide');
            $('#form_update_jenis_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-jenis-rekening").text('Simpan');

        }

        function closeBawahEditJenisRekening() {
            $("#modal_edit_jenis_rekening").modal('hide');
            $('#form_update_jenis_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-jenis-rekening").text('Simpan');
        }

        $('#modal_edit_jenis_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_jenis_rekening").modal('hide');
            $('#form_update_jenis_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-jenis-rekening").text('Simpan');
        })

        $("#form_update_jenis_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('jenisRekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_jenis_rekening").modal('hide');
                        $('#form_update_jenis_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-jenis-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });


        function hapusJenisRekening(data, bahanIdJenisRekeningBuatHapusJenisRekening) {

            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('jenis_rekening.hapus') }}",
                        data: {
                            id: bahanIdJenisRekeningBuatHapusJenisRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#dataTableJenisRekening').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }


        // bagian objek rekening

        function objekRekening(data, idBahanJenisRekening) {
            $('#modal_jenis_rekening').modal('hide');
            $('#modal_objek_rekening').modal('show');

            $('.btn_tambah_objek_rekening').attr('id', idBahanJenisRekening);

            $('#dataTableObjekRekening').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('objek_rekening.data') }}",
                    data: {
                        jenis_rekening_id: idBahanJenisRekening
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        }

        function closeAtasObjekRekening() {
            $('#modal_objek_rekening').modal('hide');
        }

        function tambahObjekRekening(data) {
            $('#modal_objek_rekening').modal('hide');
            $('#modal_tambah_objek_rekening').modal('show');
            $.ajax({
                url: '{{ route('jenisRekeningById') }}',
                method: 'get',
                data: {
                    id: data.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.jenis_rekening_id_saat_tambah_jenis_rekening').val(response.id);
                    $('.jenis_rekening_saat_tambah_jenis_rekening').val(response.kode + ' ' + response
                        .uraian_akun);
                }
            });
        }


        function closeAtasTambahObjekRekening() {
            $("#modal_tambah_objek_rekening").modal('hide');
            $('#form_tambah_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-objek-rekening").text('Simpan');

        }

        function closeBawahTambahObjekRekening() {
            $("#modal_tambah_objek_rekening").modal('hide');
            $('#form_tambah_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-objek-rekening").text('Simpan');

        }

        $('#modal_tambah_objek_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_objek_rekening").modal('hide');
            $('#form_tambah_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-objek-rekening").text('Simpan');

        })

        $("#form_tambah_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('objek_rekening.tambah') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_objek_rekening").modal('hide');
                        $('#form_tambah_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-simpan-objek-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editObjekRekening(data, idObjekRekeningBahanEdit) {
            $('#modal_objek_rekening').modal('hide');

            $('#modal_edit_objek_rekening').modal('show');


            $.ajax({
                url: '{{ route('objekRekeningById') }}',
                method: 'get',
                data: {
                    id: idObjekRekeningBahanEdit,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('.id_objek_rekening_edit_objek_rekening').val(response.id);
                    $('.jenis_rekening_id_saat_edit_jenis_rekening').val(response.jenis_rekening_id);
                    $('.jenis_rekening_saat_edit_jenis_rekening').val(response.jenis_rekening_kode + ' ' +
                        response.jenis_rekening_uraian_akun);
                    $('.kode_edit_objek_rekening').val(response.kode);
                    $('.nomenklatur_edit_objek_rekening').val(response.uraian_akun);
                    $('.deskripsi_edit_objek_rekening').val(response.deskripsi_akun);
                }
            });
        }


        function closeAtasEditObjekRekening() {
            $("#modal_edit_objek_rekening").modal('hide');
            $('#form_update_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-objek-rekening").text('Simpan');

        }

        function closeBawahEditObjekRekening() {
            $("#modal_edit_objek_rekening").modal('hide');
            $('#form_update_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-objek-rekening").text('Simpan');

        }

        $('#modal_tambah_objek_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_objek_rekening").modal('hide');
            $('#form_update_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-objek-rekening").text('Simpan');

        })


        $("#form_update_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('objek_rekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_objek_rekening").modal('hide');
                        $('#form_update_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-ubah-objek-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });


        function hapusObjekRekening(data, bahanIdObjekRekeningHapusObjekRekening) {

            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('objek_rekening.hapus') }}",
                        data: {
                            id: bahanIdObjekRekeningHapusObjekRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#dataTableObjekRekening').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }


        function rincianObjekRekening(data, idBahanRincianObjekRekening) {

            $('#modal_rincian_objek_rekening').modal('show');
            $('#modal_objek_rekening').modal('hide');

            $('#dataTableRincianObjekRekening').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('rincian_objek_rekening.data') }}",
                    data: {
                        objek_rekening_id: idBahanRincianObjekRekening
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });

            $('.btn_tambah_rincian_objek_rekening').attr('id', idBahanRincianObjekRekening);
        }

        function closeAtasRincianObjekRekening() {
            $('#modal_rincian_objek_rekening').modal('hide');
        }

        function tambahRincianObjekRekening(data) {

            $('#modal_rincian_objek_rekening').modal('hide');

            $('#modal_tambah_rincian_objek_rekening').modal('show');

            $.ajax({
                url: '{{ route('objekRekeningById') }}',
                method: 'get',
                data: {
                    id: data.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {


                    $('.objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening').val(response.id);
                    $('.objek_rekening_saat_tambah_rincian_objek_rekening').val(response.kode + ' ' + response
                        .uraian_akun);
                }
            });
        }


        function closeAtasTambahRincianObjekRekening() {
            $("#modal_tambah_rincian_objek_rekening").modal('hide');
            $('#form_tambah_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-rincian-objek-rekening").text('Simpan');

        }

        function closeBawahTambahRincianObjekRekening() {
            $("#modal_tambah_rincian_objek_rekening").modal('hide');
            $('#form_tambah_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-rincian-objek-rekening").text('Simpan');

        }


        $('#modal_tambah_rincian_objek_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_rincian_objek_rekening").modal('hide');
            $('#form_tambah_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-rincian-objek-rekening").text('Simpan');

        })


        $("#form_tambah_rincian_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rincian_objek_rekening.tambah') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_rincian_objek_rekening").modal('hide');
                        $('#form_tambah_rincian_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-simpan-rincian-objek-rekening").text('Simpan');

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editRincianObjekRekening(data, bahanIdEditRincianObjekRekening) {

            $('#modal_edit_rincian_objek_rekening').modal('show');

            $('#modal_rincian_objek_rekening').modal('hide');


            $.ajax({
                url: '{{ route('rincianObjekRekeningById') }}',
                method: 'get',
                data: {
                    id: bahanIdEditRincianObjekRekening,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#id_rincian_objek_rekenig_edit_rincian_objek_rekening').val(response
                        .id);
                    $('.objek_rekening_id_saat_tambah_rincian_objek_jenis_rekening').val(response
                        .objek_rekening_id);
                    $('.objek_rekening_saat_edit_rincian_objek_rekening').val(response.objek_rekening_kode +
                        ' ' + response.objek_rekening_uraian_akun);
                    $('.kode_edit_rincian_objek_rekening').val(response.kode);
                    $('.uraian_akun_edit_rincian_objek_rekening').val(response.uraian_akun);
                    $('.deskripsi_akun_edit_rincian_objek_rekening').val(response.deskripsi_akun);
                }
            });
        }

        function closeAtasEditRincianObjekRekening() {
            $("#modal_edit_rincian_objek_rekening").modal('hide');
            $('#form_update_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-rincian-objek-rekening").text('Simpan');
        }

        function closeBawahEditRincianObjekRekening() {
            $("#modal_edit_rincian_objek_rekening").modal('hide');
            $('#form_update_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-rincian-objek-rekening").text('Simpan');
        }


        $('#modal_edit_rincian_objek_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_rincian_objek_rekening").modal('hide');
            $('#form_update_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-rincian-objek-rekening").text('Simpan');
        })

        $("#form_update_rincian_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('rincian_objek_rekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_rincian_objek_rekening").modal('hide');
                        $('#form_update_rincian_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-rincian-objek-rekening").text('Simpan');
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function hapusRincianObjekRekening(data, idBahanHapusRincianObjekRekening){
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('rincian_objek_rekening.hapus') }}",
                        data: {
                            id: idBahanHapusRincianObjekRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#dataTableRincianObjekRekening').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }

        function subRincianObjekRekening(data, bahanIdUntukSubRincianObjekRekening) {
            console.log(bahanIdUntukSubRincianObjekRekening);
            $('#modal_sub_rincian_objek_rekening').modal('show');
            $('#modal_rincian_objek_rekening').modal('hide');

            $('#datatableSubRincianObjekRekening').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('sub_rincian_objek_rekening.data') }}",
                    data: {
                        rincian_objek_rekening_id: bahanIdUntukSubRincianObjekRekening
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode_uraian_akun',
                        name: 'kode_uraian_akun'
                    },
                    {
                        data: 'deskripsi_akun',
                        name: 'deskripsi_akun',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });

            $('.btn_tambah_sub_rincian_objek_rekening').attr('id', bahanIdUntukSubRincianObjekRekening);
        }


        function closeAtasSubRincianObjekRekening() {
            $('#modal_sub_rincian_objek_rekening').modal('hide');
        }

        function tambahSubRincianObjekRekening(data) {

            $('#modal_tambah_sub_rincian_objek_rekening').modal('show');
            $('#modal_sub_rincian_objek_rekening').modal('hide');
            $.ajax({
                url: '{{ route('rincianObjekRekeningById') }}',
                method: 'get',
                data: {
                    id: data.id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    $('.rincian_objek_rekening_id_saat_tambah_sub_rincian_objek_jenis_rekening').val(response
                        .id)
                    $('.rincian_objek_rekening_saat_tambah_rincian_objek_rekening').val(response.kode + ' ' +
                        response.uraian_akun);
                }
            });
        }


        $("#form_tambah_sub_rincian_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sub_rincian_objek_rekening.simpan') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_tambah_sub_rincian_objek_rekening").modal('hide');
                        $('#form_tambah_sub_rincian_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-simpan-sub-rincian-objek-rekening").text('Simpan');
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function closeAtasTambahSubRincianObjekRekening() {
            $("#modal_tambah_sub_rincian_objek_rekening").modal('hide');
            $('#form_tambah_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-sub-rincian-objek-rekening").text('Simpan');
        }

        function closeBawahTambahSubRincianObjekRekening() {
            $("#modal_tambah_sub_rincian_objek_rekening").modal('hide');
            $('#form_tambah_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-sub-rincian-objek-rekening").text('Simpan');
        }


        $('#modal_tambah_sub_rincian_objek_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_sub_rincian_objek_rekening").modal('hide');
            $('#form_tambah_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-simpan-sub-rincian-objek-rekening").text('Simpan');
        });

        function editSubRincianObjeKRekening(data, idBahanEditSubRincianObjeKrekening) {
            $('#modal_sub_rincian_objek_rekening').modal('hide');
            $('#modal_edit_sub_rincian_rekening').modal('show');

            $.ajax({
                url: '{{ route('subRincianObjekRekeningBy') }}',
                method: 'get',
                data: {
                    id: idBahanEditSubRincianObjeKrekening,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);

                    $('.id_edit_sub_rincian_objek_rekeing').val(response.id);
                    $('.rincian_objek_rekening_id_saat_edit_sub_rincian_objek_jenis_rekening').val(response
                        .rincian_objek_rekening_id);
                    $('.rincian_objek_rekening_saat_edit_rincian_objek_rekening').val(response
                        .rincian_objek_rekening_kode + ' ' + response.uraian_akun);
                    $('.kode_edit_sub_rincian_objek_rekening').val(response.kode);
                    $('.uraian_akun_edit_sub_rincian_objek_rekening').val(response.uraian_akun);
                    $('.deskripsi_akun_edit_sub_rincian_objek_rekening').val(response.deskripsi_akun);
                }
            });
        }


        function closeAtasEditSubRincianObjekRekening() {
            $("#modal_edit_sub_rincian_rekening").modal('hide');
            $('#form_edit_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-sub-rincian-objek-rekening").text('Simpan');
        }

        function closeBawahEditSubRincianObjekRekening() {
            $("#modal_edit_sub_rincian_rekening").modal('hide');
            $('#form_edit_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-sub-rincian-objek-rekening").text('Simpan');
        }


        $('#modal_edit_sub_rincian_rekening').on('hidden.bs.modal', function(e) {
            $("#modal_edit_sub_rincian_rekening").modal('hide');
            $('#form_edit_sub_rincian_objek_rekening')[0].reset();
            $(document).find('span.error-text').empty();
            $("#btn-edit-sub-rincian-objek-rekening").text('Simpan');
        });

        $("#form_edit_sub_rincian_objek_rekening").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sub_rincian_objek_rekening.update') }}',
                method: 'post',
                data: fd,
                cache: false,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: data.status,
                            text: data.message,
                            title: data.title,
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            showConfirmButton: false,
                        });
                        $("#modal_edit_sub_rincian_rekening").modal('hide');
                        $('#form_edit_sub_rincian_objek_rekening')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-sub-rincian-objek-rekening").text('Simpan');
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function hapusSubRincianObjeKRekening(data, idBahanHapusSubRincianObjekRekening) {
            Swal.fire({
                title: 'Anda ingin menghapus data?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('sub_rincian_objek_rekening.hapus') }}",
                        data: {
                            id: idBahanHapusSubRincianObjekRekening,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 3000,
                                    showConfirmButton: false,
                                });
                                $('#datatableSubRincianObjekRekening').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        }
    </script>
@endpush
