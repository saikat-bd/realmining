<style>
    table th,
    td {
        padding: 5px !important;
    }
</style>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')

    <!-- Custom fonts for this template-->
    <link href="{{ asset('public/users/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('public/users/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/users/font_awosme/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/users/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        #content {
            background: #ffffff;
        }

        .subtitle {
            color: rgb(250, 246, 246);
        }
    </style>

    <style>
        .bg-gradient-primary-cus {
            background-color: #3A46AE !important;
        }


        .btn-primary {
            background-color: #3A46AE;
            border-color: #3A46AE;
        }

        .btn-primary:hover {
            background-color: #3A46AE;
            border-color: white;
        }
    </style>
    @yield('style')

</head>


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        {{-- <ul class="navbar-nav bg-gradient-primary-cus sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-text mx-3">
                    <img alt="LIKE" height="50" src="{{ asset('public/logo/fabicon.png') }}" />
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('profile') }}">
                    <i class="fa fa-user-plus text-gray-400"></i>
                    <span>Profile</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('change-password') }}">
                    <i class="fa fa-key text-gray-400"></i>
                    <span>Change Password</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('logout') }}">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul> --}}
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                {{-- <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"
                        style="color:white;">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="subtitle">
                        @yield('sub_title')
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">




                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-white-600 small">{{ Auth::user()->name }}</span>

                                <img height="50" class="img-profile rounded-circle"
                                    src="{{ asset('public/logo/fabicon.png') }}">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ url('change-password') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('logout') }}" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar --> --}}


                <!-- Begin Page Content -->
                @yield('maincontianer')
                <!-- /.container-fluid -->



            </div>

            <div class="fixed-bottom bg-light mt-5">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('dashboard') }}">
                            <span></span>
                            Home
                        </a>
                        <a href="{{ url('profile') }}">
                            Profile
                        </a>
                        <a href="{{ url('change-password') }}">
                            Change Password
                        </a>
                        <a href="{{ url('logout') }}">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->



            <!-- Footer
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LIKE 2017</span>
                    </div>
                </div>
            </footer>-->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    {{-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> --}}

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/users/vendor/jquery/jquery.min.js') }}"></script>
    @yield('script')
    <script src="{{ asset('public/users/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('public/users/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('public/users/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('public/users/vendor/chart.js/Chart.min.js') }} "></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('public/users/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('public/users/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('public/users/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/users/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('public/users/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('public/users/js/jquery.syotimer.min.js') }}"></script>

</body>

</html>



<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }


    jQuery(function($) {
        /* Simple Timer. The countdown to 20:30 2035.05.09 */


        /* Periodic Timer. Period is equal 3 minutes. Effect of fading in */
        $('#periodic-timer_period_minutes').syotimer({
            year: 2020,
            month: 2,
            day: 2,
            hour: 24,
            minute: 0,
            layout: 'hms',
            doubleNumbers: false,
            effectType: 'opacity',
            periodUnit: 'm',
            periodic: true,
            periodInterval: 1440
        });

    });
</script>
