@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            Pagelaran/Pameran/Presentasi/Publikasi Ilmiah DTPS
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel Pagelaran/Pameran/Presentasi/Publikasi Ilmiah DTPS</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Dosen</th>
                                        <th rowspan="2">Judul Publikasi</th>
                                        <th rowspan="2">Jenis Publikasi</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach ($publikasi as $publik)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
        <td>{{ $publik->nama_dosen }}</td>
        <td>{{ $publik->judul_artikel }}</td>
        <td>{{ $publik->jenis_artikel }}</td>
        <!-- Aksi (Actions) -->
        <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.kinerja-dosen.publikasi-ilmiah.edit', ['tahunAjaran' => $tahun_ajaran, 'publikasiId' => $publik->id, 'jenisArtikel' => $publik->jenis_artikel]) }}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <i class="bx bx-trash me-1"></i> Delete
                    </a>
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
