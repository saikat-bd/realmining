@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Account Recovery</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">


        <!-- blog section start -->
        <!-- inner hero section end -->
        <section class="registration-section pt-100 pb-100">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="registration-wrapper section--bg">
                            <form class="transparent-form verify-gcaptcha" method="POST"
                                action="{{ url('forgot-password') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">

                                    @if (Session::get('success'))
                                        <div class="col-lg-12 form-group">
                                            <div class="mb-4">
                                                <p>Please check you mail..</p>
                                            </div>
                                        @else
                                            <div class="col-lg-12 form-group">
                                                <div class="mb-4">
                                                    <p>Please provide your email username to find your account.</p>
                                                </div>
                                                <label>Email or account No</label>
                                                <input type="text" class="form--control " name="email" required
                                                    autofocus="off" placeholder="Enter email or account No">
                                                <div class="custom-icon-field">
                                                </div>

                                                @if (Session::get('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        Email or acount no incorrect!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <div class="col-lg-12 form-group mt-4">
                                                    <button type="submit" class="btn btn--base w-100">Submit</button>
                                                </div>
                                            </div>
                                    @endif


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog section end -->




    </div><!-- main-wrapper end -->
@endsection
