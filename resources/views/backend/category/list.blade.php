@extends('backend.master')
@section('title_admin','List Categories')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-table'></i> List Category</h1>
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
                                <form role="form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                </form>
                            </div>
                            <div class="col-md-8">
                                <div class="toolbar-btn-action">
                                    <a href="{{ route('backend.category.showCreateForm') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add new</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 30px" data-sortable="false"><input type="checkbox" class="rows-check"></th>
                                <th>Name</th>
                                <th data-sortable="false">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($list_category as $key => $category)
                                <tr>
                                    <td>{{ $key+1 }}</td><td><input type="checkbox" class="rows-check"></td>
                                    <td>{{ $category['name'] }}</td>
                                    <td>
                                        <div class="btn-group btn-group-xs">
                                            {{--<a data-toggle="tooltip" title="Off" class="btn btn-default"><i class="fa fa-power-off"></i></a>--}}
                                            <a href="{{ route('backend.category.viewDetails',['id' => $category['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="data-table-toolbar">
                        {{ $list_category->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection