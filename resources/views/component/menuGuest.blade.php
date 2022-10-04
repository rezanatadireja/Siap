{{-- @if (Auth::guest())
<ul class="navbar-nav navbar-right">
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
<ul class="navbar-nav navbar right">
    <li class="dropdown dropdown-list-toogle">
        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
        <div class="dropdown-list-content dropdown-list-icons">
            @foreach(auth()->user()->notifications as $notification)
            @if ($notification->count() == 0)
            <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                <b>Tidak Ada Pemberitahuan.</b>
                <div class="time">12 Hours Ago</div>
                </div>
            </a>
            @else
                <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                <b>{{$notification->data['status_pengaduan']}}</b><b>{{$notification->data['jenis_pelayanan']}}</b> to <b>Done</b>
                <div class="time">12 Hours Ago</div>
                </div>
            </a>
            @endif
            @endforeach
        </div>
    </li>
</ul>
<li class="dropdown mb-3"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{ asset('admin/stisla/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">{{ ucwords(Auth::user()->name) }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="{{url('dashboard/mYpengaduan/')}}" class="dropdown-item has-icon">
            {{-- <input type="hidden" name="id" value="{{ (Auth::user()->id) }}"> --}}
        {{-- <i class="far fa-user"></i> Pengaduan Saya
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
@if (Auth::guest())
<ul class="navbar-nav navbar-right ml-3">
    <li>
        <a href="{{ route('login') }}" class="nav-link btn btn-icon btn-primary">Login <i class="fas fa-sign-out-alt"></i></a>
    </li>
</ul>
@else
<ul class="navbar-nav navbar-right ml-3">
    <li class="dropdown dropdown-list-toggle"> <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg @if(auth()->user()->unreadNotifications->count())beep @endif"><i class="far fa-bell"></i>
        @if (auth()->user()->unreadNotifications->count())
        <span class="badge badge-transparent mb-3 p-0">{{auth()->user()->unreadNotifications->count()}}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Pemberitahuan
        <div class="float-right">
            <a href="{{ route('markAsRead')}}">Tandai Semua Telah dibaca</a>
        </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
        @if (auth()->user()->unreadNotifications->count())
            @forelse(auth()->user()->unreadNotifications as $notification)
                <a href="#" class="dropdown-item" style="color: seagreen;">
                <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                Pengaduan<b> {{$notification->data['jenis_pelayanan']}}</b><b> {{ucwords($notification->data['status_pengaduan'])}}, silahkan download dokumen diprofil pengaduan.</b>
                <div class="time">12 Hours Ago</div>
                </div>
            </a>
            @empty
            <a href="#" class="dropdown-item">
                <div class="dropdown-item-icon bg-success text-white">
                <i class="fas fa-check"></i>
                </div>
                <div class="dropdown-item-desc">
                <b>Tidak Ada Pemberitahuan.</b>
                <div class="time">12 Hours Ago</div>
                </div>
            </a>
            @endforelse
        @endif
        </div>
        <div class="dropdown-footer text-center">
        <a href="#">Lihat Semua <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{ asset('admin/stisla/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">{{ ucwords(Auth::user()->username) }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="{{url('dashboard/mYpengaduan/')}}" class="dropdown-item has-icon">
            <input type="hidden" name="id" value="{{ (Auth::user()->id) }}">
        <i class="far fa-user"></i> Pengaduan Saya
        </a>
        <div class="dropdown-divider"></div>
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
            </a><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
                </div>
            </li>
        </ul>
@endif