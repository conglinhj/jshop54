@extends('frontend.master')
@section('title','Shop')
@section('menu-area')
    @include('frontend.includes.menu-area-for-shop')
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">

            <div class="filter-product row">
                <form method="GET" id="filter-form" data-url="{{ route('shop') }}" class="form-inline">
                    <div class="row">
                        <div class="col-md-1 left">
                            <label style="color: darkred;margin-top: 5px">Tìm theo: </label>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="select-trademark"> Hãng </label>
                                <select id="select-trademark" name="trademark" class="form-control">
                                    <option value="0">Tất cả</option>
                                    @foreach($trademarks as $trademark)
                                        <option value="{{ $trademark['id'] }}" {{ (Request::fullUrl() == Request::url().'?trademark='.$trademark['id']) ? 'selected':'' }} >{{ $trademark['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="select-price">&nbsp&nbsp&nbsp Mức giá</label>
                                <select name="price" id="select-price" class="form-control">
                                    <option value="0" {{ (Request::fullUrl() == Request::url().'?price=0') ? 'selected':'' }}> Tất cả </option>
                                    <option value="1" {{ (Request::fullUrl() == Request::url().'?price=1') ? 'selected':'' }}> < 10 triệu </option>
                                    <option value="2" {{ (Request::fullUrl() == Request::url().'?price=2') ? 'selected':'' }}> 10 - 15 triệu </option>
                                    <option value="3" {{ (Request::fullUrl() == Request::url().'?price=3') ? 'selected':'' }}> 16 - 20 triệu </option>
                                    <option value="4" {{ (Request::fullUrl() == Request::url().'?price=4') ? 'selected':'' }}> > 20 triệu </option>
                                </select>
                            </div>

                            <div class="form-group">

                            </div>

                        </div>

                        <div class="col-md-2 right" style="text-align: right;">
                            @if(Request::is('shop*'))
                                <label style="color: darkred;margin-top: 6px">{{ count($products) }} sản phẩm.</label>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

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
                                <div class="col-md-12 info-specs-product">
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
            <div class="col-md-12">
                <div class="text-center">
                    <a href="#">Show more <i class="fa fa-sort-desc"></i></a>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script_content')
<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var filter_form = $('#filter-form');
        var data_filter_form = filter_form.serialize();

        /*loc theo hang san xuat*/
        var select_trademark = $('#select-trademark');
        select_trademark.on('change', function () {
            $.ajax({
                type : 'GET',
                url : filter_form.data('url'),
                data : data_filter_form,
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.href = 'http://localhost/jshop54/public/shop?trademark='+select_trademark.val();
                    select_trademark.val(2).prop('selected', true);
                },
                error : function () {

                }
            });
        });

        /* loc theo gia */
        var select_price = $('#select-price');
        select_price.on('change', function () {
            var value = select_price.val();
            $.ajax({
                type : 'GET',
                url : filter_form.data('url'),
                data : data_filter_form,
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.href = 'http://localhost/jshop54/public/shop?price='+value;
                },
                error : function () {

                }
            });
        });

        /*wishlist*/
        $('.view-details-link').on('click', function () {
            $.ajax({
                type : 'POST',
                url : $(this).data('url'),
                data : {
                    proId : $(this).attr('data-proId')
                },
                success : function () {
                    $('.message-block').show();
                    $('.message-block').fadeOut(3000);
                },
                error : function (message) {
                    console.log(message);
                }
            });
        });

    })
</script>
@endpush