@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kualitas Pembelajaran /</span>
            Integrasi Kegiatan Penelitian/PkM dalam Pembelajaran
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 5.B | Integrasi Kegiatan Penelitian/PkM dalam Pembelajaran</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul <br>Penelitian/PkM</th>
                                        <th>Nama Dosen</th>
                                        <th>Mata Kuliah</th>
                                        <th>Bentuk Integrasi</th>
                                        <th>Tahun <br>(YYYY)</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->integrasi_penelitian as $penelitian)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $penelitian->judul_penelitian }}</td>
                                            <td class="text-wrap">{{ $penelitian->nama_dosen }}</td>
                                            <td class="text-wrap">{{ $penelitian->mata_kuliah }}</td>
                                            <td class="text-wrap">{{ $penelitian->bentuk_integrasi }}</td>
                                            <td class="text-center">{{ $penelitian->tahun }}</td>
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
