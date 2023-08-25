@extends('frontend.layout.master')
@section('title','E-SHOP || CHANGE PASSWORD')
@section('main-content')
<div class="page-content">
    
    <div class="holder mt-0">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-md-4">
                    <div id="loginForm">
                        <h2 class="text-center">Change Password</h2>

                        @if (Session::has('error'))
                            <div class="alert alert-danger" style="background-color: red;">{{Session::get('error')}}</div>    
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success" style="background-color: green;">{{Session::get('success')}}</div>    
                        @endif

                        <div class="form-wrapper">
                            <form action="{{route('changepassword')}}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <input type="password" class="form-control" name="oldpassword" placeholder="Enter Current Password" value="{{ old('oldpassword') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="newpassword" placeholder="Enter New Password" value="{{ old('newpassword') }}">
                                </div> 
                                <div class="form-group">
                                    <input type="password" class="form-control" name="confirmpassword" placeholder="Enter Confirm Password" value="{{ old('confirmpassword') }}">
                                </div>
                                <button type="submit" class="btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection