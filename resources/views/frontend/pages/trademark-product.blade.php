@extends('frontend.master')

@section('content')
    {{--<div style="background-color: #00ACEE; margin-top: 20px;">--}}
    {{--<div class="container" >--}}
    {{--<form method="GET">--}}
    {{--<select id="select-trademark" name="" data-url="">--}}
    {{--<option value="0">Tìm theo hãng</option>--}}
    {{--@foreach($trademarks as $trademark)--}}
    {{--<option value="{{ $trademark['id'] }}">{{ $trademark['name'] }}</option>--}}
    {{--@endforeach--}}
    {{--</select>--}}

    {{--<select name="" id="">--}}
    {{--<option value="">Tìm theo mức giá</option>--}}
    {{--<option value="">Dưới 10 triệu</option>--}}
    {{--<option value="">10 đến 12 triệu</option>--}}
    {{--<option value="">12 đến 15 triệu</option>--}}
    {{--<option value="">trên 15 triệu</option>--}}
    {{--</select>--}}
    {{--</form>--}}
    {{--@push('script_content')--}}
    {{--<script>--}}
    {{--$(document).ready( function () {--}}

    {{--$.ajaxSetup({--}}
    {{--headers: {--}}
    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--}--}}
    {{--});--}}

    {{--$('#select-trademark').on('change', function () {--}}
    {{--alert($(this).val());--}}
    {{--//                        $.ajax({--}}
    {{--//                            type : 'GET',--}}
    {{--//                            url : ,--}}
    {{--//                        });--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}
    {{--@endpush--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-3" style="padding: 5px;">
                        <div class="single-product box-shadow">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2><a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}">{{ $product['name'] }}</a></h2>
                                    <div class="product-carousel-price">
                                        <ins>{{ number_format($product['price'],0,",",".") }}₫</ins>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="product-f-image">
                                        <a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}"><img src="{{ $product['image'] }}" ></a>
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                                                    {{ $hw_specs }}
                                                    @if($hw_specs != "" &&   $key != (count($hw_specss) -1) ),@endif
                                                @endforeach
                                            </span>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            {{--<div class="product-hover product-hover-custom">--}}
                            {{--<a href="{{ route('cart-add',['id' => $product['id']]) }}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Mua</a>--}}
                            {{--<a href="{{ route('product',['id' => $product['id']]) }}" class="view-details-link"><i class="fa fa-link"></i> Xem chi tiết</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <a href="#">Show more <i class="fa fa-sort-desc"></i></a>
                </div>
            </div>
        </div>
    </div>

@endsection


