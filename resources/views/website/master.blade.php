<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('title')


    <meta name="title" Content="{{ $settings->meta_title }}">

    <meta name="description" content="{{ $settings->meta_descrption }}">
    <meta name="keywords" content="My GTN, GTN">
    <link type="image/x-icon" href="{{ asset('public/logo/' . $settings->favicon) }}" rel="shortcut icon">


    <link href="{{ asset('public/logo/' . $settings->favicon) }}" rel="apple-touch-icon">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $settings->company_name }} - Home">

    <meta itemprop="name" content="My GTN - Home">
    <meta itemprop="description" content="My GTN">
    <meta itemprop="image" content="{{ asset('public/logo/' . $settings->favicon) }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="My GTN">
    <meta property="og:description" content="Global Trading Network">
    <meta property="og:image" content="{{ asset('public/logo/' . $settings->favicon) }}" />
    <meta property="og:image:type" content="png" />
    <meta property="og:image:width" content="1180" />
    <meta property="og:image:height" content="600" />
    <meta property="og:url" content="{{ url('') }}">

    <meta name="twitter:card" content="summary_large_image">

    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="{{ asset('public/website/assets/global/css/bootstrap.min.css') }}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{ asset('public/website/assets/global/css/all.min.css') }}">
    <!-- lineawesome font -->
    <link rel="stylesheet" href="{{ asset('public/website/assets/global/css/line-awesome.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('public/website/assets/templates/basic/css/main.css') }}">

    <link rel="stylesheet" href="{{ asset('public/website/assets/templates/basic/css/custom.css') }}">

    <!-- slick  slider js -->
    <link rel="stylesheet" href="{{ asset('public/website/assets/global/css/lib/slick.css') }}">

    <style>
        #email-error {
            position: absolute;
            z-index: -1;
            opacity: 0;
            visibility: hidden;
        }

        .btn--base {
            background-color: #D18A32 !important;
        }

        .scroll-to-top {
            background-color: #D18A32 !important;
        }

        .choose-card__icon {
            background-color: #D18A32 !important;
        }

        .text--base {
            color: #D18A32 !important;
        }

        .hero__top-title {
            color: #D18A32 !important;
        }

        .section-subtitle {
            color: #D18A32 !important;
        }

        .btn--base,
        .btn--base:hover,
        body::-webkit-scrollbar-thumb,
        .scroll-to-top,
        .hero__radar [class*="dot-"],
        .hero__radar [class*="dot-"]::before,
        .hero__radar [class*="dot-"]::after,
        .choose-card__icon,
        .package-card__feature-list li::before,
        .package-card.popular-package::after,
        .post-share li a:hover,
        .blog-sidebar .title::after,
        .subscribe-form .subscribe-btn,
        .d-widget__icon::after,
        .social-link-list li a:hover,
        .contact-social-links li::before,
        .btn-outline--base:hover,
        .custom--accordion .accordion-button:not(.collapsed),
        .custom--table thead,
        .preloader__box [class*="line-"],
        body.lightmode .pagination .page-item.active .page-link {
            background-color: #D18A32 !important;
        }

        .text--base,
        .page-breadcrumb li:first-child::before,
        .header .main-menu li a:hover,
        .header .main-menu li a:focus,
        .main-menu li.active>a,
        .cmn-list li::before,
        .preloader__sitename,
        .lightmode .preloader__sitename,
        .page-breadcrumb li a:hover {
            color: #D18A32 !important;
        }

        .overview-card__icon ::before,
        .ratings i {
            color: #c52a0e !important;
        }
    </style>

    <link rel="stylesheet"
        href="{{ asset('public/website/assets/templates/basic/css/color871e.css?color=FB3640&amp;secondColor=0d222b') }}">
</head>

<body>

    <progress max="100" value="0" class="page-scroll-bar"></progress>

    <!-- scroll-to-top start -->
    <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="las la-arrow-up"></i>
        </span>
    </div>
    <!-- scroll-to-top end -->





    @yield('maincontent')





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('public/website/assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/website/assets/global/js/bootstrap.bundle.min.js') }}"></script>




    <!-- slick slider css -->
    <script src="{{ asset('public/website/assets/global/js/lib/slick.min.js') }}"></script>

    <!-- wow js  -->
    <script src="{{ asset('public/website/assets/templates/basic/js/lib/wow.min.js') }}"></script>


    <script src="{{ asset('public/website/assets/templates/basic/js/gsap.min.js') }}"></script>

    <script src="{{ asset('public/website/assets/templates/basic/js/ScrollTrigger.js') }}"></script>
    <script src="{{ asset('public/website/assets/templates/basic/js/app.js') }}"></script>



    <link rel="stylesheet" href="{{ asset('public/website/assets/global/css/iziToast.min.css') }}">
    <script src="{{ asset('public/website/assets/global/js/iziToast.min.js') }}"></script>


    @yield('javascript')
    <script>
        "use strict";

        function notify(status, message) {
            if (typeof message == 'string') {
                iziToast[status]({
                    message: message,
                    position: "topRight"
                });
            } else {
                $.each(message, function(i, val) {
                    iziToast[status]({
                        message: val,
                        position: "topRight"
                    });
                });
            }
        }
    </script>











</body>


</html>
