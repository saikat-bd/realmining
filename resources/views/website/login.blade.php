@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Login</title>
@endsection

<style>
    .eye {
        position: absolute;
        margin-top: 0px;
        right: 0;
        padding-right: 50px;
        cursor: pointer;
    }

    #hide1 {
        display: none;
    }
</style>

@section('maincontent')
    <div class="main-wrapper">



        <!-- Login section start -->
        <section class="registration-section pt-100 pb-100">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="registration-wrapper section--bg">
                            <form class="transparent-form verify-gcaptcha" method="POST" action="{{ url('login-check') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <label>Email <sup class="text--danger">*</sup></label>
                                        <div class="custom-icon-field">
                                            <i class="las la-user"></i>
                                            <input type="text" name="username" class="form--control"
                                                placeholder="Enter email." autocomplete="off" value="{{ old('username') }}"
                                                required>
                                        </div>
                                        <div class="col-lg-12 form-group mt-3">
                                            <label>Password <sup class="text--danger">*</sup></label>
                                            <div class="custom-icon-field">
                                                <i class="las la-key"></i>
                                                <input type="password" autocomplete="new-password" class="form--control"
                                                    id="userpass" name="password" placeholder="Enter password" required>
                                                <span class="eye toggle-password">
                                                    <i id="hide1" class="hideshow 64px lar la-eye"></i>
                                                    <i id="hide2" class="hideshow 64px las la-low-vision"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @if (Session::get('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Wrong!</strong> Acount Number. or password incorrect!
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif



                                        <div class="col-lg-12 form-group d-flex justify-content-between flex-wrap">
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember">
                                                <label class="form-check-label" for="remember">Remember Me</label>
                                            </div>
                                            <a href="{{ url('forgot-password') }}" class="text--base">Forgot Password?</a>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn--base w-100">Login</button>
                                            <p class="text-center mt-3"> Don't have an account?
                                                <a href="{{ url('create-new-account') }}" class="text--base">
                                                    Create Account </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>




    </div><!-- main-wrapper end -->
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {

            $('.hideshow').click(function() {

                var paswd = $('#userpass');

                if (paswd.attr("type") === "password") {
                    paswd.attr("type", "text");
                    $('#hide1').css('display', 'block');
                    $('#hide2').css('display', 'none');
                } else {
                    paswd.attr("type", "password");
                    $('#hide1').css('display', 'none');
                    $('#hide2').css('display', 'block');

                }
            })
        });
    </script>
@endsection
