@extends('frontend.master')
@section('title',Auth::user()->name)
@section('menu-area')
    @include('frontend.includes.menu-area-for-profile')
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="product-content-right">
                        <div class="woocommerce">

                            <div class="col-md-8 col-md-offset-1">
                                <form action="{{ route('my.edit.profile') }}" method="POST">
                                    {{ csrf_field() }}
                                    <table id="table-user-info" class="table table-responsive">
                                        <tbody>
                                        <tr>
                                            <td>Tên</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <input class="form-control input-text" type="text" name="name" value="{{$user->name}}" title="Họ tên của bạn">
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td><span>{{$user->email}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Giới tính</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('render') ? ' has-error' : '' }}">
                                                    <input class="" type="radio" name="render" value="male" {{ $user->render == 'male' ? 'checked' : '' }} title="Giới tính của bạn">Nam &nbsp&nbsp&nbsp&nbsp
                                                    <input class="" type="radio" name="render" value="female" {{ $user->render == 'female' ? 'checked' : '' }} title="Giới tính của bạn">Nữ
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>
                                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                    <input class="form-control input-text" type="text" name="phone" value="{{$user->phone}}" title="Số điện thoại của bạn">
                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td>
                                                <div id="billing_city_field" class="form-group {{ $errors->has('city_id') ? ' has-error' : '' }}">
                                                    <label class="control-label" for="billing_city">Tỉnh/Thành phố<abbr title="required" class="required">*</abbr>
                                                    </label>
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
                                                    <label class="control-label" for="billing_county">Quận/Huyện<abbr title="required" class="required">*</abbr>
                                                    </label>
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
                                                    <label class="control-label" for="billing_township">Phường, xã<abbr title="required" class="required">*</abbr>
                                                    </label>
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
                                                    <label class="control-label" for="billing_address_1">Địa chỉ nhà<abbr title="required" class="required">*</abbr>
                                                    </label>
                                                    <input type="text" value="{{ $user->address }}" placeholder="tên đường, số nhà..." id="billing_address_1" name="address" class="form-control input-text" required>
                                                    @if ($errors->has('address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input class="btn btn-primary btn-lg" type="submit" value="Cập nhật">
                                                <a class="btn btn-default btn-lg" href="{{ route('my.profile') }}">Cancel</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script_content')
<script src="{{ asset('frontend_assets/js/ajax/hanhchinhVN.js') }}"></script>
<script>
    $(document).ready( function (e) {

    })
</script>
@endpush