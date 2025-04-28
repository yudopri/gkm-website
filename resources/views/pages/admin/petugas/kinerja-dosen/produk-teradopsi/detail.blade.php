@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Produk/Jasa DTPS yang Diadopsi oleh Industri/Masyarakat</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">

                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dosen</th>
                                        <th>Nama Produk/Jasa</th>
                                        <th>Deskripsi <br>Poduk/Jasa</th>
                                        <th>Bukti</th>
                                        <th>Tahun <br>(YYYY)</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach ($data_dosen->produk_teradopsi as $index => $produk)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td> {{ $produk->nama_dosen}} </td>
                                        <td> {{ $produk->nama_produk}} </td>
                                        <td> {{ $produk->deskripsi_produk}} </td>
                                        <td> {{ $produk->bukti}}</td>
                                        <td> {{ $produk->tahun}}</td>
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
