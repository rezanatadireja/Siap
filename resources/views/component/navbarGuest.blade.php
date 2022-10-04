<nav class="navbar navbar-secondary navbar-expand-lg">
<div class="container">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('/')}}" class="nav-link">
                <span>Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('cekpengaduan') }}" class="nav-link">
                <span>Cek Pengaduan</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                <span>Pendaftaran Penduduk</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item">
                    <a href="index-0.html" class="nav-link">Kartu Keluarga</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">KTP-El</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Kartu Identitas Anak</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Penduduk Pindah/Datang</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                <span>Pencatatan Sipil</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown">
                <span>Info & Download</span>
            </a>
            <ul class="dropdown-menu">
                <li class="nav-item">
                    <a href="{{ route('info') }}" class="nav-link">Informasi Persyaratan</a>
                </li>
                <li class="nav-item">
                    <a href="{{url('guest/formulir')}}" class="nav-link">Download Formulir</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
</nav>