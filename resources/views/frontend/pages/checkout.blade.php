@extends('frontend.master')

@section('content')

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="product-content-right">
                    @if(!Auth::check())
                    <h3 class="order_review_heading">Thông tin vận chuyển</h3>
                    <div class="woocommerce">

                        <div id="login-form-checkout">
                            <p>Đăng nhập trước khi thanh toán</p>
                            @include('frontend.includes.login-form')
                        </div>
                        <div class="woocommerce-info">Have a coupon?
                            <a class="showcoupon" data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Click here to enter your code</a>
                        </div>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">
                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
                            </p>
                            <p class="form-row form-row-last">
                                <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                            </p>
                            <div class="clear"></div>
                        </form>

                    </div>
                    @else
                    <h3 class="order_review_heading">Địa chỉ giao hàng</h3>
                    <div class="woocommerce">
                        <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">

                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">

                                        <div id="billing_first_name_field" class="form-group">
                                            <label  class="control-label" for="billing_first_name">Họ Tên người nhận<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control input-text"  placeholder="" id="billing_first_name" name="billing_first_name">
                                        </div>

                                        <div id="billing_city_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            <label class="" for="billing_country">Tỉnh/Thành phố<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select data-url="{{ route('selectCity') }}" class="country_to_state country_select" id="billing_city" name="billing_city">
                                                <option value="0">Chọn Tỉnh/Thành phố</option>
                                                @foreach( $cities as $city)
                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="billing_county_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            <label class="" for="billing_country">Quận/Huyện<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select data-url="{{ route('selectCounty') }}" class="country_to_state country_select" id="billing_county" name="billing_county">
                                                <option value="0">Chọn Quận/Huyện</option>
                                            </select>
                                        </div>

                                        <div id="billing_township_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            <label class="" for="billing_country">Phường, xã<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select class="country_to_state country_select" id="billing_township" name="billing_township">
                                                <option value="0">Chọn Phường, xã</option>
                                            </select>
                                        </div>

                                        <div id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                            <label class="" for="billing_address_1">Địa chỉ nhà<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="tên đường, số nhà..." id="billing_address_1" name="billing_address_1" class="input-text ">
                                        </div>

                                        <div class="clear"></div>

                                        <div id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                            <label class="" for="billing_email">Email<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_email" name="billing_email" class="input-text ">
                                        </div>

                                        <div id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                            <label class="" for="billing_phone">Số điện thoại <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text ">
                                        </div>
                                        <div class="clear"></div>
                                        <div id="order_comments_field" class="form-row notes">
                                            <label class="" for="order_comments">Ghi chú</label>
                                            <textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea>
                                        </div>


                                        {{--<div class="create-account">--}}
                                            {{--<p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>--}}
                                            {{--<p id="account_password_field" class="form-row validate-required">--}}
                                                {{--<label class="" for="account_password">Account password <abbr title="required" class="required">*</abbr>--}}
                                                {{--</label>--}}
                                                {{--<input type="password" value="" placeholder="Password" id="account_password" name="account_password" class="input-text">--}}
                                            {{--</p>--}}
                                            {{--<div class="clear"></div>--}}
                                        {{--</div>--}}

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    @endif

                </div>
            </div>

            <div class="col-md-6">
                <h3 class="order_review_heading">Thông tin đơn hàng</h3>

                <div id="order_review" style="position: relative;">
                    <table class="shop_table">
                        <thead>
                        <tr>
                            <th class="product-name">Sản phẩm</th>
                            <th class="product-total">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::content() as $item)
                            <tr class="cart_item">
                                <td class="product-name"> {{ $item->name }} <strong class="product-quantity">×{{ $item->qty }}</strong> </td>
                                <td class="product-total">
                                    <span class="amount">{{  number_format($item->price*$item->qty) }}₫</span> </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                        <tr class="cart-subtotal">
                            <th>Tạm tính</th>
                            <td><span class="amount">{{ Cart::subtotal(0) }}₫</span>
                            </td>
                        </tr>

                        <tr class="shipping">
                            <th>Phí vận chuyển</th>
                            <td>

                                Free Shipping
                                <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                            </td>
                        </tr>

                        <tr class="order-total">
                            <th>Tổng tiền thanh toán</th>
                            <td><strong><span class="amount">£15.00</span></strong> </td>
                        </tr>

                        </tfoot>
                    </table>


                    <div id="payment">
                        <ul class="payment_methods methods">
                            <li class="payment_method_bacs">
                                <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                <label for="payment_method_bacs">Direct Bank Transfer </label>
                                <div class="payment_box payment_method_bacs">
                                    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                </div>
                            </li>
                            <li class="payment_method_cheque">
                                <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                <label for="payment_method_cheque">Cheque Payment </label>
                                <div style="display:none;" class="payment_box payment_method_cheque">
                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </li>
                            <li class="payment_method_paypal">
                                <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                </label>
                                <div style="display:none;" class="payment_box payment_method_paypal">
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                </div>
                            </li>
                        </ul>

                        <div class="form-row place-order">

                            <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">


                        </div>

                        <div class="clear"></div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('script_content')
    <script src="{{ asset('frontend_assets/js/ajax/hanhchinhVN.js') }}"></script>
@endpush