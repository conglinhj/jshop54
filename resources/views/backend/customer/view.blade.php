@extends('backend.master')
@section('title_admin',$detail_user['name'])
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h3><a href="{{ route('backend.customer.list') }}"><i class="icon-back"></i>back to list</a></h3>
    </div>
    @if(session('updated_message'))
        <div class="alert alert-info alert-dismissable col-md-8 col-md-offset-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('updated_message') }}
        </div>
    @elseif(session('created_message'))
        <div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('created_message') }}
        </div>
    @endif
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
                                <div class="toolbar-btn-action">
                                    <a class="btn btn-danger"
                                       onclick="event.preventDefault();document.getElementById('product_form_delete').submit();" >
                                        <i class="fa fa-trash-o"></i> Delete</a>
                                    <form id="product_form_delete" action="{{ route('backend.customer.destroy') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $detail_user['id'] }}" name="product_id">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <td style="width: 20%">Tên</td>
                                <td>
                                    <p>{{$detail_user->name}}</p>
                                    @if($detail_user->avatar)
                                        <div style="max-height: 100px;overflow: hidden">
                                            <a href="https://www.facebook.com/app_scoped_user_id/{{$detail_user->facebook_id}}">
                                                <img src="{{ asset($detail_user->avatar) }}" alt="avatar">
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>E-mail</td>
                                <td><span>{{$detail_user->email}}</span></td>
                            </tr>
                            <tr>
                                <td>Giới tính</td>
                                <td> {{ $detail_user->render  }}</td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>{{$detail_user->phone}}</td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>@if($detail_user->city != null) {{ $detail_user->address.', '.$detail_user->township->name.', '.$detail_user->county->name.', '.$detail_user->city->name}}@else <i>trống</i> @endif</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="widget">
                @if(count($detail_user->order) == 0 )
                    <h3>{{$detail_user->name}} Chưa có đơn hàng nào</h3>
                @else
                    <h3>Danh sách đơn hàng của {{$detail_user->name}}</h3>
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th style="width: 15%">Người nhận</th>
                            <th>sđt người nhận</th>
                            <th style="width: 33%">Địa chỉ giao hàng</th>
                            <th style="width: 11%">Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th style="width: 6%">Chi tiết</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detail_user->order as $key => $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{ $order->address.', '.$order->township->name.', '.$order->county->name.', '.$order->city->name }}</td>
                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                <td>{{$order->status==0 ? 'Đang chờ xử lý' : $order->status==1 ?'Đã được duyệt' : 'Đã bị hủy' }}</td>
                                <td><a href="{{ route('backend.order.view',['id' =>$order->id]) }}">xem <i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
<script>
    $(document).ready(function () {
        $showmore = $('#show_more');
        $showmore.on('click', function () {
            if ($showmore.text() === 'Show more...'){
                $('.introduction').css('height', 'auto');
                $showmore.text('hide...');
            } else if ($showmore.text() === 'hide...'){
                $('.introduction').css('height', '200px');
                $showmore.text('Show more...');
            }
        });
    });
</script>
@endpush