@extends('layouts.admin')

@section('title', 'DPA')
@section('content')
    <style>
        .previous {
            font-size: 14px !important;
        }

        .next {
            font-size: 14px !important;
        }

        select {
            font-size: 12px !important;
        }

        .select2-selection__rendered {
            font-size: 12px !important;
        }

        .tabel-indikator_tolak_ukur_kinerja {
            font-size: 14px;
        }

        .table-awal {
            font-size: 14px;
        }


        table.table {
            width: auto;
        }

        .tabel-indikator_tolak_ukur_kinerja {
            width: 100%;
        }

        .tabel-alokasi_tahun {
            width: 100%;
            font-size: 14px;
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
                            <li class="breadcrumb-item active">DPA</li>
                        </ol>
                    </div>
                    <h4 class="page-title">List DPA</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    <button type="button" class="btn btn-sm btn-primary" onclick="tambahDpa()">Tambah</button>
                </div>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-awal dt-responsive nowrap w-100" style="width: 100%"
                        cellspacing="0">
                        <thead>
                            <tr>

                                <th>No Dpa</th>
                                <th>Tahun</th>
                                <th>Dinas</th>
                                <th>Urusan</th>
                                <th>Bidang</th>
                                <th>Program</th>
                                <th>Kegiatan</th>
                                <th>Organisasi</th>
                                <th>Unit</th>
                                <th>Sasaran Program</th>
                                <th>Capaian Program</th>
                                <th>Alokasi Tahun</th>
                                <th>Indikator Tolak Ukur Kinerja Kegiatan</th>
                                <th>Rencana Penarikan</th>
                                <th>Team Anggaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->


        {{-- modal tambah dpa --}}
        <div class="modal fade" id="tambah-dpa" tabindex="-1" aria-labelledby="scrollableModalTitle" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-full-width  modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahDPA()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_dpa" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label for="" class="form-label">No Dpa:<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="no_dpa" class="form-control">
                                <span class="text-danger error-text wilayah_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Tahun: <sup class="text-danger">*</sup></label>
                                <select name="tahun_id" id="" class="tahun form-select"></select>
                                <span class="text-danger error-text tahun_id_error"></span>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Dinas: <sup class="text-danger">*</sup></label>
                                <select name="dinas_id" id=""
                                    class="dinas form-select select2-selection--multiple"></select>
                                <span class="text-danger error-text users_id_error"></span>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Urusan: <sup class="text-danger">*</sup></label>
                                <select name="urusan_id" id="" class="urusan form-select"></select>
                                <span class="text-danger error-text users_id_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Bidang: <sup class="text-danger">*</sup></label>
                                <select name="bidang_id" id="" class="bidang form-select" disabled>
                                    <option value="">--Pilih Urusan Dahulu--</option>
                                </select>
                                <span class="text-danger error-text bidang_id_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Program: <sup class="text-danger">*</sup></label>
                                <select name="program_id" id=""
                                    class="program form-select select2-selection--multiple" disabled>
                                    <option value="">--Pilih Bidang Dahulu--</option>
                                </select>
                                <span class="text-danger error-text program_error"></span>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Kegiatan: <sup class="text-danger">*</sup></label>
                                <select name="kegiatan_id" id=""
                                    class="kegiatan form-select select2-selection--multiple" disabled>
                                    <option value="">--Pilih Program Dahulu--</option>
                                </select>
                                <span class="text-danger error-text program_error"></span>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Organisasi: <sup
                                        class="text-danger">*</sup></label>
                                <select name="organisasi_id" id=""
                                    class="organisasi form-select select2-selection--multiple" disabled>
                                    <option value="">--Pilh Bidang Dahulu--</option>
                                </select>
                                <span class="text-danger error-text users_id_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Unit: <sup class="text-danger">*</sup></label>
                                <select name="unit_id" id=""
                                    class="unit form-select select2-selection--multiple" disabled>
                                    <option value="">--Pilih Organisasi Dahulu--</option>
                                </select>
                                <span class="text-danger error-text users_id_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-lable">Capaian Program</label>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                    <input type="text" name="indikator_capaian_program" class="form-control"
                                        placeholder="Indikator Capain Program">
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <input type="text" name="target_capain_program" class="form-control"
                                        placeholder="Target Capaian Program">
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Indikator dan Tolok Ukur Kinerja Kegiatan</label>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Indikator</label>
                                    <input type="text"
                                        name="indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" readonly value="{{ Str::ucfirst('capaian program') }}">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Total Ukur Kinjera</label>
                                    <input type="text"
                                        name="tolak_ukur_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" onkeydown="myFunction()"
                                        id="value_tolak_ukur_kinerja_capaian_program">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Target Kinerja</label>
                                    <input type="text"
                                        name="kinjer_indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Indikator</label>
                                    <input type="text"
                                        name="indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" readonly value="{{ Str::ucfirst('masukan') }}">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Total Ukur Kinjera</label>
                                    <input type="text"
                                        name="tolak_ukur_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Target Kinerja</label>
                                    <input type="text"
                                        name="kinjer_indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" data-toggle="input-mask" data-mask-format="#.##0.000"
                                        data-reverse="true">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Indikator</label>
                                    <input type="text"
                                        name="indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" readonly value="{{ Str::ucfirst('keluaran') }}">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Total Ukur Kinjera</label>
                                    <input type="text"
                                        name="tolak_ukur_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Target Kinerja</label>
                                    <input type="text"
                                        name="kinjer_indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Indikator</label>
                                    <input type="text"
                                        name="indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control" readonly value="{{ Str::ucfirst('hasil') }}">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Total Ukur Kinjera</label>
                                    <input type="text"
                                        name="tolak_ukur_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <label for="">Target Kinerja</label>
                                    <input type="text"
                                        name="kinjer_indikator_pada_indikator_dan_tolak_ukur_kinerja_kegiatan[]"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="d-flex justify-content-between aling-item-center">
                                    <label for="" class="form-label">Alokasi Tahun:</label>

                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary"
                                        onclick="TambahAlokasiTahun()">
                                        <i class="uil-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-3">
                                    <input type="text" name="tahun_alokasi[]" class="form-control"
                                        placeholder="Tahun Alokasi">
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <input type="text" name="nominal_alokasi[]" class="form-control"
                                        placeholder="Nominal Alokasi">
                                </div>
                            </div>

                            <div id="content_tambahan_alokasi_tahun">

                            </div>



                            <div class="mb-3">
                                <label for="" class="form-label">Sasaran Program: <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="sasaran_program" class="form-control">
                                <span class="text-danger error-text users_id_error"></span>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Kelompok Sasaran Kegiatan: <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="kelompo_sasaran_kegiatan" class="form-control">
                                <span class="text-danger error-text users_id_error"></span>
                            </div>








                            <div class="d-flex justify-content-end align-items-center mt-2">

                                <button type="submit" class="btn btn-success" id="btn_simpan_dpa">Simpan</button>
                            </div>
                        </form>
                    </div>



                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal tambah dpa --}}


        {{-- modal tambah rencana penarikan --}}

        <div class="modal fade" id="rencana_penarikan_dpa" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg  modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Rencana Penarikan</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahRencanaPenarikan()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_rencana_penarikan" method="POST">
                            @csrf


                            <div id="contentFormRencanaPenarikan">

                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">

                                <button type="submit" class="btn btn-success"
                                    id="btn_simpan_rencana_penarikan">Simpan</button>
                            </div>
                        </form>
                    </div>



                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal rencana penarikan --}}


        {{-- modal team anggaran --}}
        <div class="modal fade" id="team_anggaran_dpa" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl  modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Team Anggaran</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahRencanaPenarikan()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_rencana_penarikan" method="POST">
                            @csrf


                            <div id="contentTeamAnggaran">

                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">

                                <button type="submit" class="btn btn-success"
                                    id="btn_simpan_rencana_penarikan">Simpan</button>
                            </div>
                        </form>
                    </div>



                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        {{-- akhir modal team anggaran --}}

    </div>
@endsection

@push('script')
    <script>
        function TambahAlokasiTahun() {
            $html = `
                <div class="row mb-1">

                    <div class="d-flex justitfy-content-end aling-item-center mb-2">
                    <a class="btn btn-sm btn-danger delete_dynamic_tahun"">
                        <i class="uil-trash-alt"></i>
                    </a>
                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pb-3">
                                    <input type="text" name="tahun_alokasi[]" class="form-control" placeholder="Tahun Alokasi">
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                    <input type="text" name="nominal_alokasi[]" class="form-control" placeholder="Nominal Alokasi">
                                </div>
                            </div>
                `;
            $('#content_tambahan_alokasi_tahun').append($html);
        }

        function teamAnggaran(data, idDpaTeamAnggaran) {
            $('#team_anggaran_dpa').modal('show');

            $.ajax({
                url: '{{ route('dpa.formTeamAnggaranDpa') }}',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#contentTeamAnggaran').html(response);

                }
            });

            $.ajax({
                url: '{{ route('dpaById') }}',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                    dpa_id: idDpaTeamAnggaran
                },
                success: function(response) {
                    $('.dpa_id_team_anggaran').val(response.id);
                }
            });


        }


        function TambahTeamAnggaran() {
            $html = `
            <div class="row mb-1">
                <div class="d-flex justitfy-content-end aling-item-center mb-2">
                    <a class="btn btn-sm btn-danger delete_dynamic_team_anggaran"">
                        <i class="uil-trash-alt"></i>
                    </a>
                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 pb-3">
                                    <input type="text" name="nama_team_anggaran[]" class="form-control"
                                        placeholder="Nama Pada Team Anggaran">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <input type="text" name="nip_team_anggaran[]" class="form-control"
                                        placeholder="Nip Pada Team Anggaran">
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <input type="text" name="jabatan_team_anggaran[]" class="form-control"
                                        placeholder="Jabatan Pada Team Anggaran">
                                </div>
                            </div>
                `;
            $('#contentDyanmmicTeamAnggaran').append($html);
        }


        $(document).on('click', '.delete_dynamic_tahun', function() {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.delete_dynamic_team_anggaran', function() {
            $(this).parent().parent().remove();
        });

        $(document).ready(function() {
            $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('dpa.data') }}",
                },
                columns: [{
                        data: 'no_dpa',
                        name: 'no_dpa'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'dinas',
                        name: 'dinas'
                    },
                    {
                        data: 'urusan',
                        name: 'urusan'
                    },
                    {
                        data: 'bidang',
                        name: 'bidang'
                    },
                    {
                        data: 'program',
                        name: 'program'
                    },

                    {
                        data: 'kegiatan',
                        name: 'kegiatan'
                    },

                    {
                        data: 'organisasi',
                        name: 'organisasi'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'sasaran_prgoram',
                        name: 'sasaran_prgoram'
                    },
                    {
                        data: 'capaian_program',
                        name: 'capaian_program'
                    },

                    {
                        data: 'alokasi_tahun',
                        name: 'alokasi_tahun'
                    },

                    {
                        data: 'indikator_tola_ukur_kinjer_kegiatan_dpa',
                        name: 'indikator_tola_ukur_kinjer_kegiatan_dpa'
                    },
                    {
                        data: 'rencana_penarikan',
                        name: 'rencana_penarikan'
                    },


                    {
                        data: 'team_anggaran',
                        name: 'team_anggaran'
                    },


                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        function closeAtasTambahDPA() {
            $("#tambah-dpa").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_dpa')[0].reset();
            $("#btn-selanjutnya-dpa").text('Selanjutnya');
            $('#dataTable').DataTable().ajax.reload();
        }


        function closeBawahEditWilayah() {
            $("#tambah-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_wilayah')[0].reset();
            $("#btn_edit_wilayah").text('Simpan');
            $('#dataTable').DataTable().ajax.reload();
        }

        function closeAtasTambahRencanaPenarikan() {
            $('#rencana_penarikan_dpa').modal('hide');
        }

        function renanaPenarikan(data, IdBahanDpaRencanaPenarikan) {
            $('#rencana_penarikan_dpa').modal('show');

            $.ajax({
                url: '{{ route('dpa.contentRencanaPenarikan') }}',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#contentFormRencanaPenarikan').html(response);

                }
            });

            $.ajax({
                url: '{{ route('dpaById') }}',
                method: 'get',
                data: {
                    _token: '{{ csrf_token() }}',
                    dpa_id: IdBahanDpaRencanaPenarikan
                },
                success: function(response) {
                    $('.dpa_id').val(response.id);
                }
            });
        }

        $(document).ready(function() {
            $('.tahun').select2({
                dropdownParent: $("#tambah-dpa"),
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Tahun--',
                ajax: {
                    url: "{{ route('dpa.listTahun') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.tahun,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.dinas').select2({
                dropdownParent: $("#tambah-dpa"),
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Dinas--',
                ajax: {
                    url: "{{ route('dpa.listDinas') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.dinas,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.urusan').select2({
                dropdownParent: $("#tambah-dpa"),
                minimumInputLength: 1,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Urusan--',
                ajax: {
                    url: "{{ route('dpa.listUrusan') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.kode + ' ' + item.nomenklatur,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $(document).ready(function() {
            $('.urusan').change(function() {
                let urusan_id_tambah = $('.urusan').val();
                $('.bidang').removeAttr('disabled');
                $('.bidang').select2({
                    dropdownParent: $("#tambah-dpa"),
                    minimumInputLength: 1,
                    maximumInputLength: 50,
                    allowClear: true,
                    placeholder: '-- Pilih Bidang--',
                    ajax: {
                        url: "{{ route('dpa.listBidang') }}",
                        data: {
                            urusan_id: urusan_id_tambah,
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kode + ' ' + item.nomenklatur,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            });
        });


        $(document).ready(function() {
            $('.bidang').change(function() {
                let bidang_id_tambah = $('.bidang').val();
                $('.program').removeAttr('disabled');
                $('.program').select2({
                    dropdownParent: $("#tambah-dpa"),
                    minimumInputLength: 1,
                    maximumInputLength: 50,
                    allowClear: true,
                    placeholder: '-- Pilih Program--',
                    ajax: {
                        url: "{{ route('dpa.listProgram') }}",
                        data: {
                            bidang_id: bidang_id_tambah,
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kode + ' ' + item.nomenklatur,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });


                $('.organisasi').removeAttr('disabled');
                $('.organisasi').select2({
                    dropdownParent: $("#tambah-dpa"),
                    minimumInputLength: 1,
                    maximumInputLength: 50,
                    allowClear: true,
                    placeholder: '-- Pilih Organisasi--',
                    ajax: {
                        url: "{{ route('dpa.listOrganisasi') }}",
                        data: {
                            bidang_id: bidang_id_tambah,
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kode + ' ' + item.nomenklatur,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            });

            $('.organisasi').change(function() {
                let organisasi_id_tambah = $('.organisasi').val();
                $('.unit').removeAttr('disabled');
                $('.unit').select2({
                    dropdownParent: $("#tambah-dpa"),
                    minimumInputLength: 1,
                    maximumInputLength: 50,
                    allowClear: true,
                    placeholder: '-- Pilih Unit--',
                    ajax: {
                        url: "{{ route('dpa.listUnit') }}",
                        data: {
                            organisasi_id: organisasi_id_tambah,
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kode + ' ' + item.nomenklatur,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });


            });
        });

        $(document).ready(function() {
            $('.program').change(function() {
                let program_id_tambah = $('.program').val();
                $('.kegiatan').removeAttr('disabled');
                $('.kegiatan').select2({
                    dropdownParent: $("#tambah-dpa"),
                    minimumInputLength: 1,
                    maximumInputLength: 50,
                    allowClear: true,
                    placeholder: '-- Pilih Kegiatan--',
                    ajax: {
                        url: "{{ route('dpa.listKegiatan') }}",
                        data: {
                            program_id: program_id_tambah,
                        },
                        dataType: 'json',
                        delay: 500,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.kode + ' ' + item.nomenklatur,
                                        id: item.id
                                    }
                                })
                            };
                        }
                    }
                });
            });
        });


        function tambahDpa() {
            $("#tambah-dpa").modal('show');


        }


        $("#form_tambah_rencana_penarikan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.rencanaPenarikanDpaSimpan') }}',
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
                        $("#rencana_penarikan_dpa").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_rencana_penarikan')[0].reset();
                        $("#btn_simpan_rencana_penarikan").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        });

        $("#form_tambah_dpa").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dpa.simpan') }}',
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
                        $("#tambah-dpa").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_dpa')[0].reset();
                        $("#btn_simpan_dpa").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        });

        function hapusDpa(data, idBahanHapusDpa) {
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
                        url: "{{ route('dpa.hapus') }}",
                        data: {
                            id: idBahanHapusDpa,
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
    </script>
@endpush
