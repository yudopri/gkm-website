<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.kt.pendidikan.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.kt.pendidikan.index', $tahun_ajaran) }}">
            Pendidikan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.kt.penelitian.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.kt.penelitian.index', $tahun_ajaran) }}">
            Penelitian
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.kt.pengmas.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.kt.pengmas.index', $tahun_ajaran) }}">
            Pengabdian Masyarakat
        </a>
    </li>
</ul>
