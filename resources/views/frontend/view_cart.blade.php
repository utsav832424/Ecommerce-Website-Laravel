@extends('frontend.layout.master')
@section('title','E-SHOP || VIEW CART')
@section('main-content')
<div class="holder mt-0">
    <div class="container">
        <h1 class="text-center">Shopping Cart</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="cart-table">
                    {{Helper::getShoppingCartProduct()}}
                    <div class="cart-table-total">
                        <div class="row">
                            <div class="col-sm">
                                <a href="{{url('/removeAllCartProduct')}}" class="btn btn--alt">
                                    <i class="icon-cross"></i><span>clear shopping cart</span>
                                </a>
                            </div>
                            <div class="col-sm-auto">
                                <a href="{{url('/all_product')}}" class="btn">
                                    <i class="icon-angle-left"></i><span>continue shopping</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 text-right">
                <div class="sidebar-block">
                    <div class="card-total text-uppercase">Total <span class="card-total-price">₹ <span id="ftotal">{{Helper::getCartProductAmount()}}</span></span>
                    </div>
                    <a class="btn btn--full btn--lg" href="{{url('/checkout')}}">Place Order</a>
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