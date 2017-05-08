@extends('backend.master')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h3><a href="{{ route('backend.products.list') }}"><i class="icon-back"></i>back to list</a></h3>
        <h1><i class='fa fa-table'></i> detail Products : {{ $details_product['name'] }}</h1>
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

    <img src="{{ $details_product['image'] }}" alt="laptop">
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>Thông tin :</strong></h2>
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
                                    <a href="{{ route('backend.products.showEditForm',['id' => $details_product['id'] ]) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger"
                                       onclick="event.preventDefault();document.getElementById('product_form_delete').submit();" >
                                        <i class="fa fa-trash-o"></i> Delete</a>
                                    <form id="product_form_delete" action="{{ route('backend.products.destroy') }}" method="post" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $details_product['id'] }}" name="product_id">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table data-sortable class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <td width="150" ><strong>Thương hiệu</strong></td>
                                <td>{{ $details_product->trademark['name'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Loại sản phẩm</strong></td>
                                <td>{{ $details_product['category_id'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>Giới thiệu</strong></td>
                                <td>
                                    <div class="introduction">
                                        {!! $details_product['intro'] !!}
                                    </div>
                                    <a id="show_more" class="btn">Show more...</a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Giá</strong></td>
                                <td>{{ number_format($details_product['price'],0,",",".") }}</td>
                            </tr>
                            <tr>
                                <td><strong>created at</strong></td>
                                <td>{{ $details_product['created_at'] }}</td>
                            </tr>
                            <tr>
                                <td><strong>updated at</strong></td>
                                <td>{{ $details_product['updated_at'] }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach($hardwares as $key => $hardware)
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>{{ $hardware['name'] }}</strong></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table id="datatables-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <tbody>
                                @foreach($details_product->specs as $specs)
                                    @if($hardware['id'] == $specs['hardware_id'])
                                        <tr>
                                            <td style="width: 34%;">{{ $specs['name'] }}</td>
                                            <td>{{ $specs->pivot->value }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
<script>
    $(document).ready(function () {
        $showmore = $('#show_more');
        $showmore.on('click', function () {
           if ($showmore.text() == 'Show more...'){
               $('.introduction').css('height', 'auto');
               $showmore.text('hide...');
           } else if ($showmore.text() == 'hide...'){
               $('.introduction').css('height', '200px');
               $showmore.text('Show more...');
           }
       });
    });
</script>
@endpush