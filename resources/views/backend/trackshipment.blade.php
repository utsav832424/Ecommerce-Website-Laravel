@extends('backend.layout.master')
@section('title','Bigger Admin || TRACK')
@section('main-content')
<div class="content ">
    @csrf
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4" style="border-bottom: 1px solid #ececec;padding-bottom: 10px;">Product Track</h6>
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

                    <nav class="mt-4" aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<style>
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
    .editColorImageListSection {
        position: relative;
    }
    .editColorImageListSection > i {
        position: absolute;
        top: 0;
        right: 0px;
        color: red;
        padding: 2px;
        cursor: pointer;
    }
    .font-weight-600 {
        font-weight: 600;
    }
     .table_mar{
           width: 100%;
           margin: 15px 0px 15px 0px;
       }
       tbody, td, tfoot, th, thead, tr {
           border: 0 solid;
           border-color: inherit;
           padding-top: 8px;
       }
</style>
@endpush
@push('scripts')
<script>
    var csrf = "{{ csrf_token() }}"; 
</script>
@endpush
