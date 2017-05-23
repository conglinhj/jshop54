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
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <div class="col-md-6  woocommerce-checkout">
                                <table id="table-user-info" class="table table-responsive">
                                    <tbody>
                                        <tr>
                                            <td>Tên</td>
                                            <td>
                                                <p>{{$user->name}}</p>
                                                @if(Auth::user()->avatar)
                                                    <div style="max-height: 100px;overflow: hidden">
                                                        <a href="https://www.facebook.com/app_scoped_user_id/{{Auth::user()->facebook_id}}">
                                                            <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar">
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>E-mail</td>
                                            <td><span>{{$user->email}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Giới tính</td>
                                            <td> {{ $user->render == 'female' ? 'Nữ' : 'Nam' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại</td>
                                            <td>{{$user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ</td>
                                            <td>{{ $user->address.', '.$user->township->name.', '.$user->county->name.', '.$user->city->name}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><a href="{{ route('my.showEditForm') }}" class="btn btn-link" href="">Cập nhật thông tin cá nhân...</a></td>
                                        </tr>
                                    </tbody>
                                </table>

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