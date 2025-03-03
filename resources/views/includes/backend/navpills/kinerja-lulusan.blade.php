<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.ipk-lulusan.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.ipk-lulusan.index') }}">
            IPK Lulusan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.prestasi-mahasiswa.akademik.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.prestasi-mahasiswa.akademik.index') }}">
            Prestasi Akademik
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.prestasi-mahasiswa.nonakademik.index') }}">
            Prestasi Non-akademik
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.masa-studi-lulusan.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.masa-studi-lulusan.index') }}">
            Masa Studi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.waktu-tunggu.index') }}">
            Waktu Tunggu
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.evaluasi-lulusan.kesesuaian-kerja.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kesesuaian-kerja.index') }}">
            Kesesuaian Kerja
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.evaluasi-lulusan.tempat-kerja.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.tempat-kerja.index') }}">
            Tempat Kerja
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.index') }}">
            Kepuasan Pengguna
        </a>
    </li>
</ul>
