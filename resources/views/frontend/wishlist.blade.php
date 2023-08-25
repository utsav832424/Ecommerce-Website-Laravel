@extends('frontend.layout.master')
@section('title','E-SHOP || WISHLIST')
@section('main-content')
<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3 aside aside--left">
                    <div class="list-group">
                        <a href="{{url('/account_details')}}" class="list-group-item active">Account Details</a> 
                        <a href="{{url('/my_address')}}" class="list-group-item">My Addresses</a> 
                        <a href="{{url('/my_wishlist')}}" class="list-group-item">My Wishlist</a> 
                        <a href="{{url('/my_order_history')}}" class="list-group-item">My Order History</a>
                    </div>
                </div>
                <div class="col-md-9 aside">
                    <h2>Account Details</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Personal Info</h3>
                                    <p><b>Name:</b> sahil Bhayani<br>
                                        <b>E-mail:</b> sahilbhayani206@gmail.com<br>
                                        <b>Phone:</b> 9104793373<br>
                                        <b>Date Of Brith:</b></p>
                                        <div class="mt-2 clearfix">
                                            <a href="#" class="link-icn js-show-form" data-form="#updateDetails"><i class="icon-pencil"></i>Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 d-none" id="updateDetails">
                            <div class="card-body">
                                <form action="https://www.thevintagegarments.com/myaccount" method="post" enctype="multipart/form-data">
                                    <h3>Update Account Details</h3>
                                    <div class="row mt-2">
                                        <div class="col-sm-6"><label class="text-uppercase">First Name:</label>
                                            <div class="form-group"><input type="text" class="form-control" placeholder="name" name="name" value="sahil Bhayani" required=""></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">E-mail:</label>
                                            <div class="form-group"><input type="email" class="form-control" placeholder="Email" name="email" value="sahilbhayani206@gmail.com" readonly=""></div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6"><label class="text-uppercase">Phone:</label>
                                            <div class="form-group"><input type="tel" class="form-control" placeholder="Phone" name="phone" pattern="[0-9]{10}" value="9104793373" required=""></div>
                                        </div>
                                        <div class="col-sm-6"><label class="text-uppercase">Date Of Brith:</label>
                                            <div class="form-group"><input type="text" class="form-control" placeholder="DD-MM-YYYY" name="dob" value="" required=""></div>
                                        </div>
                                    </div>
                                    <div class="mt-2"><button type="reset" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancel</button> 
                                        <button type="submit" class="btn ml-1">Update</button></div>
                                    </form></div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection