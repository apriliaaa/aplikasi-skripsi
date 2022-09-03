<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pemantauan') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/main/app-dark.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />

    <!-- Fonts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
</head>


<body>

    @include('sweetalert::alert')

    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                            </svg>
                        </div>
                        <div class="logo">
                            <!-- <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo" srcset=""></a> -->
                        </div>

                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>

                </div>
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-25 h-25 d-block mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h6 class="mt-2">{{Auth()->user()->role}}</h6>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{route('dashboard')}}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if (auth()->user()->role === "SuperAdmin")
                        <li class="sidebar-item {{(Request::routeIs('admin.create') || Request::routeIs('admin.edit') || Request::routeIs('admin.data')) ? 'active' : ''}} has-sub">
                            <a href="{{route('admin.data')}}" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Admin</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{(Request::routeIs('admin.create')) ? 'active' : ''}}">
                                    <a href="{{route('admin.create')}}">Input Admin</a>
                                </li>
                                <li class="submenu-item {{(Request::routeIs('admin.data')) ? 'active' : ''}}">
                                    <a href="{{route('admin.data')}}">Data Admin</a>
                                </li>


                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->role != "Dosen")
                        <li class="sidebar-item {{(Request::routeIs('dosen.create') || Request::routeIs('dosen.edit') || Request::routeIs('dosen.data')) ? 'active' : ''}} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Dosen</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{(Request::routeIs('dosen.create')) ? 'active' : ''}}">
                                    <a href="{{route('dosen.create')}}">Input Dosen</a>
                                </li>
                                <li class="submenu-item {{(Request::routeIs('dosen.data')) ? 'active' : ''}}">
                                    <a href="{{route('dosen.data')}}">Data Dosen</a>
                                </li>


                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->role === "SuperAdmin")
                        <li class="sidebar-item  {{(Request::routeIs('prodi')) ? 'active' : ''}}">
                            <a href="{{route('prodi')}}" class='sidebar-link'>
                                <i class="bi bi-mortarboard-fill"></i>
                                <span>Program Studi</span>
                            </a>
                        </li>
                        @endif

                        <li class="sidebar-item  {{(Request::routeIs('pelanggaran')) ? 'active' : ''}}">
                            <a href="{{route('pelanggaran')}}" class='sidebar-link'>
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>Pelanggaran</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{(Request::routeIs('dokumen')) ? 'active' : ''}}">
                            <a href="{{route('dokumen')}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Item Disita</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{(Request::routeIs('mahasiswa.create')) ? 'active' : ''}}">
                            <a href="{{route('mahasiswa.create')}}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Mahasiswa</span>
                            </a>
                        </li>

                        @if (auth()->user()->role == "SuperAdmin" || auth()->user()->role == "Admin")
                        <li class="sidebar-item {{(Request::routeIs('mahasiswa.data')) ? 'active' : ''}} ">
                            <a href="{{route('mahasiswa.data')}}" class='sidebar-link'>
                                <i class="bi bi-pie-chart-fill"></i>
                                <span>Pelanggaran Mahasiswa</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{(Request::routeIs('laporan.mahasiswa')|| Request::routeIs('laporan.prodi') || Request::routeIs('laporan.detail')) ? 'active' : ''}} has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-card-list"></i>
                                <span>Laporan</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item {{(Request::routeIs('laporan.mahasiswa')) ? 'active' : ''}}">
                                    <a href="{{route('laporan.mahasiswa')}}">Laporan Mahasiswa</a>
                                </li>
                                @if (auth()->user()->role === "SuperAdmin")
                                <li class="submenu-item {{(Request::routeIs('laporan.prodi')) ? 'active' : ''}}">
                                    <a href="{{route('laporan.prodi')}}">Laporan Prodi</a>
                                </li>
                                @endif
                                <li class="submenu-item {{(Request::routeIs('laporan.detail')) ? 'active' : ''}}">
                                    <a href="{{route('laporan.detail')}}">Laporan Detail</a>
                                </li>


                            </ul>
                        </li>
                        @endif

                        <li class="sidebar-item ">
                            <form action="{{url('/logout')}}" method="post">
                                @csrf()
                                <button class="sidebar-link btn"><i class="bi bi-box-arrow-left me-3"></i> Logout</button>
                            </form>
                        </li>



                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class="p-0">
            <header class=''>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{Auth()->user()->name}}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{Auth()->user()->role}}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{asset('assets/images/faces/1.jpg')}}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{Auth()->user()->name}}!</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="{{url('user/profile')}}"><i class="icon-mid bi bi-gear me-2"></i>
                                            Edit Profil</a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{url('/logout')}}" method="post">
                                            @csrf()
                                            <button class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</button>
                                    </li>

                                    </form>

                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>



            <div id="main-content">

                <div class="page-heading">
                    <section>{{$slot}}</section>

                </div>


                <!-- <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                                by <a href="https://ahmadsaugi.com">Saugi</a></p>
                        </div>
                    </div>
                </footer> -->
            </div>


        </div>

        <script src="{{asset('assets/js/app.js')}}"></script>
        <!-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> -->

        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
</body>

</html>