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
            <li class="menu-item {{ request()->routeIs('admin.petugas.list-dosen.*') ? 'active open' : '' }}">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Grafik</div>
                    </a>
    <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
           <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Kerjasama Tridharma</div>
            </a>
         <ul class="menu-sub">
              <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kerjasama-tridharma.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kerjasama-tridharma.pendidikan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Pendidikan</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kerjasama-tridharma.penelitian.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Penelitian</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kerjasama-tridharma.pengabdian_masyarakat.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Pengabdian Masyarakat</div>
                    </a>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Data Mahasiswa</div>
            </a>
        <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-mahasiswa.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-mahasiswa.seleksi_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Seleksi Mahasiswa</div>
            </a>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-mahasiswa.mahasiswa_asing.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Mahasiswa Asing</div>
                    </a>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Data Dosen</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.dosenTetap_pt.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Dosen Tetap PT</div>
            </a>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.dospem_ta.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Pembimbing TA</div>
            </a>
                        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.ewmp_dosen.index') }}" class="menu-link">
                <div data-i18n="List Dosen">EWMP Dosen </div>
            </a>
            </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.dosen_tidak_tetap.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Dosen Tidak Tetap</div>
            </a>
             </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.data-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.data-dosen.dosen_praktisi.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Dosen Industri/Praktisi</div>
                    </a>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Kinerja Dosen</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.pengakuan_dosen.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Pengakuan/Rekognisi Dosen</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.penelitian_dtps.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Penelitian DTPS </div>
            </a>
            </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.pkm_dtps.index') }}" class="menu-link">
                <div data-i18n="List Dosen">PkM DTPS</div>
            </a>
             </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.publikasi_ilmiah.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Publikasi & Pagelaran Ilmiah</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.sitasi_dosen.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Sitasi Karya Ilmiah</div>
            </a>
            </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.produk_jasa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Produk/Jasa Teradopsi</div>
                    </a>
             </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Luaran Penelitian Lain</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.hki_paten.index') }}" class="menu-link">
                <div data-i18n="List Dosen">HKI (Paten)</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.hki_cipta.index') }}" class="menu-link">
                <div data-i18n="List Dosen">HKI (Hak Cipta)</div>
            </a>
            </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.teknologi_karya.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Teknologi & Karya</div>
            </a>
             </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-dosen.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-dosen.buku_chapter.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Buku & Chapter</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Kualitas Pembelajaran</div>
            </a>
        <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kualitas-pembelajaran.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kualitas-pembelajaran.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kualitas-pembelajaran.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kualitas-pembelajaran.kurikulum_pembelajaran.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Kurikulum & Pembelajaran</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kualitas-pembelajaran.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kualitas-pembelajaran.integrasi_penelitian.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Integrasi Penelitian</div>
            </a>
            </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kualitas-pembelajaran.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kualitas-pembelajaran.kepuasan_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Kepuasan Mahasiswa</div>
                    </a>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Penelitian DTPS</div>
            </a>
        <ul class="menu-sub">
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.penelitian-dtps.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.penelitian-dtps.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
                    </a>
                </li>
             <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.penelitian-dtps.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.penelitian-dtps.penelitian_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Penelitian Mahasiswa</div>
                    </a>
                </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.penelitian-dtps.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.penelitian-dtps.rujukan_tesis.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Rujukan Tesis/Disertasi</div>
                    </a>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">PkM DTPS Mahasiswa</div>
                    </a>
            <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.pkm-dtps-mhs.gabungan.index') }}" class="menu-link"> 
                <div data-i18n="List Dosen">Gabungan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.pkm-dtps-mhs.index') }}" class="menu-link"> 
                <div data-i18n="List Dosen">PkM DTPS Mahasiswa</div>
                    </a>
                </li>

            </ul>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Kinerja Lulusan</div>
            </a>
        <ul class="menu-sub">
         <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.ipk_lulusan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">IPK Kelulusan</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Prestasi Mahasiswa</div>
            </a>
                    <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.akademik.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Akademik</div>
            </a>
                        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.non_akademik.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Non-Akdemik</div>
            </a>
            </li>
                    </ul></li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.masa_studi.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Masa Studi Lulusan</div>
            </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Evaluasi Lulusan</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.waktu_tunggu.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Waktu Tunggu</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.kesesuaian_kerja.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Kesesuaian Kerja</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.tempat_kerja.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Tempat Kerja</div>
                    </a>
            </li>
                                <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.kinerja-lulusan.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.kinerja-lulusan.kepuasan_pengguna.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Kepuasan Pengguna</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Luaran Karya Mahasiswa</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.gabungan.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Gabungan</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.publikasi_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Publikasi Mahasiswa</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.sitasi_karya.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Sitasi Karya Mahasiwa</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.produk_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Produk/Jasa Mahasiswa</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.kerjasama-tridharma.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="List Dosen">Luaran Mahasiswa Lainnya</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
             <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.hki_paten.index') }}" class="menu-link">
                <div data-i18n="List Dosen">HKI Mahasiswa (Paten)</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.hki_cipta.index') }}" class="menu-link">
                <div data-i18n="List Dosen">HKI Mahasiswa (Hak Cipta)</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.teknologi_karya.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Teknologi & Karya Mahasiswa</div>
            </a>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.petugas.grafik.luaran-karya-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.grafik.luaran-karya-mahasiswa.buku_chapter_mahasiswa.index') }}" class="menu-link">
                <div data-i18n="List Dosen">Buku & Chapter Mahasiswa</div>
                    </a>
                </li>
            </ul>
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
