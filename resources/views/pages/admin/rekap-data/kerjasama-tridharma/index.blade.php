@extends('layouts.rekap')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header dan Dropdown Tahun Ajaran --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Rekap Data Dosen</h4>
        {{-- Dropdown TA bisa ditambahkan kembali jika perlu --}}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">TABEL 1 | Kerjasama Tridharma</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>No</th>
                                    <th>Komponen</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($rows as $i => $row)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-wrap">{{ $row['label'] }}</td>
                                        <td class="text-center">{{ $row['count'] }}</td>
                                        <td class="text-wrap">{{ ucfirst($row['keterangan']) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
