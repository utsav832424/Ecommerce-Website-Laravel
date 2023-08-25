@extends('frontend.layout.master')
@section('title','E-SHOP || HOME PAGE')
@section('main-content')
<div class="page-content">
    <!-- BN Slider 1 -->
    <div class="holder fullwidth full-nopad mt-0" style="margin-top: 0px !important">
        <div class="container">
            <div class="bnslider-wrapper">
                <div class="bnslider bnslider--lg bnslider--darkarrows keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="false" data-speed="5000" data-start-width="1920" data-start-height="815" data-start-mwidth="480" data-start-mheight="578">
                    <div class="bnslider-slide ">
                        <div class="bnslider-image-mobile" style="background-image: url('https://www.thevintagegarments.com/Assets/images/slider/fe77dbe4e20d964562747384def59cc4.png');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('img/banner_4_1662014722.jpg')}}');"></div>
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-left">
                                {{-- <div class="bnslider-text-content-flex container">
                                    <div class="bnslider-vert border-half mx-0" data-animation="fadeIn" data-animation-delay="0.5s">
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="0.8s" style="color: #ee7600;">BEST FESTIVAL DEALS</div>
                                        <div class="bnslider-text bnslider-text--sm text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #ee7600;">ON TRADITIONAL WEAR</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1.6s" style="color: #484848;">UPTO 35% OFF</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="{{url('all_product/sub-category/sarees')}}" class="btn-decor" style="color: #484848;">shop now<span class="btn-line" style="background-color: #484848;"></span></a></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="bnslider-slide ">
                        <div class="bnslider-image-mobile" style="background-image: url('https://www.thevintagegarments.com/Assets/images/slider/5c2a9ae372876d03c9297ced3238b42d.png');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('img/banner_3_1662015013.jpg')}}');"></div>
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-right">
                                {{-- <div class="bnslider-text-content-flex">
                                    <div class="bnslider-vert w-50 mx-0">
                                        <div class="bnslider-text bnslider-text--lg text-center" data-animation="popIn" data-animation-delay=".8s" style="color: #001454;">HIT REFRESH</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #001454; font-weight: 300;">FROM STAPLE TO STATEMENT, EVERYTHING YOU NEED</div>
                                        <div class="bnslider-text bnslider-text--xs text-center" data-animation="zoomIn" data-animation-delay="1.6s" style="color: #710400;">SOON ON SALE</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="{{url('all_product/sub-category/kurti')}}" class="btn-decor" style="color: #001454;">shop now<span class="btn-line" style="background-color: #001454;"></span></a></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="bnslider-slide ">
                        <div class="bnslider-image-mobile" style="background-image: url('https://www.thevintagegarments.com/Assets/images/slider/839d3d1e007b19837693fe4f4c419d16.png');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('img/banner_1_1662015031.jpg')}}');"></div>
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-right">
                                <div class="bnslider-text-content-flex">
                                    {{-- <div class="bnslider-vert w-50 mx-0">
                                        <div class="bnslider-text bnslider-text--lg text-center" data-animation="popIn" data-animation-delay=".8s" style="color: #001454;">HIT REFRESHS</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #001454; font-weight: 300;">LOOK HUN-REAL IN THE HEAT IN OURS</div>
                                        <div class="bnslider-text bnslider-text--xs text-center" data-animation="zoomIn" data-animation-delay="1.6s" style="color: #710400;">OUTFIT ALL IN ONE</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="{{url('all_product/category/kid')}}" class="btn-decor" style="color: #001454;">shop now<span class="btn-line" style="background-color: #001454;"></span></a></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bnslider-slide ">
                        <div class="bnslider-image-mobile" style="background-image: url('https://www.thevintagegarments.com/Assets/images/slider/809a0816e8c88a1d0988d716b5a38e3d.png');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('img/banner_5_1662015043.jpg')}}');"></div>
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-right">
                                {{-- <div class="bnslider-text-content-flex">
                                    <div class="bnslider-vert w-50 mx-0">
                                        <div class="bnslider-text bnslider-text--lg text-center" data-animation="popIn" data-animation-delay=".8s" style="color: #001454;">STYLE REFRESH AT </div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #001454; font-weight: 300;">A SUPER DEALS!</div>
                                        <div class="bnslider-text bnslider-text--xs text-center" data-animation="zoomIn" data-animation-delay="1.6s" style="color: #710400;">15% to 35% OFF</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="{{url('all_product/sub-category/women-shorts')}}" class="btn-decor" style="color: #001454;">shop now<span class="btn-line" style="background-color: #001454;"></span></a></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bnslider-loader">
                    <div class="loader-wrap">
                        <div class="dots">
                            <div class="dot one"></div>
                            <div class="dot two"></div>
                            <div class="dot three"></div>
                        </div>
                    </div>
                </div>
                <div class="bnslider-arrows container-fluid">
                    <div></div>
                </div>
                <div class="bnslider-dots vert-dots container-fluid"></div>
            </div>
        </div>
    </div>
    <!-- //BN Slider 1 -->
    <div class="holder fullboxed bgcolor mt-0 py-2 py-sm-3">
        <div class="container">
            <div class="row bnr-grid">

                <div class="col-md"><a href="{{url('all_product/category/men')}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="{{asset('img/Men_s_1631170823_1662021533.png')}}" data-src="{{asset('img/Men_s_1631170823_1662021533.png')}}" alt="Banner" class="lazyload"> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">new arrivals</span> <span class="bnr-text2">Men's</span> <span class="btn-decor bnr-btn">shop now<span class="btn-line"></span></span></span></span></div>
                    </a></div>
                <div class="col-md"><a href="{{url('all_product/category/woman')}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="{{asset('img/Women_s_1631170858_1662022406.png')}}" data-src="{{asset('img/Women_s_1631170858_1662022406.png')}}" alt="Banner" class="lazyload"> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">new arrivals</span> <span class="bnr-text2">Women's</span> <span class="btn-decor bnr-btn">shop now<span class="btn-line"></span></span></span></span></div>
                    </a></div>
                <div class="col-md"><a href="{{url('all_product/category/kid')}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.55"><img src="{{asset('img/Kids_1631170887_1662022417.png')}}" data-src="{{asset('img/Kids_1631170887_1662022417.png')}}" alt="Banner" class="lazyload"> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">new arrivals</span> <span class="bnr-text2">Kids</span> <span class="btn-decor bnr-btn">shop now<span class="btn-line"></span></span></span></span></div>
                    </a></div>
            </div>
        </div>
    </div>
    
    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Featured Products</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($featured as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Latest Products</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($latest as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Kurti</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($kurti as $item)
                <x-product-box :details="$item"/>
            @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/kurti')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Top</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($top as $item)
                <x-product-box :details="$item"/>
            @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/top')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">T-shirt</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($tshirt as $item)
                <x-product-box :details="$item"/>
            @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/tshirts')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Salwar Suit & Gown</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($salwarsuitandgown as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/salwar-suit--gown')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <!-- <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Women Shorts</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($womenshorts as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/women-shorts')}}" class="btn-decor">show all</a></div>
        </div>
    </div> -->

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Sarees</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($sarees as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/saree')}}" class="btn-decor">show all</a></div>
        </div>
    </div>
    
    <!-- <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Western Wear</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($westernwear as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/salwar-kameez')}}" class="btn-decor">show all</a></div>
        </div>
    </div> -->

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Salwar Kameez</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($salwarkameez as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/salwar-kameez')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">LEHENGA CHOLI</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($lehengacholi as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/lengha-choli')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Shirts</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($shirts as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/shirts')}}" class="btn-decor">show all</a></div>
        </div>
    </div>

    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Women Lehenga Choli</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($womenlehengacholi as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('all_product/sub-category/lengha-choli')}}" class="btn-decor">show all</a></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var _token = "{{ csrf_token() }}";
</script>
<script src="{{asset('frontend/js/product_box.js')}}"></script>
@endpush