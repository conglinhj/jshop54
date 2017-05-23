@extends('backend.master')
@section('title_admin',$order_detail['id'])
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h3><a href="{{ route('backend.order.list') }}"><i class="icon-back"></i>back to list</a></h3>
    </div>

    <!-- Page Heading End-->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Thông tin :</strong></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                {{--<div class="toolbar-btn-action">--}}
                                    {{--<a href="{{ route('backend.products.showEditForm',['id' => $order_detail['id'] ]) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>--}}
                                    {{--<a class="btn btn-danger"--}}
                                       {{--onclick="event.preventDefault();document.getElementById('product_form_delete').submit();" >--}}
                                        {{--<i class="fa fa-trash-o"></i> Delete</a>--}}
                                    {{--<form id="product_form_delete" action="{{ route('backend.products.destroy') }}" method="post" style="display: none;">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--<input type="hidden" value="{{ $order_detail['id'] }}" name="product_id">--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="col-md-8 col-md-offset-2">
                            <h3>Đơn hàng này
                                @if($order_detail->status ==0)đang chờ xử lý.
                                @elseif($order_detail->status ==1)đã được duyệt
                                @elseif($order_detail->status ==2)đã bị hủy
                                @endif
                            </h3>
                            <table class="my-order-table table table-bordered">
                                <tr>
                                    <td class="text-right" width="150">Mã đơn hàng </td>
                                    <td>{{ $order_detail->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Người nhận </td>
                                    <td>{{ $order_detail->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Số điện thoại </td>
                                    <td>{{ $order_detail->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Địa chỉ giao hàng </td>
                                    <td>{{ $order_detail->address.', '.$order_detail->township->name.', '.$order_detail->county->name.', '.$order_detail->city->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right">Ngày đặt hàng </td>
                                    <td>{{ $order_detail->created_at }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 50px">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>số lượng</th>
                                    <th>giá</th>
                                    <th>giảm giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_detail->product as $key => $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->pivot->quantity }}</td>
                                        <td>{{ number_format($item->pivot->price,0,",",".") }}₫</td>
                                        <td>{{ $item->pivot->discount }}</td>
                                    </tr>
                                @endforeach
                                <tr class="success">
                                    <td colspan="3">Tổng tiền</td>
                                    <td>{{ number_format($item->pivot->price*$item->pivot->quantity,0,",",".")}}₫</td>
                                </tr>
                                </tbody>
                                <tr>
                                    <td>
                                        @if( $order_detail['status'] == 0)
                                            <div class="btn-group">
                                                <a data-url="{{ route('backend.order.changeStatus') }}" data-orderId="{{ $order_detail['id'] }}" data-status="1" title="Duyệt đơn hàng {{ $order_detail['id'] }}" class="btn btn-success handling-order">Duyệt đơn hàng</a>
                                            </div>
                                            <div class="btn-group">
                                                <a data-url="{{ route('backend.order.changeStatus') }}" data-orderId="{{ $order_detail['id'] }}" data-status="2" title="Hủy đơn hàng {{ $order_detail['id'] }} " class="btn btn-danger handling-order">Hủy đơn hàng</a>
                                            </div>
                                        @else
                                        @endif
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
<script>
    $(document).ready( function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Xử lý đơn hàng

        $('.handling-order').on('click', function () {
            $.ajax({
                type : 'POST',
                url : $(this).data('url'),
                data : {
                    id : $(this).attr('data-orderId'),
                    status : $(this).attr('data-status')
                },
                success : function () {
                    location.reload();
                },
                error : function (error) {
                    console.log(error);
                }
            });

        });

    })
</script>
@endpush