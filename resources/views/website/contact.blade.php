@extends('website.master')
@section('title')
    <title>{{ $settings->company_name }} - Contact Us</title>
@endsection
@section('maincontent')
    <div class="main-wrapper">

        <section class="inner-hero bg_img"
            style="background-image: url('{{ asset('public/website/assets/images/frontend/bread_crumb/6371e6fb120661668409083.jpg') }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2 class="title text-white">Contact Us</h2>
                        <ul class="page-breadcrumb justify-content-center">
                            <li><a href="{{ url('') }}">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- blog section start -->
        <section class="contact-section overflow-hidden">
            <div class="map-area bg_img"
                style="background-image: url('{{ asset('public/website/assets/templates/basic/images/bg/map.jpg') }}');">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 text-lg-start text-center">
                            <h2 class="section-title text-white">Get in Touch</h2>
                            <p class="text-white-75">Amet consectetur adipisicing elit. Odit ipsa, blanditiis corrupti ut
                                dolorem dolore consequatur quod inventore illum sapiente odio eius.</p>
                        </div>
                        <div class="col-lg-5 text-lg-end text-center">
                            <div class="map-info-box">
                                <div class="map-info rounded-3">
                                    <p class="text-white-75"><strong class="fw-bold">Location :
                                        </strong>{{ $settings->address }}</p>
                                    <p><a href="https://www.google.com/maps/place/Level+57%2F25+Martin+Pl,+Sydney+NSW+2000,+Australia/@-33.8684318,151.2066334,17z/data=!3m2!4b1!5s0x6b12ae1496d20a6f:0x719e447d17d1f198!4m6!3m5!1s0x6b12ae400eb3aaad:0x497ddd4d4f10c9c2!8m2!3d-33.8684363!4d151.2092083!16s%2Fg%2F11q2t3601y?entry=tts&shorturl=1"
                                            target="_blank" class="text--base fs--14px">See on google map</a></p>
                                </div>
                                <div class="map-icon">
                                    <i class="las la-map-marker"></i>
                                    <div class="map-pointer-shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- map-area end -->
            <div class="contact-area pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-wrapper section--bg d-flex flex-wrap">
                                <div class="contact-wrapper__left">
                                    <form class="transparent-form verify-gcaptcha" method="post" action="#">
                                        <input type="hidden" name="_token"
                                            value="t4ju17eYtPRZUZ0228PoYcEVNASPQcOCZMgEXQLb">
                                        <div class="row">
                                            <div class="col-xl-6 form-group">
                                                <label>Name <sup class="text--danger">*</sup></label>
                                                <div class="custom-icon-field">
                                                    <i class="las la-user"></i>
                                                    <input name="name" type="text" class="form--control"
                                                        placeholder="Enter name" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 form-group">
                                                <label>Email <sup class="text--danger">*</sup></label>
                                                <div class="custom-icon-field">
                                                    <i class="las la-envelope"></i>
                                                    <input name="email" type="text" class="form--control"
                                                        placeholder="Enter email" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group">
                                                <label>Subject <sup class="text--danger">*</sup></label>
                                                <div class="custom-icon-field">
                                                    <i class="las la-sticky-note"></i>
                                                    <input name="subject" type="text" class="form--control"
                                                        placeholder="Enter subject" value="" required>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group">
                                                <label>Message <sup class="text--danger">*</sup></label>
                                                <div class="custom-icon-field">
                                                    <i class="las la-envelope-square"></i>
                                                    <textarea name="message" wrap="off" class="form--control" placeholder="Enter message" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group">
                                                <div class="mb-3">

                                                    <script src="../../../www.google.com/recaptcha/api.js"></script>
                                                    <div class="g-recaptcha"
                                                        data-sitekey="6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV"
                                                        data-callback="verifyCaptcha"></div>
                                                    <div id="g-recaptcha-error"></div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn--base w-100">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="contact-wrapper__right">
                                    <div class="mb-4">
                                        <h4 class="mb-4">Contact Info</h4>
                                        <ul class="contact-info-list">
                                            <li class="contact-info-single">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <p>{{ $settings->address }}</p>
                                            </li>
                                            <li class="contact-info-single">
                                                <i class="far fa-envelope"></i>
                                                <p><a href="mailto:{{ $settings->email }}"
                                                        class="__cf_email__">{{ $settings->email }}</a>
                                                </p>
                                            </li>
                                            <li class="contact-info-single">
                                                <i class="las la-phone"></i>
                                                <p>{{ $settings->phone_number }}</p>
                                            </li>
                                            <li class="contact-info-single">
                                                <i class="las la-globe-americas"></i>
                                                <p>{{ $settings->website }}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog section end -->




    </div><!-- main-wrapper end -->
@endsection
