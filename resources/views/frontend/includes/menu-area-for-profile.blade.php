<div class="col-sm-9" style="margin-left: -15px">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="navbar-collapse collapse menu-for-profile">
        <ul class="nav navbar-nav">
            <li {{ Request::is('my-profile*') ? 'class=active' : '' }}><a href="{{ route('my.profile', ['slug' => str_slug(Auth::user()->name), 'id'=>Auth::id()]) }}"><i class="fa fa-user" aria-hidden="true"></i> Thông tin cá nhân</a></li>
            <li {{ Request::is('list-order*') ? 'class=active' : '' }}><a href="{{ route('my.listOrder') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> Đơn đặt hàng</a></li>
            <li {{ Request::is('my-wishlist') ? 'class=active' : '' }}><a href="{{ route('wishlist') }}"><i class="fa fa-heart-o" aria-hidden="true"></i> Yêu thích</a></li>
        </ul>
    </div>
</div>
<div class="col-sm-3 right" style="margin-left: 15px;">
    <div class="shopping-item">
        <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>&nbsp&nbsp<span class="cart-amunt">{{ Cart::subtotal(0) }} ₫</span> <span class="product-count">{{ Cart::count() }}</span></a>
    </div>
</div>