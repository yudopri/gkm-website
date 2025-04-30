@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kualitas Pembelajaran /</span>
            Kurikulum, Capaian Pembelajaran, dan Rencana Pembelajaran
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 5.A | Kurikulum, Capaian Pembelajaran, dan Rencana Pembelajaran</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Semester</th>
                                        <th rowspan="2">Kode Mata <br>Kuliah</th>
                                        <th rowspan="2">Nama Mata Kuliah</th>
                                        <th rowspan="2">Mata <br>Kuliah <br>Kom- <br>petensi</th>
                                        <th colspan="3">Bobot Kredit (sks)</th>
                                        <th rowspan="2">Konversi <br>Kredit ke <br>Jam</th>
                                        <th colspan="4">Capaian Pembelajaran</th>
                                        <th rowspan="2">Dokumen <br>Rencana <br>Pembela- <br>jaran</th>
                                        <th rowspan="2">Unit <br>Penyeleng- <br>gara</th>
                                    </tr>
                                    <tr>
                                        <th>Kuliah/ <br>Responsi/ <br>Tutorial</th>
                                        <th>Seminar</th>
                                        <th>Praktikum/ <br>Praktik/ <br>Praktik <br>Lapangan</th>
                                        <th>Sikap</th>
                                        <th>Pengeta- <br>huan</th>
                                        <th>Keteram- <br>pilan <br>Umum</th>
                                        <th>Keteram- <br>pilan <br>Khusus</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->kurikulum_pembelajaran as $kurikulum)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $kurikulum->semester }}</td>
                                            <td class="text-center">{{ $kurikulum->kode_mata_kuliah }}</td>
                                            <td>{{ $kurikulum->nama_mata_kuliah }}</td>
                                            <td class="text-center">{{ $kurikulum->mata_kuliah_kompetensi ? '✓' : ''}}</td>
                                            <td class="text-center">{{ $kurikulum->sks_kuliah }}</td>
                                            <td class="text-center">{{ $kurikulum->sks_seminar }}</td>
                                            <td class="text-center">{{ $kurikulum->sks_praktikum }}</td>
                                            <td class="text-center">{{ $kurikulum->konversi_sks }}</td>
                                            <td class="text-center">{{ $kurikulum->capaian_kuliah_sikap ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kurikulum->capaian_kuliah_pengetahuan ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kurikulum->capaian_kuliah_keterampilan_umum ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kurikulum->capaian_kuliah_keterampilan_khusus ? '✓' : '' }}</td>
                                            <td class="text-center">{{ $kurikulum->dokumen }}</td>
                                            <td class="text-center">{{ $kurikulum->unit_penyelenggara }}</td>
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
