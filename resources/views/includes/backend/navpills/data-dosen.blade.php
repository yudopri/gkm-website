<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dd.dosen-tetap.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dd.dosen-tetap.index', $tahun_ajaran) }}">
            Dosen Tetap PT
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dd.dosen-pembimbing-ta.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dd.dosen-pembimbing-ta.index', $tahun_ajaran) }}">
            Pembimbing TA
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dd.ewmp-dosen.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dd.ewmp-dosen.index', $tahun_ajaran) }}">
            EWMP Dosen
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dd.dosen-tidak-tetap.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dd.dosen-tidak-tetap.index', $tahun_ajaran) }}">
            Dosen Tidak Tetap
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dd.dosen-praktisi.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dd.dosen-praktisi.index', $tahun_ajaran) }}">
            Dosen Industri/Praktisi
        </a>
    </li>
</ul>
