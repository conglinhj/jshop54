@extends('backend.master')
@section('title_admin','Product')
@push('meta_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-table'></i> Danh sách khách hàng</h1>
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
                    <h2><strong>Toolbar</strong> CRUD Table</h2>
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
                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Avatar</th>
                                <th>Phone</th>
                                <th>Địa chỉ</th>
                                {{--<th>Status</th>--}}
                                <th data-sortable="false">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <td><strong>{{ $user['email'] }}</strong></td>
                                <td><strong>{{ $user['name'] }}</strong></td>
                                <td><div style="overflow: hidden;max-height: 50px" >@if($user['avatar'])<img width="50" src="{{ asset($user['avatar']) }}">@else <i>trống</i>@endif</div></td>
                                <td>@if($user['phone']){{ $user['phone'] }}@else <i>trống</i> @endif</td>
                                <td>@if($user->city != null) {{ $user->city->name  }}@else <i>trống</i> @endif</td>
                                {{--<td style="width: 10%;">--}}
                                    {{--<div class="status-block">--}}
                                        {{--<input data-proId="{{ $user['id'] }}" data-url="{{route('backend.customer.changeStatus')}}" name="status" type="checkbox" class="ios-switch ios-switch-primary ios-switch-sm" @if($user['status'] == 1 ) checked @endif /><br>--}}
                                        {{--@if( $user['status'] == 1)--}}
                                            {{--<span class="label label-success">Active</span>--}}
                                        {{--@else--}}
                                            {{--<span class="label label-warning">Deactivated</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        {{--<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>--}}
                                        <a href="{{ route('backend.customer.view',['id' => $user['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i> xem chi tiết</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('js_content')
<script>
    $(document).ready(function () {

        //change status
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("input[name~='status']").on('change', function () {
            $input_status = $(this);
            if ( this.checked ){
                $status = 1;
            }else {
                $status = 0;
            }
            $.ajax({
                type : "POST",
                url : $input_status.data('url'),
                data : {
                    proId : $input_status.attr('data-proId'),
                    status : $status
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
                error : function (oj) {
                    console.log('loi : ' + oj);
                }
            });
        });


    })
</script>
@endpush