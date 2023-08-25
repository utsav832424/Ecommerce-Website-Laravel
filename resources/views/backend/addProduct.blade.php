@extends('backend.layout.master')
@section('title','Bigger Admin || PRODUCT')
@section('main-content')
<div class="content ">
<style>
    .color-sku{
        width: 50%;
        border-radius: 10px;
        border: 1px solid #ced4da;
        color: #212529;
        display: revert;
    }
    .package_weight{
        width: 100%;
        border-radius: 10px;
        border: 1px solid #ced4da;
        color: #212529;
        display: flex;
    }
    #sizeDetailsTable tbody tr td input[type="text"] {
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
        margin-bottom: 15px;
    }
    tbody, td, tfoot, th, thead, tr {
        border: 0 solid;
        border-color: inherit;
        padding-top: 8px;
    }
    
</style>   
    @csrf
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
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sub Category</label>
                                            <select class="form-select" id="subCategoryDropDown">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Fabric</label>
                                            <select class="form-select" id="fabric">
                                                <option value="">Select Fabric</option>
                                                @foreach ($fabric as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Occasion</label>
                                            <select class="form-select" id="occasion">
                                                <option value="">Select Occasion</option>
                                                @foreach ($occasion as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pattern</label>
                                            <select class="form-select" id="pattern">
                                                <option value="">Select Pattern</option>
                                                @foreach ($pattern as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Work</label>
                                            <select class="form-select" id="work">
                                                <option value="">Select Work</option>
                                                @foreach ($work as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sleeve</label>
                                            <select class="form-select" id="sleeve">
                                                <option value="">Select Sleeve</option>
                                                @foreach ($sleeve_type as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Wash</label>
                                            <select class="form-select" id="wash">
                                                <option value="">Select Wash</option>
                                                @foreach ($wash as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p style="margin-bottom: 0px;">Size</p>
                                            <div class="sizebox-sections">
                                                @foreach ($size as $item)    
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input size-checkbox-element" id="size_{{$item->id}}" data-value="{{$item->id}}">
                                                        <label class="form-check-label" for="size_{{$item->id}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <p style="margin-bottom: 0px;">Color</p>
                                            <div class="sizebox-sections">
                                                @foreach ($color as $item)    
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input color-checkbox-element" id="color_{{$item->id}}" data-value="{{$item->id}}">
                                                        <label class="form-check-label" for="color_{{$item->id}}" style="display: flex;align-items: center;"><p style="width: 10px;height: 10px;border: 1px solid rgba(0,0,0, 0.2);background-color: {{$item->color_code}};margin-bottom: 0px;margin-right: 5px;"></p>{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mb-3" style="margin-top: 10px;">
                                            <label class="form-label">Hook</label>
                                            <select class="form-select" id="hook">
                                                <option value="">Select Hook</option>
                                                @foreach ($hook as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
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
                                        <label class="form-label" for="product_img">Photos</label>
                                        <input type="file" class="form-control" multiple id="product_img">
                                    </div>
                                    <div id="product_image_preview_section">

                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12" style="margin-bottom: 10px;">
                                    <div>
                                        <label class="form-label" for="product_img">Color Wise Photo's</label>
                                    </div>
                                    <div class="row" id="product_color_image_preview_section" style="gap: 10px;">
                                        
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" id="product_name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control" id="product_slug">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Sku</label>
                                        <input type="text" class="form-control" id="product_sku">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <div id="descriptionEditor"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Specification</label>
                                        <div id="specificationEditor"></div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Quantity</label>
                                        <input type="text" class="form-control number-field" id="product_quantity">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control number-field" id="product_price">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Old Price</label>
                                        <input type="text" class="form-control number-field" id="product_old_price">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Save Price</label>
                                        <input type="text" class="form-control number-field" id="product_save_price" disabled readonly>
                                    </div>
                                </div> --}}
                                <div class="table-responsive">
                                    <table class="table_mar" id="sizeDetailsTable">
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
                                <div class="mb-3" >
                                    <div>
                                        <label class="form-label" for="product_img">Color Wise Photo's</label>
                                    </div>
                                    <div class="row" id="product_color_image_preview_section" style="gap: 10px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="mb-3">
                                        <label class="form-label">Catelogue Price</label>
                                        <input type="text" class="form-control number-field" id="catelogue_price">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Catelogue Pieces</label>
                                        <input type="text" class="form-control number-field" id="catelogue_pie">
                                    </div> --}}
                                   
                                    <div class="mb-3">
                                        <label class="form-label">Discount</label>
                                        <input type="text" class="form-control number-field" id="product_discount">
                                    </div>
                                    <div class="mb-3">
                                        <div style="display: flex;gap: 10px;flex-wrap: wrap;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_featured">
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_new">
                                                <label class="form-check-label" for="is_new">New</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_hot_deal">
                                                <label class="form-check-label" for="is_hot_deal">Hot Deal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" id="status">
                                            <option value="">Select Status</option>
                                            <option value="1">Ready</option>
                                            <option value="2">Publish</option>
                                        </select>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" value="United States">
                                    </div> --}}
                                </div>
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Product Weight</label>
                                        <input type="text" class="form-control package_weight" id="product_weight">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product Height</label>
                                        <input type="text" class="form-control package_weight" id="product_height">
                                    </div>
                            </div>  
                            <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Product Length</label>
                                        <input type="text" class="form-control package_weight" id="product_length">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Product Breadth</label>
                                        <input type="text" class="form-control package_weight" id="product_breadth">
                                    </div>
                            </div>
                                

                                <div class="col-md-12">
                                    <div class="btnCenter">
                                        <button class="btn btn-success" id="product_add">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Social</h6>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Twitter</label>
                                            <input type="text" class="form-control" value="https://twitter.com/roxana-roussell">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Facebook</label>
                                            <input type="text" class="form-control" value="https://www.facebook.com/roxana-roussell">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Instagram</label>
                                            <input type="text" class="form-control" value="https://www.instagram.com/roxana-roussell/">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">GitHub</label>
                                            <input type="text" class="form-control" value="https://github.com/roxana-roussell">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Change Password</h6>
                            <div class="mb-3">
                                <label class="form-label">Old Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password Repeat</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="notification-settings" role="tabpanel" aria-labelledby="notification-settings-tab">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-4">Notifications</h6>
                            <h6 class="mb-4">Activity Notifications</h6>
                            <div class="mb-5">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked="" id="cs1">
                                        <label class="form-check-label" for="cs1">Someone assigns me to a task</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked="" id="cs2">
                                        <label class="form-check-label" for="cs2">Someone mentions me in a conversation</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked="" id="cs3">
                                        <label class="form-check-label" for="cs3">Someone adds me to a project</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="cs4">
                                        <label class="form-check-label" for="cs4">Activity on a project I am a member of</label>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mb-4">Service Notifications</h6>
                            <div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="cs5">
                                        <label class="form-check-label" for="cs5">Monthly newsletter</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" checked="" id="cs6">
                                        <label class="form-check-label" for="cs6">Major feature enhancements</label>
                                    </div>
                                </div>
                                <div>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="cs7">
                                        <label class="form-check-label" for="cs7">Minor updates and bug fixes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                    <div class="card widget">
                        <div class="card-header">
                            <h6 class="card-title">Integrations</h6>
                        </div>
                        <div class="card-body p-0 overflow-hidden">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item p-4">
                                    <div class="d-md-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <figure class="mb-0 me-3">
                                                <img src="https://vetra.laborasyon.com/assets/svg/logo-integration-slack.svg" alt="...">
                                            </figure>
                                            <div>
                                                <h5 class="mb-1">Slack</h5>
                                                <small class="text-muted">Permissions: Read, Write, Comment</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-danger mt-3 mt-md-0">Disconnect</button>
                                    </div>
                                </div>
                                <div class="list-group-item p-4">
                                    <div class="d-md-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <figure class="mb-0 me-3">
                                                <img src="https://vetra.laborasyon.com/assets/svg/logo-integration-drive.svg" alt="...">
                                            </figure>
                                            <div>
                                                <h5 class="mb-1">Google Drive</h5>
                                                <small class="text-muted">Permissions: Read, Write</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-success mt-3 mt-md-0">Connect</button>
                                    </div>
                                </div>
                                <div class="list-group-item p-4">
                                    <div class="d-md-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <figure class="mb-0 me-3">
                                                <img src="https://vetra.laborasyon.com/assets/svg/logo-integration-dropbox.svg" alt="...">
                                            </figure>
                                            <div>
                                                <h5 class="mb-1">Dropbox</h5>
                                                <small class="text-muted">Permissions: Read, Write, Upload</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-danger mt-3 mt-md-0">Disconnect</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="card sticky-top mb-4 mb-md-0">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column gap-2" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="bi bi-lock me-2"></i> Password
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="notification-settings-tab" data-bs-toggle="tab" href="#notification-settings" role="tab" aria-controls="notification-settings" aria-selected="false">
                                <i class="bi bi-bell me-2"></i> Notifications
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="integrations-tab" data-bs-toggle="tab" href="#integrations" role="tab" aria-controls="integrations" aria-selected="false">
                                <i class="bi bi-arrow-down-up me-2"></i> Integrations
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/libs/ckeditor5/ckeditor.js')}}"></script>
<script src="{{asset('backend/js/product.js')}}"></script>
@endpush
