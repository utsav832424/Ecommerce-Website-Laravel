@extends('frontend.layout.master')
@section('title','E-SHOP || ORDER DETAILS')
@section('main-content')
<style>
    @media print {
        .order-print-info div {
            flex: 1
        }
        body * { visibility: hidden; }
        #orderInvoice * { visibility: visible; }
        #orderInvoice { position: absolute; top: 40px; left: 30px; }
        .invoice-section {
            display: none;
        }
    }
    .card {
        background-color: #fff;
        border-color: transparent;
        border-radius: 15px;
        box-shadow: 0px 0px 5px grey;
    }
    .orderInformation{
        padding: 5px;
    }
    .fw-bold {
        font-weight: 700!important;
    }
    .orderNumber {
        color: #ee7600;
    }
    .bg-success {
        color: #fff;
    }
    .table thead tr th {
        border-top: 0px solid #f7f7f7;
    }
    .total-price-section {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
</style>
<div class="holder mt-0">
    <div class="container mb-2">
        <div class="row" style="justify-content: end;gap: 5px;">
            <a href="{{route('usertrackshipment',[$data->awb_number])}}" class="btn btn-outline-secondary d-none d-md-block btn-icon mt-2 invoice-section">
                <i class="bi bi-printer"></i> Track Product
            </a>
            <a href="{{route('userInvoice',[$data->order_number])}}" target="_blank" class="btn btn-outline-secondary d-none d-md-block btn-icon mt-2 invoice-section">
                <i class="bi bi-printer"></i> Print
            </a>
        </div>
    </div>
    <div class="container" id="orderInvoice">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <div class="invoice">
                        <div class="d-md-flex justify-content-between align-items-center mb-4">
                            <div class="fw-bold">Invoice No : <span class="orderNumber">{{$data->order_number}}</span> </div>
                            <div class="fw-bold">Date: <span class="orderNumber">{{$data->added_datetime}}</span> </div>
                        </div>
                        <div class="d-md-flex justify-content-between align-items-center">
                            <h4>Invoice</h4>
                            <div>
                                <img width="120" src="/frontend/img/bigger.png" alt="logo">
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <strong>Bill From</strong>
                                </p>
                                <div>
                                    <div>Name: {{$data->shippingUserName}}</div>
                                    <div>Mobile: {{$data->shippingUserMobile}}</div>
                                    <div>Address: {{$data->flat_no}} {{$data->address}}, {{$data->city}}, {{$data->state}}, {{$data->country}}.{{$data->pincode}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>PHOTO</th>
                                        <th>NAME</th>
                                        <th class="text-end">QUANTITY</th>
                                        <th class="text-end">PRICE</th>
                                        <th class="text-end">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->productData as $item)     
                                    <tr>
                                        <td><img src="/{{$item->mainImg}}" class="rounded" width="60" alt="..."></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>&#8377; {{$item->price}}</td>
                                        <td>&#8377; {{$item->total_amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end total-price-section">
                            <p>Sub Total: &#8377; {{$data->sub_total}}</p>
                            <p>Shipping: Free</p>
                            {{-- <p>Tax(18%) : $259.70</p> --}}
                            <h4 class="fw-bold">Total: &#8377; {{$data->total_amount}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-8 col-md-12 aside">
                <div class="card mb-2 orderInformation">
                    <div class="card-body">
                        <div class="mb-2 d-flex align-items-center justify-content-between">
                            <span class="fw-bold">Order No : <a href="#" class="orderNumber">{{$data->order_number}}</a></span>
                            <span class="badge bg-success">{{$data->payment_status}}</span>
                        </div>
                        <div class="row mb-2 g-4 order-print-info">
                            <div class="col-md-3 col-sm-6">
                                <p class="fw-bold mb-0">Order Created at</p>
                                {{$data->added_datetime}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <p class="fw-bold mb-0">Name</p>
                                {{$data->userName}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <p class="fw-bold mb-0">Email</p>
                                {{$data->userEmail}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <p class="fw-bold mb-0">Contact No</p>
                                {{$data->userMobile}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2 orderInformation">
                    <div class="card-body">
                        <p class="fw-bold mb-2">Delivery Address</p>
                        <div>
                            <div>Name: {{$data->shippingUserName}}</div>
                            <div>Mobile: {{$data->shippingUserMobile}}</div>
                            <div>Address: {{$data->flat_no}} {{$data->address}}, {{$data->city}}, {{$data->state}}, {{$data->country}}.{{$data->pincode}}</div>
                        </div>
                    </div>
                </div>
                <div class="card widget ">
                    <div class="card-body">
                        <div class="table-responsive" tabindex="1" style="overflow: hidden; outline: none;">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->productData as $item)     
                                    <tr>
                                        <td><img src="/{{$item->mainImg}}" class="rounded" width="60" alt="..."></td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>&#8377; {{$item->price}}</td>
                                        <td>&#8377; {{$item->total_amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0 aside">
                <div class="card mb-4 orderInformation">
                    <div class="card-body">
                        <p class="fw-bold mb-2">Price</p>
                        <div class="row justify-content-center">
                            <div class="col-4 text-end">Sub Total :</div>
                            <div class="col-4">&#8377; {{$data->sub_total}}</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 text-end">Shipping :</div>
                            <div class="col-4">Free</div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-4 text-end">
                                <strong>Total :</strong>
                            </div>
                            <div class="col-4">
                                <strong>&#8377; {{$data->total_amount}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card invoice-section orderInformation">
                    <div class="card-body">
                        <p class="fw-bold mb-2">Invoice</p>
                        <div class="row justify-content-center mb-2">
                            <div class="col-6 text-end">Invoice No :</div>
                            <div class="col-6">
                                <a href="#">{{$data->order_number}}</a>
                            </div>
                        </div>
                        
                        <div class="text-center mt-2 mb-1">
                            <button class="btn btn-outline-primary" onclick="window.print();">Print PDF</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush