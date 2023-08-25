@extends('frontend.layout.master')
@section('title','E-SHOP || REGISTER')
@section('main-content')
<style>
    .loginbg{
        box-shadow: 0 0 9px grey;
        width: 607px;
        padding: 58px;
        border-radius: 16px;
        background-color: white;    
        text-align: center;
        /* border: 2px solid orange; */
    }
    .loginmaindiv{
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 40px;
        
    }
</style>
<div class="loginmaindiv">
    @csrf
    <div class="loginbg">
        <h2 class="text-center">CREATE AN ACCOUNT</h2>
        <div class="form-wrapper">
            <form action="{{route('addUsers')}}" method="post" id="users_form">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" id="users_name">
                </div>
                <div class="form-group">
                    <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" id="mobile">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" id="email">
                    
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" id="Confirm_password">
                </div>
                <!-- <div class="clearfix"><input id="checkbox1" name="checkbox1" type="checkbox" checked="checked"> <label for="checkbox1">By registering your details you agree to our Terms and Conditions and privacy and cookie policy</label></div> -->
                <div class="text-center"><button type="submit" class="btn">create an account</button></div>
                <p class="text-uppercase">Already have an account<a href="#" class="js-toggle-forms gotoLogin" style="color: #ee7600;"> Sign in</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('frontend/js/user.js')}}"></script>
@push('scripts')    
<script>
    $(function() {
        $('.gotoLogin').on('click', function() {
            window.location.href = "login";
        });
    });
</script>
@endpush
@endpush