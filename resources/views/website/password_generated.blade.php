@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Create New Password</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <section class="inner-hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/bread_crumb/6371e6fb120661668409083.jpg') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 class="title text-white">Create New Password</h2>
                        <ul class="page-breadcrumb justify-content-center">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li>Create New Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- blog section start -->
        <!-- inner hero section end -->
        <section class="registration-section pt-100 pb-100">
            <div class="el-1"><img
                    src="{{ asset('public/website/assets/images/frontend/auth_image/63887dcc0aca71669889484.png') }}"
                    alt="image"></div>
            <div class="el-2"><img
                    src="{{ asset('public/website/assets/images/frontend/auth_image/63887dcc1789d1669889484.png') }}"
                    alt="image"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="registration-wrapper section--bg">
                            <form class="transparent-form verify-gcaptcha" method="POST"
                                action="{{ url('generated-new-password') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="token" value="{{ Request('token') }}">
                                <div class="row">
                                    <div class="col-lg-12 form-group">
                                        <div class="mb-4">
                                            <div>
                                                <label>New Password</label>
                                                <input type="password" class="form--control " name="password" required
                                                    autofocus="off">
                                            </div>


                                            <div class="mt-3">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form--control " name="confirm_password"
                                                    required autofocus="off">
                                            </div>


                                            @if (Session::get('error'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    Email or acount no incorrect!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <div class="col-lg-12 form-group mt-4">
                                                <button type="submit" class="btn btn--base w-100">Submit</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog section end -->




    </div><!-- main-wrapper end -->
@endsection
