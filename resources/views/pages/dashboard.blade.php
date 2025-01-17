@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                        <h3><span></span></h3>
                                        <p class="text-muted font-15 mb-0">Total Dinas</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                        <h3><span></span></h3>
                                        <p class="text-muted font-15 mb-0">Total Anggaran</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="uil-grid text-muted" style="font-size: 24px;"></i>
                                        <h3><span></span></h3>
                                        <p class="text-muted font-15 mb-0">Total Dana Diserap</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span></span></h3>
                                        <p class="text-muted font-15 mb-0">Total Users</p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
    </div>
@endsection
