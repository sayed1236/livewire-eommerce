<div>
    <!-- Start of Footer -->
    <footer class="footer appear-animate" data-animation-options="{
        'name': 'fadeIn'
    }">
        <div class="footer-newsletter bg-primary pt-6 pb-6">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="icon-box icon-box-side text-white">
                            <div class="icon-box-icon d-inline-flex">
                                <i class="w-icon-envelop3"></i>
                            </div>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-white text-uppercase mb-0">Subscribe To Our
                                    Newsletter</h4>
                                <p class="text-white">Get all the latest information on Events, Sales and Offers.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                        <form wire:submit.prevent="subscribe" 
                            class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                            <input type="email" wire:model="subemail" class="form-control mr-2 bg-white"  id="email"
                                placeholder="Your E-mail Address"/>
                            <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                    class="w-icon-long-arrow-right"></i></button>
                                    
                        </form>
                        @error('subemail')
                                    <div class="" style="background-color: white; color:red; height:40px; font-size:15px">the subscribe mail must be a valid</div>
                                @enderror
                                @if($erroremail !==null)
                                <div class="" style="background-color: white; color:red; height:40px; font-size:15px">{{ @$erroremail }}</div>
                                @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-about">
                            <a href="{{ route('home') }}" class="logo-footer">
                                <img src="{{ url('site/images/logo.png') }}" alt="logo-footer"/>
                            </a>
                            <div class="widget-body">
                            
                            <div class="der-call"> <i class="fal fa-headphones-alt"></i>
                                <p class="widget-about-title">Call us 24/7</p>
                                <a href="tel:90123456789" class="widget-about-call">90123456789</a>
                            </div>
                                
                                <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                    & coupons ster now toon.
                                </p>

                                <div class="social-icons social-icons-colored">
                                    <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                    <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                    <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                    <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                    <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h3 class="widget-title">Company</h3>
                            <ul class="widget-body qu-links">
                                {{--  <li><a href="{{ route('trader.') }}">About Us</a></li>  --}}
                                <li><a href="#">Team Member</a></li>
                                <li><a href="#">Career</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="#">Affilate</a></li>
                                <li><a href="#">Order History</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4>
                            <ul class="widget-body qu-links">
                                <li><a href="{{ route('trader.account') }}">Track My Order</a></li>
                                <li><a href="{{ route('trader.cart') }}">View Cart</a></li>
                                <li><a href="{{ route('trader.loginastrader') }}">Sign In</a></li>
                                {{--  <li><a href="#">Help</a></li>  --}}
                                <li><a href="{{ route('trader.wishlist') }}">My Wishlist</a></li>
                                <li><a href="{{ route('trader.privacy','privacy') }}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>
                            <ul class="widget-body qu-links">
                                <li><a href="{{ route('home') }}">Payment Methods</a></li>
                                <li><a href="{{ route('home') }}">Money-back guarantee!</a></li>
                                <li><a href="{{ route('home') }}">Product Returns</a></li>
                                <li><a href="{{ route('home') }}">Support Center</a></li>
                                <li><a href="{{ route('home') }}">Shipping</a></li>
                                <li><a href="{{ route('home') }}">Term and Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-left">
                    <p class="copyright">Copyright © 2023 Octopios. All Rights Reserved.</p>
                </div>
                <div class="footer-right">
                    <span class="payment-label mr-lg-8">We're using safe payment for</span>
                    <figure class="payment">
                        <img src="{{url('site/images/payment.png')}}" alt="payment" width="159" height="25"/>
                    </figure>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
    
</div>
