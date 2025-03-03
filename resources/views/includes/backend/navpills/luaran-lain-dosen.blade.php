<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.luaran-lain.hki-paten.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.luaran-lain.hki-paten.index') }}">
            HKI Paten
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.luaran-lain.hki-hakcipta.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.luaran-lain.hki-hakcipta.index') }}">
            HKI Hak Cipta
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.luaran-lain.teknologi-karya.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.luaran-lain.teknologi-karya.index') }}">
            Teknologi & Karya
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.luaran-lain.buku-chapter.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.luaran-lain.buku-chapter.index') }}">
            Buku & Chapter
        </a>
    </li>
</ul>
