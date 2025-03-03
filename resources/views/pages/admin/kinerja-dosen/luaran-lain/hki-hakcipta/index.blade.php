@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Luaran Penelitian/PkM Lainnya oleh DTPS /</span>
            HKI (Hak Cipta, Desain Produk Industri, dll.)
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.luaran-lain-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel HKI (Hak Cipta, Desain Produk Industri, dll.)</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-dosen.luaran-lain.hki-hakcipta.create') }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Luaran Penelitian dan PkM</th>
                                        <th>Tahun <br>(YYYY)</th>
                                        <th>Keterangan</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold">II</td>
                                        <td class="text-wrap fw-bold" colspan="4">
                                            HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                                            Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                                            Sirkuit Terpadu, e) dll.)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-wrap">
                                            Program Metaverse Untuk Media Pembelajaran Sistem Cerdas Dan Manajemen Agroindustri
                                            Perkebunan
                                        </td>
                                        <td class="text-center">2024</td>
                                        <td class="text-wrap">
                                            HKI - Jenis Ciptaan Kompilasi Ciptaan/Data, Nomor Catatan 000583892
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
                            </table>
                        </div>
                        <!-- #e tabel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
