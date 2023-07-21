<header class="navbar-light bg-light d-flex flex-row justify-content-between p-1" style="margin-left: 48px; margin-right: 48px; margin-top: 12px">
    <a class="navbar-brand" href="{{ route("home") }}" style="font-size: 40px">
        ToDo
    </a>
    <div class="m-2 d-flex flex-column justify-content-center">
        <a href="{{ route("logout") }}">
            <button class="align-middle btn btn btn-danger">Logout</button>
        </a>
    </div>
</header>