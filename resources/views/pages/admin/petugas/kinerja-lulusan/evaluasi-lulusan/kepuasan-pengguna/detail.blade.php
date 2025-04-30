@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Kepuasan Pengguna Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">\
                <!--#s tabel-ref-8e2 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#tabel-ref-8e2" role="button" aria-expanded="false"
                        aria-controls="tabel-ref-8e2">
                        Tabel Referensi 8.E.2 | Kepuasan Pengguna Lulusan
                    </h5>

                    <div class="collapse show" id="tabel-ref-8e2">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!--#s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Tahun Lulus</th>
                                            <th>Jumlah Lulusan</th>
                                            <th>Jumlah Tanggapan <br>Kepuasan Pengguna <br>yang Terlacak</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->eval_kepuasan_pengguna as $pengguna)
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
                                                {{ $data_dosen->eval_kepuasan_pengguna->sum('jumlah_lulusan') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $data_dosen->eval_kepuasan_pengguna->sum('jumlah_responden') }}
                                            </th>
                                            <th class="rounded-end-bottom">Aksi</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e tabel-ref-8e2 -->

                <!--#s tabel-8e2 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#tabel-8e2" role="button" aria-expanded="false" aria-controls="tabel-8e2">
                        Tabel 8.E.2 | Kepuasan Pengguna Lulusan
                    </h5>

                    <div class="collapse show" id="tabel-8e2">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!--#s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Jenis Kemampuan</th>
                                            <th colspan="4">Tingkat Kepuasan Pengguna <br>(%)</th>
                                            <th rowspan="2">Rencana Tindak Lanjut <br>oleh UPPS/PS</th>
                                        </tr>
                                        <tr>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($data_dosen->eval_kepuasan_pengguna as $pengguna)
                                        <tr>
                                            <td class="text-center">{{$loop->iteration}}</td>
                                            <td class="text-wrap">{{ $pengguna->jenis_kemampuan}}</td>
                                            <td class="text-center"> {{ $pengguna->tingkat_kepuasan_sangat_baik}}</td>
                                            <td class="text-center"> {{ $pengguna->tingkat_kepuasan_baik}}</td>
                                            <td class="text-center"> {{ $pengguna->tingkat_kepuasan_cukup}}</td>
                                            <td class="text-center"> {{ $pengguna->tingkat_kepuasan_kurang}}</td>
                                            <td class="text-center"> {{ $pengguna->rencana_tindakan}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom"> </th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">{{$data_dosen->eval_kepuasan_pengguna->sum('tingkat_kepuasan_sangat_baik')}}</th>
                                            <th class="text-center">{{$data_dosen->eval_kepuasan_pengguna->sum('tingkat_kepuasan_baik')}} </th>
                                            <th class="text-center">{{$data_dosen->eval_kepuasan_pengguna->sum('tingkat_kepuasan_cukup')}} </th>
                                            <th class="text-center">{{$data_dosen->eval_kepuasan_pengguna->sum('tingkat_kepuasan_kurang')}} </th>
                                            <th class="text-center"></th>
                                            <th class="rounded-end-bottom">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e tabel-8e2 -->
            </div>
        </div>
    </div>
@endsection
