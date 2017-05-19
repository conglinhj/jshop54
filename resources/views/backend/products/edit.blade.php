@extends('backend.master')
@section('title_admin','Product')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h3><a href="{{ route('backend.products.list') }}"><i class="icon-back"></i>back to list</a></h3>
        <h1><i class='fa fa-table'></i> edit Products :<img width="200" src="{{ asset($details_product['image']) }}" alt="laptop"> {{ $details_product['name'] }}</h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">

        <div class="col-sm-12 portlets">

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.products.list') }}"><i class="icon-back"></i>back to list</a></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('backend.products.update') }}" class="form-horizontal" role="form" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="input-text" class="control-label">Tên sản phẩm</label>
                                    <input name="name" type="text" value="{{ $details_product['name'] }}" class="form-control"  placeholder="name product...">
                                    <input type="hidden" name="id" value="{{ $details_product['id'] }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Loại sản phẩm</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">--- Chose one ---</option>
                                        @foreach($categories as $category)
                                            <option @if($details_product['category_id'] == $category['id']) selected @endif value="{{ $category->id }}" >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Hãng</label>
                                    <select name="trademark_id" class="form-control">
                                        <option value="">--- Chose one ---</option>
                                        @foreach($trademarks as $trademark)
                                            <option @if($details_product['trademark_id'] == $trademark['id']) selected @endif value="{{ $trademark->id }}" >{{ $trademark->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Giá bán</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">VND</span>
                                        <input name="price" value="{{ $details_product['price'] }}" type="text" class="form-control">
                                        <span class="input-group-addon">.000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Ảnh</label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Choose
                                                </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" value="{{ asset($details_product['image']) }}" type="text" name="image">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ asset($details_product['image']) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giới thiệu về sản phẩm</label>
                            <textarea name="intro" id="introduction" class="introduction" rows="5">{{ $details_product['intro'] }}</textarea>
                        </div>

                        <h3><strong>Thông số kỹ thuật</strong></h3>
                        <div class="row form-inline">
                            @foreach($hardwares as $hardware)
                                <div class="col-md-6" style="margin-bottom: 30px;">
                                    <h4 style="color: #791C1A; background-color: #cecece"><strong>{{ $hardware['name'] }} :</strong></h4>
                                    <table style="width: 100%">
                                    @foreach($details_product->specs as $specs)
                                        @if($specs['hardware_id'] == $hardware['id'])
                                            <div class="form-group">
                                                <tr>
                                                    <td class="col-md-4" style="text-align: right">
                                                        <label for="input-text" class="control-label">{{ $specs['name'] }}</label>
                                                    </td>
                                                    <td>
                                                        <input style="width: 100%;" name="value[]" value="{{ $specs->pivot['value'] }}" type="text" class="form-control">
                                                        <input name="specs_id[]" type="hidden" value="{{ $specs['id'] }}">
                                                    </td>
                                                </tr>
                                            </div>
                                        @endif
                                    @endforeach
                                    </table>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js_content')
    <script type="text/javascript">
        $(document).ready(function() {
            var domain = "/jshop54/public/laravel-filemanager";
            $('#lfm').filemanager('image', {prefix: domain});

        });
    </script>
    <script src="{{ asset('backend_assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('backend_assets/libs/bootstrap-inputmask/inputmask.js') }}"></script>
    {{--<script src="{{ asset('backend_assets/libs/summernote/summernote.js') }}"></script>--}}
    {{--<script src="{{ asset('backend_assets/js/pages/forms.js') }}"></script>--}}
    <script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: /*location.hostname+*/'http://localhost/jshop54/public/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: /*location.hostname+*/'http://localhost/jshop54/public/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: /*location.hostname+*/'http://localhost/jshop54/public/laravel-filemanager?type=Files',
            filebrowserUploadUrl: /*location.hostname+*/'http://localhost/jshop54/public/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('introduction', options);
    </script>
@endpush