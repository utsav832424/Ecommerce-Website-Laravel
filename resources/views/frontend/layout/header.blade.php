<header class="hdr global_width hdr_sticky hdr-mobile-style2">
    <!-- Mobile Menu -->
    <div class="mobilemenu js-push-mbmenu">
        <div class="mobilemenu-content">
            <div class="mobilemenu-close mobilemenu-toggle">CLOSE</div>
            <div class="mobilemenu-scroll">
                <div class="mobilemenu-search"></div>
                <div class="nav-wrapper show-menu">
                    <div class="nav-toggle"><span class="nav-back"><i class="icon-arrow-left"></i></span> <span class="nav-title"></span></div>
                    <ul class="nav nav-level-1">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/new_arrivals')}}" title="">New Arrivals
                            <span class="menu-label menu-label--color1">NEW</span>
                        </a>
                    </li>
                    <li><a href="{{url('/all_product')}}" title="">SHOP BY</a><span class="arrow"></span>
                        <ul class="nav-level-2">
                            <li>
                                <a href="{{url('/all_product')}}" title="">Men's</a><span class="arrow"></span>
                                <ul class="nav-level-3">
                                    <li><a href="{{url('/all_product')}}" title="">T-shirt</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Shirts</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('/all_product')}}" title="">Women's</a><span class="arrow"></span>
                                <ul class="nav-level-3">
                                    <li><a href="{{url('/all_product')}}" title="">Kurti</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Top</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Salwar Suit & Gown</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Women Shorts</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Sarees</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Western Wear</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Salwar Kameez</a></li>
                                    <li><a href="{{url('/all_product')}}" title="">Women Lehenga Choli</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{url('/all_product')}}" title="">Kids</a><span class="arrow"></span>
                                <ul class="nav-level-3">
                                    <li><a href="{{url('/all_product')}}" title="">LEHENGA CHOLI</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{url('/hot_deals')}}" title="">hot Deals
                        <span class="menu-label menu-label--color3">Hurry Up!</span>
                    </a>
                </li>
                <li><a href="{{url('/aboutus')}}">About Us</a></li>
                <li><a href="{{url('/contactus')}}">Contact Us</a></li>
                
                
            </ul>
        </div>
        <div class="mobilemenu-bottom">
            <div class="mobilemenu-currency"></div>
            <div class="mobilemenu-language"></div>
            <div class="mobilemenu-settings"></div>
        </div>
    </div>
</div>
</div>
<!-- /Mobile Menu -->
<div class="hdr-mobile show-mobile">
    <div class="hdr-content">
        <div class="container">
            <!-- Menu Toggle -->
            <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
            <!-- /Menu Toggle -->
            <div class="logo-holder">
                <a href="{{url('/')}}" class="logo">
                    <img  src="{{asset('frontend/img/bigger.png')}}"style="width:91px">
                </a>
            </div>
            
            <div class="hdr-mobile-right">
                <div class="hdr-topline-right links-holder"></div>
                <div class="minicart-holder"></div>
            </div>
        </div>
    </div>
</div>
<div class="hdr-desktop hide-mobile">
    <div class="hdr-topline">
        <div class="container">
            <div class="row">
                
                <div class="col hdr-topline-center">
                    <div class="row">
                        <div class="custom-text">
                            <i></i><b>GST No: {{Helper::getSiteData('gst_no')}}</b>
                        </div>
                        <div class="custom-text">
                            <i class="icon icon-mobile"></i><b><a href="tel:91{{Helper::getSiteData('mobile')}}">+91 {{Helper::getSiteData('mobile')}}</a></b>
                        </div>
                    </div>
                </div>
                <div class="col-auto hdr-topline-right links-holder">
                    
                    <!-- Header Search -->
                    {{-- <div class="dropdn dropdn_search hide-mobile @@classes"><a href="https://www.thevintagegarments.com/search" class="dropdn-link"><i class="icon icon-search2"></i><span>Search</span></a>
                        <div class="dropdn-content">
                            <div class="container">
                                <form action="https://www.thevintagegarments.com/search" method="post" class="search"><button type="submit" class="search-button"><i class="icon-search2"></i></button> <input type="text" name="q" class="search-input data" placeholder="search keyword">
                                    <div class="search-popular js-search-autofill">
                                        <span class="search-popular-label">popular searches:</span>
                                        <a href='#'>kurti</a><a href='#'>top</a><a href='#'>salwar-suit---gown</a><a href='#'>women-shorts</a><a href='#'>sarees</a><a href='#'>western-wear</a><a href='#'>salwar-kameez</a><a href='#'>women-lehenga-choli</a>
                                    </div>
                                    <ul class="search-results res" style="position: absolute; left: 0px; top: 38px; display: none;">
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <!-- /Header Search -->
                    
                    <!-- Header Wishlist -->
                    <div class="dropdn dropdn_wishlist @@classes"><a href="{{url('/offers')}}" class="dropdn-link"><i class="icon icon-gift"></i><span>Offer</span></a></div>
                    @if (Session::has('userData'))
                        <div class="dropdn dropdn_wishlist @@classes"><a href="{{url('/my_wishlist')}}" class="dropdn-link"><i class="fa fa-heart-o" aria-hidden="true"></i><span>Wish List</span></a></div>
                    @endif
                    <!-- /Header Wishlist -->
                    <!-- Header Account -->
                    <div class="dropdn dropdn_account @@classes">
                        <a href="#" class="dropdn-link">
                            <i class="icon icon-person"></i>
                            @if (Session::has('userData'))
                                <span>{{Session::get('userData')->name}}</span>    
                            @endif
                            @if (!Session::has('userData'))
                                <span>My Account</span>    
                            @endif
                            {{-- <span>My Account</span> --}}
                        </a>
                        <div class="dropdn-content">
                            <div class="container">
                                <div class="dropdn-close">CLOSE</div>
                                <ul>
                                    @if (Session::has('userData'))
                                        <li><a href="{{url('/account_details')}}"><i class="icon icon-person-fill"></i><span>Profile</span></a></li>
                                        <li> <a href="{{url('/my_order_history')}}"><i class="icon icon-handbag"></i><span>Order</span></a></li>
                                        <li> <a href="{{url('/change_password')}}"><i class="icon icon-lock"></i><span>Change Password</span></a></li>
                                        <li><a href="{{url('/logout')}}"><i class="icon icon-lock"></i><span>Logout</span></a></li>
                                    @endif
                                    @if (!Session::has('userData'))
                                        <li><a href="{{url('/login')}}"><i class="icon icon-lock"></i><span>Login</span></a></li>
                                        <li><a href="{{url('/register')}}"><i class="icon icon-person-fill-add"></i><span>Register</span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Header Account -->
                </div>
            </div>
        </div>
    </div>
    <div class="hdr-content hide-mobile">
        <div class="container">
            <div class="row">
                <div class="col-auto logo-holder"><a href="{{url('/')}}" class="logo"><img src="{{asset('frontend/img/bigger.png')}}" srcset="{{asset('frontend/img/bigger.png')}}" alt=""></a></div>
                <!--navigation-->
                <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                <div class="nav-holder">
                    <div class="hdr-nav">
                        <!--mmenu-->
                        <ul class="mmenu mmenu-js">
                            <li class="mmenu-item--simple"><a href="{{url('/')}}" title="">Home</a></li>
                            <li class="mmenu-item--simple"><a href="{{url('/new_arrivals')}}" title="">New Arrivals
                                <span class="menu-label menu-label--color1">NEW</span>
                            </a>
                        </li>
                        
                        <li class="mmenu-item--simple"><a href="{{url('/all_product')}}" title="">Shop By</a>
                            <div class="mmenu-submenu">
                                <ul class="submenu-list">
                                    {{-- @foreach (Helper::getAllActiveCategory() as $item)
                                    <li>
                                        <a href="{{url('/all_product')}}" title="{{$item->name}}">{{$item->name}}</a>
                                        <ul class="nav-level-3">
                                            <li><a href="{{url('/all_product')}}" title="">T-shirt</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Shirts</a></li>
                                        </ul>
                                    </li>
                                    @endforeach --}}
                                    {{Helper::getAllActiveCategory()}}
                                    {{-- <li>
                                        <a href="{{url('/all_product')}}" title="Men's">Men's</a>
                                        <ul class="nav-level-3">
                                            <li><a href="{{url('/all_product')}}" title="">T-shirt</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Shirts</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{url('/all_product')}}" title="Women's">Women's</a>
                                        <ul class="nav-level-3">
                                            <li><a href="{{url('/all_product')}}" title="">Kurti</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Top</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Salwar Suit & Gown</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Women Shorts</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Sarees</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Western Wear</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Salwar Kameez</a></li>
                                            <li><a href="{{url('/all_product')}}" title="">Women Lehenga Choli</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{url('/all_product')}}" title="Kids">Kids</a>
                                        <ul class="nav-level-3">
                                            <li><a href="{{url('/all_product')}}" title="">LEHENGA CHOLI</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </div>
                        </li>
                        <li class="mmenu-item--simple"><a href="{{url('/hot_deals')}}" title="">hot Deals
                            <span class="menu-label menu-label--color3">Hurry Up!</span>
                        </a>
                    </li>
                    <li class="mmenu-item--mega"><a href="{{url('/aboutus')}}">About Us</a></li>
                    <li class="mmenu-item--mega"><a href="{{url('/contactus')}}">Contact Us</a>
                        
                    </li>
                </ul>
                <!--/mmenu-->
            </div>
        </div>
        <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
        <!--//navigation-->
        <div class="col-auto minicart-holder">
            <div class="minicart minicart-js">
                <a href="#" class="minicart-link">
                    <i class="icon icon-handbag"></i> <span class="minicart-qty">{{Helper::getNumberCartProduct()}}</span> 
                    <span class="minicart-title">Shopping Cart</span> <span class="minicart-total">&#x20B9; {{Helper::getCartProductAmount()}}</span>
                </a>
                <div class="minicart-drop">
                    <div class="container">
                        <div class="minicart-drop-close">CLOSE</div>
                        <div class="minicart-drop-content">
                            <h3>Recently added items:</h3>
                            {{Helper::getCartProduct()}}
                            <div class="minicart-drop-total">
                                <div class="float-right"><span class="minicart-drop-summa"><span>Cart Subtotal:</span> <b>&#x20B9; {{Helper::getCartProductAmount()}}</b></span>
                                    <div class="minicart-drop-btns-wrap">
                                        <a href="{{Helper::getCartProductAmount() == 0 ? 'javascript:void()' : url('/checkout')}}" class="btn"><i class="icon-check-box"></i><span>checkout</span></a> 
                                        <a href="{{url('/view_cart')}}" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a></div>
                                </div>
                                <div class="float-left"><a href="{{url('/view_cart')}}" class="btn btn--alt"><i class="icon-handbag"></i><span>view cart</span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="sticky-holder compensate-for-scrollbar">
    <div class="container">
        <div class="row"><a href="#" class="mobilemenu-toggle show-mobile"><i class="icon icon-menu"></i></a>
            <div class="col-auto logo-holder-s"><a href="{{url('/')}}" class="logo"><img src="{{asset('frontend/img/bigger.png')}}" srcset="{{asset('frontend/img/bigger.png')}}" alt=""></a></div>
            <!--navigation-->
            <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
            <div class="nav-holder-s"></div>
            <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
            <!--//navigation-->
            <div class="col-auto minicart-holder-s"></div>
        </div>
    </div>
</div>
</header>