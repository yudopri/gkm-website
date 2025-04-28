@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            Pengakuan/Rekognisi DTPS
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Pengakuan/Rekognisi DTPS</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Dosen</th>
                                        <th rowspan="2">Bidang Keahlian</th>
                                        <th rowspan="2">Rekognisi dan <br>Bukti Pendukung</th>
                                        <th colspan="3" class="text-center">Tingkat</th>
                                        <th rowspan="2">Tahun <br>(YYYY)</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Wilayah</th>
                                        <th class="text-center">Nasional</th>
                                        <th class="text-center">Internasional</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data_dosen->rekognisi_dtps as $rekognisi)
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

                                            <!-- Aksi -->
                                            <td>
                                                <div class="dropdown">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- #e tabel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
