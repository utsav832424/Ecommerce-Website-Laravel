@extends('frontend.layout.master')
@section('title','E-SHOP || CHECKOUT')
@section('main-content')
<div class="container">
    <h1 class="text-center">Checkout</h1>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-8">
            <div class="steps-progress">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#step1" data-step="1"><span>01.</span><span>Shipping Address</span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link con" href="#"><span>02.</span><span>Apply Promocode</span></a>
                        <a data-toggle="tab" href="#step2" data-step="2" id="nextStep"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lastStep" href="#"><span>03.</span><span>Payment Method</span></a><a data-toggle="tab" href="#step4" id="lastStep" data-step="4"></a>
                    </li>
                </ul>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 25%;"></div>
                </div>
            </div>
            <form method="post" id="checkout_form" action="{{url('/placeOrder')}}">
                @csrf
                <div class="tab-content">
                    <input type="hidden" name="orderId" id="orderId" value="0">
                    <input type="hidden" name="orderName" id="orderName" value="{{Session::get('userData')->name}}">
                    <input type="hidden" name="orderEmail" id="orderEmail" value="{{Session::get('userData')->email}}">
                    <input type="hidden" name="orderMobile" id="orderMobile" value="{{Session::get('userData')->mobile}}">
                    <input type="hidden" name="amount" id="amount" value="1">
                    <div class="tab-pane fade show active" id="step1">
                        {{Helper::getUserShippingAddress()}}
                        <div class="card-body">
                            <div class="form-group">
                                <div class="product-radio">
                                    <input type="radio" style="display: none;" class="addr" data="1" id="ad2" name="type" value="0" checked="">
                                    <label for="ad2">New</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><label class="text-uppercase">Full Name:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="fullname" placeholder="Full Name" value="">
                                    </div>
                                </div>  
                                <div class="col-sm-6"><label class="text-uppercase">Email:</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">Mobile:</label>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" maxlength="10" name="mobile" id="mobile" placeholder="Mobile Number" pattern="[0-9]{10}" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">Flat No:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="flatno" id="flat_no" placeholder="Flat No" value="">
                                    </div>
                                </div>
                                <div class="col-md-6"><label class="text-uppercase">Address:</label>
                                    <div class="form-group">
                                        <textarea class="form-control" style="height: 50px;" name="address" id="address" placeholder="Address"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">Country:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">State:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="state" id="state" placeholder="State" value="">
                                    </div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">City:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="">
                                    </div>
                                </div>
                                <div class="col-md-6"><label class="text-uppercase">Pincode:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" maxlength="6" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="button" datax="2" datay="1" class="con btn btn-sm" id="AddShippingAddress">Continue</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="step2">
                        <div class="tab-pane-inside">
                            <div class="card card--grey">
                                <div class="card-body">
                                    <h3>APPLY PROMOCODE</h3><label class="text-uppercase">promo/student code:</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="promo" id="promo" class="form-control">
                                        </div>
                                        <input type="button" class="btn valid" name="apply" value="Apply Promocode">
                                    </div>
                                    <span id="message"></span>
                                </div>
                            </div>                                    
                        </div>
                        <div class="text-right">
                            <button type="button" datax="4" datay="2" class="btn btn-sm step-next" id="applyPromocode">Continue</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="step4">
                        <div class="tab-pane-inside">
                            <div class="clearfix">
                                <input id="formcheckoutRadio3" value="2" name="payment-method" type="radio" style="display: none;" class="radio" checked="checked"> 
                                <label for="formcheckoutRadio3">
                                    <img src="https://www.thevintagegarments.com/Assets/images/payment/guaranteed.png" alt="Payment Gateway" class="img-fluid">
                                </label>
                            </div>
                            <div class="clearfix rad">
                                <input id="formcheckoutRadio4" value="1" name="payment-method" type="radio" style="display: none;" class="radio"> 
                                <label for="formcheckoutRadio4">COD ( Cash on Delivery )</label>
                            </div>
                            
                        </div>
                        <input type="hidden" name="ftotal" id="ftotal" value="{{Helper::getCartProductAmount()}}">
                        <div class="clearfix mt-1 mt-md-2">
                            <button type="submit" class="btn btn--lg w-100">Place Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 mt-2 mt-md-5">
            <h2 class="d-md-none">ORDER SUMMARY</h2>
            <div class="cart-table cart-table--sm">
                <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                    <div class="cart-table-prd-image"></div>
                    <div class="cart-table-prd-name"><b>ITEM</b></div>
                    <div class="cart-table-prd-qty"><b>QTY</b></div>
                    <div class="cart-table-prd-price"><b>PRICE</b></div>
                </div>
                {{Helper::getCheckoutProduct()}}
            </div>
            <div class="card-total-sm" id="discount" style="display:none;">
                <div class="float-right">DISCOUNT <span class="card-total-price">₹ <span id="disp">0</span></span></div>
            </div>
            <div class="card-total-sm">
                <div class="float-right">Total <span class="card-total-price">₹ <span id="fp">{{Helper::getCartProductAmount()}}</span></span><input type="hidden" id="subtotal" name="tot" class="subtotal" value="{{Helper::getCartProductAmount()}}"></div>
            </div>
            
            
            <div class="card-total-sm">
                <div class="float-right cod">Shipping Charges <span class="card-total-price">₹ <span class="ship">0</span></span></div></div>
                
                <div class="card-total-sm">
                    <div class="float-right">Final Total 
                        <span class="card-total-price">₹ <span class="finaltotal">{{Helper::getCartProductAmount()}}</span></span>
                    </div>
                </div>
                <div class="mt-2"></div>
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