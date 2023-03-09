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
                                <a class="btn btn-sm {{ $active == 'program' ? 'btn-primary' : 'btn-light' }}"
                                    type="button">
                                    Program
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm {{ $active == 'kegiatan' ? 'btn-primary' : 'btn-light' }}"
                                    type="button">
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

                            <p class="font-weight-bold">List Program</p>

                            <a href="javascript:void(0)" class="badge bg-primary text-white" onclick="tambahProgram()">
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
    <div class="modal fade" id="modal_tambah_program" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Program</h5>
                    <button type="button" class="btn-close" onclick="closeAtasTambahUProgram()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_tambah_program" method="POST">
                        @csrf

                        <input type="hidden" name="bidang_id" class="form-control" value="{{ $bidang_id }}">

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

                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahTambahProgram()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-simpan-program">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal tambah urusan --}}


    {{-- modal edit urusan --}}
    <div class="modal fade" id="modal_edit_program" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Edit Program</h5>
                    <button type="button" class="btn-close" onclick="closeAtasTambahBidang()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_edit_program" method="POST">
                        @csrf
                        <input type="hidden" name="id" class="id_edit form-control">
                        <input type="hidden" name="bidang_id" class="bidang_id_edit">

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

                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahEditBidang()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-edit-program">Simpan</button>
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
                    url: "{{ route('program.data') }}",
                    data: {
                        bidang_id: <?= $bidang_id ?>,
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-secondary text-xs font-weight-bold',
                        render: function(data, type, row) {
                            return '<a href="/dashboard/perencanaan/kegiatan/' +
                                row.id +
                                '" >' + data +
                                '</a>';
                        }
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
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        function tambahProgram() {
            $('#modal_tambah_program').modal('show');
        }

        function closeAtasTambahUrusan() {
            $("#modal_tambah_urusan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_urusan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        }

        function closeBawahTambahUrusan() {
            $("#modal_tambah_urusan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_urusan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        }

        $('#modal_tambah_urusan').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_urusan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_urusan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        });

        $("#form_tambah_program").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('program.simpan') }}',
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
                        $("#modal_tambah_program").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_program')[0].reset();
                        $("#btn-simpan-program").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editProgram(data, idBahanEditProgram) {
            $('#modal_edit_program').modal('show');

            $.ajax({
                url: '{{ route('programById') }}',
                method: 'get',
                data: {
                    id: idBahanEditProgram,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    $('.id_edit').val(response.id);
                    $('.bidang_id_edit').val(response.bidang_id);
                    $('.kode').val(response.kode);
                    $('.nomenklatur').val(response.nomenklatur);
                }
            });
        }


        $("#form_edit_program").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('program.update') }}',
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
                        $("#modal_edit_program").modal('hide');
                        $('#form_edit_program')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-proram").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });



        function hapusBidang(data, idBahanHapusBidang) {
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
                        url: "{{ route('bidang.hapus') }}",
                        data: {
                            id: idBahanHapusBidang,
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
