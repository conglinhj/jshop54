<div class="md-modal md-just-me" id="logout-modal">
    <div class="md-content">
        <h3><strong>Logout</strong> Confirmation</h3>
        <div>
            <p class="text-center">Are you sure want to logout from this awesome system?</p>
            <p class="text-center">
                <button class="btn btn-danger md-close">Nope!</button>
                <a class="btn btn-success md-close" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Yeah, I'm sure</a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </p>
        </div>
    </div>
</div>