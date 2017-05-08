<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>

                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">

                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Vietnam</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </li>
                        @if(Auth::check())
                            <li class="dropdown dropdown-small">
                                <a  data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">{{ Auth::user()->name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a class="btn-link"  href=""><i class="fa fa-user"></i>  profile</a></li>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-filled">
                <div class="panel-body">
                    @include('frontend.includes.register-form')
                </div>
            </div>
        </div>
    </div>
</div>

{{--Login modal--}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-filled">
                <div class="panel-body">
                    @include('frontend.includes.login-form')
                </div>
            </div>
        </div>
    </div>
</div>
