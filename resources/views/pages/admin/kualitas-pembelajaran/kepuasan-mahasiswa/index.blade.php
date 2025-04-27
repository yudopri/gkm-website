@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kualitas Pembelajaran /</span>
            Kepuasan Mahasiswa
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 5.C | Kepuasan Mahasiswa</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.create',$tahun_ajaran)}}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Aspek yang Diukur</th>
                                        <th colspan="4">Tingkat Kepuasan Mahasiswa <br>(%)</th>
                                        <th rowspan="2">Rencana Tindak Lanjut oleh UPPS/PS</th>

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
                                    @foreach ($kepuasan_mahasiswa as $kepuasan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $kepuasan->aspek_penilaian }}</td>
                                            <td class="text-center">{{ $kepuasan->tingkat_kepuasan_sangat_baik }}</td>
                                            <td class="text-center">{{ $kepuasan->tingkat_kepuasan_baik }}</td>
                                            <td class="text-center">{{ $kepuasan->tingkat_kepuasan_cukup }}</td>
                                            <td class="text-center">{{ $kepuasan->tingkat_kepuasan_kurang }}</td>
                                            <td class="text-wrap">{{ $kepuasan->rencana_tindakan }}</td>
                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.edit', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $kepuasan->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>

                                                        <form action="{{ route('admin.kualitas-pembelajaran.kepuasan-mahasiswa.destroy', ['tahunAjaran' => $tahun_ajaran, 'kepuasanId' => $kepuasan->id]) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus?');">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>

                                    @endforeach
                                </tbody>
                                <tfoot class="table-border-bottom-0 table-secondary">
                                    <tr>
                                        <th class="rounded-start-bottom"> </th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">{{$kepuasan_mahasiswa->sum('tingkat_kepuasan_sangat_baik')}}</th>
                                        <th class="text-center">{{$kepuasan_mahasiswa->sum('tingkat_kepuasan_baik')}}</th>
                                        <th class="text-center">{{$kepuasan_mahasiswa->sum('tingkat_kepuasan_cukup')}}</th>
                                        <th class="text-center">{{$kepuasan_mahasiswa->sum('tingkat_kepuasan_buruk')}}</th>
                                        <th class="text-center"> </th>
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
