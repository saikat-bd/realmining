 <section class="pt-100 pb-100">
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-lg-5">
                 <div class="section-header text-center wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.3s">
                     <div class="section-subtitle">Our Packages</div>
                     <h2 class="section-title">Find The Right Plan For You</h2>
                 </div>
             </div>
         </div><!-- row end -->
         <div class="row gy-4 justify-content-center">
             <div class="col-lg-10">
                 <div class="row gy-4 justify-content-center">

                     @foreach ($packages as $item)
                         <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-duration="0.5" data-wow-delay="0.5s">
                             <div class="package-card">
                                 <h4 class="package-card__name">{{ $item->package_name }}</h4>
                                 <div class="package-card__price">${{ $item->amount }}</div>
                                 <ul class="package-card__feature-list mt-4">
                                     <li>Earning Rate ${{ $item->rabit }} daily</li>
                                     <li>{{ $item->duraction }} Days</li>
                                     <li>Total Profit ${{ number_format($item->total_amount - $item->amount, 2) }}</li>
                                     <li>You will get ${{ number_format($item->total_amount, 2) }} in total</li>
                                 </ul>
                             </div><!-- package-card end -->
                         </div>
                     @endforeach




                 </div><!-- row end -->
             </div>


         </div><!-- row end -->
     </div>
 </section>
 <!-- packaage section end -->

 <div class="modal fade cmn--modal" id="chooseModal">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title method-name">Please login before buy a package</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="mb-3">To purchase a package, you have to login into your account</p>
                 <div class="form-group">
                     <a href="user/login.html" class="btn btn-sm btn--success w-100">Login</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
