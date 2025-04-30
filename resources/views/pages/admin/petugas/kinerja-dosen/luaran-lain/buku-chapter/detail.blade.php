@extends('layouts.petugas')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Luaran Penelitian/PkM Lainnya oleh DTPS /</span>
            <span class="text-muted fw-light">Buku Ber-ISBN, Book Chapter /</span>
            {{ $data_dosen->profile->nama }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h5 class="card-header">Tabel Buku Ber-ISBN, Book Chapter</h5>
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
                                        <td class="text-center fw-bold">IV</td>
                                        <td class="text-wrap fw-bold" colspan="4">
                                            Buku ber-ISBN, <i>Book Chapter</i>
                                        </td>
                                    </tr>

                                    @foreach ($data_dosen->buku_chapter_dosen as $book)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td> <!-- Iteration counter -->
                                            <td class="text-wrap">{{ $book->luaran_penelitian }}</td>
                                            <td class="text-center">{{ $book->tahun }}</td>
                                            <td class="text-wrap">{{ $book->keterangan }}</td>
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
