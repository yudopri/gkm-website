@extends('layouts.dosen')

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

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
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
                                        <tr>
                                            <td class="text-center">TS-2</td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
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
                                            <th rowspan="2">Rata-rata <br>Masa Studi</th>

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
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
                                        <tr>
                                            <td class="text-center">TS-2</td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
                                            <td class="text-center"> </td>
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
                                            <th rowspan="2">Rata-rata <br>Masa Studi</th>

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>akhir TS-3</th>
                                            <th>akhir TS-2</th>
                                            <th>akhir TS-1</th>
                                            <th>akhir TS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center">TS-1</td>
                                            <td class="text-center"> </td>
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
