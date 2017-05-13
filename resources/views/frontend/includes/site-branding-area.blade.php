<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <div class="logo">
                    <h1><a href="./"><img src="{{ asset('img/logo.png') }}"></a></h1>
                </div>
            </div>
            <div class="col-sm-7 search-block">
                <form action="{{ route('product.search' ) }}" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="key_search" placeholder="Tên sản phẩm bạn muốn tìm..." style="font-size: 14px; font-family: Roboto Condensed,sans-serif;" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>

            <div class="col-sm-3">
                <div class="shopping-item">
                    <a href="{{ route('cart') }}">Cart - <span class="cart-amunt">{{ Cart::subtotal(0) }}₫</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{ Cart::count() }}</span></a>
                </div>
            </div>

        </div>
    </div>
</div> <!-- End site branding area -->

