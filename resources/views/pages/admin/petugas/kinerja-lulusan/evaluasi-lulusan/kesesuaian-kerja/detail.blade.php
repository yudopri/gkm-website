@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Kesesuaian Bidang Kerja Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 8.D.2 | Kesesuaian Bidang Kerja Lulusan</h5>
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
                                        <th colspan="3">Jumlah lulusan Terlacak dengan Tingkat Keseuaian <br>Bidang Kerja</th>
                                    </tr>
                                    <tr>
                                        <th>Rendah</th>
                                        <th>Sedang</th>
                                        <th>Tinggi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->eval_kesesuaian_kerja as $data)
                                    @php
                                        $persentase = $data->jumlah_lulusan_terlacak > 0
                                            ? ($data->jumlah_lulusan_bekerja / $data->jumlah_lulusan_terlacak) * 100
                                            : 0;

                                        $sangat_sesuai = $persentase >= 70;
                                        $sesuai = $persentase >= 40 && $persentase < 70;
                                        $kurang_sesuai = $persentase < 40;
                                    @endphp

                                    <tr>
                                        <td class="text-center">{{ $data->tahun }}</td>
                                        <td class="text-center">{{ $data->jumlah_lulusan }}</td>
                                        <td class="text-center">{{ $data->jumlah_lulusan_terlacak }}</td>

                                        <!-- Kategori: Sangat Sesuai -->
                                        <td class="text-center">
                                            @if ($kurang_sesuai)
                                                ✓
                                            @endif

                                        </td>

                                        <!-- Kategori: Sesuai -->
                                        <td class="text-center">
                                            @if ($sesuai)
                                                ✓
                                            @endif
                                        </td>

                                        <!-- Kategori: Kurang Sesuai -->
                                        <td class="text-center">
                                            @if ($sangat_sesuai)
                                            ✓
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot class="table-border-bottom-0 table-secondary">
                                    <tr>
                                        <th class="rounded-start-bottom">Jumlah</th>
                                        <th class="text-center">{{$data_dosen->eval_kesesuaian_kerja->sum('jumlah_lulusan')}}</th>
                                        <th class="text-center">{{$data_dosen->eval_kesesuaian_kerja->sum('jumlah_lulusan_terlacak')}}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
                                        <th class="text-center"></th>
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
