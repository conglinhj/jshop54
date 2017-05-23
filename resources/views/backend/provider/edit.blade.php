@extends('backend.master')
@section('title_admin','provider')
@section('content')
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class='fa fa-edit'></i> Update provider</h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">

        <div class="col-sm-6 portlets">

            <div class="widget">
                <div class="widget-header transparent">
                    <h2><a href="{{ route('backend.provider.list') }}"><i class="icon-back"></i>back to list</a></h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div id="basic-form">
                        <form action="{{ route('backend.provider.update') }}" method="post" role="form">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="input-text" class="control-label">Name</label>
                                <input type="text" name="name" value="{{ $details_provider->name }}" class="form-control" id="input-text" placeholder="tên">
                                @if($errors->has('name'))
                                    <small class="help-block">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="input-text" class="control-label">Email</label>
                                <input type="text" name="email" value="{{ $details_provider->email }}" class="form-control" id="input-text" placeholder="email">
                                @if($errors->has('email'))
                                    <small class="help-block">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="input-text" class="control-label">Phone</label>
                                <input type="text" name="phone" value="{{ $details_provider->phone }}" class="form-control" id="input-text" placeholder="số điện thoạt">
                                @if($errors->has('phone'))
                                    <small class="help-block">{{ $errors->first('phone') }}</small>
                                @endif
                            </div>
                            <div id="billing_city_field" class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <label class="control-label" for="billing_city">Tỉnh/Thành phố</label>
                                <select data-url="{{ route('selectCity') }}" class="form-control" id="billing_city" name="city_id">
                                    <option value="0">Chọn Tỉnh/Thành phố</option>
                                    @foreach( $cities as $city)
                                        <option  value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                                            <strong>{{ $errors->first('city_id') }}</strong>
                                                        </span>
                                @endif
                            </div>
                            <div id="billing_county_field" class="form-group {{ $errors->has('county_id') ? ' has-error' : '' }}">
                                <label class="control-label" for="billing_county">Quận/Huyện</label>
                                <select data-url="{{ route('selectCounty') }}" class="form-control" id="billing_county" name="county_id">
                                    <option value="0">Chọn Quận/Huyện</option>
                                </select>
                                @if ($errors->has('county_id'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('county_id') }}</strong>
                                                    </span>
                                @endif
                            </div>
                            <div id="billing_township_field" class="form-group {{ $errors->has('township_id') ? ' has-error' : '' }}">
                                <label class="control-label" for="billing_township">Phường, xã</label>
                                <select class="form-control" id="billing_township" name="township_id">
                                    <option value="0">Chọn Phường, xã</option>
                                </select>
                                @if ($errors->has('township_id'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('township_id') }}</strong>
                                                    </span>
                                @endif
                            </div>
                            <div id="billing_address_1_field" class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="control-label" for="billing_address_1">Địa chỉ</label>
                                <input type="text" placeholder="tên đường, số nhà..." value="{{ $details_provider->address }}" id="billing_address_1" name="address" class="form-control input-text" >
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('intro') ? ' has-error' : '' }}">
                                <label for="input-text" class="control-label">Thông tin thêm</label>
                                <textarea name="intro" class="form-control"  id="input-text" placeholder="thông tin thêm về nhà cung cấp.">value="{{ $details_provider->intro }}"</textarea>
                                @if($errors->has('intro'))
                                    <small class="help-block">{{ $errors->first('intro') }}</small>
                                @endif
                            </div>
                            <input type="hidden" value="{{ $details_provider['id'] }}" name="id">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer Start -->

@endsection
@push('js_content')
<script src="{{ asset('frontend_assets/js/ajax/hanhchinhVN.js') }}"></script>

@endpush