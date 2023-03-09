@extends('layouts.admin')

@section('title', 'Sumber Dana')
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
                            <li class="breadcrumb-item active">Sumber Dana</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Form edit sumber dana</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">

            <div class="card-body">
                <form action="#" id="form_update_sumber_dana" method="POST">
                    @csrf

                    <input type="hidden" name="id" class="form-control" value="{{ $sumber_dana->id }}">

                    <div class="mb-3">
                        <label for="" class="form-label">Sumber Dana: <sup class="text-danger">*</sup></label>
                        <input type="text" name="sumber_dana" id="" class="form-control"
                            value="{{ $sumber_dana->sumber_dana }}">
                        <span class="text-danger error-text sumber_dana_error"></span>
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
        $("#form_update_sumber_dana").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $.ajax({
                url: '{{ route('sumber_dana.update') }}',
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
                            window.top.location = "{{ route('sumber_dana.index') }}"
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
