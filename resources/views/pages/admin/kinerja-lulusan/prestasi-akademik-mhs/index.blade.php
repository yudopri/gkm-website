@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Prestasi Mahasiswa /</span>
            Akademik
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 8.B.1 | Prestasi Akademik Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-lulusan.prestasi-mahasiswa.akademik.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Kegiatan</th>
                                        <th colspan="3">Tingkat</th>
                                        <th rowspan="2">Prestasi yang Dicapai</th>

                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Lokal/ <br>Wilayah</th>
                                        <th>Nasional</th>
                                        <th>Internasional</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($prestasi_akademik as $akademik)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $akademik->nama_kegiatan }}</td>
                                            <td class="text-center">
                                                @if ($akademik->tingkat == 'lokal') ✓ @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($akademik->tingkat == 'nasional') ✓ @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($akademik->tingkat == 'internasional') ✓ @endif
                                            </td>

                                            <td class="text-wrap">{{ $akademik->prestasi }}</td>

                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.kinerja-lulusan.prestasi-mahasiswa.akademik.edit', ['tahunAjaran' => $tahun_ajaran, 'akademikId' => $akademik->id]) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.kinerja-lulusan.prestasi-mahasiswa.akademik.destroy', ['tahunAjaran' => $tahun_ajaran, 'akademikId' => $akademik->id]) }}" method="POST" style="display:inline;">
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
