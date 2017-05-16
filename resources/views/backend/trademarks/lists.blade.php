@extends('backend.master')
@section('title_admin','Trademark')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-list'></i> List Trademarks</h1>
        @if(session('trademark_deleted'))
            <div class="alert alert-danger alert-dismissable col-md-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('trademark_deleted') }}
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
                    </div>
                </div>
                <div class="widget-content">
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-4">
                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="toolbar-btn-action">
                                    <a href="{{ route('backend.trademarks.showCreateForm') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                                    {{--<a class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a>--}}
                                    {{--<a class="btn btn-primary"><i class="fa fa-refresh"></i> Update</a>--}}
                                </div>
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
                                <th data-sortable="false">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list_trademarks as $value)
                                <tr>
                                    <td>1</td>
                                    <td><img src="{{ asset($value['brand']) }}" alt="{{ $value['brand'] }}"></td>
                                    <td><strong>{{ $value['name'] }}</strong></td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            {{--<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>--}}
                                            <a href="{{ route('backend.trademarks.view',['id' => $value['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $list_trademarks->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection
