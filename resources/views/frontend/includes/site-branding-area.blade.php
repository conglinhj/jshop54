<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="{{ asset('img/logo.png') }}"></a></h1>
                </div>
            </div>

            @if(Cart::count() != 0)
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="{{ route('cart') }}">Cart - <span class="cart-amunt">{{ Cart::subtotal(0) }}₫</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">{{ Cart::count() }}</span></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div> <!-- End site branding area -->

