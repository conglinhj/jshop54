@extends('frontend.master')
@section('title', 'Thanh toán ')
@section('menu-area')
    @include('frontend.includes.menu-area-for-shop')
@endsection
@section('content')
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <form enctype="multipart/form-data" action="{{ route('checkout.store') }}" class="checkout" method="post">
                {{ csrf_field() }}
                <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                <div class="col-md-5">
                    <div class="product-content-right">
                        <h3 class="order_review_heading">Địa chỉ giao hàng của quý khách</h3>
                        <div class="woocommerce">
                            <div class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">
                                        <div id="billing_first_name_field" class="form-group {{ $errors->has('customer_name') ? ' has-error' : '' }}">
                                            <label  class="control-label" for="billing_first_name">Họ tên người nhận<abbr title="required" class="required">*</abbr></label>
                                            <input type="text" value="{{ old('customer_name') }}" class="form-control input-text"  placeholder="" id="billing_first_name" name="customer_name" required>
                                            @if ($errors->has('customer_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('customer_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="billing_city_field" class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                            <label class="control-label" for="billing_country">Tỉnh/Thành phố<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select data-url="{{ route('selectCity') }}" class="form-control" id="billing_city" name="city_id">
                                                <option value="0">Chọn Tỉnh/Thành phố</option>
                                                @foreach( $cities as $city)
                                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="billing_county_field" class="form-group {{ $errors->has('county_id') ? ' has-error' : '' }}">
                                            <label class="control-label" for="billing_country">Quận/Huyện<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select data-url="{{ route('selectCounty') }}" class="form-control" id="billing_county" name="county_id">
                                                <option value="0">Chọn Quận/Huyện</option>
                                            </select>
                                            @if ($errors->has('county_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('county_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="billing_township_field" class="form-group {{ $errors->has('township_id') ? ' has-error' : '' }}">
                                            <label class="control-label" for="billing_country">Phường, xã<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <select class="form-control" id="billing_township" name="township_id">
                                                <option value="0">Chọn Phường, xã</option>
                                            </select>
                                            @if ($errors->has('township_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('township_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="billing_address_1_field" class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                            <label class="control-label" for="billing_address_1">Địa chỉ nhà<abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" value="{{ old('address') }}" placeholder="tên đường, số nhà..." id="billing_address_1" name="address" class="form-control input-text" required>
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="billing_phone_field" class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label class="control-label" for="billing_phone">Số điện thoại <abbr title="required" class="required">*</abbr>
                                            </label>
                                            <input type="text" placeholder="số điện thoại" id="billing_phone" name="phone" class="form-control input-text " required>
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div id="order_comments_field" class="form-group">
                                            <label class="control-label" for="order_comments">Ghi chú <abbr title="required" class="required">*</abbr></label>
                                            <textarea cols="10" rows="2" placeholder="" id="order_comments" class="input-text " name="note" style="width: 100%">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
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
                                <input type="hidden" name="product_id[]" value="{{ $item->id }}">
                                <td class="product-total">
                                    <input type="hidden" name="price[]" value="{{ $item->price }}">
                                    <input type="hidden" name="qty[]" value="{{ $item->qty }}">
                                    <span class="amount">{{  number_format($item->price*$item->qty) }}₫</span>
                                </td>
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
                            <tr>
                                <td colspan="2"><a href="{{route('cart')}}" class="btn btn-primary">Cập nhật giỏ hàng</a></td>
                            </tr>
                        </tfoot>
                    </table>
                        <div id="payment">
                        <ul class="payment_methods methods">
                            <li class="payment_method_bacs">
                                <input type="radio" data-order_button_text=""  value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                <label for="payment_method_bacs">Thanh toán bằng dịch vụ Internet Banking </label>
                                <div class="payment_box payment_method_bacs">
                                    <p>Đảm bảo tài khoản ngân hàng của bạn đã đăng ký dịch vụ Internet Banking.</p>
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
                            <li class="payment_method_cheque">
                                <input type="radio" data-order_button_text="" checked="checked" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                <label for="payment_method_cheque">Thanh toán khi nhận hàng (COD)</label>
                            </li>
                        </ul>
                        <div class="form-row place-order">
                            <button type="submit" id="place_order" class="btn btn-danger btn-lg">Đặt hàng</button>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script_content')
    <script src="{{ asset('frontend_assets/js/ajax/hanhchinhVN.js') }}"></script>
    <script>
        $(document).ready( function (e) {

        })
    </script>
@endpush