<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">

    <link href="{{ url('Crovex/HTML/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ url('Crovex/HTML/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('Crovex/HTML/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .topbar {
            position: fixed;
            width: 100%;
            z-index: 1001;
            top: 0;
            left: 0;
            background-color: white;
            border-bottom: 1px solid #ddd;
        }

        .navbar-custom {
            padding-left: 20px;
            padding-right: 20px;
        }

        .nav-user {
            position: relative;
        }

        .left-sidenav {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 240px;
            background-color: #ffffff;
            z-index: 1000;
            padding-top: 70px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .page-wrapper {
            margin-top: 60px;
            margin-left: 240px;
            padding: 20px 20px 80px;
            min-height: calc(100vh - 60px);
            transition: margin-left 0.3s ease;
        }

        .active-item {
            background-color: #3475FE !important;
            color: white !important;
            border-radius: 8px;
            font-weight: 600;
        }

        .left-sidenav-menu li a {
            padding: 12px 20px;
            margin: 4px 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .left-sidenav-menu li a:hover:not(.active-item) {
            background-color: #f1f5f9;
            color: #3475FE;
        }

        .logout-container {
            padding: 15px;
            width: 100%;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pagination {
            width: 100%;
            height: auto;
            margin-top: 30px;
            justify-content: center;
        }

        .pagination li {
            display: inline;
            margin: 0 5px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #3475FE;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination a:hover,
        .pagination .active span {
            background-color: #3475FE;
            border-color: #3475FE;
            color: white;
        }

        @media (max-width: 1024px) {
            .left-sidenav {
                transform: translateX(-100%);
            }
            .left-sidenav.show {
                transform: translateX(0);
            }
            .page-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="topbar">
        <div class="topbar-left d-flex align-items-center h-100 px-3">
            <a href="#" class="logo">
                <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="logo-large"
                    class="logo-lg" style="width: 140px; height: auto;">
            </a>
        </div>

        <nav class="navbar-custom d-flex justify-content-between align-items-center h-100">
            <button class="btn d-lg-none text-dark p-0 fs-4" id="toggleMobileMenu">
                <i class="ti-menu"></i>
            </button>

            <ul class="list-unstyled topbar-nav ms-auto mb-0 d-flex align-items-center">
                <li class="nav-link waves-effect waves-light nav-user d-flex align-items-center gap-2">
                    <span class="nav-user-name text-dark fw-semibold">{{ Auth::user()->name }}</span>
                    <img src="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}" alt="profile-user"
                        class="rounded-circle" style="width: 32px; height: 32px;" />
                </li>
            </ul>
        </nav>
    </div>

    <div class="left-sidenav d-flex flex-column justify-content-between">
        <ul class="metismenu left-sidenav-menu flex-grow-1">
            <li>
                <a href="/dashboard" class="{{ Request::is('dashboard*') ? 'active-item' : '' }}">
                    <i class="ti-bar-chart"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/pemilik" class="{{ Request::is('pemilik*') ? 'active-item' : '' }}">
                    <i class="ti-crown"></i><span>Pemilik</span>
                </a>
            </li>
            <li>
                <a href="/ruang" class="{{ Request::is('ruang*') ? 'active-item' : '' }}">
                    <i class="ti ti-folder"></i><span>Ruang</span>
                </a>
            </li>
            <li>
                <a href="/suratPaket" id="suratPaketLink" class="{{ Request::is('suratPaket*') ? 'active-item' : '' }}">
                    <i class="ti ti-package"></i><span>Surat & Paket</span>
                </a>
            </li>
            <li>
                <a href="/kurir" class="{{ Request::is('kurir*') ? 'active-item' : '' }}">
                    <i class="ti ti-map"></i><span>Kurir</span>
                </a>
            </li>

            @if (Auth::user()->role === 'admin')
            <li class="menu-title mt-3 text-uppercase text-muted" style="font-size: 0.72rem; font-weight: 700; padding-left: 20px; list-style: none; letter-spacing: 0.5px;">
                Menu Administrator
            </li>
            <li>
                <a href="{{ route('admin.security.index') }}" class="{{ Request::is('admin/security*') ? 'active-item' : '' }}">
                    <i class="ti ti-shield"></i><span>Kelola Security</span>
                </a>
            </li>
            @endif
        </ul>

        <div class="logout-container mb-4">
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="button" class="btn btn-danger logout-btn shadow-sm" id="logoutButton">
                    <i class="ti-power-off"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="page-content">
            @yield('content')

            @if (isset($data) && $data->hasPages())
                <div class="pagination-wrapper">
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>

    <script src="{{ url('Crovex/HTML/assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/waves.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/feather.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ url('Crovex/HTML/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ url('Crovex/HTML/assets/pages/jquery.analytics_dashboard.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="{{ url('Crovex/HTML/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: 'resolve'
            });

            $('#toggleMobileMenu').on('click', function() {
                $('.left-sidenav').toggleClass('show');
            });
        });

        document.getElementById('logoutButton').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari akun Anda!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3475FE',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    </script>
</body>
</html>
