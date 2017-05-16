@extends('frontend.master')
@section('title','Giỏ hàng')
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            @if(Cart::count() == 0)
                                <div style="text-align: center; padding-bottom: 100px;">
                                    <h4>Giỏ hàng chưa có sản phẩm nào...</h4>
                                    <a class="btn btn-default" href="{{  route('home') }}">Tiếp tục mua hàng</a>
                                </div>
                            @else
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-price">Đơn giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Thành tiền</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(Cart::content() as $item)
                                        {{ debug($item) }}
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a data-url="{{ route('cart-remove') }}" data-rowId="{{ $item->rowId }}" class="remove_cart" title="Remove this item" ><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>
                                            <td class="product-thumbnail product-name">
                                                <a>
                                                    {{ $item->name }}<br>
                                                    <img width="200" height="200" alt="poster_1_up" class="shop_thumbnail" src="{{ asset($item->options->img) }}">
                                                </a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{{ number_format($item->price,0,",",".") }} </span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="button" class="qty-button" data-url="{{ route('cart-update') }}" data-rowId="{{ $item->rowId }}" value="-" @if($item->qty == 1) disabled @endif>
                                                    <input type="number" disabled size="1" class="qty" title="Quantity" value="{{ $item->qty }}" min="0" step="1">
                                                    <input type="button" class="qty-button" data-url="{{ route('cart-update') }}" data-rowId="{{ $item->rowId }}" value="+">
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">{{  number_format($item->price*$item->qty) }}₫</span>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="text-align: right; font-size: 18px;"><strong>TỔNG TIỀN</strong></td>
                                        <td>{{ Cart::subtotal(0) }}₫</td>
                                    </tr>
                                    <tr>
                                        <td class="actions" colspan="5">
                                            {{--<div class="coupon">--}}
                                                {{--<label for="coupon_code">Coupon:</label>--}}
                                                {{--<input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">--}}
                                                {{--<input type="submit" value="Apply Coupon" name="apply_coupon" class="button">--}}
                                            {{--</div>--}}
                                            <a href="{{ route('checkout') }}" class="btn btn-danger">Tiến hành thanh toán</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif

                            <div class="cart-collaterals">


                                <div class="cross-sells">
                                    <h2>You may be interested in...</h2>
                                    <ul class="products">
                                        <li class="product">
                                            <a href="single-product.html">
                                                <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-2.jpg">
                                                <h3>Ship Your Idea</h3>
                                                <span class="price"><span class="amount">£20.00</span></span>
                                            </a>

                                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                                        </li>

                                        <li class="product">
                                            <a href="single-product.html">
                                                <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-4.jpg">
                                                <h3>Ship Your Idea</h3>
                                                <span class="price"><span class="amount">£20.00</span></span>
                                            </a>

                                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                                        </li>
                                    </ul>
                                </div>


                                {{--<div class="cart_totals ">--}}
                                    {{--<h2>Cart Totals</h2>--}}

                                    {{--<table cellspacing="0">--}}
                                        {{--<tbody>--}}
                                        {{--<tr class="cart-subtotal">--}}
                                            {{--<th>Cart Subtotal</th>--}}
                                            {{--<td><span class="amount">£15.00</span></td>--}}
                                        {{--</tr>--}}

                                        {{--<tr class="shipping">--}}
                                            {{--<th>Shipping and Handling</th>--}}
                                            {{--<td>Free Shipping</td>--}}
                                        {{--</tr>--}}

                                        {{--<tr class="order-total">--}}
                                            {{--<th>Order Total</th>--}}
                                            {{--<td><strong><span class="amount">£15.00</span></strong> </td>--}}
                                        {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}

                                {{--<form method="post" action="#" class="shipping_calculator">--}}
                                    {{--<h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Calculate Shipping</a></h2>--}}

                                    {{--<section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse">--}}

                                        {{--<p class="form-row form-row-wide">--}}
                                            {{--<select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_country" name="calc_shipping_country">--}}
                                                {{--<option value="">Select a country…</option>--}}
                                                {{--<option value="AX">Åland Islands</option>--}}
                                            {{--</select>--}}
                                        {{--</p>--}}

                                        {{--<p class="form-row form-row-wide"><input type="text" id="calc_shipping_state" name="calc_shipping_state" placeholder="State / county" value="" class="input-text"> </p>--}}

                                        {{--<p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>--}}


                                        {{--<p><button class="button" value="1" name="calc_shipping" type="submit">Update Totals</button></p>--}}

                                    {{--</section>--}}
                                {{--</form>--}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('script_content')
<script>
    $(document).ready(function () {

        $('.qty-button').on('click', function () {
            var btn;
            if ($(this).val() == '-') {
                btn = $(this).next().val();
            } else if ($(this).val() == '+') {
                btn = $(this).prev().val();
            }
            $.ajax({
                type: 'GET',
                url: $(this).attr('data-url'),
                data: {
                    id: $(this).attr('data-rowId'),
                    cal: $(this).val(),
                    qty: btn
                },
                success: function () {
                    $('.loading-block').show();
                    location.reload();
                },
                error: function (exception) {
                    alert('Exception:' + exception);
                }
            });
        });

        $('.remove_cart').on('click', function () {
            $.ajax({
                type : 'GET',
                url : $(this).attr('data-url'),
                data : {
                    row_id : $(this).attr('data-rowId')
                },
                success:function () {
                    $('.loading-block').show();
                    location.reload();
                },
                error:function(exception){alert('Exception:'+exception);}
            });
        });

    });
</script>
@endpush