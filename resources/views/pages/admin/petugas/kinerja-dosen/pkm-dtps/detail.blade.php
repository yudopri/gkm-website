@extends('layouts.petugas')

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

                                    @foreach ($data_dosen->pkm_dtps as $index => $pkm)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $sumberDana[$pkm->sumber_dana] ?? '-' }}</td>
                                            <td class="text-center">{{ number_format($pkm->jumlah_judul ?? 0) }}</td>
                                        </tr>
                                        @endforeach
                                    @if($data_dosen->pkm_dtps->isEmpty())
                                        <tr>
                                            <td class="text-center" colspan="4">Belum ada data pkm</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot class="table-border-bottom-0">
                                    <tr>
                                        <th colspan="2" class="rounded-start-bottom">Jumlah</th>
                                        <th class="text-center">{{ number_format($data_dosen->pkm_dtps->sum('jumlah_judul')) }}</th>
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
