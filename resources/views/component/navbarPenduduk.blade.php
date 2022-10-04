<ul>
    <li>
        <a class="nav-link scrollto active" href="#hero">Home</a>
    </li>
    <li>
        <a class="nav-link scrollto" href="#about">About</a>
    </li>
    <li>
        <a class="nav-link scrollto" href="#services">Services</a>
    </li>
    <li>
        <a class="nav-link scrollto " href="#portfolio">Portfolio</a>
    </li>
    <li>
        <a class="nav-link scrollto" href="#team">Team</a>
    </li>
    @if (Auth::guest())
    <li>
        <a href="{{ route('login') }}" class="nav-link">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
        {{-- <a class="nav-link scrollto" href="#pricing">Pricing</a> --}}
    </li>
    <li>
        <a href="{{ route('register') }}" class="nav-link"><i class="fas fa-user"></i> Register
    </li>
    @else
    <li class="dropdown">
        <a href="#">
            <span>{{ Auth::user()->name }}</span>
            <i class="bi bi-chevron-down"></i>
        </a>
        <ul>
            <li>
                <a href="#">{{ Auth::user()->name }}</a>
            </li>
            <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
    @endif
    <li>
        <a class="nav-link scrollto" href="#contact">Contact</a>
    </li>
</ul>
<i class="bi bi-list mobile-nav-toggle"></i>
{{-- 
@if (Auth::guest())
<ul class="navbar-nav navbar-right justify-content-end">
    <li>
        <a href="{{ route('login') }}" class="nav-link">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
    </li>
    <li>
        <a href="{{ route('register') }}" class="nav-link"><i class="fas fa-user"></i> Register
        </a>
    </li>
</ul>
@else
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{ asset('admin/stisla/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
    <a href="features-profile.html" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profile
    </a>
    <a href="features-activities.html" class="dropdown-item has-icon">
        <i class="fas fa-bolt"></i> Activities
    </a>
    <a href="features-settings.html" class="dropdown-item has-icon">
        <i class="fas fa-cog"></i> Settings
    </a>
    <div class="dropdown-divider"></div>
        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
    <i class="fas fa-sign-out-alt"></i> Logout
</a><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    </form>
    </div>
</li>
@endif --}}