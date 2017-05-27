@extends('frontend.master')
@section('menu-area')
    @include('frontend.includes.menu-area-for-shop')
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="row box-list-item">
                    @foreach($products as $product)
                        {{--{{ debug($product) }}--}}
                        <div class="col-md-3 col-sm-3" style="padding: 0px;">
                            <div class="single-product box-item">
                                <div class="row">
                                    <div class="col-md-12" style="height: 100px; overflow: hidden">
                                        <h2><a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}">{{ $product['name'] }}</a></h2>
                                        <div class="product-carousel-price">
                                            <ins>{{ number_format($product['price'],0,",",".") }}₫</ins>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="product-f-image">
                                            <a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}"><img  src="{{ asset($product['image']) }}" ></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 info-specs-product" style="height: 150px; overflow: hidden;line-height: 1.3;">
                                        @php
                                            $hw_ar = array();
                                            foreach($product->specs as $specs) {
                                                $hw_ar[$specs->hardware['name']][] =  $specs->pivot['value'];
                                            }
                                        @endphp

                                        @foreach($hw_ar as $hw => $hw_specss)
                                            <p>{{ $hw }} :
                                                <span>
                                                @foreach( $hw_specss as $key => $hw_specs)
                                                        {{ $hw_specs }}@if(trim($hw_specs) != '' &&   $key != (count($hw_specss) -1) ),@endif
                                                    @endforeach
                                            </span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="btn-add-cart">
                                    <a href="{{ route('cart-add',['id' => $product['id']]) }}" class="add-to-cart-link" title="Thêm vào giỏ hàng"><i class="fa fa-shopping-cart fa-2x"></i></a>
                                    @if(Auth::check())
                                        <a class="view-details-link" data-url="{{ route('add-wishlist') }}" data-proId="{{$product['id']}}" title="Yêu thích"><i class="fa fa-heart fa-2x"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <a href="#">Show more <i class="fa fa-sort-desc"></i></a>
                </div>
            </div>
        </div>
    </div>

@endsection


