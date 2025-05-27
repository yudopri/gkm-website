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

    <div class="mb-3">
    <form method="get" action="" class="d-flex justify-content-end">
        <input 
            type="text" 
            name="search" 
            class="form-control w-25 me-2" 
            placeholder="Cari komponen..." 
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>


    {{-- Dropdown Sorting --}}
    <div class="mb-3 d-flex justify-content-end">
        <form id="sortForm" method="get" class="d-flex gap-2">
            <input type="hidden" name="sort" id="sortInput" value="{{ $sort ?? 'label' }}">
            <input type="hidden" name="direction" id="directionInput" value="{{ $direction ?? 'asc' }}">
            <select class="form-select w-auto" id="sortSelect" onchange="submitSortForm()">
                <option value="label" {{ ($sort ?? 'label') == 'label' ? 'selected' : '' }}>Komponen</option>
                <option value="count" {{ ($sort ?? '') == 'count' ? 'selected' : '' }}>Total</option>
                <option value="min" {{ ($sort ?? '') == 'min' ? 'selected' : '' }}>Minimum</option>
                <option value="keterangan" {{ ($sort ?? '') == 'keterangan' ? 'selected' : '' }}>Keterangan</option>
            </select>
            <select class="form-select w-auto" id="directionSelect" onchange="submitSortForm()">
                <option value="asc" {{ ($direction ?? 'asc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ ($direction ?? '') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </form>
    </div>

    {{-- Script URL Redirect --}}
    <script>
        function changeTahunAjaran(select) {
            let selectedSlug = select.value;
            let dosenId = "{{ $dosenId ?? '0' }}"; // pastikan variabel ini tersedia dari controller

            if (selectedSlug && dosenId) {
                const routeTemplate = "{{ route('admin.rekap-data.pagelaran-mahasiswa', ['tahun_ajaran' => '__SLUG__', 'dosen_id' => '__DOSEN__']) }}";
                const finalUrl = routeTemplate
                    .replace('__SLUG__', encodeURIComponent(selectedSlug))
                    .replace('__DOSEN__', encodeURIComponent(dosenId));

                // Pertahankan sort & direction jika ada
                let params = [];
                let sort = document.getElementById('sortSelect')?.value || '{{ $sort ?? 'label' }}';
                let direction = document.getElementById('directionSelect')?.value || '{{ $direction ?? 'asc' }}';
                if(sort) params.push('sort=' + encodeURIComponent(sort));
                if(direction) params.push('direction=' + encodeURIComponent(direction));
                window.location.href = finalUrl + (params.length ? ('?' + params.join('&')) : '');
            }
        }

        function submitSortForm() {
        let sort = document.getElementById('sortSelect').value;
        let direction = document.getElementById('directionSelect').value;
        let search = new URLSearchParams(window.location.search).get('search') || '';

        let form = document.getElementById('sortForm');
        form.action = window.location.pathname + '?search=' + encodeURIComponent(search);
        
        document.getElementById('sortInput').value = sort;
        document.getElementById('directionInput').value = direction;
        form.submit();
    }

    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">TABEL 10 | Luaran Karya Mahasiswa </h5>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>No</th>
                                    <th>Komponen</th>
                                    <th>Total</th>
                                    <th>Minimum</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($rows as $i => $row)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-wrap">{{ $row['label'] }}</td>
                                        <td class="text-center">{{ $row['count'] }}</td>
                                        <td class="text-center">{{ $row['min'] }}</td>
                                        <td class="text-wrap">{{ ucfirst($row['keterangan']) }}</td>
                                    </tr>
                                @endforeach
                                {{-- Tambahkan data dinamis di sini --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('layouts.rekap')

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

    {{-- Dropdown Sorting --}}
    <div class="mb-3 d-flex justify-content-end">
        <form id="sortForm" method="get" class="d-flex gap-2">
            <input type="hidden" name="sort" id="sortInput" value="{{ $sort ?? 'label' }}">
            <input type="hidden" name="direction" id="directionInput" value="{{ $direction ?? 'asc' }}">
            <select class="form-select w-auto" id="sortSelect" onchange="submitSortForm()">
                <option value="label" {{ ($sort ?? 'label') == 'label' ? 'selected' : '' }}>Komponen</option>
                <option value="count" {{ ($sort ?? '') == 'count' ? 'selected' : '' }}>Total</option>
                <option value="min" {{ ($sort ?? '') == 'min' ? 'selected' : '' }}>Minimum</option>
                <option value="keterangan" {{ ($sort ?? '') == 'keterangan' ? 'selected' : '' }}>Keterangan</option>
            </select>
            <select class="form-select w-auto" id="directionSelect" onchange="submitSortForm()">
                <option value="asc" {{ ($direction ?? 'asc') == 'asc' ? 'selected' : '' }}>Ascending</option>
                <option value="desc" {{ ($direction ?? '') == 'desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </form>
    </div>

    {{-- Script URL Redirect --}}
    <script>
        function changeTahunAjaran(select) {
            let selectedSlug = select.value;
            let dosenId = "{{ $dosenId ?? '0' }}"; // pastikan variabel ini tersedia dari controller

            if (selectedSlug && dosenId) {
                const routeTemplate = "{{ route('admin.rekap-data.pagelaran-mahasiswa', ['tahun_ajaran' => '__SLUG__', 'dosen_id' => '__DOSEN__']) }}";
                const finalUrl = routeTemplate
                    .replace('__SLUG__', encodeURIComponent(selectedSlug))
                    .replace('__DOSEN__', encodeURIComponent(dosenId));

                // Pertahankan sort & direction jika ada
                let params = [];
                let sort = document.getElementById('sortSelect')?.value || '{{ $sort ?? 'label' }}';
                let direction = document.getElementById('directionSelect')?.value || '{{ $direction ?? 'asc' }}';
                if(sort) params.push('sort=' + encodeURIComponent(sort));
                if(direction) params.push('direction=' + encodeURIComponent(direction));
                window.location.href = finalUrl + (params.length ? ('?' + params.join('&')) : '');
            }
        }

        function submitSortForm() {
            let sort = document.getElementById('sortSelect').value;
            let direction = document.getElementById('directionSelect').value;
            document.getElementById('sortInput').value = sort;
            document.getElementById('directionInput').value = direction;
            document.getElementById('sortForm').submit();
        }
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">TABEL 10 | Luaran Karya Mahasiswa </h5>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>No</th>
                                    <th>Komponen</th>
                                    <th>Total</th>
                                    <th>Minimum</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($rows as $i => $row)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-wrap">{{ $row['label'] }}</td>
                                        <td class="text-center">{{ $row['count'] }}</td>
                                        <td class="text-center">{{ $row['min'] }}</td>
                                        <td class="text-wrap">{{ ucfirst($row['keterangan']) }}</td>
                                    </tr>
                                @endforeach
                                {{-- Tambahkan data dinamis di sini --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection