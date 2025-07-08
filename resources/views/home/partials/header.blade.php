<nav>
    <a href="{{ route('home') }}"><label class="logo">Medusa</label></a>

    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <span class="material material-symbols-outlined">menu</span>
    </label>

    <ul>
        <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
        <li><a class="{{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
        <li><a class="{{ request()->is('services') ? 'active' : '' }}" href="{{ url('/services') }}">Services</a></li>
        <li><a class="{{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a></li>

        @guest
            <li><a class="{{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a></li>
            <li><a class="{{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
            </li>
        @else
            <li>
                @if (Auth::user()->role === 'parent')
                    <a href="{{ route('parent.dashboard') }}" class="dashboard-icon">
                        <span>{{ strtoupper(Auth::user()->name[0]) }}</span>
                    </a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="dashboard-icon">
                        <span>{{ strtoupper(Auth::user()->name[0]) }}</span>
                    </a>
                @elseif(Auth::user()->role === 'hospital')
                    <a href="{{ route('hospital.dashboard') }}" class="dashboard-icon">
                        <span>
                            {{ strtoupper(Auth::user()->name[0]) }}</span>
                    </a>
                @else
                    @php abort(403) @endphp
                @endif
            </li>
        @endguest
    </ul>
</nav>
