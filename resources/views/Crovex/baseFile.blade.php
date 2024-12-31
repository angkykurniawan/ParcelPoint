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

        <style>
            .active-item {
                background-color: #3475FE !important;
                color: white !important;
                border-radius: 5px;
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
                        <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="logo-large" class="logo-lg" style="width: 150px; height: auto;">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <!-- Navbar -->
            <nav class="navbar-custom">
                <ul class="list-unstyled topbar-nav float-right mb-0">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <img src="{{ url('Crovex/HTML/assets/images/users/user-1.png') }}" alt="profile-user" class="rounded-circle" />
                            <span class="ml-1 nav-user-name hidden-sm">Aziz <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                    </li>
                </ul><!--end topbar-nav-->
                <ul class="list-unstyled topbar-nav mb-0">
                    <li>
                        <button class="nav-link button-menu-mobile waves-effect waves-light">
                            <i class="ti-menu nav-icon"></i>
                        </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" id="AllCompo" placeholder="Search..." class="form-control">
                            <a href=""><i class="fas fa-search"></i></a>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidenav -->
        <div class="left-sidenav">
            <ul class="metismenu left-sidenav-menu">
                <li>
                    <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active-item' : '' }}"><i class="ti-bar-chart"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                </li>
                <li>
                    <a href="/pemilik" class="{{ Request::is('pemilik') ? 'active-item' : '' }}"><i class="ti-crown"></i><span>Pemilik</span><span class="menu-arrow"></span></a>
                </li>
                <li>
                    <a href="/ruang" class="{{ Request::is('ruang') ? 'active-item' : '' }}"><i class="ti ti-folder"></i><span>Ruang</span><span class="menu-arrow"></span></a>
                </li>
                <li>
                    <a href="/suratPaket" id="suratPaketLink" class="{{ Request::is('suratPaket') ? 'active-item' : '' }}"><i class="ti ti-package"></i><span>Surat & Paket</span><span class="menu-arrow"></span></a>
                </li>
                <li>
                    <a href="/kurir" class="{{ Request::is('kurir') ? 'active-item' : '' }}"><i class="ti ti-map"></i><span>Kurir</span><span class="menu-arrow"></span></a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="position: fixed; bottom: 10px; left: 7%; transform: translateX(-50%);">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-power-off"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- end left-sidenav-->

        <div class="page-wrapper">
            <!-- Page Content-->
            <div class="page-content">
                @yield('content')
            </div>
            <footer class="footer text-center text-sm-left">
                <span class="text-muted d-none d-sm-inline-block float-right"> 2024 &copy; ParcelPoint </span>
            </footer><!--end footer-->
        </div>
        <!-- end page content -->

        <!-- jQuery  -->
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
                link.addEventListener('click', function () {
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
