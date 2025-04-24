@extends('layouts.dosen')

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

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>WT < 3 bulan</th>
                                            <th>3 ≤ WT ≤ 6 bulan</th>
                                            <th>WT > 6 bulan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center">TS-2</td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom">Jumlah</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="rounded-end-bottom">Aksi</th>
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

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>WT < 3 bulan</th>
                                            <th>3 ≤ WT ≤ 6 bulan</th>
                                            <th>WT > 6 bulan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center">TS-2</td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom">Jumlah</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="text-center">0</th>
                                            <th class="rounded-end-bottom">Aksi</th>
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
