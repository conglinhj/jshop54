
<form action="{{ url('/login')}}" method="POST" id="loginForm"  novalidate>
    {{ csrf_field() }}

    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" id="email-div">
        <label class="control-label" for="email">Email</label>
        <input id="email" type="email" placeholder="example@gmail.com" title="Please enter you email" required value="" name="email" class="form-control">
        {{-- <div id="form-errors-email" class="has-error"></div> --}}
        @if ($errors->has('email'))
            <span class="help-block">
                <strong id="form-errors-email">{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <span class="help-block small">Your email</span>
    </div>

    <div class="form-group" id="password-div">
        <label class="control-label" for="password">Password</label>
        <input type="password" title="Please enter your password" placeholder="******" required value="" name="password" id="password" class="form-control">
        <span class="help-block"><strong id="form-errors-password"></strong></span>
        <span class="help-block small">Your strong password</span>
    </div>

    <div class="form-group" id="login-errors">
        <span class="help-block"><strong id="form-login-errors"></strong></span>
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label><input type="checkbox" name="remember"> Remember Me</label>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary">Login</button>
        <a class="btn btn-link right" href="{{ url('/password/reset') }}">Quên mật khẩu ?</a>
    </div>

    <div class="form-group">
        <a class="btn btn-primary" href="{{ route('redirectToProvider',['social' => 'facebook']) }}" >
            <i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập bằng Facebook
        </a>
        <a class="btn btn-danger" href="{{ route('redirectToProvider',['social' => 'google']) }}" >
            <i class="fa fa-google" aria-hidden="true"></i> Đăng nhập bằng Google
        </a>
    </div>

    <p>Bạn chưa có tài khoản? <a class="btn-to-register" href="#" data-toggle="modal" data-target="#registerModal"> Đăng ký</a></p>

</form>