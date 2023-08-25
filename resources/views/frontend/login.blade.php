@extends('frontend.layout.master')
@section('title','E-SHOP || LOGIN')
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
    .gotoForgot {
        display: flex;
        justify-content: end;
        margin-top: 5px !important;
        cursor: pointer;
        font-size: 12px;
    }
</style>
<div class="loginmaindiv">
    <div class="loginForm loginbg">
        <h2 class="text-center">SIGN IN</h2>
        <div class="form-wrapper">
            @if (Session::has('error'))
                <div class="alert alert-danger" style="background-color: red;">{{Session::get('error')}}</div>
            @endif
            <form action="{{route('login')}}" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email address Or Mobile number" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="{{old('password')}}">
                </div>
                <p class="text-uppercase gotoForgot"><a href="{{url('/register')}}" class="js-toggle-forms gotoForgot">Forgot Your Password?</a></p>
                <button type="submit" class="btn">Sign in</button>
                <p class="text-uppercase">Don't have an account?<a href="/register" class="js-toggle-forms gotoRegister" style="color: #ee7600;"> Sign up</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')    
<script>
    $(function() {
        $('.gotoRegister').on('click', function() {
            window.location.href = "register";
        });
    });
    $(function() {
        $('.gotoForgot').on('click', function() {
            window.location.href = "forgot";
        });
    });
</script>
@endpush