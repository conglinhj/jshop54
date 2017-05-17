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
            <div class="col-md-10 col-md-offset-1">
                <div class="product-content-right">
                    <div class="woocommerce">
                        {{$user->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
