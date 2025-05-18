@extends('layouts.rekap')

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
                    {{ $tahun_ajaran == $ta->slug ? 'selected' : '' }}>
                    {{ $ta->tahun_ajaran }} ({{ ucfirst($ta->semester) }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Script URL Redirect --}}
    <script>
        function changeTahunAjaran(select) {
            let selectedSlug = select.value;
            let dosenId = "{{ $dosenId ?? '0' }}"; // pastikan variabel ini tersedia dari controller

            if (selectedSlug && dosenId) {
                const routeTemplate = "{{ route('admin.rekap-data.kerjasama-tridharma', ['tahun_ajaran' => '__SLUG__', 'dosen_id' => '__DOSEN__']) }}";
                const finalUrl = routeTemplate
                    .replace('__SLUG__', encodeURIComponent(selectedSlug))
                    .replace('__DOSEN__', encodeURIComponent(dosenId));

                window.location.href = finalUrl;
            }
        }
    </script>


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
