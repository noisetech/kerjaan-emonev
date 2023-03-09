@extends('layouts.admin')

@section('title', 'Laporan')
@section('content')
    <div class="container-fluid mt-3">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Perbulan</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Laporan Anggaran Perbulan</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card shadow mt-1">

            <div class="card-body">
                <form action="" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="" class="form-label">Bulan</label>
                        <input type="text" name="tahun" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Tahun</label>
                        <input type="text" name="tahun" class="form-control">
                    </div>




                    <button class="btn badge bg-primary" type="submit">
                        Simpan
                    </button>
                </form>
            </div> <!-- end card body-->
        </div> <!-- end card -->

    </div>
@endsection