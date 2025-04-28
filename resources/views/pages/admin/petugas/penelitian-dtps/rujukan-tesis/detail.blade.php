@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Penelitian DTPS /</span>
            Penelitian DTPS yang Menjadi Rujukan Tema Tesis/Disertasi
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 6.B | Penelitian DTPS yang Menjadi Rujukan Tema Tesis/Disertasi</h5>
                    <hr class="my-0" />
                    <div class="card-body">

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
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->rujukan_tesis_mahasiswa as $rujukan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $rujukan->nama_dosen }}</td>
                                            <td class="text-wrap">{{ $rujukan->tema_penelitian }}</td>
                                            <td class="text-wrap">{{ $rujukan->nama_mahasiswa }}</td>
                                            <td class="text-wrap">{{ $rujukan->judul }}</td>
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
