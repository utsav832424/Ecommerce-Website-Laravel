<!DOCTYPE html>
<html lang="en">
<head>
	@include('backend.layout.head')	
</head>
<body>
	
	<div class="preloader">
        <img src="{{asset('frontend/img/bigger.png')}}" alt="logo">
        <div class="preloader-icon"></div>
    </div>
	
	{{-- @include('frontend.layouts.notification') --}}
	<!-- Header -->
	@include('backend.layout.leftmenu')

    <div class="layout-wrapper">
        @include('backend.layout.header')
        <!--/ End Header -->
        @yield('main-content')
        
        @include('backend.layout.footer')
    </div>

    <script src="{{asset('backend/libs/bundle.js')}}"></script>
    @stack('scripts')
    <script src="{{asset('backend/dist/js/app.min.js')}}"></script>
    <script src="{{asset('backend/js/toastr.js')}}"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
</body>
</html>