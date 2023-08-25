@extends('frontend.layout.master')
@section('title','E-SHOP || NEW ARRIVALS')
@section('main-content')
<div class="page-content">
    <div class="holder">
        <div class="container">
            <div class="title-with-left">
                <h2 class="h1-style">New Arrivals</h2>
            </div>
            <div class="prd-grid product-listing data-to-show-4 data-to-show-md-3 data-to-show-sm-1 js-category-grid">
                @foreach ($data as $item)
                <x-product-box :details="$item"/>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var _token = "{{ csrf_token() }}";
    var min_price;
        var max_price;
        var subCategory = [];
        var fabric = [];
        var color = [];
        var size = [];
        var offset = 0;
        var status1 = true;
     window.addEventListener('scroll',function() {
        console.log(window.scrollY,$('.product-listing').height(),status1);
        
        if(window.scrollY > $('.product-listing').height() && status1==true) {
            console.log("Inside a new");
          status1 = false;
            min_price = $('#min_price').val();
            max_price = $('#max_price').val();
            subCategory = [];
            fabric = [];
            color = [];
            size = [];
            offset = offset+16;
            $('.category-list .active').each(function() {
                if ($(this).hasClass('sub_category')) {
                    subCategory.push($(this).attr('data'));
                }

                if ($(this).hasClass('fabric')) {
                    fabric.push($(this).attr('data'));
                }
            });

            $('.color-list .active').each(function() {
                if ($(this).hasClass('colors')) {
                    color.push($(this).attr('data'));
                }
            });

            $('.size-list .active').each(function() {
                if ($(this).hasClass('size')) {
                    size.push($(this).attr('data'));
                }
            });

            $.ajax({
                url: `/filterProduct`,
                method: 'post',
                data: {
                    _token: _token,
                    min_price: min_price,
                    is_new:1,
                    max_price: max_price,
                    subCategory: subCategory.join(','),
                    fabric: fabric.join(','),
                    color: color.join(','),
                    size: size.join(','),
                    offset : offset,
                    limit:16
                },
                dataType: 'json',
                success: function(res) {
                    var html = '';
                    status1 = res.data.length>0 ? true : false;
                    res.data.forEach(element => {
                        html += `<div class="prd prd-has-loader prd-new prd-popular loaded">
                                    <div class="prd-inside">
                                        <div class="prd-img-area">
                                            <a href="product/${element.slug}" class="prd-img">
                                                <img src="/${element.main_img}" data-srcset="/${element.main_img}" alt="${element.name}" class="js-prd-img lazyload">
                                            </a>`;

                                            if (element.is_featured == 1)
                                                html += `<div class="label-outstock">FEATURED</div>`;

                                            if (element.is_new == 1)
                                                html += `<div class="label-new">NEW</div>`;

                                            if (element.discount > 0)
                                                html += `<div class="label-sale">${element.discount}%</div>`;

                                            html += `<a href="javascript:void(0);" data="${element.id}" class="label-wishlist icon-heart js-label-wishlist ${element.wishProductStatus ? 'active' : ''}"></a>
                                            <ul class="list-options color-swatch">`;
                                                element.img.forEach((imgElement, index) => {
                                                    html += `<li data-image="/${imgElement.image}" class="${index == 0 ? 'active': ''}">
                                                                <a href="javascript:void(0)" class="js-color-toggle" pid="${imgElement.product_id}" cid="${imgElement.color_id}">
                                                                    <img src="/${imgElement.image}" data-srcset="/${imgElement.image}" class="lazyload" alt="MUSTARD">
                                                                </a>
                                                            </li>`;
                                                });
                                            html += `</ul>
                                            <div class="gdw-loader"></div>
                                        </div>
                                        <div class="prd-info">
                                            <div class="prd-tag">
                                                <a href="all_product/sub-category/${element.sub_catagory_slug}">${element.sub_catagory_name}</a>
                                            </div>
                                            <h2 class="prd-title">
                                                <a href="product/${element.slug}">${element.name}</a>
                                            </h2>
                                        
                                            <div class="prd-block_options prd-block prd-options">
                                                <div class="prd-size swatches">
                                                    <select id="" class="optionsSelect02">`;
                                                        element.size.forEach(sizeElement => {
                                                            html += `<option value="${sizeElement.id}">${sizeElement.name}</option>`;
                                                        });
                                                    html += `</select>
                                                    <ul class="size-list js-size-list" data-select-id="optionsSelect02">`;
                                                        element.size.forEach(sizeElement => {
                                                            html += `<li class=""><a href="javascript:void(0);" data-value="${sizeElement.id}"><span class="value">${sizeElement.name}</span></a></li>`;
                                                        });
                                                    html += `</ul>
                                                </div>
                                            </div>
                                            <div class="prd-price">
                                                <div class="price-new">1 pcs Price : &#x20B9; ${element.price}</div>`;
                                                if (element.old_price > 0)
                                                    html += `<div class="price-old">&#x20B9; ${element.old_price}</div>`;

                                                if (element.save_price > 0)
                                                    html += `<div class="price-comment">You save &#x20B9; ${element.save_price}</div>`;
                                            html += `</div>`;
                                            if (element.catelogue_price > 0)    
                                                html += `<div class="prd-price">
                                                    <div class="price-new">Catalogue Price : &#x20B9; ${element.catelogue_price}</div>
                                                </div>`;
                                            html += `<div class="prd-hover">
                                                <div class="prd-action">
                                                    <button class="btn newaddtocart"><i class="icon icon-handbag"></i><span>Add To Cart</span></button>`;
                                                    if (element.catelogue_price > 0)
                                                        html +=`<a class="btn" href="javascript:void(0)"><span>Book catalogue</span></a>`;
                                                html += `</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    });
                    $('.product-listing').append(html);
                    /* if (html == "") {
                        
                    } else {
                        $('.product-listing').append(html);
                    } */
                }
            });
        }
    });
</script>
<script src="{{asset('frontend/js/product_box.js')}}"></script>
@endpush