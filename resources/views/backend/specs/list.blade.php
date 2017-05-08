@extends('backend.master')

@push('meta_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-table'></i> List specs</h1>
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
                <div class="widget-content">
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="toolbar-btn-action">
                                    <a href="{{ route('backend.specs.showCreateForm') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th data-sortable="false">Xem chi tiết</th>
                                <th>Loại phần cứng</th>
                                <th>Tên</th>
                                <th data-sortable="false">Hiển thị</th>
                                <th data-sortable="false">Nổi bật</th>
                            </tr>
                            </thead>

                            <tbody id="box-content">
                            @foreach($list_specs as $key => $specs)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            {{--<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>--}}
                                            <a href="{{ route('backend.specs.viewDetails',['id' => $specs['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ $specs->hardware['name'] }}</td>
                                    <td>{{ $specs['name'] }}</td>
                                    <td><input data-specsId="{{ $specs['id'] }}" data-url="{{route('backend.specs.changeStatus')}}" name="status" type="checkbox" class="ios-switch ios-switch-primary ios-switch-sm" @if($specs['status'] == 1 ) checked @endif /></td>
                                    <td><input data-specsId="{{ $specs['id'] }}" data-url="{{route('backend.specs.changeSpotlight')}}" name="spotlight" type="checkbox" class="ios-switch ios-switch-danger ios-switch-sm" @if($specs['spotlight'] == 1 ) checked @endif /></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $list_specs->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
    <script type="text/javascript">
        $(document).ready(function () {
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
                        specsId : $input_status.attr('data-specsId'),
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

            $("input[name^='spotlight']").on('change', function () {
                $input_spotlight = $(this);
                if ( this.checked ){
                    $spotlight = 1;
                }else {
                    $spotlight = 0;
                }
                $.ajax({
                    type : "POST",
                    url : $input_spotlight.data('url'),
                    data : {
                        specsId : $input_spotlight.attr('data-specsId'),
                        spotlight : $spotlight
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
                    error : function () {
                        console.log('loi : ' + oj);
                    }
                });
            });

        })
    </script>
@endpush