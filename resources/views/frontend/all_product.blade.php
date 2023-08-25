@extends('frontend.layout.master')
@section('title','E-SHOP || ALL PRODUCT')
@section('main-content')
<div class="page-content">
    <div class="holder mt-0">
        <div class="container ">
            <div class="page-title text-center d-none d-lg-block">
                <div class="title">
                    <h1>{{$title}}</h1>
                    <input type="hidden" name="c" id="c" value="0">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 aside aside--left fixed-col js-filter-col">
                    <div class="fixed-col_container">
                        <div class="filter-close">CLOSE</div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Price</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content" style="">
                                <div data-role="rangeslider">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="min_price">Minimum Price</label>
                                            <input type="number" class="form-control" name="price-min" id="min_price" min="1" max="10000">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="max_price">Maximum Price</label>
                                            <input type="number" class="form-control" name="price-max" id="max_price" min="300" max="10000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Categories</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content" style="">
                                <ul class="category-list">
                                    @foreach (helper::getSubCategory() as $item)
                                    <li class="common_selector sub_category" data="{{$item->id}}"><a href="javascript:void(0);">{{$item->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Fabric</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content" style="">
                                <ul class="category-list">
                                    @foreach (helper::getFabric() as $item)
                                    <li class="common_selector fabric" data="{{$item->id}}"><a href="javascript:void(0);">{{$item->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Colors</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content" style="">
                                <ul class="color-list one-column">
                                    @foreach (helper::getColor() as $item)
                                    <li class="common_selector colors" data="{{$item->id}}">
                                        <a href="javascript:void(0);" data-tooltip="{{$item->name}}" title="{{$item->name}}">
                                            <span class="value"><p style="height:19px;width:19px;border-color:black;background: {{$item->color_code}};border-radius: 50%;"></p></span>
                                            <span class="colorname">{{$item->name}}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-block filter-group-block open">
                            <div class="sidebar-block_title"><span>Size</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content" style="">
                                <ul class="size-list two-column">
                                    @foreach (helper::getSize() as $item)
                                    <li class="common_selector size" data="{{$item->id}}"><a href="javascript:void(0);">{{$item->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg aside">
                    <div class="col-left d-flex align-items-center" style="place-content: center;">
                        <div class="filter-button d-lg-none"><a href="#" class="fixed-col-toggle">FILTER</a></div>
                    </div>
                    <div class="prd-grid-wrap">
                        <div class="filter_data prd-grid product-listing data-to-show-3 data-to-show-md-3 data-to-show-sm-1 js-category-grid">
                            @foreach ($data as $item)
                                <x-product-box :details="$item"/>
                            @endforeach
                        </div>
                        <div class="show-more d-flex mt-4 mt-md-6 justify-content-center align-items-start" id="pagination_link">
                            <input type="hidden" id="curr" name="curr" value="1">
                            <input type="hidden" id="total" name="total" value="20">
                            <div class="loader-wrap" id="ploading" style="display:none">
                                <div class="dots">
                                    <div class="dot one"></div>
                                    <div class="dot two"></div>
                                    <div class="dot three"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var _token = "{{ csrf_token() }}";
    
</script>
<script src="{{asset('frontend/js/product_box.js')}}"></script>
<script>
    $(function() {
        var min_price;
        var max_price;
        var subCategory = [];
        var fabric = [];
        var color = [];
        var size = [];
        var offset = 0;
        var status = true;
        var selectedCategory = "{{$title}}";

        // console.log(selectedCategory);

        // $('.category-list .common_selector.sub_category').each(function() {
         
        //     if($(this).text() == selectedCategory){
        //         console.log($(this).text());
            
        //             $(this).find("a").trigger("click");
               
        //     }
        // })

        $('.common_selector').on('click', function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }

            min_price = $('#min_price').val();
            max_price = $('#max_price').val();
            subCategory = [];
            fabric = [];
            color = [];
            size = [];
            offset=0;
            status = true;

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
                    max_price: max_price,
                    subCategory: subCategory.join(','),
                    fabric: fabric.join(','),
                    color: color.join(','),
                    size: size.join(','),
                },
                dataType: 'json',
                success: function(res) {
                    var html = '';

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
                    // if (html == "") {
                    //     $('.product-listing').append(html);
                    // } else {
                        
                    // }
                    $('.product-listing').html(html);
                }
            });

            console.log(min_price, max_price, subCategory, fabric, color, size);
        });

        $('#min_price, #max_price').on('change', function() {
            min_price = $('#min_price').val();
            max_price = $('#max_price').val();
            subCategory = [];
            fabric = [];
            color = [];
            size = [];
            offset=0;
            status = true;

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
                    max_price: max_price,
                    subCategory: subCategory.join(','),
                    fabric: fabric.join(','),
                    color: color.join(','),
                    size: size.join(','),
                },
                dataType: 'json',
                success: function(res) {
                    var html = '';

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
                    $('.product-listing').html(html);
                    /* if (html == "") {
                        
                    } else {
                        $('.product-listing').append(html);
                    } */
                }
            });

            console.log(min_price, max_price, subCategory, fabric, color, size);
        });
        window.addEventListener('scroll',function() {
            // console.log(window.scrollY);
        if(window.scrollY > $('.product-listing').height() && status==true) {
          status = false;
            min_price = $('#min_price').val();
            max_price = $('#max_price').val();
            subCategory = [];
            fabric = [];
            color = [];
            size = [];
            offset = offset+12;
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
                    max_price: max_price,
                    subCategory: subCategory.join(','),
                    fabric: fabric.join(','),
                    color: color.join(','),
                    size: size.join(','),
                    offset : offset,
                    limit:12
                },
                dataType: 'json',
                success: function(res) {
                    var html = '';
                    status = res.data.length>0 ? true : false;
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
    });
</script>
@endpush    