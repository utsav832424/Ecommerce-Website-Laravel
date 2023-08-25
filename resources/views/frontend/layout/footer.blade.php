<footer class="page-footer footer-style-1 global_width">
    <div class="holder bgcolor bgcolor-1 mt-0">
        <div class="container">
            <div class="row shop-features-style3">
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">worlwide delivery</div>
                        </div>
                    </a>
                </div>
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">100% Verified Products</div>
                        </div>
                    </a>
                </div>
                <div class="col-md"><a href="#" class="shop-feature light-color">
                        <div class="shop-feature-icon"><i class="icon-call"></i></div>
                        <div class="shop-feature-text">
                            <div class="text1">customer support</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top container">
        <div class="row py-md-4">
            <div class="col-md-4 col-lg">
                <div class="footer-block collapsed-mobile">
                    <div class="title">
                        <h4>Categories</h4>
                        <div class="toggle-arrow"></div>
                    </div>
                    <div class="collapsed-content">
                        <ul>
                            @foreach (Helper::getCategory() as $item)
                                <li><a href="/all_product/category/{{$item->slug}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg">
                <div class="footer-block collapsed-mobile">
                    <div class="title">
                        <h4>Information</h4>
                        <div class="toggle-arrow"></div>
                    </div>
                    <div class="collapsed-content">
                        <ul>
                            <li><a href="{{url('/aboutus')}}">About Us</a></li>
                            <li><a href="{{url('/contactus')}}">Contact Us</a></li>
                            {{-- <li><a href="https://www.thevintagegarments.com/faq">How to buy (FAQ)</a></li> --}}
                            <li><a href="{{url('/offers')}}">Offers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-lg-4">
                <div class="footer-block collapsed-mobile">
                    <div class="title">
                        <h4>contact us</h4>
                        <div class="toggle-arrow"></div>
                    </div>
                    <div class="collapsed-content">
                        <ul class="contact-list">
                            <li><i class="icon-phone"></i>
                                <span>
                                    <span class="h6-style">Call Us:</span>
                                    <span><a href="tel:91{{Helper::getSiteData('mobile')}}" style="color: #001454;">+91 {{Helper::getSiteData('mobile')}}</a></span>
                                </span>
                            </li>
                            <li><i class="icon-mail-envelope1"></i>
                                <span>
                                    <span class="h6-style">E-mail:</span>
                                    <span><a href="mailto:{{Helper::getSiteData('email')}}">{{Helper::getSiteData('email')}}</a></span>
                                </span>
                            </li>
                            <li><i class="icon-location1"></i><span><span class="h6-style">Address:</span><span>{{Helper::getSiteData('address')}}</span></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom container">
        <div class="row lined py-2 py-md-3">
            <div class="col-md-2 hidden-mobile"><a href="{{url('/')}}"><img src="{{asset('frontend/img/bigger.png')}}" class="img-fluid footer_logo" alt=""></a></div>
            <div class="col-md-7 col-lg-7 footer-copyright">
                <p class="footer-copyright-text"><span>© Copyright</span> 2020 Bigger. <span>All rights reserved Developed By <a href="https://truelinesolution.com/" style="text-decoration-line: none;"> Make Dream Infotech.</a></span></p>
                <p class="footer-copyright-links"><a href="{{url('/termsandcondition')}}">Terms & conditions</a> <a href="{{url('/privacypolicy')}}">Privacy policy</a></p>
            </div>

            <div class="col-md-auto ml-lg-auto">
                <ul class="social-list">
                    <li><a href="javascript:void(0);" class="icon icon-facebook"></a></li>
                    <li><a href="javascript:void(0);" class="icon icon-linkedin"></a></li>
                    <li><a href="javascript:void(0);" class="icon icon-instagram"></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer><a class="back-to-top js-back-to-top compensate-for-scrollbar" href="#" title="Scroll To Top"><i class="icon icon-angle-up"></i></a>
<div id="modalWishlistAdd" class="modal-info modal--success" style="display: none;">
    <div class="modal-text"><i class="icon icon-heart-fill modal-icon-info"></i><span>Product added to wishlist</span></div>
</div>
<div id="modalWishlistRemove" class="modal-info modal--error" style="display: none;">
    <div class="modal-text"><i class="icon icon-heart modal-icon-info"></i><span>Product removed from wishlist</span></div>
</div>

<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-scrollLock.min.js')}}"></script>
<script src="{{asset('frontend/js/instafeed.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.ez-plus.min.js')}}"></script>
<script src="{{asset('frontend/js/tocca.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-tabcollapse.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.isotope.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.cookie.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('frontend/js/lazysizes.min.js')}}"></script>
<script src="{{asset('frontend/js/ls.bgset.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.form.min.js')}}"></script>
<script src="{{asset('frontend/js/validator.min.js')}}"></script>
<script src="{{asset('frontend/js/slider.js')}}"></script>
<script src="{{asset('frontend/js/app.js')}}"></script>
<script src="{{asset('backend/js/toastr.js')}}"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
@stack('scripts')