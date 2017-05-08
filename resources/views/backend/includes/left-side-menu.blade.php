<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!-- Search form -->
        <form role="search" class="navbar-form">
            <div class="form-group">
                <input type="text" placeholder="Search" class="form-control">
                <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <div class="clearfix"></div>
        <!--- Profile -->
        <div class="profile-info">
            <div class="col-xs-4">
                <a href="profile.html" class="rounded-image profile-image"><img src="{{ asset('images/users/user-100.jpg') }}"></a>
            </div>
            <div class="col-xs-8">
                @if(Auth::guard('admin')->check())
                    <div class="profile-text">Welcome <b>{{ Auth::guard('admin')->user()->name }}</b></div>
                @endif

                <div class="profile-buttons">
                    <a href="javascript:;"><i class="fa fa-envelope-o pulse"></i></a>
                    {{--<a href="#connect" class="open-right"><i class="fa fa-comments"></i></a>--}}
                    <a class="md-trigger" data-modal="logout-modal" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                </div>
            </div>
        </div>
        <!--- Divider -->
        <div class="clearfix"></div>
        <hr class="divider" />
        <div class="clearfix"></div>
        <!--- Divider -->
        <div id="sidebar-menu">
            {{--{{ dd(Request::is('backend') == true ? 'class ="active"' : '') }}--}}
            <ul>
                <li><a {{ Request::is('backend')  ? 'class =active' : '' }} href="{{ route('backend') }}"><i class='icon-home-3'></i><span>Dashboard</span><span class="pull-right"></span></a></li>
                <li class="has_sub">
                    <a href='javascript:void(0);'><i class='icon-cogs'></i><span>Quản lý Kho</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                    </ul>
                </li>
                <li class='has_sub'>
                    <a href='javascript:void(0);'><i class='icon-feather'></i><span>Quản lý sản phẩm</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/trademarks*')  ? 'class =active' : '' }} href='{{ route('backend.trademarks.list') }}'><i class="glyphicon glyphicon-bookmark"></i><span>Trademarks</span></a></li>
                        <li><a {{ Request::is('backend/hardware*')  ? 'class =active' : '' }} href='{{ route('backend.hardware.list') }}'><i class="icon-cogs"></i><span>Hardware</span></a></li>
                        <li><a {{ Request::is('backend/products*')  ? 'class =active' : '' }} href='{{ route('backend.products.list') }}'><i class="fa fa-laptop"></i><span>LAPTOP</span></a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href='javascript:void(0);'><i class='icon-cogs'></i><span>Quản lý Khách hàng</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                        <li><a href=""></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div><br><br><br>
    </div>
</div>