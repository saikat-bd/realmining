<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-8 col-lg-9">
                <div class="section-header text-center wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.3s">
                    <h2 class="section-title">
                        Over 52,000 people worldwide trust the {{ $settings->company_name }} - now it's your turn
                    </h2>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row gy-4 align-items-center justify-content-between">
            <div class="col-lg-5 text-lg-start text-center">
                <div class="about-thumb wow fadeInLeft" data-wow-duration="0.5" data-wow-delay="0.5s">
                    <img src="{{ asset('public/website/assets/images/frontend/about/61333db1010691630748081.png') }}"
                        alt="image">
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight text-lg-start text-center" data-wow-duration="0.5"
                data-wow-delay="0.5s">
                <h2 class="mb-2">
                    {{ $settings->company_name }} is the Features
                </h2>
                <p>
                    GTN is currently a community based cryptocurrency multi service platform. It provides referral
                    benefits, attractive income, attractive incentives, multi digital product services to people all
                    over the world.
                </p>
                <ul class="cmn-list about-list mt-4">
                    <li>Our platform is built on top of the biggest cloud providers in the world with uptime 99.99%
                    </li>
                    <li>Launch your validator in minutes, instalt auto-scale to adapt the load without any downtime.
                    </li>
                    <li>You focus on your business ideas, we ensure your infrastructure is up and stable and always
                        up to date.</li>
                </ul>
                <a href="{{ url('create-new-account') }}" class="btn btn--base style--two mt-5">Get Started
                    <i class="las la-long-arrow-alt-right me-0 ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>
