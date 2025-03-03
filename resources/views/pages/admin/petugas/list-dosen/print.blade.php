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
</body>

</html>
