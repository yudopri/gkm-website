@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Waktu Tunggu Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s waktu-tunggu-d3 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#waktu-tunggu-d3" role="button" aria-expanded="false"
                        aria-controls="waktu-tunggu-d3">
                        Tabel 8.D.1 | Waktu Tunggu Lulusan - Diploma Tiga
                    </h5>

                    <div class="collapse show" id="waktu-tunggu-d3">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- #s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">Tahun <br>Lulus</th>
                                            <th rowspan="2">Jumlah Lulusan</th>
                                            <th rowspan="2">Jumlah Lulusan <br>yang Terlacak</th>
                                            <th rowspan="2">Jumlah Lulusan <br>yang Dipesan <br>Sebelum Lulus</th>
                                            <th colspan="3">Jumlah Lulusan Terlacak dengan Waktu Tunggu <br>Mendapatkan Pekerjaan</th>
                                        </tr>
                                        <tr>
                                            <th>WT < 3 bulan</th>
                                            <th>3 ≤ WT ≤ 6 bulan</th>
                                            <th>WT > 6 bulan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga') as $data)
                                            <tr>
                                                <td class="text-center">{{ $data->tahun }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan_terlacak }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan_terlacak_dipesan }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan_waktu_tiga_bulan }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan_waktu_enam_bulan }}</td>
                                                <td class="text-center">{{ $data->jumlah_lulusan_waktu_sembilan_bulan }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom">Jumlah</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan_terlacak')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan_terlacak_dipesan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan_waktu_tiga_bulan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan_waktu_enam_bulan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Diploma Tiga')->sum('jumlah_lulusan_waktu_sembilan_bulan')}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e waktu-tunggu-d3 -->

                <!-- #s waktu-tunggu-d4 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#waktu-tunggu-d4" role="button" aria-expanded="false"
                        aria-controls="waktu-tunggu-d4">
                        Tabel 8.D.1 | Waktu Tunggu Lulusan - Sarjana Terapan
                    </h5>

                    <div class="collapse show" id="waktu-tunggu-d4">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- #s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
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
                                        @foreach ($data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan') as $data)
                                        <tr>
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
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan_terlacak')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan_terlacak_dipesan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan_waktu_tiga_bulan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan_waktu_enam_bulan')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_waktu_tunggu->where('masa_studi', 'Sarjana/Sarjana Terapan')->sum('jumlah_lulusan_waktu_sembilan_bulan')}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e waktu-tunggu-d4 -->
            </div>
        </div>
    </div>
@endsection
