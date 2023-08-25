<!DOCTYPE html>
<html lang="en">
<head>
	@include('frontend.layout.head')	
</head>
<body class="home-page is-dropdn-click has-slider">
	
	<div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <div class="dot one"></div>
                <div class="dot two"></div>
                <div class="dot three"></div>
            </div>
        </div>
    </div>
	
	{{-- @include('frontend.layouts.notification') --}}
	<!-- Header -->
	@include('frontend.layout.header')
	<!--/ End Header -->
	@yield('main-content')
	
	@include('frontend.layout.footer')

</body>
</html>