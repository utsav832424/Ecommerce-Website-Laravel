@extends('backend.layout.master')
@section('title','Bigger Admin || ORDER DETAILS')
@section('main-content')
<style>
    @media print {
        .invoice-section {
            display: none;
        }
        .order-print-info div{
            flex: 1
        }
    }
</style>
<div class="content ">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-5 d-flex align-items-center justify-content-between">
                        <span>Order No : <a href="#">{{$data->order_number}}</a></span>
                        <span class="badge bg-success">{{$data->payment_status}}</span>
                    </div>
                    <div class="row mb-5 g-4 order-print-info">
                        <div class="col-md-3 col-sm-6">
                            <p class="fw-bold">Order Created at</p>
                            {{$data->added_datetime}}
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <p class="fw-bold">Name</p>
                            {{$data->userName}}
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <p class="fw-bold">Email</p>
                            {{$data->userEmail}}
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <p class="fw-bold">Contact No</p>
                            {{$data->userMobile}}
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0">Delivery Address</h5>
                                        {{-- <a href="#">Edit</a> --}}
                                    </div>
                                    <div>Name: {{$data->shippingUserName}}</div>
                                    <div>{{$data->flat_no}} {{$data->address}}, {{$data->city}}, {{$data->state}}, {{$data->country}}.{{$data->pincode}}</div>
                                    <div>
                                        <i class="bi bi-telephone me-2"></i> {{$data->shippingUserMobile}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body d-flex flex-column gap-3">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0">Billing Address</h5>
                                        <a href="#">Edit</a>
                                    </div>
                                    <div>Name: Workplace</div>
                                    <div>Josephin Villa</div>
                                    <div>29543 South Plaza, Canada/Sydney Mines</div>
                                    <div>
                                        <i class="bi bi-telephone me-2"></i> 484-948-8535
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="card widget">
                <h5 class="card-header">Order Items</h5>
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
        <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title mb-4">Price</h6>
                    <div class="row justify-content-center mb-3">
                        <div class="col-4 text-end">Sub Total :</div>
                        <div class="col-4">&#8377; {{$data->sub_total}}</div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-4 text-end">Shipping :</div>
                        <div class="col-4">Free</div>
                    </div>
                    {{-- <div class="row justify-content-center mb-3">
                        <div class="col-4 text-end">Tax(18%) :</div>
                        <div class="col-4">$273,77</div>
                    </div> --}}
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
            <div class="card invoice-section">
                <div class="card-body">
                    <h6 class="card-title mb-4">Invoice</h6>
                    <div class="row justify-content-center mb-3">
                        <div class="col-6 text-end">Invoice No :</div>
                        <div class="col-6">
                            <a href="#">{{$data->order_number}}</a>
                        </div>
                    </div>
                    {{-- <div class="row justify-content-center mb-3">
                        <div class="col-6 text-end">Seller GST :</div>
                        <div class="col-6">12HY87072641Z0</div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-6 text-end">Purchase GST :</div>
                        <div class="col-6">22HG9838964Z1</div>
                    </div> --}}
                    <div class="text-center mt-4">
                        <a href="{{url('admin/downloadInvoice/'.$data->order_number)}}" class="btn btn-outline-primary" target="_blank">Print PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{asset('backend/libs/select2/css/select2.min.css')}}" type="text/css">
<style>
    #staticBackdrop .modal-dialog .modal-content .modal-footer {
        padding: 5px;
    }
    #staticBackdrop .modal-dialog .modal-content .modal-footer button {
        padding: 5px 20px;
    }
</style>
@endpush
@push('scripts')
<script src="{{asset('backend/libs/prism/prism.js')}}"></script>
<script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
{{-- <script src="{{asset('backend/js/order.js')}}"></script> --}}
@endpush