@yield('meta')
<title>@yield('title')</title>
<link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/slick.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/jquery.fancybox.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/animate.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/style-light.css')}}" rel="stylesheet">
<link href="{{asset('frontend/css/icomoon.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend/css/toastr.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('backend/dist/css/bootstrap-docs.css')}}" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
@stack('style')