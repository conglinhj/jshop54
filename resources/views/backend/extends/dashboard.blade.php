@extends('backend.master')
@section('title_admin','Administrator')
@section('content')
    <div class="row" style="margin-bottom: 390px;">
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a href="{{ route('backend.products.list') }}"><i class="fa fa-laptop fa-5x"></i><br>Sản phẩm</a>
        </div>
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a href="{{ route('backend.order.list') }}" ><i class="glyphicon glyphicon-list-alt fa-5x"></i><br> Đơn hàng</a>
        </div>
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a href="{{ route('backend.customer.list') }}"><i class="fa fa-users fa-5x"></i><br>Khách hàng</a>
        </div>
    </div>

@endsection