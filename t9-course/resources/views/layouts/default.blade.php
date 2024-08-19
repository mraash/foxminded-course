<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield ('webTitle') | Course</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">

        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

        <!-- iCheck -->
        {{-- <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}

        <!-- JQVMap -->
        {{-- <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/jqvmap/jqvmap.min.css') }}"> --}}

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/admin-lte/dist/css/adminlte.min.css') }}">

        <!-- overlayScrollbars -->
        {{-- <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> --}}

        <!-- Daterange picker -->
        {{-- <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/daterangepicker/daterangepicker.css') }}"> --}}

        <!-- summernote -->
        {{-- <link rel="stylesheet" href="{{ asset('/admin-lte/plugins/summernote/summernote-bs4.min.css') }}"> --}}

        <!-- Custom css -->
        <link rel="stylesheet" href="{{ asset('/my-assets/styles.css') }}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('/admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
            </div>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{ route('pages.students.index') }}" class="brand-link">
                    <img
                        src="{{ asset('/admin-lte/dist/img/AdminLTELogo.png') }}"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8"
                    >
                    <span class="brand-text font-weight-light">
                        Course
                    </span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ route('pages.groups.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        Groups
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pages.students.index') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Students
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pages.students.add') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>
                                        Add student
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pages.students.delete') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-minus"></i>
                                    <p>
                                        Delete student
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">
                                    @yield ('tableTitle')
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield ('content')
                    </div>
                </section>

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('/admin-lte/plugins/jquery/jquery.min.js') }}"></script>

        <!-- jQuery UI 1.11.4 -->
        {{-- <script src="{{ asset('/admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}

        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        {{-- <script> $.widget.bridge('uibutton', $.ui.button) </script> --}}

        <!-- Bootstrap 4 -->
        {{-- <script src="{{ asset('/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

        <!-- ChartJS -->
        {{-- <script src="{{ asset('/admin-lte/plugins/chart.js/Chart.min.js') }}"></script> --}}

        <!-- Sparkline -->
        {{-- <script src="{{ asset('/admin-lte/plugins/sparklines/sparkline.js') }}"></script> --}}

        <!-- JQVMap -->
        {{-- <script src="{{ asset('/admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}

        <!-- jQuery Knob Chart -->
        {{-- <script src="{{ asset('/admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}

        <!-- daterangepicker -->
        {{-- <script src="{{ asset('/admin-lte/plugins/moment/moment.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}

        <!-- Tempusdominus Bootstrap 4 -->
        {{-- <script src="{{ asset('/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}

        <!-- Summernote -->
        {{-- <script src="{{ asset('/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}

        <!-- overlayScrollbars -->
        {{-- <script src="{{ asset('/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}

        <!-- AdminLTE App -->
        <script src="{{ asset('/admin-lte/dist/js/adminlte.js') }}"></script>

        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('/admin-lte/dist/js/demo.js') }}"></script> --}}

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('/admin-lte/dist/js/pages/dashboard.js') }}"></script>
    </body>
</html>
