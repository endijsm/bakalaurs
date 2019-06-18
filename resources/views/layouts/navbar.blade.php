<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel mb-5">
    <div class="container">
            <a href="/"><img src="{{ asset('vea_logo_small.png') }}" alt="VeA logo" style="margin-right: 30px; width: 40px;"></a>
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'SKAPiS') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Auth::check())
                    @if(Auth::user()->canViewCourseDescriptions())
                        <li class="nav-item"><a class="nav-link" href="/courses">Kursu apraksti</a></li>
                    @endif
		            @if(Auth::user()->canViewCatalog())
                        <li class="nav-item"><a class="nav-link" href="/catalogs">Kursu katalogi</a></li>
                    @endif
                    @if(Auth::user()->canViewStructures())
                        <li class="nav-item"><a class="nav-link" href="/faculties">Fakultātes</a></li>
                        <li class="nav-item"><a class="nav-link" href="/programs">Studiju programmas</a></li>
                    @endif
                    @if(Auth::user()->canViewReports()) 
                        <li class="nav-item"><a class="nav-link" href="/reports">Pārskati</a></li>
                    @endif
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Pieteikties') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->firstname.' '.Auth::user()->lastname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/myaccount">Mans profils</a>
                        
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Atteikties') }}
                            </a>
                            
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>