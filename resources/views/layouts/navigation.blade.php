<nav class="navbar navbar-expand-md navbar-light shadow-sm">
            
    <a class="navbar-brand" href="{{ url('/') }}">
        
        <img src="{{ asset("/img/logo.svg") }}" alt="" height="20px" width="40px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/clientes') }}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/proyectos') }}">Proyectos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/facturas') }}">Facturas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/bot') }}">Bot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/posts') }}">Posts</a>
                </li>
            @endauth
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('perfil') }}"/>Mi Perfil</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>

</nav>