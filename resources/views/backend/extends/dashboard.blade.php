@extends('backend.master')
@section('content')
    <div class="row" style="margin-bottom: 390px;">
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a href="{{ route('backend.products.list') }}"><i class="fa fa-laptop fa-5x"></i><br>LAPTOP</a>
        </div>
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a ><i class="glyphicon glyphicon-list-alt fa-5x"></i><br>Orders</a>
        </div>
        <div class="col-lg-3 col-md-3 portlets" style="text-align: center;">
            <a ><i class="fa fa-users fa-5x"></i><br>Customers</a>
        </div>
    </div>

@endsection