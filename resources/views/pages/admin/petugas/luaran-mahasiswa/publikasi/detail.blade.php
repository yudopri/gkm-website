@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            Pagelaran/Pameran/Presentasi/Publikasi Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel Pagelaran/Pameran/Presentasi/Publikasi Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Judul Artikel</th>
                                        <th rowspan="2">Jenis Publikasi</th>
                                        <th rowspan="2">Tahun <br>(YYYY)</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach ($data_dosen->publikasi_mahasiswa as $publik)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $publik->judul_artikel }}</td> <!-- Iteration counter -->
        <td>{{ $publik->jenis_artikel }}</td><!-- Display the count -->
        <td>{{ $publik->tahun }}</td>
    </tr>
@endforeach
                                </tbody>
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th colspan="3" class="rounded-start-bottom">Jumlah Judul</th>
                                        <th class="text-center">{{ $data_dosen->publikasi_mahasiswa->count('judul_artikel')}}</th>
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
