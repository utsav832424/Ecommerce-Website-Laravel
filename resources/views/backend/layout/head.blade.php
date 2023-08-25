@yield('meta')
<title>@yield('title')</title>
<link rel="shortcut icon" href="{{asset('img/favicon.png')}}"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('backend/dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('backend/dist/css/bootstrap-docs.css')}}" type="text/css">
@stack('style')
<link rel="stylesheet" href="{{asset('backend/dist/css/app.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('backend/css/toastr.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('backend/css/custom.css')}}" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">