@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Kepuasan Pengguna Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.kinerja-lulusan')
                <!-- #e navpills -->

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

                                            <!-- Aksi -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td class="text-center">TS-2</td>
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

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <!-- 1. etika -->
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-wrap">Etika</td>
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

                                        <!-- 2. Keahlian pada bidang ilmu (kompetensi utama) -->
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="text-wrap">Keahlian pada bidang ilmu (kompetensi utama)</td>
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

                                        <!-- 3. Kemampuan berbahasa asing -->
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="text-wrap">Kemampuan berbahasa asing</td>
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

                                        <!-- 4. Penggunaan teknologi informasi -->
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="text-wrap">Penggunaan teknologi informasi</td>
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

                                        <!-- 5. Kemampuan berkomunikasi -->
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="text-wrap">Kemampuan berkomunikasi</td>
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

                                        <!-- 6. Kerjasama -->
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="text-wrap">Kerjasama</td>
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

                                        <!-- 7. Pengembangan diri -->
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="text-wrap">Pengembangan diri</td>
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
                                            <th class="rounded-start-bottom"> </th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center"> </th>
                                            <th class="text-center"> </th>
                                            <th class="text-center"> </th>
                                            <th class="text-center"> </th>
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
                <!-- #e tabel-8e2 -->
            </div>
        </div>
    </div>
@endsection
