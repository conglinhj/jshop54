@extends('backend.master')
@section('title_admin','Phieu nhap')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-plus-circle'></i> Tạo phiếu nhập</h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">

        <div class="col-sm-12 portlets">

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.hardware.list') }}"><i class="icon-back"></i>back to list</a></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div id="basic-form">
                        <form action="{{ route('backend.hardware.store') }}" method="post" role="form" class="row">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('provider_id') ? ' has-error' : '' }}">
                                    <label for="select-provider" class="control-label">Nhà cung cấp</label>
                                    <select name="provider_id" id="select-provider" class="form-control">
                                        @foreach($list_provider as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('provider_id'))
                                        <small class="help-block">{{ $errors->first('provider_id') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th data-sortable="false">Giá nhập</th>
                                    </tr>
                                    </thead>
                                    <tbody  id="list-new-input">
                                    <tr class="row-input">
                                        <td>
                                            <div class="form-group {{ $errors->has('provider_id') ? ' has-error' : '' }}">
                                                <input type="text" class="form-control">
                                                @if($errors->has('provider_id'))
                                                    <small class="help-block">{{ $errors->first('provider_id') }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('provider_id') ? ' has-error' : '' }}">
                                                <input type="text" class="form-control">
                                                @if($errors->has('provider_id'))
                                                    <small class="help-block">{{ $errors->first('provider_id') }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group {{ $errors->has('provider_id') ? ' has-error' : '' }}">
                                                <div class="input-group">
                                                    <input name="price" type="text" class="form-control">
                                                    <span class="input-group-addon"> ₫</span>
                                                </div>
                                                @if($errors->has('provider_id'))
                                                    <small class="help-block">{{ $errors->first('provider_id') }}</small>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-10">
                                <a id="add-new-row" class="btn btn-default">Thêm +</a>
                                <a id="remove-row" class="btn btn-default">Thêm +</a>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js_content')
<script>
    $(document).ready( function () {
        $('#add-new-row').on('click', function () {
           $('#list-new-input').append(
               '<tr class="row-input">'
               +'<td style="border-top: 0"><div class="form-group"><input type="text" class="form-control"> </div> </td> '
                +'<td style="border-top: 0"> <div class="form-group"> <input type="text" class="form-control"> </div> </td>'
                +'<td style="border-top: 0"> <div class="form-group"> <div class="input-group"> <input name="price" type="text" class="form-control"> <span class="input-group-addon"> ₫</span> </div> </div> </td>'
                +'</tr>'
           );
        });
    })
</script>
@endpush