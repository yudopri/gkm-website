<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }

        .section-heading {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 30px;
        }

        .table-container {
            width: 100%;
            margin: 10px 0;
            overflow-x: auto;
            /* Tambahan untuk mencegah overflow */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 8px;
            /* Mengurangi padding untuk menghemat ruang */
            border: 1px solid #ccc;
            text-align: left;
            font-size: 12px;
            word-wrap: break-word;
            /* Membungkus teks yang panjang */
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 13px;
            white-space: nowrap;
            /* Menghindari tumpukan teks pada header */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .text-center {
            text-align: center;
        }

        .text-wrap {
            word-break: break-word;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-size: 11px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Data Laporan GKM</h1>
        <p>Daftar kegiatan kerjasama tridharma dan lembaga mitra</p>
    </div>

    <!-- Tabel Pertama -->
    <div class="table-container">
        <div class="section-heading">Laporan Kerjasama Pendidikan</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">No.</th>
                    <th rowspan="2" class="text-center">Lembaga Mitra</th>
                    <th colspan="3" class="text-center">Tingkat</th>
                    <th rowspan="2" class="text-center">Judul Kegiatan Kerjasama</th>
                    <th rowspan="2" class="text-center">Manfaat bagi PS</th>
                    <th rowspan="2" class="text-center">Waktu dan <br>Durasi</th>
                    <th rowspan="2" class="text-center">Bukti Kerjasama</th>
                    <th rowspan="2" class="text-center">Tahun <br>Berakhirnya <br>Kerjasama <br>(YYYY)</th>
                </tr>
                <tr>
                    <th class="text-center">Internasional</th>
                    <th class="text-center">Nasional</th>
                    <th class="text-center">Wilayah/ <br>Lokal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kerjasama_tridharma_pendidikan as $index => $laporan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $laporan->lembaga_mitra }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'internasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'nasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'lokal' ? 'v' : '' }}</td>
                        <td class="text-wrap">{{ $laporan->judul_kegiatan }}</td>
                        <td class="text-wrap">{!! $laporan->manfaat !!}</td>
                        <td>{{ $laporan->waktu_durasi }}</td>
                        <td class="text-center">
                            <a href="{{ $laporan->bukti_kerjasama }}" target="_blank">Bukti Kerjasama</a>
                        </td>
                        <td class="text-center">{{ $laporan->tahun_berakhir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Kedua -->
    <div class="table-container">
        <div class="section-heading">Laporan Kerjasama Penelitian</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">No.</th>
                    <th rowspan="2" class="text-center">Lembaga Mitra</th>
                    <th colspan="3" class="text-center">Tingkat</th>
                    <th rowspan="2" class="text-center">Judul Kegiatan Kerjasama</th>
                    <th rowspan="2" class="text-center">Manfaat bagi PS</th>
                    <th rowspan="2" class="text-center">Waktu dan <br>Durasi</th>
                    <th rowspan="2" class="text-center">Bukti Kerjasama</th>
                    <th rowspan="2" class="text-center">Tahun <br>Berakhirnya <br>Kerjasama <br>(YYYY)</th>
                </tr>
                <tr>
                    <th class="text-center">Internasional</th>
                    <th class="text-center">Nasional</th>
                    <th class="text-center">Wilayah/ <br>Lokal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kerjasama_tridharma_penelitian as $index => $laporan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $laporan->lembaga_mitra }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'internasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'nasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'lokal' ? 'v' : '' }}</td>
                        <td class="text-wrap">{{ $laporan->judul_kegiatan }}</td>
                        <td class="text-wrap">{!! $laporan->manfaat !!}</td>
                        <td>{{ $laporan->waktu_durasi }}</td>
                        <td class="text-center">
                            <a href="{{ $laporan->bukti_kerjasama }}" target="_blank">Bukti Kerjasama</a>
                        </td>
                        <td class="text-center">{{ $laporan->tahun_berakhir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Ketiga -->
    <div class="table-container">
        <div class="section-heading">Laporan Kerjasama Pengabdian Masyarakat</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">No.</th>
                    <th rowspan="2" class="text-center">Lembaga Mitra</th>
                    <th colspan="3" class="text-center">Tingkat</th>
                    <th rowspan="2" class="text-center">Judul Kegiatan Kerjasama</th>
                    <th rowspan="2" class="text-center">Manfaat bagi PS</th>
                    <th rowspan="2" class="text-center">Waktu dan <br>Durasi</th>
                    <th rowspan="2" class="text-center">Bukti Kerjasama</th>
                    <th rowspan="2" class="text-center">Tahun <br>Berakhirnya <br>Kerjasama <br>(YYYY)</th>
                </tr>
                <tr>
                    <th class="text-center">Internasional</th>
                    <th class="text-center">Nasional</th>
                    <th class="text-center">Wilayah/ <br>Lokal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kerjasama_tridharma_pengmas as $index => $laporan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $laporan->lembaga_mitra }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'internasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'nasional' ? 'v' : '' }}</td>
                        <td class="text-center">{{ $laporan->tingkat === 'lokal' ? 'v' : '' }}</td>
                        <td class="text-wrap">{{ $laporan->judul_kegiatan }}</td>
                        <td class="text-wrap">{!! $laporan->manfaat !!}</td>
                        <td>{{ $laporan->waktu_durasi }}</td>
                        <td class="text-center">
                            <a href="{{ $laporan->bukti_kerjasama }}" target="_blank">Bukti Kerjasama</a>
                        </td>
                        <td class="text-center">{{ $laporan->tahun_berakhir }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Keempat -->
    <div class="table-container">
        <div class="section-heading">Laporan Seleksi Mahasiswa Baru</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Tahun Akademik</th>
                    <th rowspan="2">Daya Tampung</th>
                    <th colspan="2" class="text-center">Jumlah Calon Mahasiswa</th>
                    <th colspan="2" class="text-center">Jumlah Mahasiswa Baru</th>
                    <th colspan="2" class="text-center">Jumlah Mahasiswa Aktif</th>
                </tr>
                <tr>
                    <th class="text-center">Pendaftar</th>
                    <th class="text-center">Lulus Seleksi</th>
                    <th class="text-center">Reguler</th>
                    <th class="text-center">Transfer <sup>*)</sup></th>
                    <th class="text-center">Reguler</th>
                    <th class="text-center">Transfer <sup>*)</sup></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data->seleksi_maba as $index => $seleksi)
                    <tr>
                        <td class="text-center">{{ $seleksi->tahun_akademik }}</td>
                        <td class="text-center">{{ $seleksi->daya_tampung }}</td>
                        <td class="text-center">{{ $seleksi->pendaftar }}</td>
                        <td class="text-center">{{ $seleksi->lulus_seleksi }}</td>
                        <td class="text-center">{{ $seleksi->maba_reguler }}</td>
                        <td class="text-center">{{ $seleksi->maba_transfer }}</td>
                        <td class="text-center">{{ $seleksi->mhs_aktif_reguler }}</td>
                        <td class="text-center">{{ $seleksi->mhs_aktif_transfer }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="11"> Belum ada data seleksi mahasiswa </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="table-border-bottom-0">
                <tr>
                    <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center">{{ $total->total_pendaftar ?? 0 }}</th>
                    <th class="text-center">{{ $total->total_lulus_seleksi ?? 0 }}</th>
                    <th class="text-center">{{ $total->total_maba_reguler ?? 0 }}</th>
                    <th class="text-center">{{ $total->total_maba_transfer ?? 0 }}</th>
                    <th colspan="2" class="text-center">{{ $total->total_mhs_aktif ?? 0 }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Tabel Kelima -->
    <div class="table-container">
        <div class="section-heading">Laporan Mahasiswa Asing</div>
        <table>
            <thead>
                <tr>
                    <th>Jumlah Mahasiswa Aktif</th>
                    <th>
                        Jumlah Mahasiswa Asing <br> Penuh Waktu (Full-time)
                    </th>
                    <th>
                        Jumlah Mahasiswa Asing <br> Paruh Waktu (Part-time)
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data->mahasiswa_asing as $index => $mhs)
                    <tr>
                        <td class="text-center">{{ $mhs->mhs_aktif }}</td>
                        <td class="text-center">{{ $mhs->mhs_asing_fulltime }}</td>
                        <td class="text-center">{{ $mhs->mhs_asing_parttime }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="4"> Belum ada data mahasiswa asing </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Keenam -->
     <div class="table-container">
        <div class="section-heading">Laporan Dosen Tetap</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Dosen</th>
                    <th rowspan="2">NIDN/NIDK</th>
                    <th colspan="2" class="text-center">Pendidikan Pasca Sarjana</th>
                    <th rowspan="2">Bidang Keahlian</th>
                    <th rowspan="2">
                        Kesesuaian <br>dengan <br>Kompetensi Inti <br>PS
                    </th>
                    <th rowspan="2">
                        Jabatan <br>Akademik
                    </th>
                    <th rowspan="2">
                        Sertifikat <br>Pendidik <br>Profesional
                    </th>
                    <th rowspan="2">
                        Sertifikat <br>Kompetensi/ <br>Profesi/ <br>Industri
                    </th>
                    <th rowspan="2">
                        Mata Kuliah yang <br>Diampu pada PS
                    </th>
                    <th rowspan="2">
                        Kesesuaian <br>Bidang <br>Keahlian <br>dengan Mata <br>Kuliah yang <br>Diampu
                    </th>
                    <th rowspan="2">
                        Mata Kuliah <br>yang Diampu <br>pada PS Lain
                    </th>
                </tr>
                <tr>
                    <th class="text-center">Magister/ <br>Magister Terapan/ <br>Spesialis</th>
                    <th class="text-center">Doktor/ <br>Doktor Terapan/ <br>Spesialis</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->dosen_tetap as $index => $dosen)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nama_dosen }}</td>
                        <td>{{ $dosen->nidn_nidk }}</td>
                        <td class="text-wrap">{{ $dosen->gelar_magister }}</td>
                        <td class="text-wrap">{{ $dosen->gelar_doktor }}</td>
                        <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                        <td class="text-center">{{ $dosen->kesesuaian_kompetensi ? '✓' : '' }}</td>
                        <td class="text-center">{{ $dosen->jabatan_akademik }}</td>
                        <td class="text-center text-wrap">{{ $dosen->sertifikat_pendidik }}</td>
                        <td class="text-center text-wrap">{{ $dosen->sertifikat_kompetensi }}</td>
                        <td>{!! $dosen->mk_diampu !!}</td>
                        <td class="text-center">{{ $dosen->kesesuaian_keahlian_mk ? '✓' : '' }}</td>
                        <td>{!! $dosen->mk_ps_lain !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Ketujuh -->
    <div class="table-container">
        <div class="section-heading">Laporan Dosen Tidak Tetap</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen</th>
                    <th>NIDN/NIDK</th>
                    <th>Pendidikan <br>Pasca Sarjana</th>
                    <th>Bidang <br>Keahlian</th>
                    <th>Jabatan <br>Akademik</th>
                    <th>Sertifikat <br>Pendidik <br>Profesional</th>
                    <th>Sertifikat <br>Kompetensi/ <br>Profesi/ <br>Industri</th>
                    <th>Mata Kuliah yang <br>Diampu pada PS</th>
                    <th>Kesesuaian <br>Bidang Keahlian <br>dengan Mata <br>Kuliah yang <br>Diampu</th>

                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->dosen_tidak_tetap as $index => $dosen)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nama_dosen }}</td>
                        <td>{{ $dosen->nidn_nidk }}</td>
                        <td class="text-wrap">{{ $dosen->pendidikan_pascasarjana }}</td>
                        <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                        <td class="text-wrap">{{ $dosen->jabatan_akademik }}</td>
                        <td class="text-wrap">{{ $dosen->sertifikat_pendidik }}</td>
                        <td class="text-wrap">{{ $dosen->sertifikat_kompetensi }}</td>
                        <td>{!! $dosen->mk_diampu !!}</td>
                        <td class="text-center">{{ $dosen->kesesuaian_keahlian_mk ? '✓' : '' }}</td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="12"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Kedelapan -->
    <div class="table-container">
        <div class="section-heading">Laporan Dosen Pembimbing TA</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="3">No.</th>
                    <th rowspan="3">Nama Dosen</th>
                    <th colspan="2" class="text-center">Jumlah Mahasiswa yang Dibimbing</th>

                </tr>
                <tr>
                    <th class="text-center">pada PS</th>
                    <th class="text-center">pada PS Lain di POLIJE</th>
                </tr>
                <tr>
                    <th class="text-center">TS</th>
                    <th class="text-center">TS</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->dosen_pembimbing_ta as $index => $dosen)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nama_dosen }}</td>
                        <td class="text-center">{{ $dosen->mhs_bimbingan_ps }}</td>
                        <td class="text-center">{{ $dosen->mhs_bimbingan_ps_lain }}</td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="5"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Kesembilan -->
    <div class="table-container">
        <div class="section-heading">Laporan EWMP Dosen</div>
        <table>
            <thead >
                <tr>
                    <th rowspan="3">No.</th>
                    <th rowspan="3">Nama Dosen (DT)</th>
                    <th rowspan="3">DTPS</th>
                    <th colspan="6" class="text-center">
                        Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam <br>
                        satuan kredit semester (sks)
                    </th>
                    <th rowspan="3">Jumlah <br>(sks)</th>
                    <th rowspan="3">
                        Rata-rata <br>per <br>Semester <br>(sks)
                    </th>
                </tr>
                <tr>
                    <th colspan="3" class="text-center">Pendidikan: <br>Pembelajaran dan Pembimbingan</th>
                    <th rowspan="2" class="text-center">Penelitian</th>
                    <th rowspan="2" class="text-center">PkM</th>
                    <th rowspan="2" class="text-center">Tugas <br>Tambahan <br>dan/atau <br>Penunjang</th>
                </tr>
                <tr>
                    <th class="text-center">PS yang <br>Diakreditasi</th>
                    <th class="text-center">PS Lain di <br>dalam PT</th>
                    <th class="text-center">PS Lain di <br>luar PT</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->ewmp_dosen as $index => $ewmp)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $ewmp->nama_dosen }}</td>
                        <td class="text-center">{{ $ewmp->is_dtps ? '✓' : '' }}</td>
                        <td class="text-center">{{ Number::format($ewmp->ps_diakreditasi ?? 0, locale: 'id') }}</td>
                        <td class="text-center">{{ Number::format($ewmp->ps_lain_dalam_pt ?? 0, locale: 'id') == 0 ? '' : '' }}</td>
                        <td class="text-center">{{ Number::format($ewmp->ps_lain_luar_pt ?? 0, locale: 'id') == 0 ? '' : '' }}</td>
                        <td class="text-center">{{ Number::format($ewmp->penelitian ?? 0, locale: 'id') }}</td>
                        <td class="text-center">{{ Number::format($ewmp->pkm ?? 0, locale: 'id') }}</td>
                        <td class="text-center">{{ Number::format($ewmp->tugas_tambahan ?? 0, locale: 'id') }}</td>
                        <td class="text-center">{{ Number::format($ewmp->jumlah_sks ?? 0, locale: 'id') }}</td>
                        <td class="text-center">{{ Number::format($ewmp->avg_per_semester ?? 0, locale: 'id') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="12"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Kesepuluh -->
    <div class="table-container">
        <div class="section-heading">Laporan Dosen Praktisi</div>
        <table>
            <thead >
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen <br>Industri/Praktisi</th>
                    <th>NIDK</th>
                    <th>Perusahaan/ <br>Industri</th>
                    <th>Pendidikan <br>Tertinggi</th>
                    <th>Bidang <br>Keahlian</th>
                    <th>Sertifikat <br>Profesi/ <br>Kompetensi/ <br>Industri</th>
                    <th>Mata Kuliah <br>yang Diampu</th>
                    <th>Bobot <br>Kredit (sks)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->dosen_praktisi as $index => $dosen)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $dosen->nama_dosen }}</td>
                        <td>{{ $dosen->nidk }}</td>
                        <td>{{ $dosen->perusahaan }}</td>
                        <td class="text-center">{{ $dosen->pendidikan_tertinggi }}</td>
                        <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                        <td>{!! $dosen->sertifikat_kompetensi !!}</td>
                        <td>{!! $dosen->mk_diampu !!}</td>
                        <td class="text-center">{{ $dosen->bobot_kredit_sks }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Kesebelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Rekognisi Dtps Dosen</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Dosen</th>
                    <th rowspan="2">Bidang Keahlian</th>
                    <th rowspan="2">Rekognisi dan <br>Bukti Pendukung</th>
                    <th colspan="3" class="text-center">Tingkat</th>
                    <th rowspan="2">Tahun <br>(YYYY)</th>
                </tr>
                <tr>
                    <th class="text-center">Wilayah</th>
                    <th class="text-center">Nasional</th>
                    <th class="text-center">Internasional</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data->rekognisi_dtps as $rekognisi)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $rekognisi->nama_dosen }}</td>
                        <td class="text-wrap">{{ $rekognisi->bidang_keahlian }}</td>
                        <td class="text-wrap">
                            <a href="{{ $rekognisi->bukti_pendukung }}">{{ $rekognisi->nama_rekognisi }}</a>
                        </td>
                        <td class="text-center">{{ $rekognisi->tingkat == 'lokal' ? '✓' : '' }}</td>
                        <td class="text-center">{{ $rekognisi->tingkat == 'nasional' ? '✓' : '' }}</td>
                        <td class="text-center">{{ $rekognisi->tingkat == 'internasional' ? '✓' : '' }}</td>
                        <td class="text-center">{{ $rekognisi->tahun }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Tabel Keduabelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Penelitian Dtps Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Sumber Pembiayaan</th>
                    <th>Jumlah Judul Penelitian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @php
$sumberDana = [
'lokal' => "a. Perguruan Tinggi (POLIJE) \n b. Mandiri",

'nasional' => "Lembaga Dalam Negeri (Diluar Polije)",

'internasional' => "Lembaga Luar Negeri"
];
@endphp

                @foreach ($data->penelitian_dtps as $index => $penelitian)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $sumberDana[$penelitian->sumber_dana] ?? '-' }}</td>
                        <td class="text-center">{{ number_format($penelitian->jumlah_judul ?? 0) }}</td>
                    </tr>
                @endforeach
                @if($penelitian_dtps->isEmpty())
                    <tr>
                        <td class="text-center" colspan="4">Belum ada data penelitian</td>
                    </tr>
                @endif
            </tbody>
            <tfoot class="table-border-bottom-0">
                <tr>
                    <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center">{{ number_format($penelitian->sum('jumlah_judul')) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel Ketigabelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Pkm Dtps Dosen</div>
        <table>
            <thead>
                <tr>
                        <th>No.</th>
                        <th>Sumber Pembiayaan</th>
                        <th>Jumlah Judul PKM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php
                    $sumberDana = [
                        'lokal' => "a. Perguruan Tinggi (POLIJE) \n b. Mandiri",

                        'nasional' => "Lembaga Dalam Negeri (Diluar Polije)",

                        'internasional' => "Lembaga Luar Negeri"
                    ];
                @endphp


                @foreach ($data->pkm_dtps as $index => $pkm)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $sumberDana[$pkm->sumber_dana] ?? '-' }}</td>
                    <td class="text-center">{{ number_format($pkm->jumlah_judul ?? 0) }}</td>
                </tr>
            @endforeach

                    @if($data->pkm_dtps->isEmpty())
                        <tr>
                            <td class="text-center" colspan="4">Belum ada data pkm</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot class="table-border-bottom-0">
                    <tr>
                        <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                        <th class="text-center">{{ number_format($pkm->sum('jumlah_judul')) }}</th>
                        <th class="rounded-end-bottom">Aksi</th>
                    </tr>
                </tfoot>
        </table>
    </div>
    <!-- Tabel Keempatbelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Produk Teradopsi Dosen</div>
        <table>
            <thead>

                <tr>
                    <th>No.</th>
                    <th>Nama Dosen</th>
                    <th>Nama Produk/Jasa</th>
                    <th>Deskripsi <br>Poduk/Jasa</th>
                    <th>Bukti</th>
                    <th>Tahun <br>(YYYY/YYYY)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($data->produk_teradopsi as $index => $produk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td> {{ $produk->nama_dosen}} </td>
                    <td> {{ $produk->nama_produk}} </td>
                    <td> {{ $produk->deskripsi_produk}} </td>
                    <td> {{ $produk->bukti}}</td>
                    <td> {{ $produk->tahun}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel Kelimabelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Publikasi Ilmiah Dosen</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Judul Artikel</th>
                    <th rowspan="2">Jenis Publikasi</th>
                    <th rowspan="2">Tahun <br>(YYYY)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($data->publikasi_ilmiah as $publik)
<tr>
<td class="text-center">{{ $loop->iteration }}</td>
<td>{{ $publik->judul_artikel }}</td> <!-- Iteration counter -->
<td>{{ $publik->jenis_artikel }}</td><!-- Display the count -->
<td>{{ $publik->tahun }}</td>
</tr>
@endforeach
            </tbody>
            <tfoot class="table-border-bottom-0">
                <tr>
                    <th colspan="3" class="rounded-start-bottom">Jumlah Judul</th>
                    <th class="text-center">{{ $publik->count('judul_artikel')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel Keenambelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Sitasi Karya Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen</th>
                    <th>Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman)</th>
                    <th>Jumlah Sitasi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->sitasi_karya_dosen as $sitasi)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td>{{ $sitasi->nama_dosen }}</td>
                        <td class="text-wrap">{{ $sitasi->judul_artikel }}</td>
                        <td class="text-center">{{ $sitasi->jumlah_sitasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel Ketujuhbelas -->
    <div class="table-container">
        <div class="section-heading">Laporan HKI (Paten) Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">z
                <tr>
                    <td class="text-center fw-bold">I</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        HKI: a) Paten, b) Paten Sederhana
                    </td>
                </tr>
                @foreach ($data->hki_paten_dosen as $paten)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $paten->luaran_penelitian }}</td>
                        <td class="text-center">{{ $paten->tahun }}</td>
                        <td class="text-wrap">{{ $paten->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel Kedelapanbelas -->
    <div class="table-container">
        <div class="section-heading">Laporan HKI (Hak Cipta) Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">II</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                        Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                        Sirkuit Terpadu, e) dll.)
                    </td>
                </tr>
                <tr>
                    @foreach ($data->hki_cipta_dosen as $hkicipta)
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $hkicipta->luaran_penelitian }}</td>
                        <td class="text-center">{{ $hkicipta->tahun }}</td>
                        <td class="text-wrap">{{ $hkicipta->keterangan }}</td>
                </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel Kesembilanbelas -->
    <div class="table-container">
        <div class="section-heading">Laporan Teknologi Karya Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">III</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial
                    </td>
                </tr>
                @foreach ($data->teknologi_karya_dosen as $karya)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $karya->luaran_penelitian }}</td>
                        <td class="text-center">{{ $karya->tahun }}</td>
                        <td class="text-wrap">{{ $karya->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluh -->
    <div class="table-container">
        <div class="section-heading">Laporan Buku Chapter Dosen</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">IV</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        Buku ber-ISBN, <i>Book Chapter</i>
                    </td>
                </tr>
                @foreach ($data->buku_chapter_dosen as $book)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $book->luaran_penelitian }}</td>
                        <td class="text-center">{{ $book->tahun }}</td>
                        <td class="text-wrap">{{ $book->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluhSatu -->
    <div class="table-container">
        <div class="section-heading">Laporan IPK Lulusan</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Tahun Lulus</th>
                    <th rowspan="2">Jumlah <br>Lulusan</th>
                    <th colspan="3">Indeks Prestasi Kumulatif</th>
                </tr>
                <tr>
                    <th>Min</th>
                    <th>Rata-rata</th>
                    <th>Maks</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->ipk_lulusan as $ipk)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $ipk->tahun }}</td>
                        <td class="text-center">{{ $ipk->jumlah_lulusan }}</td>
                        <td class="text-center">{{ $ipk->ipk_minimal }}</td>
                        <td class="text-center">{{ $ipk->ipk_rata_rata }}</td>
                        <td class="text-center">{{ $ipk->ipk_maksimal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluhDua -->
    <div class="table-container">
        <div class="section-heading">Laporan Masa Studi Lulusan</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Masa Studi</th>
                    <th rowspan="2">Tahun <br>Masuk</th>
                    <th rowspan="2">Jumlah <br>Mahasiswa <br>Diterima</th>
                    <th colspan="4">Jumlah Mahasiswa yang lulus pada</th>
                    <th rowspan="2">Jumlah <br>Lulusan s.d. <br>akhir TS</th>
                    <th rowspan="2">Rata-rata <br>Masa Studi</th>
                </tr>
                <tr>
                    <th>akhir TS-3</th>
                    <th>akhir TS-2</th>
                    <th>akhir TS-1</th>
                    <th>akhir TS</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->masa_studi_lulusan as $data)
                <tr>
                    <td class="text-center">{{ $data->masa_studi }}</td>
                    <td class="text-center">{{ $data->tahun }}</td>
                    <td class="text-center">{{ $data->jumlah_mhs_diterima }}</td>
                    <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_3 }}</td>
                    <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_2 }}</td>
                    <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_1 }}</td>
                    <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan }}</td>
                    <td class="text-center">{{ $data->mean_masa_studi }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluhTiga -->
    <div class="table-container">
        <div class="section-heading">Laporan Prestasi Akademik</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Kegiatan</th>
                    <th colspan="3">Tingkat</th>
                    <th rowspan="2">Prestasi yang Dicapai</th>
                </tr>
                <tr>
                    <th>Lokal/ <br>Wilayah</th>
                    <th>Nasional</th>
                    <th>Internasional</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->prestasi_akademik as $akademik)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $akademik->nama_kegiatan }}</td>
                        <td class="text-center">
                            @if ($akademik->tingkat == 'lokal') ✓ @endif
                        </td>
                        <td class="text-center">
                            @if ($akademik->tingkat == 'nasional') ✓ @endif
                        </td>
                        <td class="text-center">
                            @if ($akademik->tingkat == 'internasional') ✓ @endif
                        </td>

                        <td class="text-wrap">{{ $akademik->prestasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluhEmpat -->
    <div class="table-container">
        <div class="section-heading">Laporan Prestasi Nonakademik</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Kegiatan</th>
                    <th colspan="3">Tingkat</th>
                    <th rowspan="2">Prestasi yang Dicapai</th>
                </tr>
                <tr>
                    <th>Lokal/ <br>Wilayah</th>
                    <th>Nasional</th>
                    <th>Internasional</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->prestasi_nonakademik as $nonakademik)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-wrap">{{ $nonakademik->nama_kegiatan }}</td>
                    <td class="text-center">
                        @if ($nonakademik->tingkat == 'lokal') ✓ @endif
                    </td>
                    <td class="text-center">
                        @if ($nonakademik->tingkat == 'nasional') ✓ @endif
                    </td>
                    <td class="text-center">
                        @if ($nonakademik->tingkat == 'internasional') ✓ @endif
                    </td>

                    <td class="text-wrap">{{ $nonakademik->prestasi }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel KeduaPuluhLima -->
    <div class="table-container">
        <div class="section-heading">Laporan Evaluasi Kepuasan Pengguna</div>
        <table>
            <thead>
                <tr>
                    <th>Tahun Lulus</th>
                    <th>Jumlah Lulusan</th>
                    <th>Jumlah Tanggapan <br>Kepuasan Pengguna <br>yang Terlacak</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->eval_kepuasan_pengguna as $pengguna)
                    <tr>
                        <td class="text-center">{{ $pengguna->tahun }}</td>
                        <td class="text-center">{{ $pengguna->jumlah_lulusan }}</td>
                        <td class="text-center">{{ $pengguna->jumlah_responden }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-border-bottom-0 table-secondary">
                <tr>
                    <th class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center">
                        {{ $data->eval_kepuasan_pengguna->sum('jumlah_lulusan') }}
                    </th>
                    <th class="text-center">
                        {{ $data->eval_kepuasan_pengguna->sum('jumlah_responden') }}
                    </th>
                </tr>
            </tfoot>
    </div>
    <!-- Tabel KeduaPuluhEnam -->
    <div class="table-container">
        <div class="section-heading">Laporan Evaluasi Kesesuaian Kerja</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Tahun <br>Lulus</th>
                    <th rowspan="2">Jumlah Lulusan</th>
                    <th rowspan="2">Jumlah Lulusan <br>yang Terlacak</th>
                    <th colspan="3">Jumlah lulusan Terlacak dengan Tingkat Keseuaian <br>Bidang Kerja</th>
                </tr>
                <tr>
                    <th>Rendah</th>
                    <th>Sedang</th>
                    <th>Tinggi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->eval_kesesuaian_kerja as $data)
                @php
                    $persentase = $data->jumlah_lulusan_terlacak > 0
                        ? ($data->jumlah_lulusan_bekerja / $data->jumlah_lulusan_terlacak) * 100
                        : 0;

                    $sangat_sesuai = $persentase >= 70;
                    $sesuai = $persentase >= 40 && $persentase < 70;
                    $kurang_sesuai = $persentase < 40;
                @endphp

                <tr>
                    <td class="text-center">{{ $data->tahun }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan_terlacak }}</td>

                    <!-- Kategori: Sangat Sesuai -->
                    <td class="text-center">
                        @if ($kurang_sesuai)
                            ✓
                        @endif

                    </td>

                    <!-- Kategori: Sesuai -->
                    <td class="text-center">
                        @if ($sesuai)
                            ✓
                        @endif
                    </td>

                    <!-- Kategori: Kurang Sesuai -->
                    <td class="text-center">
                        @if ($sangat_sesuai)
                        ✓
                    @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot class="table-border-bottom-0 table-secondary">
                <tr>
                    <th class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center">{{$data->eval_kesesuaian_kerja->sum('jumlah_lulusan')}}</th>
                    <th class="text-center">{{$data->eval_kesesuaian_kerja->sum('jumlah_lulusan_terlacak')}}</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel KeduaPuluhTujuh -->
    <div class="table-container">
        <div class="section-heading">Laporan Evaluasi Tempat Kerja</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Tahun <br>Lulus</th>
                    <th rowspan="2">Jumlah Lulusan</th>
                    <th rowspan="2">Jumlah Lulusan <br>yang Terlacak</th>
                    <th colspan="3">
                        Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/Ukuran <br>
                        Tempat Kerja/Berwirausaha
                    </th>
                </tr>
                <tr>
                    <th>Lokal/ Wilayah/ <br>Berwirausaha tidak <br>Berbadan Hukum</th>
                    <th>Nasional/ <br>Berwirausaha <br>Berbadan Hukum</th>
                    <th>Multinasional/ <br>Internasional</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->eval_tempat_kerja as $data)
                <tr>
                    <td class="text-center">{{$data->tahun}}</td>
                    <td class="text-center">{{$data->jumlah_lulusan}} </td>
                    <td class="text-center">{{$data->jumlah_lulusan_terlacak}} </td>
                    <td class="text-center">{{$data->jumlah_lulusan_bekerja_lokal}} </td>
                    <td class="text-center">{{$data->jumlah_lulusan_bekerja_nasional}} </td>
                    <td class="text-center">{{$data->jumlah_lulusan_bekerja_internasional}} </td>
                </tr>

                @endforeach
            </tbody>
            <tfoot class="table-border-bottom-0 table-secondary">
                <tr>
                    <th class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center">{{$tempat_kerja->sum('jumlah_lulusan')}}</th>
                    <th class="text-center">{{$tempat_kerja->sum('jumlah_lulusan_terlacak')}}</th>
                    <th class="text-center">{{$tempat_kerja->sum('jumlah_lulusan_bekerja_lokal')}}</th>
                    <th class="text-center">{{$tempat_kerja->sum('jumlah_lulusan_bekerja_nasional')}}</th>
                    <th class="text-center">{{$tempat_kerja->sum('jumlah_lulusan_bekerja_internasional')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel KeduaPuluhDelapan -->
    <div class="table-container">
        <div class="section-heading">Laporan Evaluasi Waktu Tunggu</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Masa Studi</th>
                    <th rowspan="2">Tahun <br>Lulus</th>
                    <th rowspan="2">Jumlah Lulusan</th>
                    <th rowspan="2">Jumlah Lulusan <br>yang Terlacak</th>
                    <th colspan="3">Jumlah Lulusan Terlacak dengan Waktu Tunggu <br>Mendapatkan Pekerjaan</th>
                </tr>
                <tr>
                    <th>WT < 3 bulan</th>
                    <th>3 ≤ WT ≤ 6 bulan</th>
                    <th>WT > 6 bulan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->eval_waktu_tunggu as $data)
                <tr>
                    <td class="text-center">{{ $data->masa_studi }}</td>
                    <td class="text-center">{{ $data->tahun }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan_terlacak }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan_waktu_tiga_bulan }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan_waktu_enam_bulan }}</td>
                    <td class="text-center">{{ $data->jumlah_lulusan_waktu_sembilan_bulan }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="table-border-bottom-0 table-secondary">
                <tr>
                    <th class="rounded-start-bottom">Jumlah</th>
                    <th class="text-center"></th>
                    <th class="text-center">{{$data->eval_waktu_tunggu->sum('jumlah_lulusan')}}</th>
                    <th class="text-center">{{$data->eval_waktu_tunggu->sum('jumlah_lulusan_terlacak')}}</th>
                    <th class="text-center">{{$data->eval_waktu_tunggu->sum('jumlah_lulusan_waktu_tiga_bulan')}}</th>
                    <th class="text-center">{{$data->eval_waktu_tunggu->sum('jumlah_lulusan_waktu_enam_bulan')}}</th>
                    <th class="text-center">{{$data->eval_waktu_tunggu->sum('jumlah_lulusan_waktu_sembilan_bulan')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel KeduaPuluhSembilan -->
    <div class="table-container">
        <div class="section-heading">Laporan Integrasi Penelitian</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul <br>Penelitian/PkM</th>
                    <th>Nama Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Bentuk Integrasi</th>
                    <th>Tahun <br>(YYYY)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->integrasi_penelitian as $penelitian)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $penelitian->judul_penelitian }}</td>
                        <td class="text-wrap">{{ $penelitian->nama_dosen }}</td>
                        <td class="text-wrap">{{ $penelitian->mata_kuliah }}</td>
                        <td class="text-wrap">{{ $penelitian->bentuk_integrasi }}</td>
                        <td class="text-center">{{ $penelitian->tahun }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Tabel TigaPuluh -->
    <div class="table-container">
        <div class="section-heading">Laporan Kepuasan Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Aspek yang Diukur</th>
                    <th colspan="4">Tingkat Kepuasan Mahasiswa <br>(%)</th>
                    <th rowspan="2">Rencana Tindak Lanjut oleh UPPS/PS</th>
                </tr>
                <tr>
                    <th>Sangat Baik</th>
                    <th>Baik</th>
                    <th>Cukup</th>
                    <th>Kurang</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->kepuasan_mahasiswa as $kepuasan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $kepuasan->aspek_penilaian }}</td>
                        <td class="text-center">{{ $kepuasan->tingkat_kepuasan_sangat_baik }}</td>
                        <td class="text-center">{{ $kepuasan->tingkat_kepuasan_baik }}</td>
                        <td class="text-center">{{ $kepuasan->tingkat_kepuasan_cukup }}</td>
                        <td class="text-center">{{ $kepuasan->tingkat_kepuasan_kurang }}</td>
                        <td class="text-wrap">{{ $kepuasan->rencana_tindakan }}</td>

                @endforeach
            </tbody>
            <tfoot class="table-border-bottom-0 table-secondary">
                <tr>
                    <th class="rounded-start-bottom"> </th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-center">{{$data->kepuasan_mahasiswa->sum('tingkat_kepuasan_sangat_baik')}}</th>
                    <th class="text-center">{{$data->kepuasan_mahasiswa->sum('tingkat_kepuasan_baik')}}</th>
                    <th class="text-center">{{$data->kepuasan_mahasiswa->sum('tingkat_kepuasan_cukup')}}</th>
                    <th class="text-center">{{$data->kepuasan_mahasiswa->sum('tingkat_kepuasan_buruk')}}</th>
                    <th class="text-center"> </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- Tabel TigaPuluhSatu -->
    <div class="table-container">
        <div class="section-heading">Laporan Kurikulum Pembelajaran</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Semester</th>
                    <th rowspan="2">Kode Mata <br>Kuliah</th>
                    <th rowspan="2">Nama Mata Kuliah</th>
                    <th rowspan="2">Mata <br>Kuliah <br>Kom- <br>petensi</th>
                    <th colspan="3">Bobot Kredit (sks)</th>
                    <th rowspan="2">Konversi <br>Kredit ke <br>Jam</th>
                    <th colspan="4">Capaian Pembelajaran</th>
                    <th rowspan="2">Dokumen <br>Rencana <br>Pembela- <br>jaran</th>
                    <th rowspan="2">Unit <br>Penyeleng- <br>gara</th>
                </tr>
                <tr>
                    <th>Kuliah/ <br>Responsi/ <br>Tutorial</th>
                    <th>Seminar</th>
                    <th>Praktikum/ <br>Praktik/ <br>Praktik <br>Lapangan</th>
                    <th>Sikap</th>
                    <th>Pengeta- <br>huan</th>
                    <th>Keteram- <br>pilan <br>Umum</th>
                    <th>Keteram- <br>pilan <br>Khusus</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->kurikulum_pembelajaran as $kurikulum)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $kurikulum->semester }}</td>
                        <td class="text-center">{{ $kurikulum->kode_mata_kuliah }}</td>
                        <td>{{ $kurikulum->nama_mata_kuliah }}</td>
                        <td class="text-center">{{ $kurikulum->mata_kuliah_kompetensi ? '✓' : ''}}</td>
                        <td class="text-center">{{ $kurikulum->sks_kuliah }}</td>
                        <td class="text-center">{{ $kurikulum->sks_seminar }}</td>
                        <td class="text-center">{{ $kurikulum->sks_praktikum }}</td>
                        <td class="text-center">{{ $kurikulum->konversi_sks }}</td>
                        <td class="text-center">{{ $kurikulum->capaian_kuliah_sikap ? '✓' : '' }}</td>
                        <td class="text-center">{{ $kurikulum->capaian_kuliah_pengetahuan ? '✓' : '' }}</td>
                        <td class="text-center">{{ $kurikulum->capaian_kuliah_keterampilan_umum ? '✓' : '' }}</td>
                        <td class="text-center">{{ $kurikulum->capaian_kuliah_keterampilan_khusus ? '✓' : '' }}</td>
                        <td class="text-center">{{ $kurikulum->dokumen }}</td>
                        <td class="text-center">{{ $kurikulum->unit_penyelenggara }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhDua -->
    <div class="table-container">
        <div class="section-heading">Laporan Penelitian Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen</th>
                    <th>Tema Penelitian <br>sesuai Roadmap</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Kegiatan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->penelitian_mahasiswa as $penelitian)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $penelitian->nama_dosen }}</td>
                        <td class="text-wrap">{{ $penelitian->tema_penelitian }}</td>
                        <td class="text-wrap">{{ $penelitian->nama_mahasiswa }}</td>
                        <td class="text-wrap">{{ $penelitian->judul }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhTiga -->
    <div class="table-container">
        <div class="section-heading">Laporan Rujukan Tesis Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Dosen</th>
                    <th>Tema Penelitian <br>sesuai Roadmap</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul <br>Tesis/Disertasi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->rujukan_tesis_mahasiswa as $rujukan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-wrap">{{ $rujukan->nama_dosen }}</td>
                        <td class="text-wrap">{{ $rujukan->tema_penelitian }}</td>
                        <td class="text-wrap">{{ $rujukan->nama_mahasiswa }}</td>
                        <td class="text-wrap">{{ $rujukan->judul }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhEmpat -->
    <div class="table-container">
        <div class="section-heading">Laporan PKM Dtps Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tema PkM sesuai <br>Roadmap</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Kegiatan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->pkm_dtps_mahasiswa as $pkm)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-wrap">{{ $pkm->tema }}</td>
                    <td class="text-wrap">{{ $pkm->nama_mhs }}</td>
                    <td class="text-wrap">{{ $pkm->judul }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhLima -->
    <div class="table-container">
        <div class="section-heading">Laporan Produk Jasa Mahasiswa</div>
        <table>
            <thead>

                <tr>
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Produk/Jasa</th>
                    <th>Deskripsi <br>Poduk/Jasa</th>
                    <th>Bukti</th>
                    <th>Tahun <br>(YYYY)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($data->produk_jasa_mahasiswa as $index => $produk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td> {{ $produk->nama_mahasiswa}} </td>
                    <td> {{ $produk->nama_produk}} </td>
                    <td> {{ $produk->deskripsi_produk}} </td>
                    <td> {{ $produk->bukti}}</td>
                    <td> {{ $produk->tahun}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhEnam -->
    <div class="table-container">
        <div class="section-heading">Laporan Publikasi Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Judul Artikel</th>
                    <th rowspan="2">Jenis Publikasi</th>
                    <th rowspan="2">Tahun <br>(YYYY)</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($data->publikasi_mahasiswa as $publik)
<tr>
<td class="text-center">{{ $loop->iteration }}</td>
<td>{{ $publik->judul_artikel }}</td> <!-- Iteration counter -->
<td>{{ $publik->jenis_artikel }}</td><!-- Display the count -->
<td>{{ $publik->tahun }}</td>
</tr>
@endforeach
            </tbody>
            <tfoot class="table-border-bottom-0">
                <tr>
                    <th colspan="3" class="rounded-start-bottom">Jumlah Judul</th>
                    <th class="text-center">{{ $data->publikasi_mahasiswa->count('judul_artikel')}}</th>
                    <th class="rounded-end-bottom">Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- TigaPuluhTujuh -->
    <div class="table-container">
        <div class="section-heading">Laporan Sitasi Karya Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman)</th>
                    <th>Jumlah Sitasi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($data->sitasi_karya_mahasiswa as $sitasi)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td>{{ $sitasi->nama_mahasiswa }}</td>
                        <td class="text-wrap">{{ $sitasi->judul_artikel }}</td>
                        <td class="text-center">{{ $sitasi->jumlah_sitasi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhDelapan -->
    <div class="table-container">
        <div class="section-heading">Laporan HKI (Paten) Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">z
                <tr>
                    <td class="text-center fw-bold">I</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        HKI: a) Paten, b) Paten Sederhana
                    </td>
                </tr>
                @foreach ($data->hki_paten_mahasiswa as $paten)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $paten->luaran_penelitian }}</td>
                        <td class="text-center">{{ $paten->tahun }}</td>
                        <td class="text-wrap">{{ $paten->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- TigaPuluhSembilan -->
    <div class="table-container">
        <div class="section-heading">Laporan HKI (Hak Cipta) Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">II</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                        Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                        Sirkuit Terpadu, e) dll.)
                    </td>
                </tr>
                <tr>
                    @foreach ($data->hki_cipta_mahasiswa as $hkicipta)
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $hkicipta->luaran_penelitian }}</td>
                        <td class="text-center">{{ $hkicipta->tahun }}</td>
                        <td class="text-wrap">{{ $hkicipta->keterangan }}</td>
                </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    <!-- EmpatPuluh -->
    <div class="table-container">
        <div class="section-heading">Laporan Teknologi Karya Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">III</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial
                    </td>
                </tr>
                @foreach ($data->teknologi_karya_mahasiswa as $karya)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $karya->luaran_penelitian }}</td>
                        <td class="text-center">{{ $karya->tahun }}</td>
                        <td class="text-wrap">{{ $karya->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- EmpatPuluhSatu -->
    <div class="table-container">
        <div class="section-heading">Laporan Buku Chapter Mahasiswa</div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Luaran Penelitian dan PkM</th>
                    <th>Tahun <br>(YYYY)</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td class="text-center fw-bold">IV</td>
                    <td class="text-wrap fw-bold" colspan="4">
                        Buku ber-ISBN, <i>Book Chapter</i>
                    </td>
                </tr>
                @foreach ($data->buku_chapter_mahasiswa as $book)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                        <td class="text-wrap">{{ $book->luaran_penelitian }}</td>
                        <td class="text-center">{{ $book->tahun }}</td>
                        <td class="text-wrap">{{ $book->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
