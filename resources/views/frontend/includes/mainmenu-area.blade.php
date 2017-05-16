<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-9" style="margin-left: -30px">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li {{ Request::is('smartphone') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-mobile fa-2x" aria-hidden="true"></i> Smart Phone</a></li>
                        <li {{ Request::is('shop') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-laptop fa-2x" aria-hidden="true"></i> Laptop</a></li>
                        <li {{ Request::is('tablet') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-tablet fa-2x" aria-hidden="true"></i> Tablet</a></li>
                        <li {{ Request::is('tablet') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-newspaper-o fa-2x" aria-hidden="true"></i> Tin tức</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3 right" style="margin-left: 30px">
                <div class="shopping-item" style="margin-top: 3px;margin-right: -15px">
                    <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>&nbsp&nbsp<span class="cart-amunt">{{ Cart::subtotal(0) }} ₫</span> <span class="product-count">{{ Cart::count() }}</span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->