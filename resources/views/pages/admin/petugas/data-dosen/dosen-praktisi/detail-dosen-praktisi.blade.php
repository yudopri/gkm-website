@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            Dosen Industri/Praktisi
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Dosen Industri/Praktisi</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Dosen <br>Industri/Praktisi</th>
                                        <th>NIDK</th>
                                        <th>Perusahaan/ <br>Industri</th>
                                        <th>Pendidikan <br>Tertinggi</th>
                                        <th>Bidang <br>Keahlian</th>
                                        <th>Sertifikat <br>Profesi/ <br>Kompetensi/ <br>Industri</th>
                                        <th>Mata Kuliah <br>yang Diampu</th>
                                        <th>Bobot <br>Kredit (sks)</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data_dosen->dosen_praktisi as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $dosen->nama_dosen }}</td>
                                            <td>{{ $dosen->nidk }}</td>
                                            <td>{{ $dosen->perusahaan }}</td>
                                            <td class="text-center">{{ $dosen->pendidikan_tertinggi }}</td>
                                            <td class="text-wrap">{{ $dosen->bidang_keahlian }}</td>
                                            <td>{!! $dosen->sertifikat_kompetensi !!}</td>
                                            <td>{!! $dosen->mk_diampu !!}</td>
                                            <td class="text-center">{{ $dosen->bobot_kredit_sks }}</td>
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
