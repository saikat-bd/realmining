@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - About</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <section class="inner-hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/bread_crumb/6371e6fb120661668409083.jpg') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 class="title text-white">About</h2>
                        <ul class="page-breadcrumb justify-content-center">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li>About</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- about section start -->
        @include('website.include.about')
        <!-- about section end -->

        <!-- why choose section start -->
        @include('website.include.services')
        <!-- why choose section end -->

        <!-- overview section start -->
        @include('website.include.companygrow')
        <!-- overview section end -->


        <!-- faq section start -->
        @include('website.include.faq')
        <!-- faq section end -->
        <!-- cta section start -->
        @include('website.include.joinus')
        <!-- cta section end -->
        <!-- blog section start -->
        @include('website.include.blogs')
        <!-- blog section end -->
        <!-- subscribe section start -->
        @include('website.include.subscripbe')
        <!-- subscribe section end -->




    </div><!-- main-wrapper end -->
@endsection
