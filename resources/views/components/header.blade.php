<header>
    <div id="logo">
        <a href="{{route('home')}}">
            <img src="/images/logo.png" alt="Logo ciclopatas"/>
        </a>
    </div>
    <nav x-data="{ open: false }" class="main-nav">
        <!-- Navigation Links -->
        <div class="nav-links">
            <x-nav-link :href="route('bikes.index')" :active="request()->routeIs('bikes.index')">
                {{ __('Catalogo') }}
            </x-nav-link>
        </div>

        <!-- Settings Dropdown / Auth Links -->
        <div class="auth-links">
            @auth
                <div class="user-menu" id="user-menu">
                    <button type="button" class="user-trigger" id="user-trigger" aria-expanded="false" aria-controls="user-dropdown">
                        <span>{{ Auth::user()->name }}</span>
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="user-dropdown" id="user-dropdown" hidden>
                        <a href="{{ route('profile.edit') }}">
                            {{ __('Profile') }}
                        </a>
                        
                        <a href="{{ route('booking.index') }}">
                            {{ __('Reservas') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Log In') }}
                </x-nav-link>

                <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="btn-register">
                    {{ __('Register') }}
                </x-nav-link>
            @endauth
        </div>
    </nav>
</header>