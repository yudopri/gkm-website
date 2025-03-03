@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            PkM DTPS
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.kinerja-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel PkM DTPS</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-dosen.rekognisi-dtps.create') }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Sumber Pembiayaan</th>
                                        <th rowspan="1">Jumlah <br>Judul PkM</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">TS</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            a) Perguruan Tinggi (POLIJE) <br>
                                            b) Mandiri
                                        </td>
                                        <td class="text-center">10</td>

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
                                        <td>Lembaga dalam negeri (diluar POLIJE)</td>
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
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Lembaga luar negeri</td>
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
                                    {{-- @forelse ($penelitian_dtps as $penelitian)
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                a) Perguruan Tinggi (POLIJE) <br>
                                                b) Mandiri
                                            </td>
                                            <td class="text-center">12</td>

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
                                            <td>Lembaga dalam negeri (diluar POLIJE)</td>
                                            <td class="text-center">1</td>

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
                                            <td>Lembaga luar negeri</td>
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
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
                                        </tr>
                                    @endforelse --}}
                                </tbody>
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                                        <th class="text-center">10</th>
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
