<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{{ $settings->company_name }}</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/fonts.googleapis.com.css') }}" />
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/ace.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/ace-rtl.min.css') }}" />

</head>

<body class="login-layout login-layout light-login">
    <div class="main-container">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <div class="center">
                            <h1>
                                <i class="ace-icon fa fa-leaf green"></i>
                                <span class="red">{{ $settings->company_name }}</span>
                                <span class="white" id="id-text2"></span>
                            </h1>
                            <h4 class="blue" id="id-company-text">&copy; Software</h4>
                        </div>

                        <div class="space-6"></div>

                        <div class="position-relative">
                            <div id="login-box" class="login-box visible widget-box no-border">
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <h4 class="header blue lighter bigger">
                                            <i class="ace-icon fa fa-coffee green"></i>
                                            Please Enter Your Information
                                        </h4>

                                        @if (Session::has('error'))
                                            <div class="alert alert-danger
												alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>
                                                <strong>{{ Session::get('error') }}</strong>
                                            </div>
                                        @endif
                                        <div class="space-6"></div>

                                        <form method="POST" action="{{ url('adminlogincheck') }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <fieldset>
                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="text" name="email" autocomplete="off"
                                                            id="email" class="form-control" placeholder="E-mail" />
                                                        <i class="ace-icon fa fa-user"></i>
                                                        @if ($errors->has('email'))
                                                            <div id="validationServer03Feedback"
                                                                class="invalid-feedback">
                                                                {{ $errors->first('email') }}
                                                            </div>
                                                        @endif
                                                    </span>
                                                </label>

                                                <label class="block clearfix">
                                                    <span class="block input-icon input-icon-right">
                                                        <input type="password" name="password" autocomplete="off"
                                                            id="password" required class="form-control"
                                                            placeholder="Password" />
                                                        <i class="ace-icon fa fa-lock"></i>
                                                        @if ($errors->has('password'))
                                                            <div id="validationServer03Feedback"
                                                                class="invalid-feedback">
                                                                {{ $errors->first('password') }}
                                                            </div>
                                                        @endif
                                                    </span>
                                                </label>

                                                <div class="space"></div>

                                                <div class="clearfix">
                                                    <label class="inline">
                                                        <input type="checkbox" class="ace" />
                                                        <span class="lbl"> Remember Me</span>
                                                    </label>

                                                    <button type="submit"
                                                        class="width-35 pull-right btn btn-sm btn-primary">
                                                        <i class="ace-icon fa fa-key"></i>
                                                        <span class="bigger-110">Login</span>
                                                    </button>
                                                </div>

                                                <div class="space-4"></div>
                                            </fieldset>
                                        </form>

                                        <div class="social-or-login center">
                                            <span class="bigger-110">Or Login Using</span>
                                        </div>

                                        <div class="space-6"></div>


                                    </div><!-- /.widget-main -->


                                </div><!-- /.widget-body -->
                            </div><!-- /.login-box -->





                        </div><!-- /.position-relative -->


                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.main-content -->
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="{{ asset('public/admin/js/jquery-2.1.4.min.js') }}"></script>

    <!-- <![endif]-->
    <!--[if IE]>
        <script src="public/js/jquery-1.11.3.min.js"></script>
        <![endif]-->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write(
            "<script src='{{ asset('public/admin/js/jquery.mobile.custom.min.js') }}'>" + "<" +
            "/script>");
    </script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::has('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'E-mail or password is invalid!',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
</body>

</html>
