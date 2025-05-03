@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Dosen Pembimbing Utama Tugas Akhir
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Dosen Pembimbing Utama Tugas Akhir</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dd.dosen-pembimbing-ta.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="3">No.</th>
                                        <th rowspan="3">Nama Dosen</th>
                                        <th colspan="2" class="text-center">Jumlah Mahasiswa yang Dibimbing</th>

                                        <!-- Aksi -->
                                        <th rowspan="3">Aksi</th>
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
                                    @forelse ($dospem as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->nama_dosen }}</td>
                                            <td class="text-center">{{ $dosen->mhs_bimbingan_ps }}</td>
                                            <td class="text-center">{{ $dosen->mhs_bimbingan_ps_lain }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-pembimbing-ta.edit', ['tahunAjaran' => $tahun_ajaran, 'pembimbingTaId' => $dosen->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-pembimbing-ta.destroy', ['tahunAjaran' => $tahun_ajaran, 'pembimbingTaId' => $dosen->id]) }}"
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
                                            <td class="text-center" colspan="5"> Belum ada data kerjasama </td>
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
