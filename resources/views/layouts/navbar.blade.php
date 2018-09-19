<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('index') }}">{{ config('app.name', 'Laravel') }}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ strpos( url()->current(), route('home', ['type' => 'all']) ) !== false ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home', ['type' => 'all']) }}">Home</a>
            </li>
            @if(!auth()->guest() && !(auth()->user()->user_type == 3))
                <li class="nav-item {{ strpos( url()->current(), route('dashboard') ) !== false ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav">
            @if (auth()->guest())
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}"><span class="oi oi-person" title="Profile" aria-hidden="true"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
