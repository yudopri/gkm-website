<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kualitas-pembelajaran.kurikulum-pembelajaran.*') ? 'active' : '' }}"
            href="{{ route('admin.kualitas-pembelajaran.kurikulum-pembelajaran.index') }}">
            Kurikulum Pembelajaran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kualitas-pembelajaran.integrasi-penelitian.*') ? 'active' : '' }}"
            href="{{ route('admin.kualitas-pembelajaran.integrasi-penelitian.index') }}">
            Integrasi Penelitian
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.kualitas-pembelajaran.kepuasan-mahasiswa.*') ? 'active' : '' }}"
            href="{{ route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.index') }}">
            Kepuasan Mahasiswa
        </a>
    </li>
</ul>
