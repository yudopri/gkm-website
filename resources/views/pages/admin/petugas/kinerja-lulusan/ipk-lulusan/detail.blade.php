@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            IPK Lulusan
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel 8.A | IPK Lulusan</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Tahun Lulus</th>
                                        <th rowspan="2">Jumlah <br>Lulusan</th>
                                        <th colspan="3">Indeks Prestasi Kumulatif</th>
                                    </tr>
                                    <tr>
                                        <th>Min</th>
                                        <th>Rata-rata</th>
                                        <th>Maks</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($data_dosen->ipk_lulusan as $ipk)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $ipk->tahun }}</td>
                                            <td class="text-center">{{ $ipk->jumlah_lulusan }}</td>
                                            <td class="text-center">{{ $ipk->ipk_minimal }}</td>
                                            <td class="text-center">{{ $ipk->ipk_rata_rata }}</td>
                                            <td class="text-center">{{ $ipk->ipk_maksimal }}</td>
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
