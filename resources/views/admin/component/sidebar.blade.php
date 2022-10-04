<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">SIAP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SIAP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu Dashboard</li>
            <li class="{{ Request::is('dashboard') ? "active" : "" }}">
                <a href="{{ url('dashboard') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Dashboard</span></a>
            </li>
            @if(auth()->user()->checkPermission('user.index'))
            <li class="menu-header">Manajemen User & Permissions</li>
            <li class="{{ Request::is('users') ? "active" : "" }}">
                <a href="{{ url('users') }}" class="nav-link"><i class="far fa-user"></i> <span>Data User</span></a>
            </li>
            <li class="{{ Request::is('admin/penduduk') ? "active" : "" }}">
                <a href="{{ url('admin/penduduk') }}" class="nav-link"><i class="fas fa-users"></i> <span>Data Penduduk</span></a>
            </li>
            @endif
            <li class="menu-header">Manajemen Pengaduan</li>
            <li class="{{ Request::is('admin/pengaduan') ? "active" : "" }}"">
                <a href="{{ url('admin/pengaduan')}}" class="nav-link"><i class="fas fa-file-archive"></i><span>Data Pengaduan</span></a>
            </li>
            <li class="menu-header">Manajemen Bidang Pengaduan</li>
            <li class="{{ Request::is('bidangpengaduan') ? "active" : "" }}">
                <a href="{{ url('bidangpengaduan')}}" class="nav-link"><i class="fas fa-landmark"></i><span>Bidang Pengaduan</span></a>
            </li>
            <li class="{{ Request::is('subbidang') ? "active" : "" }}">
                <a href="{{ url('subbidang')}}" class="nav-link"><i class="fas fa-archway"></i><span>Sub Bagian Bidang</span></a>
            </li>
            <li class="{{ Request::is('jenis-pengaduan') ? "active" : "" }}">
                <a href="{{ url('jenis-pengaduan')}}" class="nav-link"><i class="fas fa-box-open"></i><span>Pelayanan Pengaduan</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/jenis-syarat') ? "active" : "" }}">
                <a href="{{ url('admin/jenis-syarat')}}" class="nav-link"><i class="far fa-newspaper"></i> <span>Syarat Pengaduan</span>
                </a>
            </li>
            <li class="menu-header">Pengaturan Berkas Formulir</li>
            <li class="{{ Request::is('formulir') ? "active" : "" }}">
                <a href="{{route('formulir')}}" class="nav-link"><i class="fas fa-folder-open"></i> <span>Berkas Formulir</span></a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="{{ Request::is('laporan-pengaduan') ? "active" : "" }}">
                <a href="{{route('laporan-pengaduan')}}" class="nav-link"><i class="fas fa-file-alt"></i> <span>Laporan Pengaduan</span></a>
            </li>
    </aside>
</div>


