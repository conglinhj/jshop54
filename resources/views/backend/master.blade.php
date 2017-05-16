<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title_admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">
    @stack('meta_content')
    <base href="{{ asset('') }}">
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
    <link href="{{ asset('backend_assets/libs/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/style.css" rel="stylesheet') }}" type="text/css" />
    <!-- Extra CSS Libraries Start -->
    <link href="{{ asset('backend_assets/libs/rickshaw/rickshaw.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/morrischart/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/jquery-clock/clock.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/bootstrap-calendar/css/bic_calendar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/sortable/sortable-theme-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/jquery-weather/simpleweather.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/libs/bootstrap-xeditable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="{{ asset('backend_assets/css/style-responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend_assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

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
<body class="fixed-left">
<!-- Modal Start -->
<!-- Modal Task Progress -->
@include('backend.includes.task-progress')

<!-- Modal Logout -->
@include('backend.includes.logout-modal')
<!-- Modal End -->
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    @include('backend.includes.topbar')
    <!-- Top Bar End -->
    <!-- Left Sidebar Start -->
    @include('backend.includes.left-side-menu')
    <!-- Left Sidebar End -->
    <!-- Right Sidebar Start -->
    {{--@include('backend.includes.right-side-menu')--}}
    <!-- Right Sidebar End -->
    <!-- Start right content -->
    <div class="content-page">
        <!-- ============================================================== -->
        <!-- Start Content here -->
        <!-- ============================================================== -->
        <div class="content">

            @yield('content')

            <!-- Footer Start -->
            <footer>
                J-shop Management
                <div class="footer-links pull-right">
                    <a href="#">About</a><a href="#">Contact Us</a>
                </div>
            </footer>
            <!-- Footer End -->
        </div>
        <!-- ============================================================== -->
        <!-- End content here -->
        <!-- ============================================================== -->

    </div>
    <!-- End right content -->

</div>
<div class="loading-block">
    <img width="64" src="{{ asset('images/loading.gif') }}" alt="loading....">
</div>
<div id="contextMenu" class="dropdown clearfix">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display:block;position:static;margin-bottom:5px;">
        <li><a tabindex="-1" href="javascript:;" data-priority="high"><i class="fa fa-circle-o text-red-1"></i> High Priority</a></li>
        <li><a tabindex="-1" href="javascript:;" data-priority="medium"><i class="fa fa-circle-o text-orange-3"></i> Medium Priority</a></li>
        <li><a tabindex="-1" href="javascript:;" data-priority="low"><i class="fa fa-circle-o text-yellow-1"></i> Low Priority</a></li>
        <li><a tabindex="-1" href="javascript:;" data-priority="none"><i class="fa fa-circle-o text-lightblue-1"></i> None</a></li>
    </ul>
</div>
<!-- End of page -->
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
<!-- Page Specific JS Libraries -->
<script src="{{ asset('backend_assets/libs/d3/d3.v3.js') }}"></script>
<script src="{{ asset('backend_assets/libs/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/raphael/raphael-min.js') }}"></script>
{{--<script src="{{ asset('backend_assets/libs/morrischart/morris.min.js') }}"></script>--}}
<script src="{{ asset('backend_assets/libs/jquery-knob/jquery.knob.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-clock/clock.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-easypiechart/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/bootstrap-calendar/js/bic_calendar.min.js') }}"></script>
<script src="{{ asset('backend_assets/libs/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('backend_assets/js/apps/calculator.js') }}"></script>
<script src="{{ asset('backend_assets/js/apps/todo.js') }}"></script>
<script src="{{ asset('backend_assets/js/apps/notes.js') }}"></script>
{{--<script src="{{ asset('backend_assets/js/pages/index.js') }}"></script>--}}
<script src="{{ asset('backend_assets/libs/dropzone/dropzone.min.js') }}"></script>
@stack('js_content')
</body>
</html>