@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            Seleksi Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-mahasiswa')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Seleksi Mahasiswa Baru</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dm.seleksi-maba.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">Tahun Akademik</th>
                                        <th rowspan="2">Daya Tampung</th>
                                        <th colspan="2" class="text-center">Jumlah Calon Mahasiswa</th>
                                        <th colspan="2" class="text-center">Jumlah Mahasiswa Baru</th>
                                        <th colspan="2" class="text-center">Jumlah Mahasiswa Aktif</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
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
                                    @forelse ($seleksi_maba as $seleksi)
                                        <tr>
                                            <td class="text-center">{{ $seleksi->tahun_akademik }}</td>
                                            <td class="text-center">{{ $seleksi->daya_tampung }}</td>
                                            <td class="text-center">{{ $seleksi->pendaftar }}</td>
                                            <td class="text-center">{{ $seleksi->lulus_seleksi }}</td>
                                            <td class="text-center">{{ $seleksi->maba_reguler }}</td>
                                            <td class="text-center">{{ $seleksi->maba_transfer }}</td>
                                            <td class="text-center">{{ $seleksi->mhs_aktif_reguler }}</td>
                                            <td class="text-center">{{ $seleksi->mhs_aktif_transfer }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dm.seleksi-maba.edit', ['tahunAjaran' => $tahun_ajaran, 'seleksiMabaId' => $seleksi->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dm.seleksi-maba.destroy', ['tahunAjaran' => $tahun_ajaran, 'seleksiMabaId' => $seleksi->id]) }}"
                                                            data-confirm-delete="true">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
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
                                        <th class="rounded-end-bottom">Aksi</th>
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
