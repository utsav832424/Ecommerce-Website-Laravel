@extends('backend.layout.master')
@section('title','Bigger Admin || PRODUCT')
@section('main-content')
<div class="content ">
    <style>
        .edit_color_sku{
           width: 50%;
           border-radius: 10px;
           border: 1px solid #ced4da;
           color: #212529;
           display: revert;
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
       #sizeDetailsEditTable tbody tr td input[type="text"] {
           width: 50%;
           padding: 5px;
           border-radius: 10px;
           border: 1px solid #ced4da;
           color: #212529;
           text-align: center;
           display: revert;
       }
       .table_mar{
           width: 100%;
           margin-bottom: 15px
       }
       tbody, td, tfoot, th, thead, tr {
           border: 0 solid;
           border-color: inherit;
           padding-top: 8px;
       }
       
   </style>    
    @csrf
    <input type="hidden" name="productId" value="{{$data->id}}" id="productId">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Basic Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Main Category</label>
                                            <select class="form-select" id="mainCategoryDropDown">
                                                <option value="">Select Main Category</option>
                                                @foreach ($category as $item)
                                                    @if ($item->id == $data->category_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sub Category</label>
                                            <select class="form-select" id="subCategoryDropDown">
                                                <option value="">Select Sub Category</option>
                                                @foreach ($subCategory as $item)
                                                    @if ($item->id == $data->sub_category_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fabric</label>
                                            <select class="form-select" id="fabric">
                                                <option value="">Select Fabric</option>
                                                @foreach ($fabric as $item)
                                                    @if ($item->id == $data->fabric_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Occasion</label>
                                            <select class="form-select" id="occasion">
                                                <option value="">Select Occasion</option>
                                                @foreach ($occasion as $item)
                                                    @if ($item->id == $data->occasion_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pattern</label>
                                            <select class="form-select" id="pattern">
                                                <option value="">Select Pattern</option>
                                                @foreach ($pattern as $item)
                                                    @if ($item->id == $data->pattern_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Work</label>
                                            <select class="form-select" id="work">
                                                <option value="">Select Work</option>
                                                @foreach ($work as $item)
                                                    @if ($item->id == $data->work_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sleeve</label>
                                            <select class="form-select" id="sleeve">
                                                <option value="">Select Sleeve</option>
                                                @foreach ($sleeve_type as $item)
                                                    @if ($item->id == $data->sleeve_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Wash</label>
                                            <select class="form-select" id="wash">
                                                <option value="">Select Wash</option>
                                                @foreach ($wash as $item)
                                                    @if ($item->id == $data->wash_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p style="margin-bottom: 0px;">Size</p>
                                            <div class="sizebox-sections">
                                                @foreach ($size as $item)   
                                                    @if (in_array($item->id, explode(",", $data->size_id)))
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input size-checkbox-element" checked id="size_{{$item->id}}" data-value="{{$item->id}}">
                                                            <label class="form-check-label" for="size_{{$item->id}}">{{$item->name}}</label>
                                                        </div>    
                                                    @else
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input size-checkbox-element" id="size_{{$item->id}}" data-value="{{$item->id}}">
                                                            <label class="form-check-label" for="size_{{$item->id}}">{{$item->name}}</label>
                                                        </div>    
                                                    @endif 
                                                    
                                                @endforeach
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <p style="margin-bottom: 0px;">Color</p>
                                            <div class="sizebox-sections">
                                                @foreach ($color as $item)
                                                    @if (in_array($item->id, explode(",", $data->color_id)))
                                                        <div class="form-check">
                                                            <input type="checkbox" checked class="form-check-input color-checkbox-element" id="color_{{$item->id}}" data-value="{{$item->id}}">
                                                            <label class="form-check-label" for="color_{{$item->id}}" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);background-color: {{$item->color_code}};margin-bottom: 0px;margin-right: 5px;"></p>{{$item->name}}</label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input color-checkbox-element" id="color_{{$item->id}}" data-value="{{$item->id}}">
                                                            <label class="form-check-label" for="color_{{$item->id}}" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);background-color: {{$item->color_code}};margin-bottom: 0px;margin-right: 5px;"></p>{{$item->name}}</label>
                                                        </div>    
                                                    @endif 
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-3" style="margin-top: 10px;">
                                            <label class="form-label">Hook</label>
                                            <select class="form-select" id="hook">
                                                <option value="">Select Hook</option>
                                                @foreach ($hook as $item)
                                                    @if ($item->id == $data->hook_id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Product Information</h6>
                            <div class="row">
                                {{-- <div class="col-md-12" style="margin-bottom: 10px;">
                                    <div>
                                        <label class="form-label" for="product_img">Color Wise Photo's</label>
                                    </div>
                                    <div class="row" id="product_color_image_preview_section" style="gap: 10px;">
                                        @foreach ($colorImg as $item)    
                                            <div class="col-md-6" style="width: 49%;">
                                                <div class="mainColorSelectcontent">
                                                    <label class="form-check-label">{{$item->name}}</label>
                                                    <input type="file" multiple="" class="form-control colorImgFileInput" data-colorid="{{$item->id}}" data-colorname="{{$item->name}}" id="color_{{$item->id}}_img">
                                                </div>
                                                <div class="selectColorImgPreviewSection">
                                                    @foreach ($item->img as $img)
                                                        <div class="editColorImageListSection">
                                                            <img src="/{{$img->image}}">
                                                            <i class="fa fa-times-circle deleteColorImg" data-colorImgId="{{$img->id}}"></i>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" id="product_name" value="{{$data->name}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="product_slug" value="{{$data->slug}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" id="product_sku" value="{{$data->sku}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <div id="descriptionEditor">{!! $data->description !!}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Specification</label>
                                        <div id="specificationEditor">{!! $data->specification !!}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Quantity</label>
                                        <input type="text" class="form-control number-field" id="product_quantity" value="{{$data->quantity}}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control number-field" id="product_price" value="{{$data->price}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Old Price</label>
                                        <input type="text" class="form-control number-field" id="product_old_price" value="{{$data->old_price}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Save Price</label>
                                        <input type="text" class="form-control number-field" id="product_save_price" disabled readonly value="{{$data->save_price}}">
                                    </div>
                                </div> --}}
                                <div class="table-responsive">
                                    <table class="table_mar" id="sizeDetailsEditTable">
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
                                                <td style="text-align: center;">
                                                    <input type="text" class="form-control size-quantity" id="size_{{$item->name}}_product_quantity" value=" {{$item->quantity}}">
                                                </td>
                                                <td style="text-align: center;">
                                                    <input type="text" class="form-control size-oldprice" id="size_{{$item->name}}_product_oldprice" value=" {{$item->old_price}}">
                                                </td>
                                                <td style="text-align: center;">
                                                    <input type="text" class="form-control size-newprice" id="size_{{$item->name}}_product_newprice" value=" {{$item->price}}">
                                                </td>
                                                <td class="text-end">{{$item->old_price - $item->price}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-3" >
                                    <div>
                                        <label class="form-label" for="product_img">Color Wise Photo's</label>
                                    </div>
                                    <div class="row" id="product_color_image_preview_section" style="gap: 10px;">
                                        @foreach ($colorImg as $item)    
                                            <div class="col-md-6" style="width: 49%;">
                                                <div class="mainColorSelectcontent"  style="display: flex;
                                                flex-direction: column;
                                                gap: 8px;">
                                                    <label class="form-check-label">{{$item->name}}</label>
                                                    <input type="text" class="form-control edit_color_sku" id="product_edit_color_sku" placeholder="color sku" value="{{$item->img[0]->color_sku}}">

                                                    <input type="file" multiple="" class="form-control colorImgFileInput" data-colorid="{{$item->id}}" data-colorname="{{$item->name}}" id="color_{{$item->id}}_img">
                                                </div>
                                                <div class="selectColorImgPreviewSection">
                                                    @foreach ($item->img as $img)
                                                        <div class="editColorImageListSection">
                                                            <img src="/{{$img->image}}">
                                                            <i class="fa fa-times-circle deleteColorImg" data-colorImgId="{{$img->id}}"></i>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="mb-3">
                                        <label class="form-label">Catelogue Price</label>
                                        <input type="text" class="form-control number-field" id="catelogue_price" value="{{$data->catelogue_price}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Catelogue Pieces</label>
                                        <input type="text" class="form-control number-field" id="catelogue_pie" value="{{$data->catelogue_pis}}">
                                    </div> --}}
                                    <div class="mb-3">
                                        <label class="form-label">Discount</label>
                                        <input type="text" class="form-control number-field" id="product_discount" value="{{$data->discount}}">
                                    </div>
                                    <div class="mb-3">
                                        <div style="display: flex;gap: 10px;flex-wrap: wrap;">
                                            @if ($data->is_featured == 1)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_featured" checked>
                                                    <label class="form-check-label" for="is_featured">Featured</label>
                                                </div>    
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_featured">
                                                    <label class="form-check-label" for="is_featured">Featured</label>
                                                </div>
                                            @endif
                                            
                                            @if ($data->is_new == 1)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_new" checked>
                                                    <label class="form-check-label" for="is_new">New</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_new">
                                                    <label class="form-check-label" for="is_new">New</label>
                                                </div>
                                            @endif
                                            
                                            @if ($data->is_hot_deal == 1)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_hot_deal" checked>
                                                    <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_hot_deal">
                                                    <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                                </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" id="status">
                                            <option value="">Select Status</option>
                                            @if ($data->status == 1)
                                                <option value="1" selected>Ready</option>    
                                            @else
                                                <option value="1">Ready</option>
                                            @endif
                                            
                                            @if ($data->status == 2)
                                                <option value="2" selected>Publish</option>                                                
                                            @else
                                                <option value="2">Publish</option>    
                                            @endif
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Product Weight</label>
                                        <input type="text" class="form-control package_weight" id="product_weight" value="{{$data->package_weight}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product Height</label>
                                        <input type="text" class="form-control package_weight" id="product_height" value="{{$data->package_height}}">
                                    </div>
                            </div>  
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Product Length</label>
                                        <input type="text" class="form-control package_weight" id="product_length" value="{{$data->package_length}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product Breadth</label>
                                        <input type="text" class="form-control package_weight" id="product_breadth" value="{{$data->package_breadth}}">
                                    </div>
                            </div>
                                
                                <div class="col-md-12">
                                    <div class="btnCenter">
                                        <button class="btn btn-success" id="product_update">Update</button>
                                    </div>
                                </div>
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
<script src="{{asset('backend/libs/ckeditor5/ckeditor.js')}}"></script>
<script src="{{asset('backend/js/product.js')}}"></script>
@endpush
