<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li {{ Request::is('home') ? 'class=active' : '' }}><a href="{{ route('home') }}">Home</a></li>
                    <li {{ Request::is('shop') ? 'class=active' : '' }}><a href="{{ route('shop') }}">Laptop</a></li>
                    <li {{ Request::is('smartphone') ? 'class=active' : '' }}><a href="{{ route('shop') }}">Smart Phone</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->