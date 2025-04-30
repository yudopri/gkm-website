@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            <span class="text-muted fw-light">Luaran Penelitian/PkM Lainnya oleh Mahasiswa /</span>
            HKI (Hak Cipta, Desain Produk Industri, dll.)
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel HKI (Hak Cipta, Desain Produk Industri, dll.)</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Luaran Penelitian dan PkM</th>
                                        <th>Tahun <br>(YYYY)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold">II</td>
                                        <td class="text-wrap fw-bold" colspan="3">
                                            HKI: a) Hak Cipta, b) Desain Produk Industri, c) Perlindungan Varietas Tanaman (Sertifikat Perlindungan
                                            Varietas Tanaman, Sertifikat Pelepasan Varietas, Sertifikat Pendaftaran Varietas), d) Desain Tata Letak
                                            Sirkuit Terpadu, e) dll.)
                                        </td>
                                    </tr>
                                    <tr>
                                        @foreach ($data_dosen->hki_cipta_mahasiswa as $hkicipta)
                                            <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                                            <td class="text-wrap">{{ $hkicipta->luaran_penelitian }}</td>
                                            <td class="text-center">{{ $hkicipta->tahun }}</td>
                                            <td class="text-wrap">{{ $hkicipta->keterangan }}</td>
                                    </tr>
                                        @endforeach
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
