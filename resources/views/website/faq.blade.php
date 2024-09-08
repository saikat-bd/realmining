@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Faq</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <section class="inner-hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/bread_crumb/6371e6fb120661668409083.jpg') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 class="title text-white">Faq</h2>
                        <ul class="page-breadcrumb justify-content-center">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li>Faq</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>




        <!-- faq section start -->
        @include('website.include.faq')
        <!-- faq section end -->
        <!-- cta section start -->
        @include('website.include.services')
        <!-- cta section end -->






    </div><!-- main-wrapper end -->
@endsection
