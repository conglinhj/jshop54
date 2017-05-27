<div class="col-sm-9" style="margin-left: -15px">
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
            @foreach($categories as $category)
                <li {{ Request::is('category/'.$category->id.'-'.str_slug($category->name)) ? 'class=active' : '' }}>
                    <a href="{{ route('shop.category',['category_id'=>$category->id, 'slug'=>str_slug($category->name)]) }}">
                        @if($category->id==1)
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                        @elseif($category->id==2)
                            <i class="fa fa-mobile" aria-hidden="true"></i>
                        @elseif($category->id==3)
                            <i class="fa fa-tablet" aria-hidden="true"></i>
                        @endif
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            <li {{ Request::is('new') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Tin tức</a></li>
            {{--<li {{ Request::is('sale') ? 'class=active' : '' }}><a href="{{ route('shop') }}"><i class="fa fa-gift" aria-hidden="true"></i> Khuyến mãi</a></li>--}}
        </ul>
    </div>
</div>
<div class="col-sm-3 right" style="margin-left: 15px;">
    <div class="shopping-item">
        <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>&nbsp&nbsp<span class="cart-amunt">{{ Cart::subtotal(0) }} ₫</span> <span class="product-count">{{ Cart::count() }}</span></a>
    </div>
</div>