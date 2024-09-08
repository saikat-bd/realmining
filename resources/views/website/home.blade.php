@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Home</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <!-- hero section start -->
        <section class="hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/banner/63887e0372c7c1669889539.jpg') }}');">
            <div class="hero__radar">
                <div class="hero__radar-content">
                    <div class="circle"><img
                            src="{{ asset('public/website/assets/templates/basic/images/elements/hero/circle.png') }}"
                            alt="image"></div>
                    <div class="radar"><img
                            src="{{ asset('public/website/assets/templates/basic/images/elements/hero/radar.png') }}"
                            alt="image"></div>
                    <span class="dot-1"></span>
                    <span class="dot-2"></span>
                    <span class="dot-3"></span>
                    <span class="dot-4"></span>
                    <span class="dot-5"></span>
                    <span class="dot-6"></span>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-lg-start text-center">
                        <div class="hero__top-title wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.3s">
                            {{ $settings->company_name }}
                        </div>
                        <h2 class="hero__title text-white wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.5s">
                            FOCUS YOUR SMART & DIGITAL GOAL
                        </h2>
                        <p class="hero__description text-white wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.7s">
                            You need tested strategies, powerful tools, and experienced traders to arm you with knowledge.
                            That's where we come in.
                        </p>
                        <a href="{{ url('auth') }}" class="btn btn--base mt-4 wow fadeInUp" data-wow-duration="0.5"
                            data-wow-delay="0.7s">
                            Join Us Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero section end -->
        <!-- about section start -->
        @include('website.include.about')
        <!-- about section end -->
        <!-- how it work start -->
        @include('website.include.whychoses')
        <!-- how it work end -->
        <!-- why choose section start -->
        @include('website.include.services')
        <!-- why choose section end -->
        <!-- overview section start -->
        @include('website.include.companygrow')
        <!-- overview section end -->
        <!-- packaage section start -->
        @include('website.include.packages')


        <!-- faq section start -->
        @include('website.include.faq')
        <!-- faq section end -->
        <!-- cta section start -->
        @include('website.include.joinus')
        <!-- cta section end -->
        <!-- blog section start -->

        <!-- blog section end -->
        <!-- subscribe section start -->
        @include('website.include.subscripbe')
        <!-- subscribe section end -->




    </div><!-- main-wrapper end -->
@endsection
