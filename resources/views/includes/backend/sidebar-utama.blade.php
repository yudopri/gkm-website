<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('backend/img/logo/logo-polije.png') }}" width="40" alt="logo-polije">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">GKM POLIJE</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Tabel -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Tabel</span>
        </li>

        @hasanyrole('admin|petugas')
            <!-- #s List Dosen -->
            <li class="menu-item {{ request()->routeIs('admin.petugas.list-dosen.*') ? 'active' : '' }}">
                <a href="{{ route('admin.petugas.list-dosen.index') }}" class="menu-link">
                    <div data-i18n="List Dosen">List Dosen</div>
                </a>
            </li>
            <!-- #e List Dosen -->
        @endhasanyrole

        @hasanyrole('dosen|staff|D3|D4|S2')
            <!-- #s Tahun Ajaran -->
            <li class="menu-item {{ request()->routeIs('admin.dosen.tahun-ajaran.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dosen.tahun-ajaran.index') }}" class="menu-link">
                    <div data-i18n="Tahun Ajaran">Tahun Ajaran</div>
                </a>
            </li>
            <!-- #e Tahun Ajaran -->
        @endhasanyrole

    </ul>
</aside>
