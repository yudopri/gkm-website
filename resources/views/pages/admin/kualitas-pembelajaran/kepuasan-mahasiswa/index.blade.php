@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kualitas Pembelajaran /</span>
            Kepuasan Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.kualitas-pembelajaran')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 5.C | Kepuasan Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.create') }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Aspek yang Diukur</th>
                                        <th colspan="4">Tingkat Kepuasan Mahasiswa <br>(%)</th>
                                        <th rowspan="2">Rencana Tindak Lanjut oleh UPPS/PS</th>

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
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-wrap">
                                            Keandalan (reliability): kemampuan dosen, tenaga kependidikan, dan pengelola dalam
                                            memberikan pelayanan.
                                        </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-wrap">
                                            Mempertahankan dan meningkatkan kemampuan dosen dengan mengikuti pelatihan-pelatihan, dan
                                            meningkatkan kualitas tanaga pendidik dalam memberikan pelayanan kepada mahasiswa
                                        </td>

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
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-wrap">
                                            Daya tanggap (responsiveness): kemauan dari dosen, tenaga kependidikan, dan pengelola
                                            dalam membantu mahasiswa dan memberikan jasa dengan cepat.
                                        </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-wrap">
                                            Mempertahankan dan meningkatkan peranan dosen dan tenaga pendidik dalam memberikan jasa
                                            dengan cepat ntuk membantu mahasiswa
                                        </td>

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
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="text-wrap">
                                            Kepastian (assurance): kemampuan dosen, tenaga kependidikan, dan pengelola untuk memberi
                                            keyakinan kepada mahasiswa bahwa pelayanan yang diberikan telah sesuai dengan ketentuan.
                                        </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-wrap">
                                            Mempertahankan dan meningkatkan peranan dosen, tenaga pendidik dan pengelola untuk
                                            memberikan pelayanan telah sesuai dengan ketentuan.
                                        </td>

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
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-wrap">
                                            Empati (empathy): kesediaan/kepedulian dosen, tenaga kependidikan, dan pengelola untuk
                                            memberi perhatian kepada mahasiswa.
                                        </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-wrap">
                                            Mempertahankan dan meningkatkan peranan dosen wali dalam membimbing mahasiswa baik secara
                                            akademik maupun non akademik.
                                        </td>

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
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td class="text-wrap">
                                            Tangible: penilaian mahasiswa terhadap kecukupan, aksesibitas, kualitas sarana dan
                                            prasarana.
                                        </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-center"> </td>
                                        <td class="text-wrap">
                                            Mempertahankan dan meningkatkan kualitas fasilitas, sarana dan prasarana yang ada di
                                            Kampus 4 Sidoarjo
                                        </td>

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
                                        <th class="text-center">0</th>
                                        <th class="text-center">0</th>
                                        <th class="text-center">0</th>
                                        <th class="text-center">0</th>
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
