@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Luaran Penelitian/PkM Lainnya oleh DTPS /</span>
            Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-dosen.luaran-lain.teknologi-karya.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Luaran Penelitian dan PkM</th>
                                        <th>Tahun <br>(YYYY)</th>
                                        <th>Keterangan</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold">III</td>
                                        <td class="text-wrap fw-bold" colspan="4">
                                            Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial
                                        </td>
                                    </tr>
                                    @foreach ($teknologi_karya as $karya)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                                            <td class="text-wrap">{{ $karya->luaran_penelitian }}</td>
                                            <td class="text-center">{{ $karya->tahun }}</td>
                                            <td class="text-wrap">{{ $karya->keterangan }}</td>
                                        <!-- Aksi -->
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('admin.kinerja-dosen.luaran-lain.teknologi-karya.edit', ['tahunAjaran' => $tahun_ajaran, 'karyaId' => $karya->id]) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('admin.kinerja-dosen.luaran-lain.teknologi-karya.destroy', ['tahunAjaran' => $tahun_ajaran, 'karyaId' => $karya->id]) }}" method="POST" style="display:inline;">
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
