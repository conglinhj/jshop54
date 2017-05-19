@extends('frontend.master')
@section('title','Hóa đơn')
@section('menu-area')
    @include('frontend.includes.menu-area-for-profile')
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-content-right">
                        <div class="woocommerce">

                            <div class="col-md-8 col-md-offset-2">
                                <h3>Đơn hàng của bạn đang được xử lý.</h3>
                                <table class="my-order-table table table-bordered">
                                    <tr>
                                        <td class="text-right" width="150">Mã đơn hàng </td>
                                        <td>{{ $order_detail->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Người nhận </td>
                                        <td>{{ $order_detail->customer_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Số điện thoại </td>
                                        <td>{{ $order_detail->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Địa chỉ giao hàng </td>
                                        <td>{{ $order_detail->address.', '.$order_detail->township->name.', '.$order_detail->county->name.', '.$order_detail->city->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Ngày đặt hàng </td>
                                        <td>{{ $order_detail->created_at }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>số lượng</th>
                                        <th>giá</th>
                                        <th>giảm giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_detail->product as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->pivot->quantity }}</td>
                                            <td>{{ number_format($item->pivot->price,0,",",".") }}₫</td>
                                            <td>{{ $item->pivot->discount }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="success">
                                        <td colspan="3">Tổng tiền</td>
                                        <td>{{ number_format($item->pivot->price*$item->pivot->quantity,0,",",".")}}₫</td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
