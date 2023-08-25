@extends('frontend.layout.master')
@section('title','E-SHOP || SINGLE PRODUCT')
@section('main-content')
<style>
    form .stars {
        background: url("{{ asset('img/stars.png') }}") repeat-x 0 0;
        width: 150px;
    }

    form .stars input[type="radio"] {
        position: absolute;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    form .stars input[type="radio"].star-5:checked ~ span {
        width: 100%;
    }

    form .stars input[type="radio"].star-4:checked ~ span {
        width: 80%;
    }

    form .stars input[type="radio"].star-3:checked ~ span {
        width: 60%;
    }

    form .stars input[type="radio"].star-2:checked ~ span {
        width: 40%;
    }

    form .stars input[type="radio"].star-1:checked ~ span {
        width: 20%;
    }

    form .stars label {
    /* display: block; */
    /* width: 30px; */
    /* height: 30px; */
    /* margin: 0 !important; */
    padding: 0 !important;
    /* text-indent: -999em; */
    /* float: left; */
    /* position: relative; */
    /* z-index: 10; */
    /* background: transparent !important; */
    cursor: pointer;
    min-width: inherit;
}

    form .stars label:hover ~ span {
        background-position: 0 -30px;
    }

    form .stars label.star-5:hover ~ span {
        width: 100% !important;
    }

    form .stars label.star-4:hover ~ span {
        width: 80% !important;
    }

    form .stars label.star-3:hover ~ span {
        width: 60% !important;
    }

    form .stars label.star-2:hover ~ span {
        width: 40% !important;
    }

    form .stars label.star-1:hover ~ span {
        width: 20% !important;
    }
    form .stars label:before,form .stars label:after
    {
        display:none;
    }
    form .stars span {
        display: block;
        width: 0;
        position: relative;
        top: 0;
        left: 0;
        height: 30px;
        background: url("{{ asset('img/stars.png') }}") repeat-x 0 -60px;
        -webkit-transition: -webkit-width 0.5s;
        -moz-transition: -moz-width 0.5s;
        -ms-transition: -ms-width 0.5s;
        -o-transition: -o-width 0.5s;
        transition: width 0.5s;
    }
    .prd-rating i{
        color: #e6e6e6;
        font-size: 25px;
        cursor: pointer;
        transition: color 0.2s ease-out;
    }
    .card-body .prd-rating [class*='icon']:not(.fill){
        opacity: 1
    }
    .prd-rating i.active{
        color: #ff9c1a;
    }
    .selectColorImgPreviewSection img {
        width: 50px;
    }
    .reviewimage1{
        display: flex;
        flex-direction: row;
        gap: 5px;
    }
    .reviewimage1 img{
       height: 50px;
    }
</style>
<div class="page-content">
    <div class="holder">
        <div class="container">
            <div class="row prd-block prd-block--mobile-image-first js-prd-gallery" id="prdGallery100">
                <div class="col-md-6 col-xl-5">
                    <div class="prd-block_info js-prd-m-holder mb-2 mb-md-0"></div>
                    <div class="prd-block_main-image main-image--slide js-main-image--slide">
                        <div class="prd-block_main-image-holder js-main-image-zoom" data-zoomtype="inner">
                            <div class="prd-block_main-image-video js-main-image-video">
                                <video loop muted preload="metadata" controls="controls"><source src="#"></video>
                                <div class="gdw-loader"></div>
                            </div>
                            <div class="prd-has-loader" width="50px">
                                <div class="gdw-loader"></div>
                                <img  src="/{{$data->main_img}}" class="zoom" alt="" data-zoom-image="/{{$data->main_img}}">
                            </div>
                            <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                            <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                        </div>
                        <div class="prd-block_main-image-links"> <a href="#" class="prd-block_zoom-link"><i class="icon icon-zoomin"></i></a></div>
                    </div>
                    <div class="product-previews-wrapper">
                        <div class="product-previews-carousel" id="previewsGallery100">
                            @foreach ($data->product_img as $item)
                            <a href="#" data-value="{{$item->name}}" data-image="/{{$item->image}}"data-zoom-image="/{{$item->image}}">
                                <img src="/{{$item->image}}" alt="">
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="prd-block_info">
                        <div class="prd-inside">
                            <div class="js-prd-d-holder prd-holder">
                                <div class="prd-block_title-wrap">
                                    <h1 class="prd-block_title">{{$data->name}}</h1>
                                    @if ($data->discount > 0)    
                                        <div class="prd-block__labels">
                                            <span class="prd-label--sale">{{$data->discount}}%</span>                                    
                                        </div>
                                    @endif
                                </div>
                                <div class="prd-block_info-top">
                                    <div class="prd-rating"><a href="#rating" class="prd-review-link">
                                        <i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><span>67 reviews</span></a>
                                    </div>
                                    <a href="#" data="145" class="productwishlist label-wishlist icon-heart js-label-wishlist "></a>
                                </div>
                                <div class="prd-block_description topline">
                                    <p>
                                        {!! $data->specification !!}
                                    </p>
                                </div>
                            </div>
                            <div class="prd-block_options topline">
                                <div class="prd-color swatches"><span class="option-label">Color:</span>
                                    <select id="optionsSelect01">
                                        @foreach ($data->img as $item)
                                            <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <ul class="color-list color-list--sm" data-select-id="optionsSelect01">
                                        @foreach ($data->img as $item)
                                            <li>
                                                <a class="js-color-toggle" pid="{{$item->product_id}}" cid="{{$item->color_id}}" href="#" data-toggle="tooltip" data-placement="top" title="{{$item->name}}" data-value="{{$item->name}}" data-image="/{{$item->image}}">
                                                    <span class="value"><img src="/{{$item->image}}" alt=""></span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class=" swatches"><span class="option-label">Size:</span>
                                    <div class="prd-size">
                                        <select class="optionsSelect02">
                                            @foreach ($data->size as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <ul class="size-list js-size-list" data-select-id="optionsSelect02">
                                            @foreach ($data->size as $item)
                                            <li class="">
                                                <a href="#" data-value="{{$item->id}}"><span class="value">{{$item->name}}</span></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class=" swatches"><span class="option-label">Material:</span>
                                    <ul class="size-list size-list--wide js-size-list" data-select-id="optionsSelect03">
                                        <li><a href="#" data-value="synthetics"><span class="value">{{$data->fabric_name}}</span></a></li>
                                    </ul>
                                </div>
                            </div>    
                            <div class="prd-block_qty topline">
                                <span class="option-label">Qty:</span>
                                <div class="qty qty-changer">
                                    <fieldset><input type="button" value="&#8210;" class="decrease"> <input type="number" style="width: 35px;text-align: center;border:0;font-size: 12px;" class="qty-input" value="1" name="qty" data-min="1"> <input type="button" value="+" class="increase"></fieldset>
                                </div>
                            </div>
                            <div class="prd-block_actions">
                                <div class="prd-block_price">
                                    <span class="prd-block_price--actual">&#x20B9; <span data='{{$data->price}}' id='ap'>{{$data->price}}</span></span>
                                    <span class="prd-block_price--old">&#x20B9; <span data="{{$data->old_price}}" id="op">{{$data->old_price}}</span></span>                                    
                                </div>
                                <div class="btn-wrap">
                                    <button class="btn addtocart btn--add-to-cart singal_product_add_to_cart" ><i class="icon icon-handbag"></i><span>Add To Cart</span></button>
                                </div>
                            </div>
                            @if ($data->catelogue_price > 0)    
                            <div class="prd-block_actions topline">
                                <div class="prd-block_price"><span class="prd-block_price--actual">&#x20B9; {{$data->catelogue_price}}</span>
                                    <span class="prd-block_pcs">{{$data->catelogue_pis}} Pcs.</span>
                                </div>
                                <div class="btn-wrap">
                                    <a class="btn btn--add-to-cart" href="javascript:void(0)"><i class="icon icon-handbag"></i><span>Book catalogue</span></a>
                                </div>
                            </div>
                            @endif 
                            <div class="prd-safecheckout topline">
                                <h2>Check COD Availability</h2>
                                <div class="row">
                                    <div class="col-md-9 col-9">
                                        <input type="text" maxlength="6" name="code" class="form-control code" placeholder="Enter Pincode">
                                    </div>
                                    <button class="btn" id="checkcode">Check</button>
                                </div>
                                <h4 style="font-size: 12px;" class="result"></h4>
                            </div>
                            <div class="prd-safecheckout topline">
                                <h3 class="h2-style">guaranteed safe checkout</h3>
                                <img src="https://www.thevintagegarments.com/Assets/images/payment/guaranteed.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 mt-xl-0 sidebar-product">
                    <div class="shop-features-style4">
                        <a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                            <div class="shop-feature-text"><div class="text1">Free worlwide delivery</div></div>
                        </a>
                        <a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">100% verified products</div>
                            </div>
                        </a>
                        <a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-call"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">24/7 customer support</div>
                            </div>
                        </a>
                        <a href="#" class="shop-feature" data-toggle="modal" data-target="#inquiry">
                            <div class="shop-feature-icon"><i class="icon-mail"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">
                                    <div class="btn-wrap">
                                        <button class="btn"><span> Send Inquiry</span></button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="holder">
            <div class="container">
                <div class="row vert-margin">
                    <div class="col-md-6">
                        <h2>Description</h2>
                        <p>{!! $data->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('error'))
            <div class="alert alert-danger" style="background-color: red;">{{Session::get('error')}}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-danger" style="background-color: green;">{{Session::get('success')}}</div>
        @endif
        <div class="holder" id="rating">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 text-center d-flex align-items-center justify-content-center">
                        <div class="card-body card-body-rating border">
                            <div class="prd-rating-value text-success">{{$ceilreview}}</div>   
                            @if ($ceilreview == 1)
                                <div class="prd-rating justify-content-center">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>                            
                                </div>
                            @endif    
                            @if ($ceilreview == 2)
                                <div class="prd-rating justify-content-center">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>                            
                                </div>
                            @endif    
                            @if ($ceilreview == 3)
                                <div class="prd-rating justify-content-center">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>                            
                                </div>
                            @endif    
                            @if ($ceilreview == 4)
                                <div class="prd-rating justify-content-center">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star"></i>                            
                                </div>
                            @endif    
                            @if ($ceilreview == 5)
                                <div class="prd-rating justify-content-center">
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>
                                    <i class="icon-star active"></i>                            
                                </div>
                            @endif    
                            <div>Based on {{$totalreview_user}} review</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card-body card-body-progress">
                            <div class="row">
                                <div class="col-3">
                                    <h6>Excellent</h6>
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width:58.208955223881%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <h6>({{$review_star5}})</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Very Good</h6>
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" style="width:41.791044776119%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <h6>({{$review_star4}})</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Good</h6>
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width:2%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <h6>({{$review_star3}})</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Average</h6>
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width:5%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <h6>({{$review_star2}})</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h6>Poor</h6>
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:10%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <h6>({{$review_star1}})</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                        <div class="review-write"><a href="#" class="btn btn--lg js-show-form" data-form="#writeReview"><i class="icon-pencil"></i><span>Write Your Reviews</span></a><br><small>share your experience/views about this product</small></div>
                    </div>
                </div>
                <div class="mt-3 d-none" id="writeReview">
                    @if (Session::has('userData'))
                        <form action="{{route('productReview')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="stars prd-rating">
                                <input type="radio" value="1" name="rate" class="star-1" id="star-1">
                                <label class="star-1" for="star-1"><i class="icon-star"></i></label>
                                <input type="radio" value="2" name="rate" class="star-2" id="star-2">
                                <label class="star-2" for="star-2"><i class="icon-star"></i></label>
                                <input type="radio" value="3" name="rate" class="star-3" id="star-3">
                                <label class="star-3" for="star-3"><i class="icon-star"></i></label>
                                <input type="radio" value="4" name="rate" class="star-4" id="star-4">
                                <label class="star-4" for="star-4"><i class="icon-star"></i></label>
                                <input type="radio" value="5" name="rate" class="star-5" id="star-5">
                                <label class="star-5" for="star-5"><i class="icon-star"></i></label>
                                <span></span>
                            </div>
                            <input type="hidden" name="pid" value="{{$data->id}}">
                            <div class="mb-3" >
                                <div class="row" id="product_review_image_preview_section" style="gap: 10px;">
                                    <div class="col-md-12" style="width: 100%;">
                                        <div class="mainColorSelectcontent" style="display: flex;flex-direction: column;width: 30%;gap: 8px;">
                                            <label class="form-check-label"></label>
                                            <input type="file" multiple="" name="reviewImages[]" class="form-control reviewImgFileInput" placeholder="Choose Review Image">
                                        </div>
                                        <div class="selectColorImgPreviewSection">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-dark"><span class="required">*</span>MESSAGE</label> 
                                <textarea class="form-control textarea--height-100" name="message" data-required-error="Please fill the field" required="" spellcheck="false"></textarea>
                            </div>
                            <div class="mt-2">
                                <button type="reset" class="btn btn--alt js-close-form" data-form="#writeReview">Cancel</button>
                                <button type="submit" class="btn ml-1">Add Review</button>
                            </div>
                        </form>
                    @else
                        <div class="empty-category">
                            <div class="empty-category-text"><span>SORRY</span>, LOGIN TO ADD REVIEW</div>
                            <div class="empty-category-button"><a href="{{ route('login') }}" class="btn-decor">LOGIN NOW</a></div>
                            <div class="empty-category-icon"><i class="icon-sad-face"></i></div>
                        </div>
                    @endif
                </div>
                @foreach ($review as $item)
                <div class="review-item">
                    <div class="row">
                        <div class="col-md">
                            <h4 class="review-item_author">{{$item->name}}</h4>
                        </div>
                        <div class="col-md-auto">
                            <div class="review-item_date">{{$item->added_datetime}}</div>
                        </div>
                    </div>
                    <div class="review-item_date"></div>
                    <div class="review-item_rating">
                        @if ($item->star == 1)
                            <i class="icon-star fill"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star "></i>    
                        @endif
                        @if ($item->star == 2)
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star "></i>    
                        @endif 
                        @if ($item->star == 3)
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star"></i>
                            <i class="icon-star "></i>    
                        @endif 
                        @if ($item->star == 4)
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star "></i>    
                        @endif  
                        @if ($item->star == 5)
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>
                            <i class="icon-star fill"></i>    
                        @endif                  
                    </div>
                    <div class="reviewimage1">
                            @foreach ($item->img as $item1)
                                <img src="/{{$item1->image}}" alt="">
                            @endforeach
                    </div>
                    <span>{{$item->message}}</span>
                </div> 
                @endforeach
                
                

            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">Related Products</h2>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-2 data-to-show-xs-1 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach ($reletedData as $item)
                    <x-product-box :details="$item"/>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('/all_product')}}" class="btn-decor">show all</a></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var _token = "{{ csrf_token() }}";
</script>
<script src="{{asset('frontend/js/singal_product.js')}}"></script>
@endpush