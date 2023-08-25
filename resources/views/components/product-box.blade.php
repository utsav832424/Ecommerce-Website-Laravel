{{-- {{$details->id}} --}}
<div class="prd prd-has-loader prd-new prd-popular ">
    <div class="prd-inside">
        <div class="prd-img-area">
            <a href="{{url('product/'.$details->slug)}}" class="prd-img">
                <img src="/{{$details->main_img}}" data-srcset="/{{$details->main_img}}" alt="{{$details->name}}" class="js-prd-img lazyload">
            </a>
            @if ($details->is_featured == 1)
                <div class="label-outstock">FEATURED</div>
            @endif
            @if ($details->is_new == 1)
                <div class="label-new">NEW</div>
            @endif
            @if ($details->discount > 0)
                <div class="label-sale">{{$details->discount}}%</div>
            @endif
            <a href="#" data="{{$details->id}}" class="label-wishlist icon-heart js-label-wishlist {{$details->wishProductStatus ? 'active' : ''}}"></a>
            <ul class="list-options color-swatch">
                @foreach ($details->img as $index => $item)    
                    <li data-image="/{{$item->image}}">
                        <a href="#" class="js-color-toggle" pid="{{$item->product_id}}" cid="{{$item->color_id}}">
                            <img src="/{{$item->image}}" data-srcset="/{{$item->image}}" class="lazyload" alt="MUSTARD">
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="gdw-loader"></div>
        </div>
        <div class="prd-info">
            <div class="prd-tag">
                <a href="{{url('all_product/sub-category/'.$details->sub_catagory_slug)}}">{{$details->sub_catagory_name}}</a>
            </div>
            <h2 class="prd-title">
                <a href="{{url('product/'.$details->slug)}}">{{$details->name}}</a>
            </h2>
            {{-- <div class="prd-rating">
                @if ($details['rating'] == 1)
                    <i class="icon-star fill"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                @endif
                @if ($details['rating'] == 2)
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                @endif
                @if ($details['rating'] == 3)
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                @endif
                @if ($details['rating'] == 4)
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star"></i>
                @endif
                @if ($details['rating'] == 5)
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                    <i class="icon-star fill"></i>
                @endif
                
            </div> --}}
            <div class="prd-block_options prd-block prd-options">
                <div class="prd-size swatches">
                    <select id="" class="optionsSelect02">
                        @foreach ($details->size as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <ul class="size-list js-size-list" data-select-id="optionsSelect02">
                        @foreach ($details->size as $item)
                        <li class=""><a href="#" data-value="{{$item->id}}"><span class="value">{{$item->name}}</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="prd-price">
                <div class="price-new">1 pcs Price : &#x20B9; {{$details->price}}</div>
                @if ($details->old_price > 0)
                    <div class="price-old">&#x20B9; {{$details->old_price}}</div>
                @endif
                @if ($details->save_price > 0)
                    <div class="price-comment">You save &#x20B9; {{$details->save_price}}</div>
                @endif
            </div>
            @if ($details->catelogue_price > 0)    
                <div class="prd-price">
                    <div class="price-new">Catalogue Price : &#x20B9; {{$details->catelogue_price}}</div>
                </div>
            @endif
            <div class="prd-hover">
                <div class="prd-action">
                    <button class="btn addtocart"><i class="icon icon-handbag"></i><span>Add To Cart</span></button>
                    @if ($details->catelogue_price > 0)
                        <a class="btn" href="javascript:void(0)"><span>Book catalogue</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>