@extends('backend.layout.master')
@section('title','Bigger Admin || PRODUCT')
@section('main-content')
<div class="content ">
    @csrf
    <input type="hidden" name="productId" value="{{$data->id}}" id="productId">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-4" style="border-bottom: 1px solid #ececec;padding-bottom: 10px;">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Main Category : </label>
                                            @foreach ($category as $item)
                                                @if ($item->id == $data->category_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Sub Category : </label>
                                            @foreach ($subCategory as $item)
                                                @if ($item->id == $data->sub_category_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Fabric : </label>
                                            @foreach ($fabric as $item)
                                                @if ($item->id == $data->fabric_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Occasion : </label>
                                            @foreach ($occasion as $item)
                                                @if ($item->id == $data->occasion_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Pattern : </label>
                                            @foreach ($pattern as $item)
                                                @if ($item->id == $data->pattern_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Work : </label>
                                            @foreach ($work as $item)
                                                @if ($item->id == $data->work_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Sleeve : </label>
                                            @foreach ($sleeve_type as $item)
                                                @if ($item->id == $data->sleeve_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Product Breadth : </label>
                                            <span>{{$data->package_breadth}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p class="font-weight-600" style="margin-bottom: 0px;">Size</p>
                                            <div class="sizebox-sections">
                                                @foreach ($size as $item)   
                                                    @if (in_array($item->id, explode(",", $data->size_id)))
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="size_{{$item->id}}">{{$item->name}}</label>
                                                        </div>  
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div style="margin: 10px 0px 15px 0px;">
                                            <p class="font-weight-600" style="margin-bottom: 0px;">Color</p>
                                            <div class="sizebox-sections">
                                                @foreach ($color as $item)
                                                    @if (in_array($item->id, explode(",", $data->color_id)))
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="color_{{$item->id}}" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);background-color: {{$item->color_code}};margin-bottom: 0px;margin-right: 5px;"></p>{{$item->name}}</label>
                                                        </div>  
                                                    @endif 
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Wash : </label>
                                            @foreach ($wash as $item)
                                                @if ($item->id == $data->wash_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Hook : </label>
                                            @foreach ($hook as $item)
                                                @if ($item->id == $data->hook_id)
                                                    {{$item->name}}
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Product Weight : </label>
                                            <span>{{$data->package_weight}}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Product Length : </label>
                                            <span>{{$data->package_length}}</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label font-weight-600">Product Height : </label>
                                            <span>{{$data->package_height}}</span>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4" style="border-bottom: 1px solid #ececec;padding-bottom: 10px;">Product Information</h6>
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <div>
                                        <label class="form-label font-weight-600" for="product_img">Color Wise Photo's</label>
                                    </div>
                                    <div class="row" id="product_color_image_preview_section" style="gap: 10px;">
                                        @foreach ($colorImg as $item)    
                                            <div class="col-md-6" style="width: 49%;">
                                                <div class="mainColorSelectcontent"  style="display: flex;
                                                flex-direction: column;
                                                gap: 8px;">
                                                    <label class="form-check-label font-weight-600">{{$item->name}}</label>
                                                    <label class="form-check-label" for="ColorSku_{{$item->img[0]->color_id}}">{{$item->img[0]->color_sku}}</label>
                                                </div>
                                                <div class="selectColorImgPreviewSection">
                                                    @foreach ($item->img as $img)
                                                            <img src="/{{$img->image}}">
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <p class="form-label font-weight-600">Name : </p>
                                        <span>{{$data->name}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <p class="form-label font-weight-600">Slug : </p>
                                        <span>{{$data->slug}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <p class="form-label font-weight-600">SKU : </p>
                                        <span>{{$data->sku}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p class="form-label font-weight-600">Description : </p>
                                        <div style="margin-left: 30px;">{!! $data->description !!}</div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="form-label font-weight-600">Specification : </p>
                                        <div style="margin-left: 30px;">{!! $data->specification !!}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Quantity : </label>
                                        <span>{{$data->quantity}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Price : </label>
                                        <span>{{$data->price}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Old Price : </label>
                                        <span>{{$data->old_price}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Save Price : </label>
                                        <span>{{$data->save_price}}</span>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    {{-- <div class="mb-3">
                                        <label class="form-label font-weight-600">Catelogue Price : </label>
                                        <span>{{$data->catelogue_price}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Catelogue Pieces : </label>
                                        <span>{{$data->catelogue_pis}}</span>
                                    </div> --}}
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Discount : </label>
                                        <span>{{$data->discount}}</span>
                                    </div>
                                    <div class="mb-3">
                                        <div style="display: flex;gap: 10px;flex-wrap: wrap;">
                                            @if ($data->is_featured == 1)
                                                <div class="form-check" style="padding-left: 0px;">
                                                    <label class="form-check-label font-weight-600" for="is_featured">Featured : </label>
                                                    <span>Yes</span>
                                                </div>    
                                            @else
                                                <div class="form-check" style="padding-left: 0px;">
                                                    <label class="form-check-label font-weight-600" for="is_featured">Featured : </label>
                                                    <span>No</span>
                                                </div>
                                            @endif
                                            
                                            @if ($data->is_new == 1)
                                                <div class="form-check">
                                                    <label class="form-check-label font-weight-600" for="is_new">New : </label>
                                                    <span>Yes</span>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <label class="form-check-label font-weight-600" for="is_new">New : </label>
                                                    <span>No</span>
                                                </div>
                                            @endif
                                            
                                            @if ($data->is_hot_deal == 1)
                                                <div class="form-check">
                                                    <label class="form-check-label font-weight-600" for="is_hot_deal">Hot Deal : </label>
                                                    <span>Yes</span>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <label class="form-check-label font-weight-600" for="is_hot_deal">Hot Deal : </label>
                                                    <span>No</span>
                                                </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label font-weight-600">Status : </label>
                                            @if ($data->status == 1)
                                                Ready
                                            @endif
                                            
                                            @if ($data->status == 2)
                                                Publish
                                            @endif
                                            
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table_mar" class="sizeDetailsTable">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Size</th>
                                                <th style="text-align: center;">Quantity</th>
                                                <th style="text-align: center;">Old Price</th>
                                                <th style="text-align: center;">New Price</th>
                                                <th class="text-end">Save Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizeData as $item)
                                            <tr class="size_{{$item->name}}_size_details_row" data-id="{{$item->size_id}}">
                                                <td class="text-start">{{$item->name}}</td>
                                                <td style="text-align: center;">{{$item->quantity}} </td>
                                                <td style="text-align: center;">{{$item->old_price}}</td>
                                                <td style="text-align: center;">{{$item->price}}</td>
                                                <td class="text-end">{{$item->old_price - $item->price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4" style="border-bottom: 1px solid #ececec;padding-bottom: 10px;">Quantity Adjustment</h6>
                            <div class="d-md-flex gap-4 align-items-center">
                                <div class="d-none d-md-flex">All carts</div>
                                <div class="d-md-flex gap-4 align-items-center">
                                    <form class="mb-3 mb-md-0">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <select class="form-select" id="sortOrder" onchange="fetchQty();">
                                                    <option value="">Sort by</option>
                                                    <option value="desc" selected>Desc</option>
                                                    <option value="asc">Asc</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-select" id="perPageItem">
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
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
                    </div> --}}

                    {{-- <div class="table-responsive" tabindex="1" >
                        <table class="table table-custom table-lg mb-0" id="categoriesTable">
                            <thead>
                                <tr>
                                    <th>SR NO</th>
                                    <th>Quantity</th>
                                    <th>DATE TIME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Cortie Gemson</td>
                                    <td>
                                        <span class="badge bg-primary">Processing</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                    
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
<script src="{{asset('backend/js/product.js')}}"></script>
<script>
    $(function() {
        fetchQty();

        $(".pagination").on('click', '.page-link', function() {
            pageIndex = $(this).data('page');
            fetchQty();
        });

        $('#categorySearch').on('keyup', function() {
            categorySearch = $(this).val().trim();
            fetchQty();
        });

        $('#perPageItem').on('change', function() {
            pageIndex = 0;
            fetchQty();
        });

        $('#categoryDropDown').on('change', function() {
            maincategoryId = $(this).val();
            fetchQty();
        });
    });
    function fetchQty() {
        $.ajax({
            url: '/admin/fetchQty',
            method: 'post',
            dataType: 'json',
            data: {
                "_token": csrf,
                "limit": $('#perPageItem').val(),
                "offset": $('#perPageItem').val() * pageIndex,
                "sort": $('#sortOrder').val(),
                "productId":$('#productId').val()
            },
            success: function(res) {
                var html = '';
                res.data.forEach((element, index) => {
                    html += `<tr>
                        <td>${$('#perPageItem').val() * pageIndex + (index + 1)}</td>
                        <td>${element.qty}</td>
                        <td>${moment(element.added_datetime).format('DD-MM-YYYY h:mm:ss A')}</td>
                    </tr>`;
                });
                $('#categoriesTable tbody').html(html);

                var navHtml = `<li class="page-item">
                                    <a class="page-link" data-page="0" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                    </a>
                                </li>`;
                for (let index = 0; index < res.totalPage; index++) {
                    if (pageIndex == index) {
                        navHtml += `<li class="page-item active"><a class="page-link" data-page="${index}">${index + 1}</a></li>`;
                    } else {
                        navHtml += `<li class="page-item"><a class="page-link" data-page="${index}">${index + 1}</a></li>`;
                    }
                }

                navHtml += `<li class="page-item">
                                <a class="page-link" data-page="${res.totalPage - 1}" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>`;
                $('.pagination').html(navHtml);
            }
        });
    }
</script>
@endpush
