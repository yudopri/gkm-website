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


        
                <!-- #s 9. rekap data -->
                <li class="menu-item">
                <a href="{{ route('admin.rekap-data.kurikulum-dan-mahasiswa', ['tahun_ajaran' => '2024-2025']) }}" class="menu-link">
                    <div data-i18n="Rekap Data">Kurikulum dan Mahasiswa</div>
                </a>

                <a href="{{ route('admin.rekap-data.penelitian-dtps', ['tahun_ajaran' => '2024-2025']) }}"class="menu-link">
                    <div data-i18n="Rekap Data">Penelitian DTPS</div>
                </a>

                <a href="{{ route('admin.rekap-data.pkm-dtps', ['tahun_ajaran' => '2024-2025']) }}" class="menu-link">
                    <div data-i18n="Rekap Data">PKM DTPS</div>
                </a>
                
                <a href="{{ route('admin.rekap-data.kualitas-pembelajaran', ['tahun_ajaran' => '2024-2025']) }}"class="menu-link">
                    <div data-i18n="Rekap Data">Kualitas Pembelajaran</div>
                </a>

            
        </li>
<!-- #e . rekap data -->




        
    </ul>
</aside>