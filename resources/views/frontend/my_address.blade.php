@extends('frontend.layout.master')
@section('title','E-SHOP || MYADDRESS')
@section('main-content')
<div class="holder mt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 aside">
                <div class="list-group tab-section">
                    <a href="{{url('/account_details')}}" class="list-group-item">Account Details</a>
                    <a href="{{url('/my_address')}}" class="list-group-item active">My Addresses</a>
                    <a href="{{url('/my_wishlist')}}" class="list-group-item">My Wishlist</a>
                    <a href="{{url('/my_order_history')}}" class="list-group-item">My Order History</a>
                </div>
            </div>
            <div class="col-md-12 aside">
                <div class="row">
                    <div class="col-md-3">
                        <h2>My Addresses</h2>
                    </div>
                    {{-- <div class="col-md-3">
                        <a href="#" class="btn" data-fancybox="" data-src="#modalQuickView"> ADD ADDRESS</a>
                    </div> --}}
                </div>
                <div class="row">
                </div>
                <div class="card-body">
                    <h3>Address </h3>
                    <p><b>Name : </b>sahil Bhayani<br>
                        <b>Email : </b>sahilbhayani222@gmail.com<br>
                        <b>Mobile : </b>9104793373<br>
                        <b>Address : </b>147 , Gautam park Soc.., , surat , Gujarat , india</p>
                    <div class="mt-2 clearfix">
                        {{-- <a href="javascript:void(0)" data="sahil Bhayani" datax="sahilbhayani222@gmail.com" datay="9104793373" dataz="147" dataw="Gautam park Soc..," datal="33" datapin="395010" datacountry="india" datacity="surat" datastate="Gujarat" class="link-icn js-show-form eaddress" data-form="#updateAddress"><i class="icon-pencil"></i>Edit</a> --}}
                        {{-- <a href="https://www.thevintagegarments.com/myaddress/33" data="sahil Bhayani" datax="sahilbhayani222@gmail.com" datay="9104793373" dataz="147" dataw="Gautam park Soc..," datal="33" datapin="395010" datacountry="india" datacity="surat" datastate="Gujarat" class="link-icn js-show-form eaddress" data-form="#updateAddress"><i class="icon-pencil"></i>Edit</a> --}}
                        <!-- <a href="https://www.thevintagegarments.com/delete/myaddress/Address/address/add_id/33" class="link-icn ml-1 float-right"><i class="icon-cross"></i>Delete</a> -->
                    </div>
                </div>
                
                <div class="card mt-3 d-none" id="updateAddress">
                    <div class="card-body">
                        <h3>Edit Address</h3>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6"><label class="text-uppercase">Full Name</label>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="addid" name="addid">
                                            <input type="text" class="form-control" id="fullname" name="name" placeholder="Full Name" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">Email</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="emailid" name="email" placeholder="Email" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">Mobile</label>
                                        <div class="form-group">
                                            <input type="tel" class="form-control" id="mobileno" name="mobile" placeholder="Mobile Number" pattern="[0-9]{10}" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">Flat No</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="flno" name="flatno" placeholder="Flat No" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-12"><label class="text-uppercase">Address</label>
                                        <div class="form-group">
                                            <textarea class="form-control" style="height: 50px;" id="addr" name="address" placeholder="Address" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">Pincode</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">Country</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">State</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="state" name="state" placeholder="State" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label class="text-uppercase">City</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="reset" class="btn btn--alt js-close-form" data-form="#updateAddress">Cancel</button>
                                    <button type="submit" class="btn ml-1">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection