@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Tempat Kerja Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 8.E.1 | Tempat Kerja Lulusan</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s  tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">Tahun <br>Lulus</th>
                                        <th rowspan="2">Jumlah Lulusan</th>
                                        <th rowspan="2">Jumlah Lulusan <br>yang Terlacak</th>
                                        <th colspan="3">
                                            Jumlah Lulusan Terlacak yang Bekerja Berdasarkan Tingkat/Ukuran <br>
                                            Tempat Kerja/Berwirausaha
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Lokal/ Wilayah/ <br>Berwirausaha tidak <br>Berbadan Hukum</th>
                                        <th>Nasional/ <br>Berwirausaha <br>Berbadan Hukum</th>
                                        <th>Multinasional/ <br>Internasional</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->eval_tempat_kerja as $data)
                                    <tr>
                                        <td class="text-center">{{$data->tahun}}</td>
                                        <td class="text-center">{{$data->jumlah_lulusan}} </td>
                                        <td class="text-center">{{$data->jumlah_lulusan_terlacak}} </td>
                                        <td class="text-center">{{$data->jumlah_lulusan_bekerja_lokal}} </td>
                                        <td class="text-center">{{$data->jumlah_lulusan_bekerja_nasional}} </td>
                                        <td class="text-center">{{$data->jumlah_lulusan_bekerja_internasional}} </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                                <tfoot class="table-border-bottom-0 table-secondary">
                                    <tr>
                                        <th class="rounded-start-bottom">Jumlah</th>
                                        <th class="text-center">{{$data_dosen->eval_tempat_kerja->sum('jumlah_lulusan')}}</th>
                                        <th class="text-center">{{$data_dosen->eval_tempat_kerja->sum('jumlah_lulusan_terlacak')}}</th>
                                        <th class="text-center">{{$data_dosen->eval_tempat_kerja->sum('jumlah_lulusan_bekerja_lokal')}}</th>
                                        <th class="text-center">{{$data_dosen->eval_tempat_kerja->sum('jumlah_lulusan_bekerja_nasional')}}</th>
                                        <th class="text-center">{{$data_dosen->eval_tempat_kerja->sum('jumlah_lulusan_bekerja_internasional')}}</th>
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
