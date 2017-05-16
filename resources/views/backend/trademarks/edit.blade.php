@extends('backend.master')
@section('title_admin','Trademark')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-edit'></i> Update Trademark</h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">

        <div class="col-sm-6 portlets">

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.trademarks.list') }}"><i class="icon-back"></i>back to list</a></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div id="basic-form">
                        <form action="{{ route('backend.trademarks.update') }}" method="post" role="form">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="input-text" class="control-label">Name</label>
                                <input type="hidden" value="{{ $details_trademark['id'] }}" name="id">
                                <input value="{{ $details_trademark['name'] }}" type="text" name="name" class="form-control" id="input-text" placeholder="Input text">
                                @if($errors->has('name'))
                                    <small class="help-block">{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                            {{--<div class="fallback">--}}
                            {{--<input name="file" type="file" multiple />--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <img src="{{ $details_trademark['brand'] }}" alt="trademark brand"><br>
                                <input type="file" class="btn btn-default" title="Search for a file to add">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection