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
       width: 70px;
       height: 70px;
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
    .d-flex{
        display: flex;
        align-items: center;
        flex-flow: column;
        gap: 5px;
    }
    .btnaccept{
        background-color: green;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px;
    }
    .btncancel{
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px;
    }
    .prdetail{
        display: flex;
        align-items: center;
        flex-flow: row;
        gap: 5px
    }
    .nameprdeatil{
        padding-left: 10px;
        display: flex;
        align-items: flex-start;
        flex-flow: column;
    }
    .orderdetil{
        color: gray;
        font-size:13px;
    }
    .namepr{
        text-align: start;
        font-weight: 800;
        font-size: 15px;
        margin-bottom: 2px;
    }
    .table td {
        vertical-align: middle;
        white-space: nowrap;
        text-align: center;
    }
    .table thead th {
        text-align: center;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 1px;
        font-weight: 500;
    } .btnlabel{
        gap: 4px;
        font-weight: 800;
        display: flex;
        font-size: 15px;
        background-color: #ff6e40;
        color: white;
        border: none;
        border-radius: 5px;
        padding:  5px 10px 5px 10px;
        align-items: center;
        width: 100%;
        justify-content: center;
    }
    .readydownload{
        color: #1ead6c;
        font-size: 15px
    }.btndelhivry{
        gap: 4px;
        display: flex;
        font-size: 15px;
        border: none;
        border-radius: 20px;
        padding: 5px 10px 5px 10px;
        align-items: center;
        width: 100%;
        justify-content: center;
    }.shiporder{
        background-color: #ff6e40;
        color: white;
    border: none;
    border-radius: 5px;
    padding: 5px;
    }.shipO{
        display: flex;
        justify-content: end;
        position: absolute;
        position: absolute;
        bottom: 5px;
    }
    
</style>
<div class="content">
    @csrf
    <ul class="nav nav-pills my-5 justify-content-center" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="articles" aria-selected="true">
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
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#returnorder" role="tab" aria-controls="users" aria-selected="false">Return Order</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
       
        <div class="tab-pane fade show active" id="pending" role="tabpanel">
    
                <div class="table-responsive" tabindex="1">
                    <table class="table table-custom table-lg mb-0" id="categoriesTable">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input color-checkbox-element" id="selectAllPendingOrder">
                                </th>
                                <th>Product Details</th>
                                <th>Color Sku ID</th>
                                <th>SKU ID</th>
                                <th>Quantity</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
       
        </div>
       
        <div class="tab-pane  fade" id="readytoshop" role="tabpanel">
            <div class="table-responsive" tabindex="2">
                <table class="table table-custom table-lg mb-0" id="categoriesTable">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input color-checkbox-element" id="color">
                                {{-- <label class="form-check-label" for="color" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);margin-bottom: 0px;margin-right: 5px;"></p></label> --}}
                            </th>
                            <th>Products</th>
                            <th>Color Sku ID</th>
                            <th>SKU ID</th>
                            {{-- <th>Category</th>
                            <th>Sub Category</th> --}}
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input color-checkbox-element" id="color">
                                {{-- <label class="form-check-label" for="color" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);margin-bottom: 0px;margin-right: 5px;"></p></label> --}}
                           </td>
                            <td>
                                <div class="prdetail">
                                    <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                    <div class="nameprdeatil">
                                        <p class="namepr">saree 2 women</p>
                                        <div class="orderdetil">Order ID : 7896541230125_8</div>
                                    </div>
                                </div> 
                            </td>
                            <td>4258795210_1</td>
                            <td>SKU-101_ob</td>
                            <td>102</td>
                            <td>XXL</td>
                            <td>24 Feb</td>
                           
                            <td class="text-end">
                                <div class="d-flex">
                                        <button class="btnlabel"><span class="material-icons">vertical_align_bottom</span>Label</button>
                                        <div class="readydownload">Downloaded</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="shipped" role="tabpanel">
            <div class="table-responsive" tabindex="3">
                <table class="table table-custom table-lg mb-0" id="categoriesTable">
                    <thead>
                        <tr>
                            <th class="text-start">Shipped Products</th>
                            <th>Color Sku ID</th>
                            <th>SKU ID</th>
                            {{-- <th>Category</th>
                            <th>Sub Category</th> --}}
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Delhivery Partner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="prdetail">
                                    <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                    <div class="nameprdeatil">
                                        <p class="namepr">saree 2 women</p>
                                        <div class="orderdetil">Order ID : 7896541230125_8</div>
                                    </div>
                                </div> 
                            </td>
                            <td>4258795210_1</td>
                            <td>SKU-101_ob</td>
                            <td>102</td>
                            <td>XXL</td>
                            <td class="text-end">
                                <button class="btndelhivry"><span class="material-icons">local_shipping</span>Delhivery</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="cancelled" role="tabpanel">
            <div class="table-responsive" tabindex="4">
                <table class="table table-custom table-lg mb-0" id="categoriesTable">
                    <thead>
                        <tr>
                            <th class="text-start">Cancelled Products</th>
                            <th>Color Sku ID</th>
                            <th>SKU ID</th>
                            {{-- <th>Category</th>
                            <th>Sub Category</th> --}}
                            <th>Quantity</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="prdetail">
                                    <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                    <div class="nameprdeatil">
                                        <p class="namepr">saree 2 women</p>
                                        <div class="orderdetil">Order ID : 7896541230125_8</div>
                                    </div>
                                </div> 
                            </td>
                            <td>4258795210_1</td>
                            <td>SKU-101_ob</td>
                            <td>102</td>
                            <td>XXL</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="returnorder" role="tabpanel">
            <div class="table-responsive" tabindex="5">
                <table class="table table-custom table-lg mb-0" id="categoriesTable">
                    <thead>
                        <tr>
                            <th class="text-start">Return Orders</th>
                            <th>Color Sku ID</th>
                            <th>SKU ID</th>
                            {{-- <th>Category</th>
                            <th>Sub Category</th> --}}
                            <th>Quantity</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="prdetail">
                                    <div class="img"><img src="/product_images/image-1659163273942.jpg" class="imgsection"></div>
                                    <div class="nameprdeatil">
                                        <p class="namepr">saree 2 women</p>
                                        <div class="orderdetil">Order ID : 7896541230125_8</div>
                                    </div>
                                </div> 
                            </td>
                            <td>4258795210_1</td>
                            <td>SKU-101_ob</td>
                            <td>102</td>
                            <td>XXL</td>
                        </tr>
                    </tbody>
                </table>
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