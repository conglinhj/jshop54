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
                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <div class="col-md-12" style="text-align: center">
                                <h4>Những sản phẩm bạn mà yêu thích.</h4>
                                @if(count($products) == 0)
                                    <p>Bạn chưa chưa yêu thích sản phẩm nào, ghé qua cửa hàng của chúng tôi để tìm nhé.</p>
                                    <br><a class="btn btn-default" href="{{  route('home') }}">Trang chủ</a>
                                @endif
                            </div>

                            @foreach($products as $product)
                                <div class="col-md-2 col-sm-2" style="padding: 5px;">
                                    <div class="single-product box-shadow">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="product-f-image">
                                                    <a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}"><img src="{{ asset($product['image']) }}" ></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12" style="height: 100px; overflow: hidden; text-align: center">
                                                <h2 style="margin-top: 0" <a href="{{ route('product',[ 'pro_id' => $product['id'], 'product_slug' => str_slug($product['name']) ]) }}">{{ $product['name'] }}</a></h2>
                                                <div class="product-carousel-price">
                                                    <ins>{{ number_format($product['price'],0,",",".") }}₫</ins>
                                                </div>
                                            </div>
                                            <div class="form-group" style="text-align: center">
                                                <button data-url="{{route('remove-wishlist')}}" data-proId="{{$product['id']}}" class="btn dislike">Bỏ thích</button>
                                                <a href="{{ route('cart-add',['id' => $product['id']]) }}" class="btn btn-primary">Mua</a>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_content')
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /*wishlist*/
        $('.dislike').on('click', function () {
            $.ajax({
                type : 'POST',
                url : $(this).data('url'),
                data : {
                    proId : $(this).attr('data-proId')
                },
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.reload();
                },
                error : function (message) {
                    console.log(message);
                }
            });
        });

    })
</script>
@endpush
