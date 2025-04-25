@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Produk/Jasa Mahasiswa yang Diadopsi oleh Industri/Masyarakat</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.luaran-mahasiswa.produk-jasa.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">

                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Nama Produk/Jasa</th>
                                        <th>Deskripsi <br>Poduk/Jasa</th>
                                        <th>Bukti</th>
                                        <th>Tahun <br>(YYYY)</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach ($produk_jasa as $index => $produk)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td> {{ $produk->nama_mahasiswa}} </td>
                                        <td> {{ $produk->nama_produk}} </td>
                                        <td> {{ $produk->deskripsi_produk}} </td>
                                        <td> {{ $produk->bukti}}</td>
                                        <td> {{ $produk->tahun}}</td>

                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.luaran-mahasiswa.produk-jasa.edit', ['produkId' => $produk->id, 'tahunAjaran' => $tahun_ajaran]) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.luaran-mahasiswa.produk-jasa.destroy', ['produkId' => $produk->id, 'tahunAjaran' => $tahun_ajaran]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus?');">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                                </div>
                                            </div>
                                        </td>
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
