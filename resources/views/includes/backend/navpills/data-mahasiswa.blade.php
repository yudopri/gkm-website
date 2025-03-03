<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dm.seleksi-maba.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dm.seleksi-maba.index', $tahun_ajaran) }}">
            Seleksi Mahasiswa
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dosen.dm.mahasiswa-asing.*') ? 'active' : '' }}"
            href="{{ route('admin.dosen.dm.mahasiswa-asing.index', $tahun_ajaran) }}">
            Mahasiswa Asing
        </a>
    </li>
</ul>
