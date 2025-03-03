@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            <span class="text-muted fw-light">Seleksi Mahasiswa /</span>
            {{ $data_dosen->profile->nama }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel Seleksi Mahasiswa Baru</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap mb-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
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
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data_dosen->seleksi_maba as $seleksi)
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
                        <!-- #e tabel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
