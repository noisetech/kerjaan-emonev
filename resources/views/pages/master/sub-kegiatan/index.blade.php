@extends('layouts.admin')


@section('title', 'Perencanaan')
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
                            <li class="breadcrumb-item active">Perencanaan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Perencanaan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-sm-12 col-lg-3 col-md-3 col-xl-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center">
                            <p>
                                <a class="btn btn-sm btn-primary" type="button">
                                    Urusan
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm btn-primary" type="button">
                                    Bidang
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm btn-primary" type="button">
                                    Program
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm btn-primary" type="button">
                                    Kegiatan
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm  {{ $active == 'sub kegiatan' ? 'btn-primary' : 'btn-light' }}"
                                    type="button">
                                    Sub Kegiatan
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-8 col-md-8 col-xl-8">
                <div class="card shadow">
                    <div class="card-header">
                        <p>
                            <a href="{{ route('perencanaan') }}" class="badge bg-info text-white">Kembali</a>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">

                            <p class="font-weight-bold">List Sub Kegiatan</p>

                            <a href="javascript:void(0)" class="badge bg-primary text-white" onclick="tambahSubKegiatan()">
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table dt-responsive nowrap w-100" style="width: 100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nomenklatur</th>
                                            <th>Kinerja</th>
                                            <th>Indikator</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah urusan --}}
    <div class="modal fade" id="modal_tambah_sub_kegiatan" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Sub Kegiatan</h5>
                    <button type="button" class="btn-close" onclick="closeAtasTambahSubKegiatan()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_tambah_sub_kegiatan" method="POST">
                        @csrf

                        <input type="hidden" name="kegiatan_id" class="form-control" value="{{ $kegiatan_id }}">

                        <div class="mb-3">
                            <label for="" class="form-label">Satuan</label>
                            <select name="satuan_id" class="satuan form-select"></select>
                            <span class="text-danger error-text satuan_id_error"></span>
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Kode</label>
                            <input type="text" name="kode" class="form-control">
                            <span class="text-danger error-text kode_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Nomenklatur</label>
                            <input type="text" name="nomenklatur" class="form-control">
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Kinerja</label>
                            <textarea name="kinerja" class="form-control" cols="30" rows="10"
                                style="height: 200px
                            !important;"></textarea>
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">indikator</label>
                            <textarea name="indikator" class="form-control" cols="30" rows="10"
                                style="height: 200px
                            !important;"></textarea>
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>


                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahTambahSubKegiatan()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-simpan-sub-kegiatan">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal tambah urusan --}}


    {{-- modal edit urusan --}}
    <div class="modal fade" id="modal_edit_sub_kegiatan" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Edit Kegiatan</h5>
                    <button type="button" class="btn-close" onclick="closeAtasEditSubKegiatan()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_edit_kegiatan" method="POST">
                        @csrf

                        <input type="hidden" name="id" class="id_edit form-control">

                        <input type="hidden" name="kegiatan_id" class="form-control" value="{{ $kegiatan_id }}">

                        <div class="mb-3">
                            <label for="" class="form-label">Satuan</label>
                            <select name="satuan_id" class="satuan_edit form-select"></select>
                            <span class="text-danger error-text satuan_id_error"></span>
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Kode</label>
                            <input type="text" name="kode" class="kode form-control">
                            <span class="text-danger error-text kode_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Nomenklatur</label>
                            <input type="text" name="nomenklatur" class="nomenklatur form-control">
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Kinerja</label>
                            <textarea name="kinerja" class="kinerja form-control" cols="30" rows="10"
                                style="height: 200px
                            !important;"></textarea>
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">indikator</label>
                            <textarea name="indikator" class="indikator form-control" cols="30" rows="10"
                                style="height: 200px
                            !important;"></textarea>
                            <span class="text-danger error-text nomenklatur_error"></span>
                        </div>


                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahEditBidang()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-edit-sub-kegiatan">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal edit urusan --}}
@endsection

@push('script')
    <script>
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
                    url: "{{ route('sub_kegiatan.data') }}",
                    data: {
                        kegiatan_id: <?= $kegiatan_id ?>,
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },

                    {
                        data: 'nomenklatur',
                        name: 'nomenklatur'
                    },

                    {
                        data: 'kinerja',
                        name: 'kinerja'
                    },


                    {
                        data: 'indikator',
                        name: 'indikator'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        function tambahSubKegiatan() {
            $('#modal_tambah_sub_kegiatan').modal('show');
        }

        function closeAtasTambahSubKegiatan() {
            $("#modal_tambah_sub_kegiatan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_sub_kegiatan')[0].reset();
            $(".satuan").val('').trigger('change');
            $("#btn-simpan-sub-kegiatan").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }

        function closeBawahTambahSubKegiatan() {
            $("#modal_tambah_sub_kegiatan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_sub_kegiatan')[0].reset();
            $(".satuan").val('').trigger('change');
            $("#btn-simpan-sub-kegiatan").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }


        $("#form_tambah_sub_kegiatan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sub_kegiatan.simpan') }}',
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
                        $("#modal_tambah_sub_kegiatan").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_sub_kegiatan')[0].reset();
                        $("#btn-simpan-sub-kegiatan").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });




        function editSubKegiatan(data, idBahanEditKegiatan) {
            $('#modal_edit_sub_kegiatan').modal('show');

            $.ajax({
                url: '{{ route('subKegiatanById') }}',
                method: 'get',
                data: {
                    id: idBahanEditKegiatan,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    $('.id_edit').val(response.id);
                    $('.kode').val(response.kode);
                    $('.nomenklatur').val(response.nomenklatur);
                    $('.kinerja').val(response.kinerja);
                    $('.indikator').val(response.indikator);


                    $.ajax({
                        type: 'GET',
                        url: "{{ route('satuanBySubKegiatan') }}",
                        data: {
                            id: response.id
                        }
                    }).then(function(data) {
                        console.log(data);
                        for (i = 0; i < data.length; i++) {
                            // selected
                            var newOption = new Option(data[i].satuan, data[i].id, true,
                                true);

                            $('.satuan_edit').append(newOption).trigger('change');
                        }
                    });
                }
            });
        }




        $("#form_edit_kegiatan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('kegiatan.update') }}',
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
                        $("#modal_edit_kegiatan").modal('hide');
                        $('#form_edit_kegiatan')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-kegiatan").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });




        function hapusSubKegiatan(data, idBahanhapusSubKegiatan) {
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
                        url: "{{ route('sub_kegiatan.hapus') }}",
                        data: {
                            id: idBahanhapusSubKegiatan,
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



        $(document).ready(function() {
            $('.satuan').select2({
                placeholder: '--Pilih Satuan',
                minimumInputLength: 3,
                allowClear: true,
                dropdownParent: $("#modal_tambah_sub_kegiatan"),
                ajax: {
                    url: "{{ route('sub_kegiatan.listSataun') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.satuan,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });

        $(document).ready(function() {
            $('.satuan_edit').select2({
                placeholder: '--Pilih Satuan',
                minimumInputLength: 3,
                allowClear: true,
                dropdownParent: $("#modal_tambah_sub_kegiatan"),
                ajax: {
                    url: "{{ route('sub_kegiatan.listSataun') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.satuan,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
    </script>
@endpush
