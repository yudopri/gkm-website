@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Dosen Pembimbing Utama Tugas Akhir
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Dosen Pembimbing Utama Tugas Akhir</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
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
                                    @forelse ($data_dosen->dosen_pembimbing_ta as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->nama_dosen }}</td>
                                            <td class="text-center">{{ $dosen->mhs_bimbingan_ps }}</td>
                                            <td class="text-center">{{ $dosen->mhs_bimbingan_ps_lain }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> Belum ada data kerjasama </td>
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
