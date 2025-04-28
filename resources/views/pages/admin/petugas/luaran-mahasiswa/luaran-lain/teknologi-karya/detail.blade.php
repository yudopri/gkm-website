@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            <span class="text-muted fw-light">Luaran Penelitian/PkM Lainnya oleh Mahasiswa /</span>
            Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial</h5>
                    <hr class="my-0" />
                    <div class="card-body">

                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>No.</th>
                                        <th>Luaran Penelitian dan PkM</th>
                                        <th>Tahun <br>(YYYY)</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-center fw-bold">III</td>
                                        <td class="text-wrap fw-bold" colspan="4">
                                            Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni, Rekayasa Sosial
                                        </td>
                                    </tr>
                                    @foreach ($data_dosen->teknologi_karya_mahasiswa as $karya)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                                            <td class="text-wrap">{{ $karya->luaran_penelitian }}</td>
                                            <td class="text-center">{{ $karya->tahun }}</td>
                                            <td class="text-wrap">{{ $karya->keterangan }}</td>

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
