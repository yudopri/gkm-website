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
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-dosen.publikasi-ilmiah.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Judul Artikel</th>
                                        <th rowspan="2">Jenis Publikasi</th>
                                        <th rowspan="2">Tahun <br>(YYYY)</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach ($publikasi as $publik)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $publik->judul_artikel }}</td> <!-- Iteration counter -->
        <td>{{ $publik->jenis_artikel }}</td><!-- Display the count -->
        <td>{{ $publik->tahun }}</td>

        <!-- Aksi (Actions) -->
        <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('admin.kinerja-dosen.publikasi-ilmiah.edit', ['publikasiId' => $publik->id, 'tahunAjaran' => $tahun_ajaran]) }}">
<i class="bx bx-edit-alt me-1"></i> Edit
</a>

<form action="{{ route('admin.kinerja-dosen.publikasi-ilmiah.destroy', ['publikasiId' => $publik->id, 'tahunAjaran' => $tahun_ajaran]) }}" method="POST" style="display:inline;">
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
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th colspan="3" class="rounded-start-bottom">Jumlah Judul</th>
                                        <th class="text-center">{{ $totals}}</th>
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
