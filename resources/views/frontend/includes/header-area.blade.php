<div class="header-area">
    <div class="container">
        <div class="row">

            <div class="col-sm-2" style="text-align: center">
                <h1 style="margin-bottom: 5px"><a href="{{ route('home') }}"><img style="height: 60px; margin-top: 10px" src="{{ asset('img/jshop.png') }}"></a></h1>
            </div>
            <div class="col-sm-6 search-block">
                <form action="{{ route('shop' ) }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="key" placeholder="Tên sản phẩm bạn muốn tìm..." style="font-size: 14px; font-family: Roboto Condensed,sans-serif;" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

            <div class="col-sm-4 search-block">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">

                        {{--<li class="dropdown dropdown-small">--}}
                            {{--<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="value">English </span><b class="caret"></b></a>--}}
                            {{--<ul class="dropdown-menu">--}}
                                {{--<li><a href="#">Vietnam</a></li>--}}
                                {{--<li><a href="#">English</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        @if(Auth::check())
                            <li class="dropdown dropdown-small">
                                <a  data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">{{ Auth::user()->name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-link"  href="{{ route('my.profile') }}"><i class="fa fa-user"></i>  profile</a></li>
                                    <li>
                                        <a class="btn-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>  Thoát</a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="#" data-toggle="modal" data-target="#loginModal"> Đăng nhập</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#registerModal"> Đăng ký</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

{{--register modal--}}
<div class="modal fade" hidden="true" id="registerModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="panel panel-filled">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Đăng ký với:</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <a class="btn btn-primary btn-block" href="{{ route('redirectToProvider',['social' => 'facebook']) }}" >
                            <i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập bằng Facebook
                        </a>
                        <a class="btn btn-danger btn-block" href="{{ route('redirectToProvider',['social' => 'google']) }}" >
                            <i class="fa fa-google" aria-hidden="true"></i> Đăng nhập bằng Google
                        </a>
                    </div>
                    @include('frontend.includes.register-form')
                </div>
            </div>
        </div>
    </div>
</div>

{{--Login modal--}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="panel panel-filled">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title ">Đăng nhập với :</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <a class="btn btn-primary btn-block" href="{{ route('redirectToProvider',['social' => 'facebook']) }}" >
                            <i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập bằng Facebook
                        </a>
                        <a class="btn btn-danger btn-block" href="{{ route('redirectToProvider',['social' => 'google']) }}" >
                            <i class="fa fa-google" aria-hidden="true"></i> Đăng nhập bằng Google
                        </a>
                    </div>
                    @include('frontend.includes.login-form')
                </div>
            </div>
        </div>
    </div>
</div>
