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
                    <h4 class="page-title">Form tambah dinas</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">

            <div class="card-body">
                <form action="#" id="form_tambah_dinas" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="mb-3">
                        <label for="" class="form-label">Wilayah: <sup class="text-danger">*</sup></label>
                        <select name="wilayah_id" id="" class="wilayah form-select"></select>
                        <span class="text-danger error-text wilayah_id_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Users: <sup class="text-danger">*</sup></label>
                        <select name="users_id[]" id=""
                            class="users form-select select2-selection--multiple"></select>
                        <span class="text-danger error-text users_id_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Dinas: <sup class="text-danger">*</sup></label>
                        <input type="text" name="dinas" id="" class="form-control">
                        <span class="text-danger error-text dinas_error"></span>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Foto: <sup class="text-danger">*</sup></label>
                        <input type="file" name="foto" class="form-control">
                        <span class="text-danger error-text foto_error"></span>
                    </div>


                    <div class="mb-3">
                        <label for="" class="form-label">Icon: <sup class="text-danger">*</sup></label>
                        <input type="file" name="icon" class="form-control">
                        <span class="text-danger error-text icon_error"></span>
                    </div>

                    <button class="btn  btn-sm badge bg-primary text-white" type="submit">
                        Simpan
                    </button>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->

    </div>
@endsection

@push('script')
    <script>
        $("#form_tambah_dinas").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('dinas.simpan') }}',
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
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        setTimeout(function() {
                            window.top.location = "{{ route('dinas') }}"
                        }, 1800);

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });


        $(document).ready(function() {
            $('.wilayah').select2({
                minimumInputLength: 2,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Wilayah--',
                ajax: {
                    url: "{{ route('dinas.list_wilayah') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.wilayah,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $(document).ready(function() {
            $('.users').select2({
                minimumInputLength: 2,
                multiple: true,
                maximumInputLength: 50,
                allowClear: true,
                placeholder: '-- Pilih Wilayah--',
                ajax: {
                    url: "{{ route('dinas.list_user') }}",
                    dataType: 'json',
                    delay: 500,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.email,
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
