@extends('frontend.layout.master')
@section('title','E-SHOP || MYWISHLIST')
@section('main-content')
<div class="holder mt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 aside ">
                <div class="list-group tab-section">
                    <a href="{{url('/account_details')}}" class="list-group-item">Account Details</a> 
                    <a href="{{url('/my_address')}}" class="list-group-item">My Addresses</a> 
                    <a href="{{url('/my_wishlist')}}" class="list-group-item active">My Wishlist</a> 
                    <a href="{{url('/my_order_history')}}" class="list-group-item">My Order History</a>
                </div>
            </div>
            <div class="col-md-12 aside">
                <h2>My Wishlist</h2>
                <div class="cart-table cart-table--wishlist">
                    @foreach ($data as $item)    
                        <div class="cart-table-prd">
                            <div class="cart-table-prd-image">
                                <a href="#"><img src="/{{$item->main_img}}" alt=""></a>
                            </div>
                            <div class="cart-table-prd-name">
                                <h5>{{$item->sub_catagory_name}}</h5>
                                <h2><a href="/product/{{$item->slug}}">{{$item->name}}</a></h2>
                            </div>
                            <div class="cart-table-prd-price"><span>price:</span><b> ₹ {{$item->price}}</b></div>
                            <div class="cart-table-addtocart">
                                <a href="/product/{{$item->slug}}" class="btn">View Detail</a>
                                <a href="javascript:void(0);" data-productId="{{$item->wishlistsId}}" class="icon-cross delete-from-wishlist" title="Remove from wishlist"></a>
                            </div>
                        </div>
                    @endforeach
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
@endpush