@extends('backend.master')

@push('meta_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='icon-info-circled-2'></i> Details Hardware</h1>
        @if(session('updated_message'))
            <div class="alert alert-info alert-dismissable col-md-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('updated_message') }}
            </div>
        @elseif(session('created_message'))
            <div class="alert alert-success alert-dismissable col-md-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('created_message') }}
            </div>
        @endif
    </div>
    <!-- Page Heading End-->
    <div class="row">
        <div class="col-md-7">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.hardware.list') }}"><i class="icon-back"></i>back to list</a></h2>
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
                                    <a href="{{ route('backend.hardware.showEditForm',['id' => $details_hardware['id']]) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger"
                                       onclick="event.preventDefault();document.getElementById('hardware_form_delete').submit();" >
                                        <i class="fa fa-trash-o"></i> Delete</a>
                                    <form id="hardware_form_delete" action="{{ route('backend.hardware.destroy') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $details_hardware['id'] }}" name="hardware_id">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <td>Tên phần cứng</td>
                                <td><strong>{{ $details_hardware['name'] }}</strong></td>
                            </tr>
                            <tr>
                                <td>Ngày tạo</td>
                                <td>{{ $details_hardware['created_at'] }}</td>
                            </tr>
                            <tr>
                                <td>Ngày cập nhật</td>
                                <td>{{ $details_hardware['updated_at'] }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Thông số kỹ thuật</strong></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th data-sortable="true">Tên</th>
                                <th data-sortable="false">Hiển thị</th>
                                <th data-sortable="false">Nổi bật</th>
                                <th data-sortable="false">Cập nhật</th>
                            </tr>
                            </thead>

                            <tbody id="box-content">
                            @foreach($specs_list as $key => $specs)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="specs-name-block" style="width: 33%">
                                        <p>{{ $specs['name'] }}</p>
                                        <div class="specs-name-input form-inline" style="display: none;">
                                            <input type="text" class="form-control" name="specs_name" value="{{ $specs['name'] }}">
                                            <a data-url="{{ route('backend.specs.update') }}" data-specsId="{{ $specs['id'] }}" class="btn-sm btn-success specs-submit-button"  data-toggle="tooltip"  title="Nhấp để sửa">Submit</a>
                                        </div>
                                    </td>
                                    <td><input data-specsId="{{ $specs['id'] }}" data-url="{{route('backend.specs.changeStatus')}}" name="status" type="checkbox" class="ios-switch ios-switch-primary ios-switch-sm" @if($specs['status'] == 1 ) checked @endif /></td>
                                    <td><input data-specsId="{{ $specs['id'] }}" data-url="{{route('backend.specs.changeSpotlight')}}" name="spotlight" type="checkbox" class="ios-switch ios-switch-danger ios-switch-sm" @if($specs['spotlight'] == 1 ) checked @endif /></td>
                                    <td style="width: 20%">
                                        <div class="btn-group btn-group-sm">
                                            {{--<a href="{{ route('backend.specs.viewDetails',['id' => $specs['id'] ]) }}" data-toggle="tooltip" title="View details" class="btn btn-default"><i class="fa fa-eye"></i></a>--}}
                                            <a class="btn btn-success editspecs-button" data-toggle="tooltip" title="Cập nhật {{ $specs['name'] }}"> <i class="fa fa-edit"></i></a>
                                            <a data-url="{{ route('backend.specs.destroy') }}" data-specsId="{{ $specs['id'] }}" class="btn btn-danger deletespecs-button" data-toggle="tooltip" title="Xóa {{ $specs['name'] }}"> <i class="fa fa-remove"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div id="basic-form">
                        <form id="specs_form" method="post" role="form" style="display: none;">
                            {{ csrf_field() }}
                            <div id="specs-block" class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" id="input-text" placeholder="Tên thông số">
                                <input type="hidden" name="hardware_id" value="{{ $details_hardware['id'] }}">
                                <small id="specs-message" class="help-block"></small>
                            </div>
                            <div class="form-group">
                                <a data-url="{{ route('backend.specs.store') }}" id="submit-button" class="btn btn-success">Submit</a>
                            </div>
                        </form>
                        <div class="form-group col-md-12">
                            <a id="new-specs-input" class="btn btn-default" title="thêm mới thông số kỹ thuật">+ Thêm mới</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
<script src="{{ asset('backend_assets/js/ajax/hardwareView.js') }}" ></script>
@endpush