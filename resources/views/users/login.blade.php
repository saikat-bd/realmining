<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LIKE | Digital Marketing Business</title>

    <!-- loader
    <link href="{{ asset('public/login/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/login/js/pace.min.js') }}"></script>
 -->
    <!--favicon-->
    <link rel="shortcut icon" href="{{ asset('public/assets/logo/favicon.png') }}">
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('public/login/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/app-style.css') }}" rel="stylesheet" />
    <style>
        .eye {
            position: absolute;
            margin-top: -35px;
            right: 0;
            padding-right: 5px;
            cursor: pointer;
        }

        #hide1 {
            display: none;
        }
    </style>

</head>

<body class="bg-theme bg-theme1">

    <!-- start loader
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>-->
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">


        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img width="170" height="100" src="{{ asset('public/assets/logo/logo.png') }}" />
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Sign In</div>
                    <form method="POST" action="{{ url('login-check') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="username" class="form-control input-shadow" required
                                    autofocus name="username" placeholder="Username">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="password" name="password" required
                                    class="form-control input-shadow" placeholder="Enter Password">
                                <span class="eye toggle-password">
                                    <span id="hide1" class="material-icons-outlined">visibility</span>
                                    <span id="hide2" class="material-icons-outlined">visibility_off</span>
                                </span>
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <div class="icheck-material-white">
                                    <input type="checkbox" id="user-checkbox" checked="" />
                                    <label for="user-checkbox">Remember me</label>
                                </div>
                            </div>
                            <div class="form-group col-6 text-right">
                                <a href="{{ url('reset-password') }}">Forgot password?</a>
                            </div>
                        </div>

                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert"
                                style="padding-left: 10px; padding-top:10px;">
                                <strong>Incorrect!</strong> <br />Username or password!<br /> &nbsp;
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <button type="submit" class="btn btn-light btn-block">Sign In</button>
                        <div style="margin-top:20px;">
                            <a href="{{ url('') }}">←back to home page</a> | <a
                                href="{{ url('create-new-account') }}">->Create new account</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/login/js/bootstrap.min.js') }}"></script>


</body>

</html>
