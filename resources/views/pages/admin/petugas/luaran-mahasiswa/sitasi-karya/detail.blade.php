@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            Karya Ilmiah Mahasiswa yang Disitasi
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Karya Ilmiah Mahasiswa yang Disitasi</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul Artikel yang Disitasi (Jurnal, Volume, Tahun, Nomor, Halaman)</th>
                                        <th>Jumlah Sitasi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->sitasi_karya_mahasiswa as $sitasi)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                                            <td>{{ $sitasi->nama_mahasiswa }}</td>
                                            <td class="text-wrap">{{ $sitasi->judul_artikel }}</td>
                                            <td class="text-center">{{ $sitasi->jumlah_sitasi }}</td>

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
