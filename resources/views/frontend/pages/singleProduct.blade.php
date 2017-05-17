@extends('frontend.master')
@section('title',$product_details['name'])
@section('menu-area')
    @include('frontend.includes.menu-area-for-shop')
@endsection
@section('content')

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="product-content-right">

                    <div class="product-breadcroumb">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('trademark', [ 'trademark_slug' => str_slug( $product_details->trademark['name'] ), 'trademark_id' => $product_details->trademark['id']]) }}">{{ $product_details->trademark['name'] }}</a>
                        <span>{{ $product_details['name'] }}</span>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="{{ asset($product_details['image']) }}" alt="">
                                    </div>

                                    <div class="product-gallery">
                                        <img src="{{ asset('img/product-thumb-1.jpg') }}" alt="">
                                        <img src="{{ asset('img/product-thumb-2.jpg') }}" alt="">
                                        <img src="{{ asset('img/product-thumb-3.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h2 class="product-name">{{ $product_details['name'] }}</h2>
                                <div class="product-inner-price">
                                    <ins>{{ number_format($product_details['price'],0,",",".") }}₫</ins>
                                </div>
                                <a href="{{ route('cart-add',['id' => $product_details['id']]) }}" class="add_to_cart_button" type="submit">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="intro-block col-md-7" style="overflow: hidden">
                                <p>{!! $product_details['intro'] !!}</p>
                            </div>
                            <div class="col-md-5">
                                <div class="product-inner">
                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#specs" aria-controls="home" role="tab" data-toggle="tab">Thông số kỹ thuật</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Bình luận & Đánh giá</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="specs">
                                                @foreach($hardwares as $hardware)

                                                    <div >
                                                        <div class="table-responsive">
                                                            <table  class="table table">
                                                                <tr class="active"><td style="padding-bottom: 0;" colspan="2"><h4>{{ $hardware['name'] }}</h4></td></tr>
                                                                @foreach($product_details->specs as $detail)
                                                                    @if($hardware['id'] == $detail['hardware_id'])
                                                                        <tr>
                                                                            <td style="width: 40%"><p> {{ $detail['name'] }}</p></td>
                                                                            <td><p> @php echo ( $detail->pivot['value'] != null ? $detail->pivot['value'] : "Chưa cập nhật") @endphp</p></td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Tên</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Đánh giá của bạn</p>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="product-carousel">
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-1.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony Smart TV - 2015</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$700.00</ins> <del>$100.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-2.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Apple new mac book 2015 March :P</a></h2>
                                    <div class="product-carousel-price">
                                        <ins>$899.00</ins> <del>$999.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-3.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Apple new i phone 6</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$400.00</ins> <del>$425.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-4.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony playstation microsoft</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$200.00</ins> <del>$225.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-5.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Sony Smart Air Condtion</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$1200.00</ins> <del>$1355.00</del>
                                    </div>
                                </div>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset('img/product-6.jpg') }}" alt="">
                                        <div class="product-hover">
                                            <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="">Samsung gallaxy note 4</a></h2>

                                    <div class="product-carousel-price">
                                        <ins>$400.00</ins>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection