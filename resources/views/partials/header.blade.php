<header>
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src={{ asset('img/logo3.png') }} alt="">
            </a>
            <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" 
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"><i
                    class="fas fa-bars fa-1x"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto hamb">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item mr-3 login">
                            <a class="nav-link" href="{{ route('login') }}"><i class="far fa-user"></i>{{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item register">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Sei un dottore? Iscriviti') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a href="{{ route('admin.home') }}" class="nav-link">Area Riservata</a>
                        </li>
                        
                        @if (!Auth::user()->info)
                        <li class="nav-item dropdown">
                            <a href="{{ route('admin.infos.create') }}" class="nav-link">{{ Auth::user()->email }}</a>

                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a href="{{ route('admin.infos.show', Auth::user()->info['id']) }}" class="nav-link">{{ Auth::user()->email }}</a>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
        </div>
    </nav>
</header>