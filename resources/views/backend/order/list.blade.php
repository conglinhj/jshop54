@extends('backend.master')
@section('title_admin','Product')
@section('content')

    {{--view detail modal--}}

        <!-- Modal -->
        <div class="modal fade" id="viewDetail" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"> Chi tiết hóa đơn</h4>
                    </div>
                    <div class="modal-body">
                        <table id="form-view-detail" class="my-order-table table table-bordered">
                        </table>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>số lượng</th>
                                <th>giá</th>
                                <th>giảm giá</th>
                            </tr>
                            </thead>
                            <tbody id="list-item-detail">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-table'></i> Danh sách Đơn hàng</h1>
        @if(session('deleted_message'))
            <div class="alert alert-info alert-danger col-md-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('deleted_message') }}
            </div>
        @endif
    </div>
    <!-- Page Heading End-->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div id="list-block" class="widget-content">
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select data-url="{{ route('backend.order.list') }}" data-href="{{Request::url()}}" id="status-list" class="form-control">
                                        <option {{ (Request::fullUrl() == Request::url().'?status=10') ? 'selected':'' }} value="10">Tất cả các đơn hàng</option>
                                        <option {{ (Request::fullUrl() == Request::url().'?status=0') ? 'selected': (Request::fullUrl() == Request::url()) ? 'selected' : '' }} value="0" >Đơn hàng chưa xử lý</option>
                                        <option {{ (Request::fullUrl() == Request::url().'?status=1') ? 'selected':'' }} value="1" >Đơn hàng đã duyệt</option>
                                        <option {{ (Request::fullUrl() == Request::url().'?status=2') ? 'selected':'' }} value="2" >Đơn hàng đã hủy</option>
                                        {{--<option value="3" >Deleted</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form  method="GET"  role="form" class="form-inline">
                                    <input id="date-filter" type="date" name="date" data-href="{{ Request::url() }}" data-url="{{ route('backend.order.list') }}"   class="form-control" placeholder="Chọn ngày để tìm...">
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('backend.order.list') }}" role="form" class="form-inline">
                                    <input type="text" name="order_id" class="form-control" placeholder="Nhập mã đơn hàng cần tìm...">
                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>ngày đặt</th>
                                <th>Trạng thái</th>
                                <th data-sortable="false"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($orders as $key => $order)
                            <tr>
                                <td><strong>{{ $order['id'] }}</strong></td>
                                <td><strong>{{ $order->user['name'] }}</strong></td>
                                <td><strong>{{ $order['created_at'] }}</strong></td>
                                <td style="width: 10%;">
                                    <div class="status-block">
                                        @if( $order['status'] == 1)
                                            <span class="label label-success">Đã duyệt</span>
                                        @elseif($order['status'] == 0)
                                            <span class="label label-warning">Chưa xử lý</span>
                                        @elseif($order['status'] == 2)
                                            <span class="label label-danger">Đã hủy</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a data-url="{{ route('backend.order.view') }}" data-orderId="{{ $order['id'] }}" data-toggle="modal" data-target="#viewDetail" title="Xem chi tiết đơn hàng {{ $order['id'] }}" class="btn btn-primary btn-view-detail">xem chi tiết</a>
                                    </div>
                                    @if( $order['status'] == 0)
                                        <div class="btn-group btn-group-xs">
                                            <a data-url="{{ route('backend.order.changeStatus') }}" data-orderId="{{ $order['id'] }}" data-status="1" title="Duyệt đơn hàng {{ $order['id'] }}" class="btn btn-success handling-order">Duyệt đơn hàng</a>
                                        </div>
                                        <div class="btn-group btn-group-xs">
                                            <a data-url="{{ route('backend.order.changeStatus') }}" data-orderId="{{ $order['id'] }}" data-status="2" title="Hủy đơn hàng {{ $order['id'] }} " class="btn btn-danger handling-order">Hủy đơn hàng</a>
                                        </div>
                                    @else
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js_content')
<script>
    $(document).ready( function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**
         * Xem chi tiết đơn hàng
         */
        var form_detail = $('#form-view-detail');
        var list_item_detail = $('#list-item-detail');
        $('#viewDetail').on('hidden.bs.modal', function (e) {
            form_detail.empty();
            $('#order-subtotal').remove();
            $('.item-detail').remove();
        });

        var view_btn = $('.btn-view-detail');
        view_btn.on('click', function () {
            $.ajax({
                type : 'GET',
                url : $(this).data('url'),
                data : { id : $(this).attr('data-orderId') },
                dataType : 'JSON',
                success : function (order_detail) {

                    var subtotal = 0;

                    $.each(order_detail, function (index, order) {
                        form_detail.append(
                            '<tr><td>Mã hóa đơn</td><td>'+order.id+'</td></tr>'
//                            +'<tr><td>Khách hàng</td><td>'+order.user.name+'</td></tr>'
//                            +'<tr><td>Email khách hàng</td><td>'+order.user.email+'</td></tr>'
                            +'<tr><td>Tên người nhận</td><td>'+order.customer_name+'</td></tr>'
                            +'<tr><td>Số điện thoại người nhận</td><td>'+order.phone+'</td></tr>'
                            +'<tr><td>Địa chỉ</td><td>'+order.address+', '+order.township.name+', '+order.county.name+', '+order.city.name+'</td></tr>'
                            +'<tr><td>Ngày tạo</td><td>'+order.created_at+'</td></tr>'
                        );

                        $.each(order.product, function (i, product) {
                            list_item_detail.append(
                             '<tr class="item-detail">'
                                +'<td>'+product.name+'</td>'
                                +'<td>'+product.pivot.quantity+'</td>'
                                +'<td>'+product.pivot.price+'</td>'
                                +'<td>'+product.pivot.discount+'</td>'
                            +'</tr>'
                            );

                            subtotal += product.pivot.price*product.pivot.quantity;

                        });

                        list_item_detail.append(
                            '<tr id="order-subtotal" class="success">'
                                +'<td colspan="3">Tổng tiền</td>'
                                +'<td>'+subtotal+'₫</td>'
                            +'</tr>'
                        );

                    })
                },
                error : function (message) {
                    console.log(message);
                }
            });
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
                success : function (order) {
                    console.log(order);
                    console.log(order.responseText);
                    location.reload();
                },
                error : function (error) {
                    console.log(error);
                }
            });

        });

        /**
         * Thay đổi danh sách
         */
            //change list
        var type_list = $('#status-list');
        type_list.on('change', function () {
            $.ajax({
                type : 'GET',
                url : $(this).data('url'),
                data : {
                    status : type_list.val()
                },
                dataType : 'text',
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.href = type_list.data('href')+'?status='+type_list.val();
                }
            });
        });

        var date_filter = $('#date-filter');
        date_filter.on('change', function () {
            $.ajax({
                type : 'GET',
                url : $(this).data('url'),
                data : {
                    date : $(this).val()
                },
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.href = date_filter.data('href')+'?date='+date_filter.val();
                }
            });
        })


    })
</script>
@endpush