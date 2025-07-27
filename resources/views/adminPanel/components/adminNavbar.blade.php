<nav class="navbar">
    <div>
        <a href="/"><img src="{{ asset('images/PostifyLogo.png') }}" alt="Logo"></a>
    </div>

    <div class="nav-links">
        <a href="{{ route('admin.posts') }}" class="{{ request()->routeIs('admin.posts') ? 'active' : '' }}">Posts</a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">Users</a>
        <a href="{{ route('admin.logout') }}"
            class="{{ request()->routeIs('admin.logout') ? 'active' : '' }}">Logout</a>
    </div>
</nav>