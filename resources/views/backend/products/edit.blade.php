@extends('backend.master')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-plus-circle'></i> Edit a Product</h1>
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
                                    <label class="control-label">Ảnh</label>
                                    <div class="row">
                                        <div class="col-md-3"><input id="upload_images" class="btn btn-default" type="button" value='Select file'></div>
                                        <div class="col-md-9">
                                            <input id="output_images" value="{{ $details_product['image'] }}" name="image" type="text" class="form-control">
                                        </div>
                                    </div>
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
                            <div class="col-md-6"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Giới thiệu về sản phẩm</label>
                            <textarea name="intro" class="summernote" rows="5">{{ $details_product['intro'] }}</textarea>
                        </div>

                        <h3><strong>Thông số kỹ thuật</strong></h3>
                        <div class="row">
                            @foreach($hardwares as $hardware)
                                <div class="col-md-6">
                                    <h4 style="color: #791C1A;"><strong>{{ $hardware['name'] }} :</strong></h4>
                                    @foreach($details_product->specs as $specs)
                                        @if($specs['hardware_id'] == $hardware['id'])
                                            <div class="form-group">
                                                <label for="input-text" class="control-label">{{ $specs['name'] }}</label>
                                                <input name="value[]" value="{{ $specs->pivot['value'] }}" type="text" class="form-control">
                                                <input name="specs_id[]" type="hidden" value="{{ $specs['id'] }}">
                                            </div>
                                        @endif
                                    @endforeach
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
            $('.summernote').summernote({
                height: 150,
            });

            var button = document.getElementById( 'upload_images' );
            button.onclick = function() {
                selectFileWithCKFinder( 'output_images' );
            };
            function selectFileWithCKFinder( elementId ) {
                CKFinder.modal( {
                    chooseFiles: true,
                    width: 800,
                    height: 600,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            var output = document.getElementById( elementId );
                            output.value = file.getUrl();
                        } );

                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            var output = document.getElementById( elementId );
                            output.value = evt.data.resizedUrl;
                        } );
                    }
                } );
            }

        });
    </script>
    <script src="{{ asset('backend_assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('backend_assets/libs/bootstrap-inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('backend_assets/libs/summernote/summernote.js') }}"></script>
    <script src="{{ asset('backend_assets/js/pages/forms.js') }}"></script>
@endpush