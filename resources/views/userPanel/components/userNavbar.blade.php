    <nav class="navbar">
        <div class="logo-name">
            <a href="/"><img src="{{ asset('storage/images/PostifyLogo.png') }}" alt="Logo"></a>
            <span id="userName">Hi, <strong>{{ Auth::user()->name }}</strong></span>
        </div>
        <div class="nav-links">
            <a href="{{ route('user.logout') }}"
                class="{{ request()->routeIs('user.logout') ? 'active' : '' }}">Logout</a>
        </div>
    </nav>