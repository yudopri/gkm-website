<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.rekognisi-dtps.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.rekognisi-dtps.index') }}">
            Rekognisi DTPS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.penelitian-dtps.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.penelitian-dtps.index') }}">
            Penelitian DTPS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.pkm-dtps.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.pkm-dtps.index') }}">
            PkM DTPS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.publikasi-ilmiah.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.publikasi-ilmiah.index') }}">
            Publikasi Ilmiah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.sitasi-karya.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.sitasi-karya.index') }}">
            Sitasi
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kinerja-dosen.produk-teradopsi.*') ? 'active' : '' }}"
            href="{{ route('admin.kinerja-dosen.produk-teradopsi.index') }}">
            Produk/Jasa Teradopsi
        </a>
    </li>
</ul>
