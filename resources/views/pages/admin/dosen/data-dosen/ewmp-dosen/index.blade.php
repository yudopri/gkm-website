@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen
        </h4>

        <div class="row">
            <div class="col-md-12">
                <!-- #s navpills -->
                @include('includes.backend.navpills.data-dosen')
                <!-- #e navpills -->

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.dosen.dd.ewmp-dosen.create', $tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="3">No.</th>
                                        <th rowspan="3">Nama Dosen (DT)</th>
                                        <th rowspan="3">DTPS</th>
                                        <th colspan="6" class="text-center">
                                            Ekuivalen Waktu Mengajar Penuh (EWMP) pada saat TS dalam <br>
                                            satuan kredit semester (sks)
                                        </th>
                                        <th rowspan="3">Jumlah <br>(sks)</th>
                                        <th rowspan="3">
                                            Rata-rata <br>per <br>Semester <br>(sks)
                                        </th>

                                        <!-- Aksi -->
                                        <th rowspan="3">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-center">Pendidikan: <br>Pembelajaran dan Pembimbingan</th>
                                        <th rowspan="2" class="text-center">Penelitian</th>
                                        <th rowspan="2" class="text-center">PkM</th>
                                        <th rowspan="2" class="text-center">Tugas <br>Tambahan <br>dan/atau <br>Penunjang</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">PS yang <br>Diakreditasi</th>
                                        <th class="text-center">PS Lain di <br>dalam PT</th>
                                        <th class="text-center">PS Lain di <br>luar PT</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($ewmp_dosen as $ewmp)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $ewmp->nama_dosen }}</td>
                                            <td class="text-center">{{ $ewmp->is_dtps ? '✓' : '' }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->ps_diakreditasi ?? 0, locale: 'id') }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->ps_lain_dalam_pt ?? 0, locale: 'id') == 0 ? '' : '' }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->ps_lain_luar_pt ?? 0, locale: 'id') == 0 ? '' : '' }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->penelitian ?? 0, locale: 'id') }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->pkm ?? 0, locale: 'id') }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->tugas_tambahan ?? 0, locale: 'id') }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->jumlah_sks ?? 0, locale: 'id') }}</td>
                                            <td class="text-center">{{ Number::format($ewmp->avg_per_semester ?? 0, locale: 'id') }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.dosen.dd.ewmp-dosen.edit', ['tahunAjaran' => $tahun_ajaran, 'ewmpDosenId' => $ewmp->id]) }}">
                                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('admin.dosen.dd.ewmp-dosen.destroy', ['tahunAjaran' => $tahun_ajaran, 'ewmpDosenId' => $ewmp->id]) }}"
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
