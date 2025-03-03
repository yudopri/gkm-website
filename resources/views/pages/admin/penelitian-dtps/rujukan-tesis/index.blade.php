@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Penelitian DTPS /</span>
            Penelitian DTPS yang Menjadi Rujukan Tema Tesis/Disertasi
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.penelitian-dtps')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 6.B | Penelitian DTPS yang Menjadi Rujukan Tema Tesis/Disertasi</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.penelitian-dtps.rujukan-tesis.create') }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dosen</th>
                                        <th>Tema Penelitian <br>sesuai Roadmap</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul <br>Tesis/Disertasi</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-wrap"> </td>
                                        <td class="text-wrap"> </td>
                                        <td class="text-wrap"> </td>
                                        <td class="text-wrap"> </td>

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
        </div>
    </div>
@endsection
