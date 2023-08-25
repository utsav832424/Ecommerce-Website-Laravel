@extends('backend.layout.master')
@section('title','Bigger Admin || SITE SETTING')
@section('main-content')
<div class="content ">
    <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="mb-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Site Information</h6>
                                <form action="{{route('site_update')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">GST No</label>
                                                <input type="text" class="form-control" name="gst_no" id="gst_no" value="{{$data->gst_no}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email Address</label>
                                                <input type="text" class="form-control" name="email" id="email" value="{{$data->email}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control number-field" name="mobile" id="mobile" value="{{$data->mobile}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea name="address" class="form-control" id="" cols="30" rows="5" id="address">{{$data->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="colo-12" style="display: flex;justify-content: end;">
                                            <button class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
</style>
@endpush
@push('scripts')
<script>
    $('.number-field').on('keypress', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
</script>
@endpush
