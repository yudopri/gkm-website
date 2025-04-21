@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            PkM DTPS
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel PkM DTPS</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s btn tambah -->
                        <a href="{{ route('admin.kinerja-dosen.pkm-dtps.create',$tahun_ajaran) }}" class="btn btn-info mb-3">
                            <span class="tf-icons bx bx-plus bx-18px me-2"></span>Tambah Data
                        </a>
                        <!-- #e btn tambah -->

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                <tr>
                                        <th>No.</th>
                                        <th>Sumber Pembiayaan</th>
                                        <th>Jumlah Judul PKM</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @php
                                    $sumberDana = [
                                        'lokal' => "a. Perguruan Tinggi (POLIJE) \n b. Mandiri",
                                
                                        'nasional' => "Lembaga Dalam Negeri (Diluar Polije)",
                                
                                        'internasional' => "Lembaga Luar Negeri"
                                    ];
                                @endphp
                                

                                @foreach ($pkm_dtps as $index => $pkm)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $sumberDana[$pkm->sumber_dana] ?? '-' }}</td>
                                    <td class="text-center">{{ number_format($totals[$pkm->sumber_dana] ?? 0) }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.kinerja-dosen.pkm-dtps.edit', ['pkmId' => $pkm->id, 'tahunAjaran' => $tahun_ajaran]) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                            
                                                <form action="{{ route('admin.kinerja-dosen.pkm-dtps.destroy', ['pkmId' => $pkm->id, 'tahunAjaran' => $tahun_ajaran]) }}" method="POST" style="display:inline;">
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

                                    @if($pkm_dtps->isEmpty())
                                        <tr>
                                            <td class="text-center" colspan="4">Belum ada data pkm</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                                        <th class="text-center">{{ number_format($totals->sum()) }}</th>
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
