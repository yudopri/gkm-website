@extends('layouts.dashboard')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header dan Dropdown Tahun Ajaran --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Rekap Data Dosen</h4>

        {{-- Dropdown Tahun Ajaran pakai slug --}}
        <select class="form-select" id="tahunAjaranSelect" onchange="changeTahunAjaran(this)">
            <option value="">-- Pilih Tahun Ajaran --</option>
            @foreach($tahunAjaranList as $ta)
                <option 
                    value="{{ $ta->slug }}"
                    {{ $selected_slug == $ta->slug ? 'selected' : '' }}>
                    {{ $ta->tahun_ajaran }} ({{ ucfirst($ta->semester) }})
                </option>
            @endforeach
        </select>
            </div>

    {{-- Script URL Redirect --}}
    <script>
        function changeTahunAjaran(select) {
            var selectedSlug = select.value;
            if (selectedSlug) {
                window.location.href = "{{ url()->current() }}?tahun_ajaran=" + encodeURIComponent(selectedSlug);
            }
        }
    </script>

    {{-- Tampilkan pesan jika tidak ada data --}}


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Rekap keseluruhan data Dosen</h5>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>No</th>
                                    <th>Komponen</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                 @foreach($rows as $row)
                                    @if($row['tipe'] === 'utama')
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $row['label'] }}</td>
                                        <td class="text-center">{{ $row['count'] }}</td>
                                    
                                    </tr>
                                    @endif
                                @endforeach
                                {{-- Tampilkan rasio di luar tabel utama jika mau --}}
                                @foreach($rows as $row) 
                                    @if($row['tipe'] === 'rasio')
                                        <tr>
                                            <td colspan="5" class="fw-bold bg-light">{{ $row['label'] }}: {{ $row['count'] }}</td>
                                        </tr>
                                    @endif
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
