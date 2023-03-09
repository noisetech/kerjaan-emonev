@extends('layouts.admin')

@section('title', 'Wilayah')
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
                            <li class="breadcrumb-item active">Wilayah</li>
                        </ol>
                    </div>
                    <h4 class="page-title">List Wilayah</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#tambah-wilayah">Tambah wilayah</button>
                </div>


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table dt-responsive nowrap w-100" style="width: 100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Wilayah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->


        {{-- modal tambah wilayah --}}
        <div class="modal fade" id="tambah-wilayah" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Tambah</h5>
                        <button type="button" class="btn-close" onclick="closeAtasTambahWilayah()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_tambah_wilayah" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label for="" class="form-label">Wilayah<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="wilayah" class="form-control">
                                <span class="text-danger error-text wilayah_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn btn-danger mx-1"
                                    onclick="closeBawahTambahWilayah()">Batal</button>
                                <button type="submit" class="btn btn-success" id="btn_simpan_wilayah">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        {{-- akhir modal tambah wilayah --}}


        {{-- modal edit wilayah --}}

        <div class="modal fade" id="edit-wilayah" tabindex="-1" aria-labelledby="scrollableModalTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">Form Ubah</h5>
                        <button type="button" class="btn-close" onclick="closeAtasEditWilayah()"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form_update_wilayah" method="POST">
                            @csrf

                            <input type="hidden" name="id" class="id_wilayah_saat_edit_wilayah form-control">

                            <div class="mb-2">
                                <label for="" class="form-label">Wilayah<sup
                                        class="text-danger mx-1">*</sup></label>
                                <input type="text" name="wilayah" class="wilayah_saat_edit_wilayah form-control">
                                <span class="text-danger error-text wilayah_error"></span>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <button type="button" class="btn btn-danger mx-1"
                                    onclick="closeBawahEdithWilayah()">Batal</button>
                                <button type="submit" class="btn btn-success" id="btn_edit_wilayah">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        {{-- akhir modal edit wilayah --}}
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                scrollY: '200px',
                scrollCollapse: true,
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('wilayah.data') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
        });
        function closeAtasTambahWilayah() {
            $("#tambah-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_wilayah')[0].reset();
            $("#btn_simpan_wilayah").text('Simpan');
            $('#dataTable').DataTable().ajax.reload();
        }
        function closeBawahTambahWilayah() {
            $("#tambah-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_tambah_wilayah')[0].reset();
            $("#btn_simpan_wilayah").text('Simpan');
            $('#dataTable').DataTable().ajax.reload();
        }
        function closeAtasEditWilayah() {
            $("#edit-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_wilayah')[0].reset();
            $("#btn_edit_wilayah").text('Simpan');
            $('#dataTable').DataTable().ajax.reload();
        }
        function closeBawahEditWilayah() {
            $("#tambah-wilayah").modal('hide');
            $(document).find('span.error-text').empty();
            $('#form_update_wilayah')[0].reset();
            $("#btn_edit_wilayah").text('Simpan');
            $('#dataTable').DataTable().ajax.reload();
        }
        $("#form_tambah_wilayah").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('wilayah.store') }}',
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
                        $("#tambah-wilayah").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_tambah_wilayah')[0].reset();
                        $("#btn_simpan_wilayah").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        });
        $("#form_update_wilayah").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('wilayah.update') }}',
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
                        $("#edit-wilayah").modal('hide');
                        $(document).find('span.error-text').empty();
                        $('#form_update_wilayah')[0].reset();
                        $("#btn_edit_wilayah").text('Simpan');
                        $('#datatable').DataTable().ajax.reload();
                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });
        });
        s
        function editWilayah(data, bahanWilayahIdFormEdit) {
            $('#edit-wilayah').modal('show');
            $.ajax({
                url: '{{ route('wilayahById') }}',
                method: 'get',
                data: {
                    id: bahanWilayahIdFormEdit,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('.id_wilayah_saat_edit_wilayah').val(response.id);
                    $('.wilayah_saat_edit_wilayah').val(response.wilayah);
                }
            });
        }
        function hapusWilayah(data, bahanWilayahIdHapus) {
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
                        url: "{{ route('wilayah.destroy') }}",
                        data: {
                            id: bahanWilayahIdHapus,
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
