<ul class="nav-main">
    <li class="nav-main-item">
        <a class="nav-main-link{{ request()->is('*home*') ? ' active' : '' }}" href="{{route('index')}}">
            <i class="nav-main-link-icon si si-cursor"></i>
            <span class="nav-main-link-name">Dashboard</span>
        </a>
    </li>
    <li class="nav-main-heading">More</li>
    <li class="nav-main-item open">
    <a class="nav-main-link{{ request()->is('*pengajuan-magang/*') ? ' active' : '' }}" href="{{route('pengajuan-magang.index')}}">
            <i class="nav-main-link-icon fa fa-map-marked-alt"></i>
            <span class="nav-main-link-name">Pengajuan Magang</span>
        </a>
    </li>
</ul>