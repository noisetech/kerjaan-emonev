@extends('layouts.admin')


@section('title', 'Perencanaan Organisasi')
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
                            <li class="breadcrumb-item active">Perencanaan Organisasi</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Perencanaan Organisasi</h4>
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
                                <a class="btn btn-sm {{ $active == 'organisasi' ? 'btn-primary' : 'btn-light' }}"
                                    type="button">
                                    Organisasi
                                </a>
                            </p>

                            <p>
                                <a class="btn btn-sm {{ $active == 'kegiatan' ? 'btn-primary' : 'btn-light' }}"
                                    type="button">
                                    Unit
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
                            <a href="{{ route('perencanaan_organisasi.urusan') }}" class="badge bg-info text-white">Kembali</a>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">

                            <p class="font-weight-bold">List organisasi</p>

                            <a href="javascript:void(0)" class="badge bg-primary text-white" onclick="tambahOrganisasi()">
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
    <div class="modal fade" id="modal_tambah_organisasi" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Organisasi</h5>
                    <button type="button" class="btn-close" onclick="closeAtasTambahOrganisasi()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_tambah_organisasi" method="POST">
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
                                onclick="closeBawahTambahOrganisasi()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-simpan-organiasi">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal tambah urusan --}}


    {{-- modal edit urusan --}}
    <div class="modal fade" id="modal_edit_organisasi" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Edit Organisasi</h5>
                    <button type="button" class="btn-close" onclick="closeAtasEditOrganisasi()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_ubah_organisasi" method="POST">
                        @csrf
                        <input type="hidden" name="id" class="id_edit_organisasi form-control">
                        <input type="hidden" name="bidang_id" value="{{ $bidang_id }}">

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
                                onclick="closeBawahEditOrganisasi()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-edit-organisasi">Simpan</button>
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
                    url: "{{ route('perencanaan-organisasi.organisasi-data') }}",
                    data: {
                        bidang_id: <?= $bidang_id ?>,
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-secondary text-xs font-weight-bold',
                        render: function(data, type, row) {
                            return '<a href="/dashboard/perencanaa-organisasi/unit/' +
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

        function tambahOrganisasi() {
            $('#modal_tambah_organisasi').modal('show');
        }

        function closeAtasTambahOrganisasi() {
            $("#modal_tambah_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_organisasi')[0].reset();
            $("#btn-simpan-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }

        function closeBawahTambahOrganisasi() {
            $("#modal_tambah_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_organisasi')[0].reset();
            $("#btn-simpan-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }

        $('#modal_tambah_organisasi').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_organisasi')[0].reset();
            $("#btn-simpan-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        });

        $("#form_tambah_organisasi").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan-organisasi.organisasi-simpan') }}',
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
                        $("#modal_tambah_organisasi").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_organisasi')[0].reset();
                        $("#btn-simpan-organiasi").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editBidang(data, idBahanEditBidang) {
            $('#modal_edit_bidang').modal('show');

            $.ajax({
                url: '{{ route('perencanaan-organisasi.bidangById') }}',
                method: 'get',
                data: {
                    id: idBahanEditBidang,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#id_edit_bidang').val(response.id);
                }
            });
        }

        function closeAtasEditOrganisasi() {
            $("#modal_edit_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_ubah_organisasi')[0].reset();
            $("#btn-edit-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }

        function closeBawahEditOrganisasi() {
            $("#modal_edit_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_ubah_organisasi')[0].reset();
            $("#btn-edit-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        }

        $('#modal_edit_organisasi').on('hidden.bs.modal', function(e) {
            $("#modal_edit_organisasi").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_ubah_organisasi')[0].reset();
            $("#btn-edit-organiasi").text('Simpan');
            $('#datatable').DataTable().ajax.reload();
        });


        $("#form_ubah_organisasi").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('perencanaan-organisasi.organisasi-update') }}',
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
                        $("#modal_edit_organisasi").modal('hide');
                        $('#form_ubah_organisasi')[0].reset();
                        $(document).find('span.error-text').empty();
                        $("#btn-edit-organisasi").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function editOrganisasi(data, idBahanEditOrganisasi) {

            $('#modal_edit_organisasi').modal('show');


            $.ajax({
                url: '{{ route('perencanaan-organisasi.organisasiById') }}',
                method: 'get',
                data: {
                    id: idBahanEditOrganisasi,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.id_edit_organisasi').val(response.id);
                    $('.kode').val(response.kode);
                    $('.nomenklatur').val(response.nomenklatur);
                    $('.nama_bulan').val(response.nama_bulan);
                }
            });
        }

        function hapusOrganisasi(data, idBahanHapusOrganisasi) {
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
                        url: "{{ route('perencanaan-organisasi.organisasi-hapus') }}",
                        data: {
                            id: idBahanHapusOrganisasi,
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
