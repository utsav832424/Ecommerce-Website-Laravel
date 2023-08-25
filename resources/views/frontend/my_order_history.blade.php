@extends('frontend.layout.master')
@section('title','E-SHOP || MY ORDER HISTORY')
@section('main-content')
<div class="holder mt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 aside">
                <div class="list-group tab-section">
                    <a href="{{url('/account_details')}}" class="list-group-item">Account Details</a> 
                    <a href="{{url('/my_address')}}" class="list-group-item">My Addresses</a> 
                    <a href="{{url('/my_wishlist')}}" class="list-group-item">My Wishlist</a> 
                    <a href="{{url('/my_order_history')}}" class="list-group-item active">My Order History</a>
                </div>
            </div>
            <div class="col-md-12 aside">
                <h2>Order History</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-order-history" id="orderTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total Price</th>
                                <th style="text-align: right;" scope="col">Cancel | Invoice | Reorder</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <nav class="mt-4" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" data-page="0" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" data-page="-1" aria-label="Next">
                                <span aria-hidden="true">»</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var _token = "{{ csrf_token() }}";
</script>
<script src="{{asset('frontend/js/myOrderlist.js')}}"></script>
@endpush