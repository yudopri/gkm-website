@extends('layouts.dosen')

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
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kualitas-pembelajaran.integrasi-penelitian.create', $tahun_ajaran)}}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

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

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($integrasi_penelitian as $penelitian)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $penelitian->judul_penelitian }}</td>
                                            <td class="text-wrap">{{ $penelitian->nama_dosen }}</td>
                                            <td class="text-wrap">{{ $penelitian->mata_kuliah }}</td>
                                            <td class="text-wrap">{{ $penelitian->bentuk_integrasi }}</td>
                                            <td class="text-center">{{ $penelitian->tahun }}</td>

                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.kualitas-pembelajaran.integrasi-penelitian.edit', ['tahunAjaran' => $tahun_ajaran, 'penelitianId' => $penelitian->id]) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.kualitas-pembelajaran.integrasi-penelitian.destroy', ['tahunAjaran' => $tahun_ajaran, 'penelitianId' => $penelitian->id]) }}" method="POST" style="display:inline;">
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
