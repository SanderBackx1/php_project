<nav class="navbar navbar-expand-md navbar-light nav-color shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/home">Alumnapp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav mr-auto">
                @auth

                @if(auth()->user()->verantwoordelijke)
                <li class="nav-item">
                    <a class="nav-link" href="/alumni">Alumni</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/avonden">Evenementen</a>
                </li>
                @if(auth()->user()->admin)
                <li class="nav-item">
                    <a class="nav-link" href="/admin/gebruikers">Personen</a> {{--     Voor admin alleen--}}
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/opleidingen">Opleidingen</a>{{--     Voor admin alleen--}}
                </li>
                @endif
                @endauth
            </ul>
        </div>
        <ul class="navbar-nav mr-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Inloggen of inschrijven</a>
            </li>
            @endguest
        </ul>
        <ul class="navbar-nav mr-auto">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                    {{ auth()->user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/profiel"><i class="fas fa-user-alt"></i>Profiel bekijken</a>
                    <a class="dropdown-item" href="/mail"><i class="fas fa-envelope"></i>Mail</a>
                    <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</nav>
