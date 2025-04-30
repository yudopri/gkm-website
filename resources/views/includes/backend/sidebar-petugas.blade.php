<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('backend/img/logo/logo-polije.png') }}" width="40" alt="logo-polije" />
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

        <!-- #s 1. kerjasama tridharma -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kt.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Kerjasama Tridharma">Kerjasama Tridharma</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kt.pendidikan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kt.pendidikan.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Pendidikan">Pendidikan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kt.penelitian.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kt.penelitian.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Penelitian">Penelitian</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kt.pengabdian-masyarakat.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kt.pengabdian-masyarakat.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Pengabdian Masyarakat">Pengabdian Masyarakat</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- #e 1. kerjasama tridharma -->

        <!-- #s 2. mahasiswa -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dm.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Data Mahasiswa">Data Mahasiswa</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dm.seleksi-maba.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dm.seleksi-maba.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Seleksi Mahasiswa">Seleksi Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dm.mahasiswa-asing.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dm.mahasiswa-asing.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Mahasiswa Asing">Mahasiswa Asing</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- #e 2. mahasiswa -->

        <!-- #s 3.a data dosen -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Data Dosen">Data Dosen</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.dosen-tetap.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dd.dosen-tetap.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Dosen Tetap PT">Dosen Tetap PT</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.dosen-pembimbing-ta.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dd.dosen-pembimbing-ta.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Pembimbing TA">Pembimbing TA</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.ewmp-dosen.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dd.ewmp-dosen.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="EWMP Dosen">EWMP Dosen</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.dosen-tidak-tetap.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dd.dosen-tidak-tetap.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Dosen Tidak Tetap">Dosen Tidak Tetap</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dd.dosen-praktisi.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.dd.dosen-praktisi.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Dosen Industri/Praktisi">Dosen Industri/Praktisi</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- #e 3.a dosen -->

        <!-- #s 3.b kinerja dosen -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Kinerja Dosen">Kinerja Dosen</div>
            </a>
            <ul class="menu-sub">
            <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.rekognisi-dtps.*') ? 'active' : '' }}">
    <a href="{{ route('admin.petugas.detail.kd.rekognisi-dtps.show', $dosenId) }}" class="menu-link">
        <div data-i18n="Pengakuan/Rekognisi Dosen">Pengakuan/Rekognisi Dosen</div>
    </a>
</li>

                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.penelitian-dtps.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kd.penelitian-dtps.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Penelitian DTPS">Penelitian DTPS</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.pkm-dtps.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kd.pkm-dtps.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="PkM DTPS">PkM DTPS</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.publikasi-ilmiah.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kd.publikasi-ilmiah.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Publikasi & Pagelaran Ilmiah">Publikasi & Pagelaran Ilmiah</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.sitasi-karya.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kd.sitasi-karya.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Sitasi Karya Ilmiah">Sitasi Karya Ilmiah</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.produk-teradopsi.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kd.produk-teradopsi.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Produk/Jasa Teradopsi">Produk/Jasa Teradopsi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.luaran-lain.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Luaran Penelitian Lain">Luaran Penelitian Lain</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.luaran-lain.hki-paten.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kd.luaran-lain.hki-paten.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="HKI (Paten)">HKI (Paten)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.luaran-lain.hki-hakcipta.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kd.luaran-lain.hki-hakcipta.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="HKI (Hak Cipta)">HKI (Hak Cipta)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.luaran-lain.teknologi-karya.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kd.luaran-lain.teknologi-karya.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Teknologi & Karya">Teknologi & Karya</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kd.luaran-lain.buku-chapter.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kd.luaran-lain.buku-chapter.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Buku & Chapter">Buku & Chapter</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- #e 3.b kinerja dosen -->

        <!-- #s 5. kualitas pembelajaran -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kpl.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Kualitas Pembelajaran">Kualitas Pembelajaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kpl.kurikulum-pembelajaran.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kpl.kurikulum-pembelajaran.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Kurikulum & Pembelajaran">Kurikulum & Pembelajaran</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kpl.integrasi-penelitian.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kpl.integrasi-penelitian.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Integrasi Penelitian">Integrasi Penelitian</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kpl.kepuasan-mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kpl.kepuasan-mahasiswa.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Kepuasan Mahasiswa">Kepuasan Mahasiswa</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- #e 5. kualitas pembelajaran -->

        <!-- #s 6. penelitian DTPS -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.pdtps.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Penelitian DTPS">Penelitian DTPS</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.pdtps.penelitian-mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.pdtps.penelitian-mahasiswa.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Penelitian Mahasiswa">Penelitian Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.pdtps.rujukan-tesis.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.pdtps.rujukan-tesis.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Rujukan Tesis/Disertasi">Rujukan Tesis/Disertasi</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- #e 6. penelitian DTPS -->

        <!-- #s 7. PkM DTPS Mahasiswa -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.dtpsm.pkm-dtps-mahasiswa.*') ? 'active' : '' }}">
            <a href="{{ route('admin.petugas.detail.dtpsm.pkm-dtps-mahasiswa.show', $dosenId) }}" class="menu-link">
                <div data-i18n="PkM DTPS Mahasiswa">PkM DTPS Mahasiswa</div>
            </a>
        </li>
        <!-- #e 7. PkM DTPS Mahasiswa -->

        <!-- #s 8. kinerja lulusan -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Kinerja Lulusan">Kinerja Lulusan</div>
            </a>
            <ul class="menu-sub">
                <!-- 8.a -->
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.ipk-lulusan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kl.ipk-lulusan.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="IPK Lulusan">IPK Lulusan</div>
                    </a>
                </li>
                <!-- 8.b -->
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.prestasi-mahasiswa.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Prestasi Mahasiswa">Prestasi Mahasiswa</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.prestasi-mahasiswa.akademik.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.prestasi-mahasiswa.akademik.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Akademik">Akademik</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.prestasi-mahasiswa.nonakademik.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.prestasi-mahasiswa.nonakademik.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Non-akademik">Non-akademik</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- 8.c -->
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.masa-studi-lulusan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.kl.masa-studi-lulusan.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Masa Studi Lulusan">Masa Studi Lulusan</div>
                    </a>
                </li>
                <!-- 8.d 8.e -->
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.evaluasi-lulusan.*') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Evaluasi Lulusan">Evaluasi Lulusan</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.evaluasi-lulusan.waktu-tunggu.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.evaluasi-lulusan.waktu-tunggu.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Waktu Tunggu">Waktu Tunggu</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.evaluasi-lulusan.kesesuaian-kerja.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.evaluasi-lulusan.kesesuaian-kerja.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Kesesuaian Kerja">Kesesuaian Kerja</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.evaluasi-lulusan.tempat-kerja.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.evaluasi-lulusan.tempat-kerja.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Tempat Kerja">Tempat Kerja</div>
                            </a>
                        </li>
                        <li
                            class="menu-item {{ request()->routeIs('admin.petugas.detail.kl.evaluasi-lulusan.kepuasan-pengguna.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.kl.evaluasi-lulusan.kepuasan-pengguna.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Kepuasan Pengguna">Kepuasan Pengguna</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- #e 8. kinerja lulusan -->

        <!-- #s 8.f -->
        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Luaran Karya Mahasiswa">Luaran Karya Mahasiswa</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.publikasi-mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.lm.publikasi-mahasiswa.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Publikasi Mahasiswa">Publikasi Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.sitasi-karya-mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.lm.sitasi-karya-mahasiswa.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Sitasi Karya Mahasiswa">Sitasi Karya Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.produk-jasa-mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.petugas.detail.lm.produk-jasa-mahasiswa.show', $dosenId) }}" class="menu-link">
                        <div data-i18n="Produk/Jasa Mahasiswa">Produk/Jasa Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.luaran-lain.*') ? 'active open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Luaran Mahasiswa Lainnya">Luaran Mahasiswa Lainnya</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.luaran-lain.hki-paten-mahasiswa.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.lm.luaran-lain.hki-paten-mahasiswa.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="HKI Mahasiswa (Paten)">HKI Mahasiswa (Paten)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.luaran-lain.hki-hakcipta-mahasiswa.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.lm.luaran-lain.hki-hakcipta-mahasiswa.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="HKI Mahasiswa (Hak Cipta)">HKI Mahasiswa (Hak Cipta)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.luaran-lain.teknologi-karya-mahasiswa.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.lm.luaran-lain.teknologi-karya-mahasiswa.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Teknologi & Karya Mahasiswa">Teknologi & Karya Mahasiswa</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->routeIs('admin.petugas.detail.lm.luaran-lain.buku-chapter-mahasiswa.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.petugas.detail.lm.luaran-lain.buku-chapter-mahasiswa.show', $dosenId) }}" class="menu-link">
                                <div data-i18n="Buku & Chapter Mahasiswa">Buku & Chapter Mahasiswa</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- #e 8.f -->

    </ul>
</aside>
