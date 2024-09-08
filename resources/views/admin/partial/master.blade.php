<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    @yield('title')
    <meta name="description" content="Mailbox with some customizations as described in docs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <!-- page specific plugin styles -->
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/fonts.googleapis.com.css') }}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/ace.min.css') }}" class="ace-main-stylesheet"
        id="main-ace-style" />
    <!--[if lte IE 9]>
   <link rel="stylesheet" href="{{ asset('public/admin/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
  <![endif]-->
    <link rel="stylesheet" href="{{ asset('public/admin/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/ace-rtl.min.css') }}" />

    <script src="{{ asset('public/admin/js/ace-extra.min.js') }}"></script>
    @yield('cssfile')
    <style>
        .invalid-feedback {
            color: red;
        }
    </style>
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler"
                data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="{{ url('admin/dashboard') }}" class="navbar-brand">
                    <small>
                        {{ $settings->company_name }}
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">


                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="{{ asset('public/logo/' . $settings->logo) }}"
                                alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                {{ Auth::user()->name }}
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul
                            class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="#">
                                    <i class="ace-icon fa fa-cog"></i>
                                    Settings
                                </a>
                            </li>

                            <li>
                                <a href="profile.html">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="{{ url('admin/logout') }}">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        @include('admin.partial.navbar')

        <div class="main-content">
            @yield('mainsection')
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <span class="blue bolder">{{ $settings->company_name }}</span>
                        Application &copy; 2023-2023
                    </span>

                    &nbsp; &nbsp;
                    <span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->
    <!--[if !IE]> -->
    <script src="{{ asset('public/admin/js/jquery-2.1.4.min.js') }}"></script>
    <!-- <![endif]-->
    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write(
            "<script src='{{ asset('public/admin/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
    </script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <!-- page specific plugin scripts -->
    <script src="{{ asset('public/admin/js/bootstrap-tag.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.hotkeys.index.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap-wysiwyg.min.js') }}"></script>

    <!-- ace scripts -->
    <script src="{{ asset('public/admin/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/ace.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('javascript')

</body>

</html>
