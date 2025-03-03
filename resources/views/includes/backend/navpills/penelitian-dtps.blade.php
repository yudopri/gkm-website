<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.penelitian-dtps.penelitian-mahasiswa.*') ? 'active' : '' }}"
            href="{{ route('admin.penelitian-dtps.penelitian-mahasiswa.index') }}">
            Penelitian Mahasiswa
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.penelitian-dtps.rujukan-tesis.*') ? 'active' : '' }}"
            href="{{ route('admin.penelitian-dtps.rujukan-tesis.index') }}">
            Desertasi
        </a>
    </li>
</ul>
