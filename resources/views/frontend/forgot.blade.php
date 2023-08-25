@extends('frontend.layout.master')
@section('title','E-SHOP || FORGOT')
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
    .already-code {
        display: flex;
        justify-content: end;
        margin-top: 5px !important;
        cursor: pointer;
        font-size: 12px;
    }
</style>
<div class="loginmaindiv">
    <div class="loginForm loginbg">
        <h2 class="text-center">Forgot Password</h2>
        <div class="form-wrapper">
            @if (Session::has('error'))
                <div class="alert alert-danger" style="background-color: red;">{{Session::get('error')}}</div>
            @endif
            <form action="{{route('forgot')}}" method="post">
                @csrf
                @method('post')
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email address Or Mobile number" id="email" value="{{old('email')}}">
                </div>
                <span class="already-code">I Have An Already Code</span>
                <div class="text-center"><button type="submit" class="btn">forgot</button></div>
                <p class="text-uppercase">Already have an account<a href="#" class="js-toggle-forms gotoLogin" style="color: #ee7600;"> Sign in</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')    
<script>
    $(function() {
        $('.gotoLogin').on('click', function() {
            window.location.href = "login";
        });
        $('.already-code').on('click', function() {
            window.location.href = "resetpassword";
        });
    });
</script>
@endpush