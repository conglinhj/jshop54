<div class="footer-top-area" style="padding-bottom: 120px">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>J<span>shop</span></h2>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                @if(Auth::check())
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Hi! {{ Auth::user()->name }} </h2>
                        <ul>
                            <li><a href="{{ route('my.profile', ['slug' => str_slug(Auth::user()->name), 'id'=>Auth::id()]) }}">My account</a></li>
                            <li><a href="{{ route('my.listOrder') }}">Order history</a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Categories</h2>
                    <ul>
                        <li><a href="#">Smart Phone</a></li>
                        <li><a href="#">Laptop</a></li>
                        <li><a href="#">Tablet</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Đăng ký mail, để nhận những tin tức mới, tin khuyến mãi... từ chúng tôi</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="your email">
                            <input type="submit" value="Đăng ký">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>Đồ án tốt nghiệp Trường Đại học Giao Thông Vận Tải </p>
                    <p>Sinh viên thực hiện : <a href="https://www.facebook.com/cog.linh.joy"> Nguyễn Công Linh</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->
