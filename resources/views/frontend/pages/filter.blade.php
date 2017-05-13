@extends('frontend.master')

@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="filter-product row">
                <form method="GET" id="filter-form" data-url="{{ route('shop') }}">
                    <label for="select-trademark">Tìm theo hãng</label>
                    <select id="select-trademark" name="trademark">
                        <option value="0">Tất cả</option>
                        @foreach($trademarks as $trademark)
                            <option value="{{ $trademark['id'] }}">{{ $trademark['name'] }}</option>
                        @endforeach
                    </select>

                    <label for="select-price">Tìm theo mức giá</label>
                    <select name="price-filter" id="select-price">
                        <option value="">Tất cả</option>
                        <option value="">Dưới 10 triệu</option>
                        <option value="">10 đến 12 triệu</option>
                        <option value="">12 đến 15 triệu</option>
                        <option value="">trên 15 triệu</option>
                    </select>

                </form>
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

                        $('#select-trademark').on('change', function () {
//                            alert($('#filter-form').data('url'));
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
                                    location.reload();
                                },
                                error : function () {

                                }
                            });
                        })
                    })
                </script>
                @endpush
            </div>

            <div class="row box-list-item">
                @foreach($products as $product)
                    <div class="col-md-3 col-sm-3" style="padding: 0px;">
                        <div class="single-product box-item">
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


