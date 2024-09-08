@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Packages</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <section class="inner-hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/bread_crumb/6371e6fb120661668409083.jpg') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 class="title text-white">Packages</h2>
                        <ul class="page-breadcrumb justify-content-center">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li>Packages</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <!-- cta section start -->
        @include('website.include.packages')
        <!-- cta section end -->

        <!-- faq section start -->
        @include('website.include.faq')
        <!-- faq section end -->







    </div><!-- main-wrapper end -->
@endsection
