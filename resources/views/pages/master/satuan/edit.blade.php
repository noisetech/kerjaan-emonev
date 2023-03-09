@extends('layouts.admin')

@section('title', 'Satuan')
@section('content')

    <div class="container-fluid mt-3">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Satuan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Form ubah satuan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">

            <div class="card-body">
                <form action="#" id="form_ubah_satuan" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $satuan->id }}">


                    <div class="mb-3">
                        <label for="" class="form-label">Satuan: <sup class="text-danger">*</sup></label>
                        <input type="text" name="satuan" id="" class="form-control"
                            value="{{ $satuan->satuan }}">
                        <span class="text-danger error-text satuan_error"></span>
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
        $("#form_ubah_satuan").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('satuan.update') }}',
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
                            window.top.location = "{{ route('satuan.index') }}"
                        }, 1800);

                    } else {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });
        });
    </script>
@endpush
