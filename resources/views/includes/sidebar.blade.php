<div class="leftside-menu menuitem-active">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('backend/emonev.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('backend/emonev.png') }}" alt="" height="50">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('backend/emonev.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('backend/emonev.png') }}" alt="" height="50">
        </span>
    </a>

    <div class="h-100 show" id="leftside-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <!--- Sidemenu -->
                            <ul class="side-nav">

                                <li class="side-nav-title side-nav-item">Dashboard</li>


                                <li class="side-nav-item">
                                    <a href="{{ route('dashboard') }}" class="side-nav-link">
                                        <i class="uil-home-alt"></i>
                                        <span> Dashboard </span>
                                    </a>
                                </li>


                                <li class="side-nav-title side-nav-item">Module Pembangunan</li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarPembangunan" aria-expanded="false"
                                        aria-controls="sideBarPembangunan" class="side-nav-link collapsed">
                                        <i class="uil-list-ui-alt"></i>
                                        <span> Pembangunan </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarPembangunan" style="">
                                        <ul class="side-nav-second-level">
                                            <li>
                                                <a href="apps-email-inbox.html">Rencana Pembangunan</a>
                                            </li>
                                            <li>
                                                <a href="apps-email-read.html">Komponen Pembangunan</a>
                                            </li>

                                            <li>
                                                <a href="apps-email-read.html">Laporan Pembangunan</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-title side-nav-item">Module Anggaran</li>


                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link collapsed">
                                        <i class="uil-copy-alt"></i>
                                        <span> Anggaran </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarPages" style="">
                                        <ul class="side-nav-second-level">


                                            <li>
                                                <a href="{{ route('dpa') }}">DPA</a>
                                            </li>
                                            <li>
                                                <a href="#">Rincian Pengambilan</a>
                                            </li>


                                            <li class="side-nav-item">
                                                <a data-bs-toggle="collapse" href="#sidebarPagesAuth" aria-expanded="false" aria-controls="sidebarPagesAuth">
                                                    <span> Laporan </span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <div class="collapse" id="sidebarPagesAuth">
                                                    <ul class="side-nav-third-level">
                                                        <li>
                                                            <a href="{{ route('angaran.laporan.pertahun') }}">Laporan Pertahun</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('angaran.laporan.perbulan') }}">Laporan Perbulan</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('angaran.laporan.triwulan') }}">Lapora Pertriwulan</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </li>

                                <li class="side-nav-title side-nav-item">Manage Master</li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarModuleMaster" aria-expanded="false"
                                        aria-controls="sidebarModuleMaster" class="side-nav-link collapsed">
                                        <i class="uil-list-ui-alt"></i>
                                        <span> Master </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarModuleMaster" style="">
                                        <ul class="side-nav-second-level">
                                            <li>
                                                <a href="{{ route('tahun') }}">Tahun</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('bulan') }}">Bulan</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('wilayah') }}">Wilayah</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('dinas') }}">Dinas</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('sumber_dana.index') }}">Sumber Dana</a>
                                            </li>


                                            <li>
                                                <a href="{{ route('satuan.index') }}">Satuan</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('rekening') }}">Rekening</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('perencanaan') }}">Perencanaan</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('perencanaan_organisasi.urusan') }}">Perencaaan Organisasi</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>




                                <li class="side-nav-title side-nav-item">Manage User</li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sideBarSpatie" aria-expanded="false"
                                        aria-controls="sidebarModuleMaster" class="side-nav-link collapsed">
                                        <i class="uil-cog"></i>
                                        <span> Setting </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sideBarSpatie" style="">
                                        <ul class="side-nav-second-level">
                                            <li>
                                                <a href="{{ route('users') }}">Users</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('role') }}">Role</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('permission') }}">Permission</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 260px; height: 1625px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 236px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>


    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('backend/assets/images/gambar-pln1.png') }}" alt="" height="50">
        </span>
    </a>



</div>
