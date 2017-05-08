@extends('backend.master')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='icon-info-circled-2'></i> Details Trademarks</h1>
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
        <div class="col-md-8">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.trademarks.list') }}"><i class="icon-back"></i>back to list</a></h2>
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
                                    <a href="{{ route('backend.trademarks.showEditForm',['id' => $details_trademark['id']]) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger"
                                       onclick="event.preventDefault();document.getElementById('trademark_form_delete').submit();" >
                                        <i class="fa fa-trash-o"></i> Delete</a>
                                    <form id="trademark_form_delete" action="{{ route('backend.trademarks.destroy') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $details_trademark['id'] }}" name="trademark_id">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Trademark Name</td>
                                    <td><strong>{{ $details_trademark['name'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td><img src="{{ asset($details_trademark['brand']) }}"></td>
                                </tr>
                                <tr>
                                    <td>created at</td>
                                    <td>{{ $details_trademark['created_at'] }}</td>
                                </tr>
                                <tr>
                                    <td>updated at</td>
                                    <td>{{ $details_trademark['updated_at'] }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection
