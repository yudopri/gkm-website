@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Tempat Kerja Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.kinerja-lulusan')
                <!-- #e navpills -->

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

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Lokal/ Wilayah/ <br>Berwirausaha tidak <br>Berbadan Hukum</th>
                                        <th>Nasional/ <br>Berwirausaha <br>Berbadan Hukum</th>
                                        <th>Multinasional/ <br>Internasional</th>
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
        </div>
    </div>
@endsection
