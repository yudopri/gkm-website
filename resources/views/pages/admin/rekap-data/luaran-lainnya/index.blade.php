@extends('layouts.rekap')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Header dan Dropdown Tahun Ajaran --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Rekap Data Dosen</h4>

        <select class="form-select" onchange="changeTahunAjaran(this)">
            <option value="">-- Pilih Tahun Ajaran --</option>
            @foreach($tahunAjaranList as $ta)
                <option 
                    value="{{ str_replace('/', '-', $ta->tahun_ajaran) }}" 
                    {{ str_replace('/', '-', $tahun_ajaran) == str_replace('/', '-', $ta->tahun_ajaran) ? 'selected' : '' }}>
                    {{ $ta->tahun_ajaran }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Script langsung ditaruh di sini --}}
    <script>
        function changeTahunAjaran(select) {
            let selected = select.value;
            if (selected) {
                const route = "{{ route('admin.rekap-data.kerjasama-tridharma', ['tahun_ajaran' => '__REPLACE__']) }}";
                const finalUrl = route.replace('__REPLACE__', selected);  // Sudah pakai format yang bersih
                console.log("Final URL:", finalUrl);
                window.location.href = finalUrl;
            }
        }
    </script>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">TABEL 5 | Luaran Lainnya </h5>
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
                            
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-wrap">Tabel 3.b.7| Luaran Penelitian/PkM Lainnya - HKI (Paten, Paten Sederhana)</td>
                                <td class="text-center">1</td>
                                <td class="text-wrap">
                                    Kurang
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-wrap">Tabel 3.b.8| Luaran Penelitian/PkM Lainnya - HKI (Hak Cipta, Desain Produk Industri, dll.)</td>
                                <td class="text-center">1</td>
                                <td class="text-wrap">
                                    Kurang
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-wrap">Tabel 3.b.9| Luaran Penelitian/PkM Lainnya - Teknologi Tepat Guna, Produk, Karya Seni, Rekayasa Sosial</td>
                                <td class="text-center">1</td>
                                <td class="text-wrap">
                                    Kurang
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="text-wrap">Tabel 3.b.10| Luaran Penelitian/PkM Lainnya - Buku ber-ISBN, Book Chapter</td>
                                <td class="text-center">1</td>
                                <td class="text-wrap">
                                    Kurang
                                </td>
                            </tr>
                            
                            
                            {{-- Tambahkan data dinamis di sini --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        

    </div>
</div>
   
    </div>
</div>
@endsection
