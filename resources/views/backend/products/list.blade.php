@extends('backend.master')
@section('title_admin','Product')
@push('meta_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-table'></i> List Products</h1>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select data-url="{{ route('backend.products.list') }}" id="type-list" class="form-control">
                                        <option value="0" selected>Tất cả</option>
                                        <option value="1" >Active</option>
                                        <option value="2" >Deactivated</option>
                                        {{--<option value="3" >Deleted</option>--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="toolbar-btn-action">
                                    <a href="{{ route('backend.products.showCreateForm') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                                </div>
                            </div>
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
                                <th>No</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Trademark</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th data-sortable="false">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list_products as $key => $product)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img width="50" src="{{ asset($product['image']) }}"></td>
                                <td><strong>{{ $product['name'] }}</strong></td>
                                <td>{{ $product->trademark['name'] }}</td>
                                <td>{{ $product->category['name'] }}</td>
                                <td>{{ number_format($product['price'],0,",",".") }} VND</td>
                                <td style="width: 10%;">
                                    <div class="status-block">
                                        <input data-proId="{{ $product['id'] }}" data-url="{{route('backend.products.changeStatus')}}" name="status" type="checkbox" class="ios-switch ios-switch-primary ios-switch-sm" @if($product['status'] == 1 ) checked @endif /><br>
                                        @if( $product['status'] == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-warning">Deactivated</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        {{--<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>--}}
                                        <a href="{{ route('backend.products.view',['id' => $product['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $list_products->links() }}
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

        //change list
        $('#type-list').on('change', function () {
            var type_list = $(this).val();
            $.ajax({
                type : 'GET',
                url : $(this).data('url'),
                data : {
                    type : type_list
                },
                dataType : 'text',
                beforeSend : function () {
                    $('.loading-block').show();
                },
                complete : function () {
                    $('.loading-block').hide();
                },
                success : function () {
                    location.reload();
                }
            });
        })
    })
</script>
@endpush