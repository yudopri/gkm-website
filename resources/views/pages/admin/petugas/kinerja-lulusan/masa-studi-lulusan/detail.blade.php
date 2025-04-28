@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            Masa Studi Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s masa-studi-d3 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#masa-studi-d3" role="button" aria-expanded="false"
                        aria-controls="masa-studi-d3">
                        Tabel 8.C | Masa Studi Lulusan - Diploma Tiga
                    </h5>

                    <div class="collapse show" id="masa-studi-d3">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- #s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">Tahun <br>Masuk</th>
                                            <th rowspan="2">Jumlah <br>Mahasiswa <br>Diterima</th>
                                            <th colspan="5">Jumlah Mahasiswa yang lulus pada</th>
                                            <th rowspan="2">Jumlah <br>Lulusan s.d. <br>akhir TS</th>
                                            <th rowspan="2">Rata-rata <br>Masa Studi</th>
                                        </tr>
                                        <tr>
                                            <th>akhir TS-4</th>
                                            <th>akhir TS-3</th>
                                            <th>akhir TS-2</th>
                                            <th>akhir TS-1</th>
                                            <th>akhir TS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->masa_studi_lulusan->where('masa_studi','Diploma Tiga') as $data)
                                            <tr>
                                                <td class="text-center">{{ $data->tahun }}</td>
                                                <td class="text-center">{{ $data->jumlah_mhs_diterima }}</td>
                                                <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_4 }}</td>
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
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e masa-studi-d3 -->

                <!-- #s masa-studi-d4 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#masa-studi-d4" role="button" aria-expanded="false"
                        aria-controls="masa-studi-d4">
                        Tabel 8.C | Masa Studi Lulusan - Sarjana/Sarjana Terapan
                    </h5>

                    <div class="collapse show" id="masa-studi-d4">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- #s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">Tahun <br>Masuk</th>
                                            <th rowspan="2">Jumlah <br>Mahasiswa <br>Diterima</th>
                                            <th colspan="7">Jumlah Mahasiswa yang lulus pada</th>
                                            <th rowspan="2">Jumlah <br>Lulusan s.d. <br>akhir TS</th>
                                            <th rowspan="2">Rata-rata <br>Masa Studi</th>\
                                        </tr>
                                        <tr>
                                            <th>akhir TS-6</th>
                                            <th>akhir TS-5</th>
                                            <th>akhir TS-4</th>
                                            <th>akhir TS-3</th>
                                            <th>akhir TS-2</th>
                                            <th>akhir TS-1</th>
                                            <th>akhir TS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->masa_studi_lulusan->where('masa_studi','Sarjana/Sarjana Terapan') as $data)
                                        <tr>
                                            <td class="text-center">{{ $data->tahun }}</td>
                                            <td class="text-center">{{ $data->jumlah_mhs_diterima }}</td>
                                            <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_6 }}</td>
                                            <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_5 }}</td>
                                            <td class="text-center">{{ $data->jumlah_mhs_lulus_akhir_ts_4 }}</td>
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
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e masa-studi-d4 -->

                <!-- #s masa-studi-s2 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#masa-studi-s2" role="button" aria-expanded="false"
                        aria-controls="masa-studi-s2">
                        Tabel 8.C | Masa Studi Lulusan - Magister/Magister Terapan
                    </h5>

                    <div class="collapse show" id="masa-studi-s2">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!-- #s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">Tahun <br>Masuk</th>
                                            <th rowspan="2">Jumlah <br>Mahasiswa <br>Diterima</th>
                                            <th colspan="4">Jumlah Mahasiswa yang lulus pada</th>
                                            <th rowspan="2">Jumlah <br>Lulusan s.d. <br>akhir TS</th>
                                            <th rowspan="2">Rata-rata <br>Masa Studi</th>\
                                        </tr>
                                        <tr>
                                            <th>akhir TS-3</th>
                                            <th>akhir TS-2</th>
                                            <th>akhir TS-1</th>
                                            <th>akhir TS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->masa_studi_lulusan->where('masa_studi','Magister/Magister Terapan') as $data)
                                        <tr>
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
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e masa-studi-s2 -->
            </div>
        </div>
    </div>
@endsection
