<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Security</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">

    <!-- Base Css Files -->
    <link href="{{ asset('backend_assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/fontello/css/fontello.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/animate-css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/nifty-modal/css/component.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/ios7-switch/ios7-switch.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/pace/pace.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/sortable/sortable-theme-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_assets/libs/jquery-icheck/skins/all.css') }}" rel="stylesheet" />
    <!-- Code Highlighter for Demo -->
    <link href="{{ asset('backend_assets/libs/prettify/github.css') }}" rel="stylesheet" />

    <!-- Extra CSS Libraries Start -->
    <link href="{{ asset('backend_assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="{{ asset('backend_assets/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{ asset('backend_assets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('backend_assets/img/apple-touch-icon.png') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('backend_assets/img/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('backend_assets/img/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend_assets/img/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('backend_assets/img/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend_assets/img/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('backend_assets/img/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('backend_assets/img/apple-touch-icon-152x152.png') }}" />
</head>
<body class="fixed-left login-page">


<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal">
    <div class="md-content">
        <h3><strong>Logout</strong> Confirmation</h3>
        <div>
            <p class="text-center">Are you sure want to logout from this awesome system?</p>
            <p class="text-center">
                <button class="btn btn-danger md-close">Nope!</button>
                <a href="login.html" class="btn btn-success md-close">Yeah, I'm sure</a>
            </p>
        </div>
    </div>
</div>        <!-- Modal End -->
<!-- Begin page -->
<div class="container">
    <div class="full-content-center">
        {{--<p class="text-center"><a href="#"><img src="{{ asset('backend_assets/img/login-logo.png') }}" alt="Logo"></a></p>--}}
        <div class="login-wrap animated flipInX">
            <div class="login-block">
                {{--<img src="{{ asset('images/users/default-user.png') }}" class="img-circle not-logged-avatar">--}}
                <form role="form" action="{{ route('admin.login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group login-input {{ $errors->has('email') ? ' has-error' : '' }}">
                        <i class="fa fa-user overlay"></i>
                        <input  type="text" class="form-control text-input" placeholder="Username" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group login-input {{ $errors->has('password') ? ' has-error' : '' }}">
                        <i class="fa fa-key overlay"></i>
                        <input type="password" class="form-control text-input" placeholder="********" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">LOGIN</button>
                        </div>
                        <div class="col-sm-6">
                            <a href="register.html" class="btn btn-default btn-block">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- the overlay modal element -->
<div class="md-overlay"></div>
<!-- End of eoverlay modal -->
<script>
    var resizefunc = [];
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('backend_assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-detectmobile/detect.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-animate-numbers/jquery.animateNumbers.js') }}"></script>
<script src="{{ asset('backend_assets/libs/ios7-switch/ios7.switch.js') }}"></script>
<script src="{{ asset('backend_assets/libs/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-sparkline/jquery-sparkline.js') }}"></script>
<script src="{{ asset('backend_assets/libs/nifty-modal/js/classie.js') }}"></script>
<script src="{{ asset('backend_assets/libs/nifty-modal/js/modalEffects.js') }}"></script>
<script src="{{ asset('backend_assets/libs/sortable/sortable.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-fileinput/bootstrap.file-input.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-select2/select2.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/pace/pace.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-icheck/icheck.min.js') }}"></script>

<!-- Demo Specific JS Libraries -->
<script src="{{ asset('backend_assets/libs/prettify/prettify.js') }}"></script>

<script src="{{ asset('backend_assets/js/init.js') }}"></script>
</body>
</html>