<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepala_sekolah')
            <li class="nav-heading">Menu</li>

            <li class="nav-item">
                <a class="nav-link collapsed " href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#data" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="data" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/guru') }}">
                            <i class="bi bi-circle"></i><span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/kriteria') }}">
                            <i class="bi bi-circle"></i><span>Kriteria</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->role == 'kepala_sekolah')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('/penilaian') }}">
                    <i class="bi bi-filter-square"></i>
                    <span>Penilaian</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-journals"></i>
                <span>Hasil Penilaian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Kelola User</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Logout</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
