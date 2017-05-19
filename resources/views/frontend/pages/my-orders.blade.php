@extends('frontend.master')
@section('title',Auth::user()->name)
@section('menu-area')
    @include('frontend.includes.menu-area-for-profile')
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <h2>Danh sách đơn hàng của bạn</h2>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10%">Mã đơn hàng</th>
                            <th style="width: 20%">Người nhận</th>
                            <th>Phone</th>
                            <th style="width: 40%">Địa chỉ</th>
                            <th>Ngày tạo</th>
                            <th style="width: 6%">Chi tiết</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{ $order->address.', '.$order->township->name.', '.$order->county->name.', '.$order->city->name }}</td>
                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                <td><a href="{{ route('my.order',['id' =>$order->id]) }}">xem <i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
