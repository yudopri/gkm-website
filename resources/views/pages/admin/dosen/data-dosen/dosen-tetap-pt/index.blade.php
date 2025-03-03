@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Dosen Tetap Perguruan Tinggi
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Dosen Tetap Perguruan Tinggi</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dd.dosen-tetap.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nama Dosen</th>
                                        <th rowspan="2">NIDN/NIDK</th>
                                        <th colspan="2" class="text-center">Pendidikan Pasca Sarjana</th>
                                        <th rowspan="2">Bidang Keahlian</th>
                                        <th rowspan="2">
                                            Kesesuaian <br>dengan <br>Kompetensi Inti <br>PS
                                        </th>
                                        <th rowspan="2">
                                            Jabatan <br>Akademik
                                        </th>
                                        <th rowspan="2">
                                            Sertifikat <br>Pendidik <br>Profesional
                                        </th>
                                        <th rowspan="2">
                                            Sertifikat <br>Kompetensi/ <br>Profesi/ <br>Industri
                                        </th>
                                        <th rowspan="2">
                                            Mata Kuliah yang <br>Diampu pada PS
                                        </th>
                                        <th rowspan="2">
                                            Kesesuaian <br>Bidang <br>Keahlian <br>dengan Mata <br>Kuliah yang <br>Diampu
                                        </th>
                                        <th rowspan="2">
                                            Mata Kuliah <br>yang Diampu <br>pada PS Lain
                                        </th>
                                        <!-- Aksi -->
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Magister/ <br>Magister Terapan/ <br>Spesialis</th>
                                        <th class="text-center">Doktor/ <br>Doktor Terapan/ <br>Spesialis</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($dosen_tetap as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->nama_dosen }}</td>
                                            <td>{{ $dosen->nidn_nidk }}</td>
                                            <td class="text-wrap">{{ $dosen->gelar_magister }}</td>
                                            <td class="text-wrap">{{ $dosen->gelar_doktor }}</td>
                                            <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                                            <td class="text-center">{{ $dosen->kesesuaian_kompetensi ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $dosen->jabatan_akademik }}</td>
                                            <td class="text-center text-wrap">{{ $dosen->sertifikat_pendidik }}</td>
                                            <td class="text-center text-wrap">{{ $dosen->sertifikat_kompetensi }}</td>
                                            <td>{!! $dosen->mk_diampu !!}</td>
                                            <td class="text-center">{{ $dosen->kesesuaian_keahlian_mk ? '✓' : '' }}</td>
                                            <td>{!! $dosen->mk_ps_lain !!}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-tetap.edit', ['tahunAjaran' => $tahun_ajaran, 'dosenTetapId' => $dosen->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.dosen.dd.dosen-tetap.destroy', ['tahunAjaran' => $tahun_ajaran, 'dosenTetapId' => $dosen->id]) }}"
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
                                            <td class="text-center" colspan="15"> Belum ada data kerjasama </td>
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
