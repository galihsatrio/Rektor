<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
            </ul>
            {{-- <div class="search-element">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                <div class="search-backdrop"></div>
            </div> --}}
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown dropdown-list-toggle">
                @if(auth()->user()->role == 'rektor')
                    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                        <i class="far fa-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notifications
                            {{-- <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div> --}}
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons" style="height: auto">
                            <a href="/daftar-agenda" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                @if($data['total'] != 0)
                                    <div class="dropdown-item-desc">
                                        Ada {{ $data['total'] }} agenda baru, segera periksa.
                                        <div class="time text-primary">{{ $data['tanggal'] }}</div>
                                    </div>
                                @else
                                    <div class="dropdown-item-desc">
                                        Belum ada agenda terbaru.
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                        <a href="/daftar-agenda">Lihat Agenda <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                @else
                    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                        <i class="far fa-bell"></i>
                    </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notifications
                            {{-- <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div> --}}
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons" style="height: auto">
                            <a href="/daftar-agenda" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                @if($data['total_dosen'] != 0)
                                    <div class="dropdown-item-desc">
                                        Ada {{ $data['total_dosen'] }} dosen yang masa aktifnya melebihi 4 tahun tetapi belum naik jabatan, cek sekarang!
                                        <div class="time text-primary">{{ $data['tanggal_dosen'] }}</div>
                                    </div>
                                @else
                                    <div class="dropdown-item-desc">
                                        Belum ada notifikasi terbaru.
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                        <a href="/daftar-agenda">Lihat Dosen <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                @endif
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">   {{ Auth()->user()->nama }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a href="/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item has-icon text-danger d-flex align-items-center">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
      </nav>
