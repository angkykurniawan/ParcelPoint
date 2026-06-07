<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">

    <!-- jvectormap -->
    <link href="{{ url('Crovex/HTML/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ url('Crovex/HTML/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ url('Crovex/HTML/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('Crovex/HTML/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Fix the navbar and user profile */
        .topbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
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
            width: 220px;
            background-color: #ffff;
            z-index: 999;
            padding-top: 60px;
            /* Adjust for fixed navbar */
            box-shadow: 0.2px 0 1px rgba(0, 0, 0, 0.2);
        }

        .page-wrapper {
            margin-top: 60px;
            /* Adjust for fixed navbar */
            margin-left: 260px;
            /* Increased space for left sidebar */
            padding: 20px 20px 80px;
            /* Add more padding at the bottom for pagination */
        }

        .active-item {
            background-color: #3475FE !important;
            color: white !important;
            border-radius: 5px;
        }

        /* Center pagination */
        .pagination {
            width: 100%;
            height: auto;
            margin-top: 20px;
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
            border-radius: 5px;
            color: #3475FE;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #3475FE;
            color: white;
        }

        .pagination .active a {
            background-color: #3475FE;
            height: auto;
            color: white;
        }

    </style>
</head>

<body>
    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="#" class="logo">
                <span>
                    <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="logo-large"
                        class="logo-lg" style="width: 150px; height: 40px; margin-top: 15px;">
                </span>
            </a>
        </div>
        <!--end logo-->
        <!-- Navbar -->
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="nav-link waves-effect waves-light nav-user">
                    <span class="ml-1 nav-user-name">{{ Auth::user()->name }} </span>
                    <img src="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}" alt="profile-user"
                        class="rounded-circle" />
                </li>
            </ul><!--end topbar-nav-->
        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->

    <!-- Left Sidenav -->
    <div class="left-sidenav">
        <ul class="metismenu left-sidenav-menu">
            <li>
                <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active-item' : '' }}"><i
                        class="ti-bar-chart"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
            </li>
            <li>
                <a href="/pemilik" class="{{ Request::is('pemilik') ? 'active-item' : '' }}"><i
                        class="ti-crown"></i><span>Pemilik</span><span class="menu-arrow"></span></a>
            </li>
            <li>
                <a href="/ruang" class="{{ Request::is('ruang') ? 'active-item' : '' }}"><i
                        class="ti ti-folder"></i><span>Ruang</span><span class="menu-arrow"></span></a>
            </li>
            <li>
                <a href="/suratPaket" id="suratPaketLink"
                    class="{{ Request::is('suratPaket') ? 'active-item' : '' }}"><i
                        class="ti ti-package"></i><span>Surat & Paket</span><span class="menu-arrow"></span></a>
            </li>
            <li>
                <a href="/kurir" class="{{ Request::is('kurir') ? 'active-item' : '' }}"><i
                        class="ti ti-map"></i><span>Kurir</span><span class="menu-arrow"></span></a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" id="logoutForm"
                    style="position: fixed; bottom: 10px; left: 7%; transform: translateX(-50%);">
                    @csrf
                    <button type="button" class="btn btn-primary" id="logoutButton">
                        <i class="ti-power-off"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <!-- end left-sidenav-->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="page-content">
            <br>
            @yield('content')
            <!-- Ensure pagination is included in the content -->
            @if (isset($data) && $data->hasPages())
                <div class="pagination-wrapper">
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>
    <!-- end page content -->

    <!-- jQuery -->
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

    <!-- App js -->
    <script src="{{ url('Crovex/HTML/assets/js/app.js') }}"></script>

    <script>
        document.querySelectorAll('.left-sidenav-menu li a').forEach(link => {
            link.addEventListener('click', function() {
                // Remove active-item class from all links
                document.querySelectorAll('.left-sidenav-menu li a').forEach(item => {
                    item.classList.remove('active-item');
                });

                // Add active-item class to the clicked link
                this.classList.add('active-item');
            });
        });
    </script>
</body>

</html>

<script>
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah form untuk dikirim langsung

        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun Anda!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna memilih "Ya, Logout!", kirimkan form logout
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true,
            width: 'resolve'
        });
    });
</script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


</body>
