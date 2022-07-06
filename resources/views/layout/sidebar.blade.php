<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Rektor</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Rk</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Jadwal</li>
            @if(Auth()->user()->role == 'admin')
            <li class="nav-item {{ request()->is('agenda') ? 'active' : '' }}">
                <a class="nav-link" href="/agenda">
                    <i class="far fa-calendar-alt"></i>
                    <span>Agenda</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->role == 'rektor')
            <li class="nav-item {{ request()->is('daftar-agenda') ? 'active' : '' }}">
                <a class="nav-link" href="/daftar-agenda">
                    <i class="fas fa-calendar-day"></i>
                    <span>Schedule</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->role == 'admin')
            <li class="nav-item {{ request()->is('reschedule') ? 'active' : '' }}">
                <a class="nav-link" href="/reschedule">
                    <i class="far fa-calendar-check"></i>
                    <span>Reschedule</span>
                </a>
            </li>

            <li class="menu-header"> <i class="fa fa-cube"></i> Master</li>
            <li class="nav-item {{ request()->is('pengguna') ? 'active' : '' }}">
                <a class="nav-link" href="/pengguna">
                    <i class="fas fa-user-friends"></i>
                    <span>Pengguna</span>
                </a>
            </li>
            @endif
            <li class="menu-header">Data</li>
            <li class="nav-item {{ request()->is('dosen') ? 'active' : '' }}">
                <a class="nav-link" href="/dosen">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Dosen</span>

                </a>
            </li>
            <li class="nav-item {{ request()->is('mahasiswa') ? 'active' : '' }}">
                <a class="nav-link" href="/mahasiswa">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            {{-- <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li> --}}
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>
