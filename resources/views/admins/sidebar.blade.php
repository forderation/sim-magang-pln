<ul class="nav-main">
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('*4dm1n/index*') ? ' active' : '' }}" href="{{route('admin.index')}}">
            <i class="nav-main-link-icon si si-cursor"></i>
            <span class="nav-main-link-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-main-heading">More</li>
    <li class="nav-main-item open">
    <a class="nav-main-link{{ request()->is('*lokasi-magang*') ? ' active' : '' }}" href="{{route('lokasi-magang.index')}}">
            <i class="nav-main-link-icon fa fa-map-marked-alt"></i>
            <span class="nav-main-link-name">Lokasi Magang</span>
        </a>
    </li>
</ul>