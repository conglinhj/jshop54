<form action="{{ url('/register')}}" id="registerForm" method="post" name="registerForm">
    <div class="form-group" id="register-name">
        <label class="control-label" for="name">Họ tên</label>
        <input class="form-control" id="name" name="name" placeholder="choose name" required="" title="Nhập họ tên của bạn nhé" type="text">
        <span class="help-block"><strong id="register-errors-name"></strong></span>
    </div>
    <div class="form-group" id="register-email">
        {{ csrf_field() }}
        <label class="control-label" for="email">Email</label>
        <input class="form-control" id="email" name="email" placeholder="example@gmail.com" required="" title="Nhập email của bạn nhé" type="email" value="">
        <span class="help-block"><strong id="register-errors-email"></strong></span>
    </div>
    <div class="form-group" id="register-password">
        <label class="control-label" for="password">Mật khẩu</label>
        <input class="form-control" id="password" name="password" placeholder="******" required="" title="Please enter your password" type="password" value="">
        <span class="help-block"><strong id="register-errors-password"></strong></span>
    </div>
    <div class="form-group">
        <label class="control-label" for="password-confirm">Nhập lại mật khẩu</label>
        <input class="form-control" id="password-confirm" name="password_confirmation" placeholder="******" type="password">
        <span class="help-block"><strong id="form-errors-password-confirm"></strong></span>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block">Đăng ký</button>
    </div>

    <p>Bạn đã có tài khoản? <a class="btn-to-login" href="#" data-toggle="modal" data-target="#loginModal"> Đăng nhập</a></p>
</form>