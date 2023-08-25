<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <link rel="shortcut icon" type="image/png" href=" {{public_path('img/favicon.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{public_path('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{public_path('frontend/css/slick.min.css')}}" rel="stylesheet">
    <link href="{{public_path('frontend/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{public_path('frontend/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{public_path('frontend/css/style-light.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{public_path('backend/dist/css/bootstrap-docs.css')}}" type="text/css">
</head>
<body>
    <style type="text/css" media="all">
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
        .d-md-flex {
            display: flex;
            justify-content: space-between;
            flex-direction: unset;
            width: 100%;
            align-items: center;
        }
        .d-md-flex div, .d-md-flex h4 {
            flex: 1;
            display: inline-block;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="invoice">
                <div class="d-md-flex justify-content-between align-items-center mb-4">
                    <div class="fw-bold">Invoice No : <span class="orderNumber">{{$data->order_number}}</span> </div>
                    <div class="fw-bold" style="float: right;">Date: <span class="orderNumber">{{$data->added_datetime}}</span> </div>
                </div>
                <div class="d-md-flex justify-content-between align-items-center">
                    <h4>Invoice</h4>
                    <div style="float: right;">
                        <img width="120px" height="60px" src="{{public_path('/frontend/img/bigger.png')}}" alt="logo">
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
                <br>
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
                                <td><img src="{{public_path($item->mainImg)}}" class="rounded" width="60" alt="..."></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$item->price}}</td>
                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$item->total_amount}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end total-price-section" style="float: right;">
                    <div>Sub Total: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$data->sub_total}}</div>
                    <div>Shipping: Free</div>
                    <div class="fw-bold">Total: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$data->total_amount}} </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>