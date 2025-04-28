@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            PkM DTPS yang Melibatkan Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 7 | PkM DTPS yang Melibatkan Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tema PkM sesuai <br>Roadmap</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul Kegiatan</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->pkm_dtps_mahasiswa as $pkm)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $pkm->tema }}</td>
                                        <td class="text-wrap">{{ $pkm->nama_mhs }}</td>
                                        <td class="text-wrap">{{ $pkm->judul }}</td>
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
