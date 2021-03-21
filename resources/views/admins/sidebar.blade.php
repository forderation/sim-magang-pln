<ul class="nav-main">
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('*4dm1n/index*') ? ' active' : '' }}" href="{{route('admin.index')}}">
            <i class="nav-main-link-icon si si-cursor"></i>
            <span class="nav-main-link-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('*peserta*') ? ' active' : '' }}" href="{{route('peserta-magang.index')}}">
            <i class="nav-main-link-icon fa fa-users"></i>
            <span class="nav-main-link-name">Daftar Akun Peserta</span>
        </a>
    </li>
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('*profil*') ? ' active' : '' }}" href="{{route('admin.profil')}}">
            <i class="nav-main-link-icon far fa-user-circle"></i>
            <span class="nav-main-link-name">Profil</span>
        </a>
    </li>
    <li class="nav-main-heading">More</li>
    <li class="nav-main-item open">
        <a class="nav-main-link{{ request()->is('*lokasi-magang*') ? ' active' : '' }}" href="{{route('lokasi-magang.index')}}">
            <i class="nav-main-link-icon fa fa-map-marked-alt"></i>
            <span class="nav-main-link-name">Lokasi Magang</span>
        </a>
    </li>
    <li class="nav-main-item open">
        <a class="nav-main-link{{ request()->is('*pelaksanaan-magang*') ? ' active' : '' }}" href="{{route('pelaksanaan-magang.index')}}">
            <i class="nav-main-link-icon fa fa-keyboard"></i>
            <span class="nav-main-link-name">Pelaksanaan</span>
        </a>
    </li>
    <li class="nav-main-item open">
        <a class="nav-main-link{{ request()->is('*sertifikat-magang*') ? ' active' : '' }}" href="{{route('sertifikat-magang.index')}}">
            <i class="nav-main-link-icon fa fa-file-signature"></i>
            <span class="nav-main-link-name">Surat Keterangan Magang</span>
        </a>
    </li>
</ul>