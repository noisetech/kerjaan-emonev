@extends('layouts.admin')

@section('title', 'Bulan')
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
                            <li class="breadcrumb-item active">Bulan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">List Bulan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    <a href="javascript:void(0)" class="badge bg-primary text-white" onclick="tambahBulan()">
                        Tambah
                    </a>
                </div>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table dt-responsive nowrap w-100" style="width: 100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->

    </div>

    {{-- modal tambah bulan --}}
    <div class="modal fade" id="modal_tambah_bulan" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Tambah Bulan</h5>
                    <button type="button" class="btn-close" onclick="closeAtasTambahBulan()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_tambah_bulan" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Bulan</label>
                            <input type="text" name="nama_bulan" class="form-control">
                            <span class="text-danger error-text nama_bulan_error"></span>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahTambahBulan()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-simpan-bulan">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal bulan --}}


    {{-- modal edit bulan --}}
    <div class="modal fade" id="modal_edit_bulan" tabindex="-1" aria-labelledby="scrollableModalTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Form Edit Bulan</h5>
                    <button type="button" class="btn-close" onclick="closeAtasEditBulan()"></button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_update_bulan" method="POST">
                        @csrf

                        <input type="text" name="id" class="id_edit form-control">

                        <div class="mb-3">
                            <label for="" class="form-label">Bulan</label>
                            <input type="text" name="nama_bulan" class="form-control nama_bulan">
                            <span class="text-danger error-text nama_bulan_error"></span>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <button type="button" class="btn badge bg-secondary text-white mx-1"
                                onclick="closeBawahEditBulan()">Batal</button>
                            <button type="submit" class="btn badge bg-primary text-white"
                                id="btn-edit-bulan">Simpan</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    {{-- akhir modal bulan --}}
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
                    url: "{{ route('bulan.data') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama_bulan',
                        name: 'nama_bulan'
                    },

                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            // console.log(id);
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
                        url: "{{ route('tahun.destroy') }}",
                        data: {
                            id: id,
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
        });

        // bagian tambah bulan
        $("#form_tambah_bulan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('bulan.simpan') }}',
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
                        $("#modal_tambah_bulan").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_bulan')[0].reset();
                        $("#btn-simpan-bulan").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function tambahBulan() {
            $('#modal_tambah_bulan').modal('show');
        }

        function closeAtasTambahBulan() {
            $("#modal_tambah_bulan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_bulan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        }

        function closeBawahTambahBulan() {
            $("#modal_tambah_bulan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_bulan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        }

        $('#modal_tambah_bulan').on('hidden.bs.modal', function(e) {
            $("#modal_tambah_bulan").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_bulan')[0].reset();
            $("#btn-simpan-bulan").text('Simpan');
        })
        // akhir tambah bulan


        // modal edit bulan

        function editBulan(data, idBulanEdit) {

            $('#modal_edit_bulan').modal('show');

            $.ajax({
                url: '{{ route('bulanById') }}',
                method: 'get',
                data: {
                    id: idBulanEdit,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.id_edit').val(response.id);
                    $('.nama_bulan').val(response.nama_bulan);
                }
            });
        }

        $("#form_update_bulan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('bulan.update') }}',
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
                        $("#modal_edit_bulan").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_update_bulan')[0].reset();
                        $("#btn-edit-bulan").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });

        function hapusBulan(data, idbahanhapusBulan) {
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
                        url: "{{ route('bulan.hapus') }}",
                        data: {
                            id: idbahanhapusBulan,
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
