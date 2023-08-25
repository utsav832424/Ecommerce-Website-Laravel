@extends('backend.layout.master')
@section('title','Bigger Admin || PRODUCT LIST')
@section('main-content')
<div class="content">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                {{-- <div class="d-none d-md-flex">All carts</div> --}}
                <div class="d-md-flex gap-4 align-items-center" style="width: 100%">
                    <form class="mb-3 mb-md-0 col-md-12">
                        <div class="row g-3">
                            <div class="col-md-1">
                                <select class="form-select" id="sortOrder" onchange="fetchCategory();">
                                    <option value="">Sort by</option>
                                    <option value="desc" selected>Desc</option>
                                    <option value="asc">Asc</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select class="form-select" id="perPageItem">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select class="form-select" id="categoryDropDown">
                                    <option value="">Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <select class="form-select" id="fabric">
                                    <option value="">Fabric</option>
                                    @foreach ($fabric as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" id="categorySearch" class="form-control" placeholder="Search">
                                    <button class="btn btn-outline-light" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive" tabindex="1">
        <table class="table table-custom table-lg mb-0" id="categoriesTable">
            <thead>
                <tr>
                    <th>SR NO</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>SKU</th>
                    {{-- <th>Category</th>
                    <th>Sub Category</th> --}}
                    <th>Quantity</th>
                    <th>Sell</th>
                    <th>Price</th>
                    <th>Catelogue Price</th>
                    <th>Catelogue Pis</th>
                    {{-- <th>Featured</th>
                    <th>New</th> --}}
                    <th>Stock</th>
                    <th>Active</th>
                    {{-- <th>Created</th> --}}
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>Cortie Gemson</td>
                    <td>
                        <span class="badge bg-primary">Processing</span>
                    </td>
                    <td>1</td>
                    <td class="text-end">
                        <div class="d-flex">
                            <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">Show</a>
                                    <a href="#" class="dropdown-item">Edit</a>
                                    <a href="#" class="dropdown-item">Delete</a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <nav class="mt-4" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        </ul>
    </nav>
    
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('editSizeStock') }}" method="post" id="size_quantity">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Quantity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table_stock" id="sizestockTable">
                                <thead>
                                    <tr>
                                        <th class="text-start">Size</th>
                                        <th style="text-align: center;">Quantity</th>
                                        <th style="text-align: center;">Old Price</th>
                                        {{-- <th>Category</th>
                                        <th>Sub Category</th> --}}
                                        <th style="text-align: center;">New Price</th>
                                        <th class="text-end">Save Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                            {{-- <div class="mb-3">
                                <div>S</div>
                                <div>XL</div>
                                <div>XXL</div>
                            </div> --}}
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeCategorymodelBtn" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Edit</button>
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
    /* #staticBackdrop{
        height: 50%;
        width: 40%;
    } */
    #staticBackdrop .modal-dialog .modal-content .modal-footer {
        padding: 5px;
    }
    #staticBackdrop .modal-dialog .modal-content .modal-footer button {
        padding: 5px 20px;
    }
    .quantitySection .viewQuantity {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .quantitySection .viewQuantity i.fa-pencil-square-o {
        color: darkgray;
        cursor: pointer;
    }
    .quantitySection .editQuantity {
        display: none;
        align-items: center;
        justify-content: space-between;
    }
    .quantitySection .editQuantity .save {
        cursor: pointer;
    }
    .size_box input[type="text"]{
    display: block;
    width: 50%;
    padding: 3px;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 5px;
    text-align: center;
    }
    .size_box{
        display: flex;
        align-items: center;
        gap: 10px;
        flex-flow: row;
    }
    .table_stock{
        width: 100%;
        margin-bottom: 15px
    }
    tbody, td, tfoot, th, thead, tr {
        border: 0 solid;
        border-color: inherit;
        padding-top: 8px;
    }
    #sizestockTable tbody tr td input[type="text"] {
        width: 50%;
        padding: 5px;
        border-radius: 10px;
        border: 1px solid #ced4da;
        color: #212529;
        text-align: center;
        display: revert;
    }
</style>
@endpush
@push('scripts')
<script src="{{asset('backend/libs/prism/prism.js')}}"></script>
<script src="{{asset('backend/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/js/productList.js')}}"></script>
@endpush