<button class="sidebar-menu-button">
    <span class="material-icons">menu</span>
</button>

<aside class="sidebar collapsed">
    <header class="sidebar-header">
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ asset('default/logo.jpg') }}" alt="Medusa Logo" />
        </a>
        <button class="sidebar-toggler">
            <span class="material-icons">chevron_left</span>
        </button>
    </header>

    <nav class="sidebar-nav">
        <ul class="nav-list primary-nav">
            <li class="nav-item">
                <a href="{{ route('parent.dashboard') }}"
                    class="nav-link {{ request()->is('parent/index') ? 'active' : '' }}">
                    <span class="material-icons">dashboard</span>
                    <span class="nav-label">Dashboard</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Dashboard</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('child.index') }}"
                    class="nav-link {{ request()->is('parent/child') ? 'active' : '' }}">
                    <span class="material-icons">child_care</span>
                    <span class="nav-label">My Children</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">My Children</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('booking.create') }}"
                    class="nav-link {{ request()->is('parent/book') ? 'active' : '' }}">
                    <span class="material-icons">turned_in_not</span>
                    <span class="nav-label">Book Hospital</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Book Hospital</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('booking.index') }}"
                    class="nav-link {{ request()->is('parent/bookings') ? 'active' : '' }}">
                    <span class="material-icons">notifications</span>
                    <span class="nav-label">My Bookings</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">My Bookings</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports.parent') }}"
                    class="nav-link {{ request()->is('parent/reports') ? 'active' : '' }}">
                    <span class="material-icons">article</span>
                    <span class="nav-label">Reports</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">Reports</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav-list secondary-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show') }}">
                    <span class="material-icons">person</span>
                    <span class="nav-label">Logged in as {{ explode(' ', Auth::user()->name)[0] }}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link dropdown-title">{{ Auth::user()->email }}</a></li>
                </ul>
            </li>
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-submit">
                    <li class="nav-item">
                        <span class="nav-link">
                            <span class="material-icons">logout</span>
                            <span class="nav-label">Sign Out</span>
                        </span>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link dropdown-title">Sign Out</a></li>
                        </ul>
                    </li>
                </button>
            </form>
        </ul>
    </nav>
</aside>
