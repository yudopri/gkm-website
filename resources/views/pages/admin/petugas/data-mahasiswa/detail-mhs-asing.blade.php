@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            <span class="text-muted fw-light">Mahasiswa Asing /</span>
            {{ $data_dosen->profile->nama }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel Mahasiswa Asing</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap mb-3">
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
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data_dosen->mahasiswa_asing as $mhs)
                                        <tr>
                                            <td class="text-center">{{ $mhs->mhs_aktif }}</td>
                                            <td class="text-center">{{ $mhs->mhs_asing_fulltime }}</td>
                                            <td class="text-center">{{ $mhs->mhs_asing_parttime }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4"> Belum ada data mahasiswa asing </td>
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
