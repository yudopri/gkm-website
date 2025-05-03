@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Dosen Tidak Tetap
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Dosen Tidak Tetap</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dd.dosen-tidak-tetap.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dosen</th>
                                        <th>NIDN/NIDK</th>
                                        <th>Pendidikan <br>Pasca Sarjana</th>
                                        <th>Bidang <br>Keahlian</th>
                                        <th>Jabatan <br>Akademik</th>
                                        <th>Sertifikat <br>Pendidik <br>Profesional</th>
                                        <th>Sertifikat <br>Kompetensi/ <br>Profesi/ <br>Industri</th>
                                        <th>Mata Kuliah yang <br>Diampu pada PS</th>
                                        <th>Kesesuaian <br>Bidang Keahlian <br>dengan Mata <br>Kuliah yang <br>Diampu</th>

                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($dosenTidakTetap as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->nama_dosen }}</td>
                                            <td>{{ $dosen->nidn_nidk }}</td>
                                            <td class="text-wrap">{{ $dosen->pendidikan_pascasarjana }}</td>
                                            <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                                            <td class="text-wrap">{{ $dosen->jabatan_akademik }}</td>
                                            <td class="text-wrap">{{ $dosen->sertifikat_pendidik }}</td>
                                            <td class="text-wrap">{{ $dosen->sertifikat_kompetensi }}</td>
                                            <td>{!! $dosen->mk_diampu !!}</td>
                                            <td class="text-center">{{ $dosen->kesesuaian_keahlian_mk ? '✓' : '' }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-tidak-tetap.edit', ['tahunAjaran' => $tahun_ajaran, 'dosenTidakTetapId' => $dosen->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-tidak-tetap.destroy',  ['tahunAjaran' => $tahun_ajaran, 'dosenTidakTetapId' => $dosen->id]) }}"
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
                                            <td class="text-center" colspan="12"> Belum ada data kerjasama </td>
                                        </tr>
                                    @endforelse
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
