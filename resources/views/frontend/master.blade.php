<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon" />

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/font-awesome.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    @include('frontend.includes.header-area')
    {{--@include('frontend.includes.site-branding-area')--}}
    {{--@include('frontend.includes.mainmenu-area')--}}
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                @yield('menu-area')
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    @yield('content')

    @include('frontend.includes.bottom')

    <div class="loading-block">
        <img width="128" src="{{ asset('images/loading4.gif') }}" alt="loading....">
    </div>
    <div class="message-block">
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Đã thêm vào danh sách yêu thích.</strong>
        </div>
    </div>
    <!-- Latest jQuery form server -->
    <script src="{{ asset('frontend_assets/js/jquery.min.js') }}"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>

    <!-- jQuery sticky menu -->
    <script src="{{ asset('frontend_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/jquery.sticky.js') }}"></script>

    <!-- jQuery easing -->
    <script src="{{ asset('frontend_assets/js/jquery.easing.1.3.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>

    <!-- Slider -->
    <script type="text/javascript" src="{{ asset('frontend_assets/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend_assets/js/script.slider.js') }}"></script>
    @stack('script_content')
    <script type="text/javascript" src="{{ asset('frontend_assets/js/ajax/authenticate.js') }}"></script>
</body>
</html>