<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LIKE | Digital Marketing Business</title>
    <!-- loader-->
    <link href="{{ asset('public/login/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('public/login/js/pace.min.js') }}"></script>
    <!--favicon-->
    <link rel="shortcut icon" href="{{ asset('public/assets/logo/favicon.png') }}">
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('public/login/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/login/css/app-style.css') }}" rel="stylesheet" />


</head>

<body class="bg-theme bg-theme1">


    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img width="170" height="100" src="{{ asset('public/assets/logo/logo.png') }}" />
                    </div>

                    @if (Session::has('success'))
                        <strong>Please check your email, we are send link</strong>
                    @else
                        <div class="card-title text-uppercase text-center py-3">Forgot password</div>
                        <form method="POST" action="{{ url('forgot-password') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <div class="position-relative has-icon-right">
                                    <input type="text" id="email"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif input-shadow"
                                        name="email" placeholder="Enter E-mail" value="{{ old('email') }}">
                                    <div class="form-control-position">
                                        <i class="icon-user"></i>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div id="validationServer03Feedback" style="color:red;"
                                            class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                            </div>


                            <button type="submit" class="btn btn-light btn-block">Reset Password</button>
                            <div style="margin-top:20px;">
                                <a href="{{ url('auth') }}">←back to Login</a>
                            </div>
                        </form>
                    @endif




                </div>
            </div>

        </div>


    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('public/login/js/bootstrap.min.js') }}"></script>


</body>

</html>
