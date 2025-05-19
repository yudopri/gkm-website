@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Evaluasi Lulusan /</span>
            Kepuasan Pengguna Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">
<!-- #s btn tambah -->
<a href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
    <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
</a>
<!-- #e btn tambah -->
                <!--#s tabel-ref-8e2 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#tabel-ref-8e2" role="button" aria-expanded="false"
                        aria-controls="tabel-ref-8e2">
                        Tabel Referensi 8.E.2 | Kepuasan Pengguna Lulusan
                    </h5>

                    <div class="collapse show" id="tabel-ref-8e2">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!--#s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th>Tahun Lulus</th>
                                            <th>Jumlah Lulusan</th>
                                            <th>Jumlah Tanggapan <br>Kepuasan Pengguna <br>yang Terlacak</th>

                                            <!-- Aksi -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($kepuasan_pengguna as $pengguna)
    <tr>
        <td class="text-center">{{ $pengguna['tahun'] }}</td>
        <td class="text-center">{{ $pengguna['jumlah_lulusan'] }}</td>
        <td class="text-center">{{ $pengguna['jumlah_responden'] }}</td>
        <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Contoh: ambil ID pertama dari group untuk aksi -->
                    <a class="dropdown-item" href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.edit', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $pengguna['ids']->first()]) }}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <form action="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.destroy', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $pengguna['ids']->first()]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bx bx-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@endforeach

                                    </tbody>
                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom">Jumlah</th>
                                            <th class="text-center">
                                                {{ $kepuasan_pengguna->sum('jumlah_lulusan') }}
                                            </th>
                                            <th class="text-center">
                                                {{ $kepuasan_pengguna->sum('jumlah_responden') }}
                                            </th>
                                            <th class="rounded-end-bottom">Aksi</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e tabel-ref-8e2 -->

                <!--#s tabel-8e2 -->
                <div class="card mb-4">
                    <h5 class="card-header" data-bs-toggle="collapse" href="#tabel-8e2" role="button" aria-expanded="false" aria-controls="tabel-8e2">
                        Tabel 8.E.2 | Kepuasan Pengguna Lulusan
                    </h5>

                    <div class="collapse show" id="tabel-8e2">
                        <hr class="my-0" />
                        <div class="card-body">
                            <!--#s tabel -->
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-info">
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Jenis Kemampuan</th>
                                            <th colspan="4">Tingkat Kepuasan Pengguna <br>(%)</th>
                                            <th rowspan="2">Rencana Tindak Lanjut <br>oleh UPPS/PS</th>

                                            <!-- Aksi -->
                                            <th rowspan="2">Aksi</th>
                                        </tr>
                                        <tr>
                                            <th>Sangat Baik</th>
                                            <th>Baik</th>
                                            <th>Cukup</th>
                                            <th>Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($detail_kepuasan_pengguna as $pengguna)
                                           <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-wrap">{{ $pengguna['jenis_kemampuan'] }}</td>
        <td class="text-center">{{ $pengguna['tingkat_kepuasan_sangat_baik'] }}</td>
        <td class="text-center">{{ $pengguna['tingkat_kepuasan_baik'] }}</td>
        <td class="text-center">{{ $pengguna['tingkat_kepuasan_cukup'] }}</td>
        <td class="text-center">{{ $pengguna['tingkat_kepuasan_kurang'] }}</td>
        <td class="text-center">{{ $pengguna['rencana_tindakan'] }}</td>

        <!-- Aksi -->
        <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Edit -->
                    <a class="dropdown-item" href="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.edit', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $pengguna['id']]) }}">
                        <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>

                    <!-- Delete -->
                    <form action="{{ route('admin.kinerja-lulusan.evaluasi-lulusan.kepuasan-pengguna.destroy', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $pengguna['id']]) }}"
                        method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bx bx-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
@endforeach

                                    </tbody>

                                    <tfoot class="table-border-bottom-0 table-secondary">
                                        <tr>
                                            <th class="rounded-start-bottom"> </th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">{{$detail_kepuasan_pengguna->sum('tingkat_kepuasan_sangat_baik')}}</th>
                                            <th class="text-center">{{$detail_kepuasan_pengguna->sum('tingkat_kepuasan_baik')}} </th>
                                            <th class="text-center">{{$detail_kepuasan_pengguna->sum('tingkat_kepuasan_cukup')}} </th>
                                            <th class="text-center">{{$detail_kepuasan_pengguna->sum('tingkat_kepuasan_kurang')}} </th>
                                            <th class="text-center"></th>
                                            <th class="rounded-end-bottom">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- #e tabel -->
                        </div>
                    </div>
                </div>
                <!-- #e tabel-8e2 -->
            </div>
        </div>
    </div>
@endsection
