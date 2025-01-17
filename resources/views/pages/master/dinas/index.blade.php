@extends('layouts.admin')

@section('title', 'Dinas')
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
                            <li class="breadcrumb-item active">Dinas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">List Dinas</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">
            <div class="card-header">
                <div class="d-flex justify-content-end align-items-center">

                    <a href="{{ route('dinas.tambah') }}" class="btn badge bg-primary text-white">
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
                                <th>Dinas</th>
                                <th>Wilayah</th>
                                <th>Akun</th>
                                <th>Foto</th>
                                <th>Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->

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
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, "50"]
                ],
                order: [],
                ajax: {
                    url: "{{ route('dinas.data') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'dinas',
                        name: 'dinas'
                    },
                    {
                        data: 'wilayah',
                        name: 'wilayah'
                    },
                    {
                        data: 'akun',
                        name: 'akun'
                    },
                    {
                        data: 'foto',
                        name: 'foto'
                    },
                    {
                        data: 'icon',
                        name: 'icon',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]

            });
        });

        $(document).on('click', '.hapus_sumber_dana', function(e) {
            e.preventDefault();
            let id = $(this).attr('data-id');

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
                        url: "{{ route('sumber_dana.hapus') }}",
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
    </script>
@endpush
