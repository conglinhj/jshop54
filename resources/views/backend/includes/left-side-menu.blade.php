<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!-- Search form -->

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
                <li class="has_sub"><a href='javascript:void(0);'><i class='glyphicon glyphicon-list-alt'></i><span>Xử lý đơn hàng</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/order*')  ? 'class =active' : '' }} href='{{ route('backend.order.list') }}'><span>Danh sách đơn hàng</span></a></li>
                    </ul>
                </li>
                <li class="has_sub"><a href='javascript:void(0);'><i class='icon-users'></i><span>Quản lý Khách hàng</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/customer*')  ? 'class =active' : '' }} href="{{ route('backend.customer.list') }}"><span>Danh sách khách hàng</span></a></li>
                    </ul>
                </li>

                {{--<li class="has_sub"><a href='javascript:void(0);'><i class='icon-list-nested'></i><span>Quản lý nhập hàng</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>--}}
                    {{--<ul>--}}
                        {{--<li><a {{ Request::is('backend/phieunhap*')  ? 'class =active' : '' }} href="{{ route('backend.phieunhap.list') }}">Danh sách phiếu nhập</a></li>--}}
                        {{--<li><a {{ Request::is('backend/provider*')  ? 'class =active' : '' }} href="{{ route('backend.provider.list') }}">Danh sách nhà cung cấp</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-feather'></i><span>Loại sản phẩm</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/category*')  ? 'class =active' : '' }} href='{{ route('backend.category.list') }}'><i class="icon-list"></i><span>Danh sách loại sản phẩm</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='glyphicon glyphicon-bookmark'></i><span>Thương hiệu</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/trademarks*')  ? 'class =active' : '' }} href='{{ route('backend.trademarks.list') }}'><i class="glyphicon glyphicon-bookmark"></i><span>Danh sách Thương hiệu</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-cogs'></i><span>Phần cứng</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/hardware*')  ? 'class =active' : '' }} href='{{ route('backend.hardware.list') }}'><i class="icon-cogs"></i><span>Danh sách phần cứng</span></a></li>
                        <li><a {{ Request::is('backend/specs*')  ? 'class =active' : '' }} href='{{ route('backend.specs.list') }}'><i class="icon-cogs"></i><span>Thông số kỹ thuật</span></a></li>
                    </ul>
                </li>
                <li class='has_sub'><a href='javascript:void(0);'><i class='icon-feather'></i><span>Quản lý sản phẩm</span><span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
                    <ul>
                        <li><a {{ Request::is('backend/products')  ? 'class =active' : '' }} href='{{ route('backend.products.list') }}'><i class="fa fa-laptop"></i><span>Danh sách sản phẩm</span></a></li>
                        <li><a {{ Request::is('backend/products/create*')  ? 'class =active' : '' }} href='{{ route('backend.products.showCreateForm') }}'><i class="fa fa-plus"></i><span>Thêm sản phẩm mới</span></a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div><br><br><br>
    </div>
</div>