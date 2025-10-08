<nav class="navbar navbar-expand-lg navbar-light bg-danger-subtle px-3">
    <strong><a class="navbar-brand" href='/home'>Inventory</a></strong>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">

            @auth
                <li class="nav-item me-3">
                    <div class="nav-link">
                        <strong>Welcome, {{ucfirst( Auth::user()->name) }}</strong>
                    </span>
                </li>

                <li class="nav-item mt-1">
                   <a href="/logout" class="btn btn-danger">Logout</a>
                </li>
            @endauth

        </ul>
    </div>
</nav>
