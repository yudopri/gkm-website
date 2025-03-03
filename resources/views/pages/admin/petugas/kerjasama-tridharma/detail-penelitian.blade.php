@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kerjasama Tridharma /</span>
            <span class="text-muted fw-light">Penelitian /</span>
            {{ $data_dosen->profile->nama }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Kerjasama Penelitian</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Lembaga Mitra</th>
                                        <th colspan="3" class="text-center">Tingkat</th>
                                        <th rowspan="2">Judul Kegiatan Kerjasama
                                        </th>
                                        <th rowspan="2">Manfaat bagi PS</th>
                                        <th rowspan="2">Waktu dan <br>Durasi</th>
                                        <th rowspan="2">Bukti Kerjasama</th>
                                        <th rowspan="2">Tahun <br>Berakhirnya <br>Kerjasama <br>(YYYY)</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Internasional</th>
                                        <th class="text-center">Nasional</th>
                                        <th class="text-center">Wilayah/ <br>Lokal</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data_dosen->kerjasama_tridharma_penelitian as $kerjasama)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $kerjasama->lembaga_mitra }}</td>
                                            <td class="text-center">{{ $kerjasama->tingkat === 'internasional' ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kerjasama->tingkat === 'nasional' ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kerjasama->tingkat === 'lokal' ? '✓' : '' }}</td>
                                            <td class="text-wrap">{{ $kerjasama->judul_kegiatan }}</td>
                                            <td>
                                                {!! $kerjasama->manfaat !!}
                                            </td>
                                            <td>{{ $kerjasama->waktu_durasi }}</td>
                                            <td><a href="{{ $kerjasama->bukti_kerjasama }}" target="_blank">Bukti Kerjasama</a></td>
                                            <td class="text-center">{{ $kerjasama->tahun_berakhir }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="11"> Belum ada data kerjasama </td>
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
