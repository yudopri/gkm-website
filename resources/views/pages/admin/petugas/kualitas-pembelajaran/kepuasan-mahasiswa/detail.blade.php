@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kualitas Pembelajaran /</span>
            Kepuasan Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 5.C | Kepuasan Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
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
                                    @foreach ($data_dosen->kepuasan_mahasiswa as $kepuasan)
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
                                        <th class="text-center">{{$data_dosen->kepuasan_mahasiswa->sum('tingkat_kepuasan_sangat_baik')}}</th>
                                        <th class="text-center">{{$data_dosen->kepuasan_mahasiswa->sum('tingkat_kepuasan_baik')}}</th>
                                        <th class="text-center">{{$data_dosen->kepuasan_mahasiswa->sum('tingkat_kepuasan_cukup')}}</th>
                                        <th class="text-center">{{$data_dosen->kepuasan_mahasiswa->sum('tingkat_kepuasan_buruk')}}</th>
                                        <th class="text-center"> </th>
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
