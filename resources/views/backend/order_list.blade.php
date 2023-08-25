@extends('backend.layout.master')
@section('title','Bigger Admin || ORDER LIST')
@section('main-content')
<style>
    #myTab{
        margin-top: 0px !important;
    }
    .count{
        background-color: white;
        border-radius: 5px;
        padding: 3px;
    }
    .imgsection{
        width: 100%;
        
    }
    .detailsection{
        display: flex;
        gap: 15px;
        width: 100%;
        justify-content: center;
    }
    .textcontent{
        width: 10%;
    }
    .img{
        width: 25%;
    }
    .btn{
        margin-top: 0px;
    }
    .cardtxt{
        margin-bottom: 0rem;
    }
    .btn2{
        display: flex;
        gap: 10px;
        margin-top: 10px;
        justify-content: end;
    }
    .btncolor{
        background-color: green;
        color: white;
    }
    .rs_size{
        width: 460px;
    }
    .btncolor2{
        background-color: #ff6e40;
        color: white;
        margin-left: 230px;
    }

    .emptyProduct {
        justify-content: center;
        align-items: center;
        height: calc(100vh - 420px);
    }
    .detail_courier{
        display:flex;
        align-items: center;
        justify-content: space-between;
    }
    .detail_min{
        margin: 18px 0px 0px 2px;
        color:black;
        font-weight: bold;
    }
    .detail_data{
        margin: 18px 0px 0px 2px;
    }
    .min_weight{
        margin: 18px 0px 0px 2px;
    }
    .real_time{
        margin: 18px 0px 0px 2px;
    }
    .delivery_boy{
        margin: 18px 0px 0px 2px;
    }
    .pod{
        margin: 18px 0px 0px 2px;
    }
    .call_before{
        margin: 18px 0px 0px 2px;
    }
    .detail_row{
        display:flex;
        align-items: center;
        gap: 5px;
    }
    
</style>
<div class="content">
    @csrf
    <ul class="nav nav-pills my-5 justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#onhold" role="tab" aria-controls="classic" aria-selected="true">
                On Hold 
                @if ($hold > 0)
                    <span class="count">{{$hold}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="articles" aria-selected="false">
                Pending 
                @if ($pending > 0)
                    <span class="count">{{$pending}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#readytoshop" role="tab" aria-controls="photos" aria-selected="false">
                Ready to Ship 
                @if ($ship > 0)
                    <span class="count">{{$ship}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#shipped" role="tab" aria-controls="users" aria-selected="false">Shipped</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#cancelled" role="tab" aria-controls="users" aria-selected="false">Cancelled</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="onhold" role="tabpanel">  
            @if ($hold > 0)    
                <div class="row g-4">
                    <div class="card border, rs_size">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            @endif
            @if ($hold == 0)    
                <div class="row emptyProduct">
                    <div class="card border, rs_size">
                        <div class="card-body">
                            <div class="detailsection">
                                <h3>The product on hold is empty</h3>
                            </div>
                        </div>
                    </div>
                </div> 
            @endif
        </div>
        <div class="tab-pane fade" id="pending" role="tabpanel">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;" id="AcceptOrderbtn">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <div class="detailsection">
                                <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                    <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                    <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                    <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                    <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                                </div>
                            </div>
                            
                            
                            <div class="btn2">
                                <a href="#" class="btn btn-success" style="width: 100%;">Accept Order</a>
                                <a href="#" class="btn btn-primary" style="width: 100%">Cancel Order</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane  fade" id="readytoshop" role="tabpanel">
            <div class="row g-4">
                <div class="card border, rs_size">
                    <div class="card-body">
                        <div class="detailsection">
                            <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                            <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                            </div>
                        </div>
                        
                        
                        <div class="btn2">
                            <a href="#" class="btn btn-primary, btncolor2"  style="width: 40%"><i class="fa fa-download" aria-hidden="true"></i> &nbsp; Label </a>
                        </div>
                        
                    </div>
                </div>
            </div>  
        </div>
        <div class="tab-pane fade" id="shipped" role="tabpanel">
            <div class="row g-4">
                <div class="card border, rs_size">
                    <div class="card-body">
                        <div class="detailsection">
                            <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                            <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel">
            <div class="row g-4">
                <div class="card border, rs_size">
                    <div class="card-body">
                        <div class="detailsection">
                            <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                            <div class=""><h6 class="card-title">Girls Green Colour Full Length Party Wear Sequin Work Gown Dress</h6>
                                <p class="cardtxt"> <strong>Order Num:</strong> &nbsp;413482140320_1</p>
                                <p class="cardtxt"> <strong>Size:</strong> &nbsp;6-7 year</p>
                                <p class="cardtxt"> <strong>Product SKU: </strong> &nbsp;natsha_green</p>
                                <p class="cardtxt"> <strong>QTY: </strong> &nbsp;5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form id="courier_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Select Courier Company</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="courier-name" class="col-form-label detail_min">Courier Company</label>
                            <select class="select2-example" id="courier-name" class="col-form-label">
                                <option value="">Select</option>
                            </select>
                            <div class="detail_courier">
                                <div class="detail_row">
                                    <div class="detail_min">Min Weight :</div>
                                    <div class="min_weight"></div>
                                </div>
                                <div class="detail_row">
                                    <div class="detail_min">Real Time Tracking :</div>
                                    <div class="real_time"></div>
                                </div>
                                <div class="detail_row">
                                    <div class="detail_min">Delivery Boy Contact :</div>
                                    <div class="delivery_boy"></div>
                                </div>
                            </div>
                            <div class="detail_courier">
                                <div class="detail_row">
                                    <div class="detail_min">Pod Available :</div>
                                    <div class="pod"></div>
                                </div>
                                <div class="detail_row">
                                    <div class="detail_min">Call Before Delivery :</div>
                                    <div class="call_before"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="AddShipment">Add</button>
                    </div>
                </form>
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
<script src="{{asset('backend/js/order.js')}}"></script>
@endpush