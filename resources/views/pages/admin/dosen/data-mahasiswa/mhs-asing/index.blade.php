@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            Mahasiswa Asing
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-mahasiswa')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Mahasiswa Asing</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dm.mahasiswa-asing.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>Jumlah Mahasiswa Aktif</th>
                                        <th>
                                            Jumlah Mahasiswa Asing <br> Penuh Waktu (Full-time)
                                        </th>
                                        <th>
                                            Jumlah Mahasiswa Asing <br> Paruh Waktu (Part-time)
                                        </th>
                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($mhs_asing as $mhs)
                                        <tr>
                                            <td class="text-center">{{ $mhs->mhs_aktif }}</td>
                                            <td class="text-center">{{ $mhs->mhs_asing_fulltime }}</td>
                                            <td class="text-center">{{ $mhs->mhs_asing_parttime }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dm.mahasiswa-asing.edit', ['tahunAjaran' => $tahun_ajaran, 'mahasiswaAsingId' => $mhs->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dm.mahasiswa-asing.destroy', ['tahunAjaran' => $tahun_ajaran, 'mahasiswaAsingId' => $mhs->id]) }}"
                                                            data-confirm-delete="true">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> Belum ada data mahasiswa asing </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="table-border-bottom-0">
    <tr>
        <th colspan="3" class="text-center rounded-start-bottom">Jumlah</th>
        <!-- This cell will remain empty or can be used for something else if necessary -->
        <th></th>
    </tr>
    <tr>
        <th class="text-center">{{ number_format($total->total_mhs_aktif ?? 0) }}</th>
        <th class="text-center">{{ number_format($total->total_mhs_asing_fulltime ?? 0) }}</th>
        <th class="text-center">{{ number_format($total->total_mhs_asing_parttime ?? 0) }}</th>
        <th class="text-center"></th> <!-- Empty column for actions if needed -->
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
