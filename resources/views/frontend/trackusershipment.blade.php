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
    .titlemes{
        font-weight: bold;
        font-size: 15px;
    }
    .rwdot{
        display: flex;
        flex-direction: column;
        padding-bottom: 38px;
    }
    .roundt{
        height: 25px;
        width: 25px;
        background-color: #ff6e40;
        border-radius: 50%;
    }
    .stepc{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .lines{
        border-left: 1px solid #ff6e40;
        height: 100px;
        margin-left: 12px;
        position: relative;
    }
</style>
<div class="holder mt-0">
    
    <div class="container" id="orderInvoice">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-body">
                    <h6 class="card-title mb-4" style="border-bottom: 1px solid #ececec;font-size: 18px;padding: 10px 0px 10px 0px">Product Track</h6>
                    <div class="row">
                        <div class="col-md-3">
                            @foreach ($data->productData as $item)
                                <div><img src="/{{$item->mainImg}}" class="rounded" width="100" alt="..."></div>
                                <div>Name : {{$item->name}}</div>
                                <div>QUANTITY :{{$item->quantity}}</div>
                                <div>PRICE: {{$item->price}}</div>
                                <div>TOTAL :{{$item->total_amount}}</div>
                            @endforeach
                        </div>    
                        <div class="col-md-1">
                            <div class="roundt"></div>
                            <div class="lines"></div>
                            <div class="roundt"></div>
                            <div class="lines"></div>
                            <div class="roundt"></div>
                            <div class="lines"></div>
                            <div class="roundt"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="rwdot">
                                <div class="titlemes">Order Confirmed</div>
                                <div class="">BAREJA EPU (NCX)</div>
                                <div class="">2021-03-02 18:19</div>
                                <div class="">SHIPMENT ARRIVED</div>
                            </div>
                            <div class="rwdot">
                                <div class="titlemes">SHIPPED</div>
                                <div class="">BAREJA EPU (NCX)</div>
                                <div class="">2021-03-02 22:07</div>
                                <div class="">SHIPMENT FURTHER CONNECTED</div>
                            </div>
                            <div class="rwdot">
                                <div class="titlemes">OUT FOR DELIVERY</div>
                                <div class="">AHMEDABAD (PMX)</div>
                                <div class="">2021-03-08 07:21</div>
                                <div class="">SHIPMENT OUT FOR DELIVERY</div>
                            </div>
                            <div class="rwdot">
                                <div class="titlemes">DELIVERED</div>
                                <div class="">AHMEDABAD (PMX)</div>
                                <div class="">2021-03-08 11:24</div>
                                <div class="">SHIPMENT DELIVERED</div>
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
</script>
@endpush