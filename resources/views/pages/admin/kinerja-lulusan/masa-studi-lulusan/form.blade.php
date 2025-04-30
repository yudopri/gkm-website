@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Lulusan /</span>
            <span class="text-muted fw-light">Masa Studi Lulusan /</span>
            <span class="text-muted fw-light">({{ $masaStudi}}) /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0"> Kinerja Lulusan / Masa Studi Lulusan / ({{ $masaStudi}}) </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="masa_studi" name="masa_studi"
                                      value="{{ old('masa_studi') ?? $masaStudi }}"  />
                                </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_mhs_diterima">Jumlah Mahasiswa Diterima</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_mhs_diterima" name="jumlah_mhs_diterima"
                                        value="{{ old('jumlah_mhs_diterima', $MasaStudiLulusan->jumlah_mhs_diterima) }}" required />
                                </div>
                            </div>
                            @php
    $maxStudi = match($masaStudi) {
        'Diploma Tiga' => 4,
        'Sarjana/Sarjana Terapan' => 6,
        'Magister/Magister Terapan' => 3,
        default => 0
    };
@endphp


                           {{-- TS --}}
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="jumlah_mhs_lulus_akhir_ts">Jumlah Mahasiswa Lulus Akhir TS</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="jumlah_mhs_lulus_akhir_ts" name="jumlah_mhs_lulus_akhir_ts"
            value="{{ old('jumlah_mhs_lulus_akhir_ts', $MasaStudiLulusan->jumlah_mhs_lulus_akhir_ts) }}" required />
    </div>
</div>

@for ($i = 1; $i <= $maxStudi; $i++)
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="jumlah_mhs_lulus_akhir_ts_{{ $i }}">
            Jumlah Mahasiswa Lulus Akhir TS {{ $i }}
        </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="jumlah_mhs_lulus_akhir_ts_{{ $i }}" name="jumlah_mhs_lulus_akhir_ts_{{ $i }}"
                value="{{ old("jumlah_mhs_lulus_akhir_ts_$i", $MasaStudiLulusan?->{"jumlah_mhs_lulus_akhir_ts_$i"} ?? '') }}" required />
        </div>
    </div>
@endfor


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mean_masa_studi">Rata Rata Masa Studi</label>
                                <div class="col-sm-10">
                                    <input type="number" step="0.01" class="form-control" id="mean_masa_studi" name="mean_masa_studi"
                                        value="{{ old('mean_masa_studi', $MasaStudiLulusan->mean_masa_studi) }}" required />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun Lulusan (YYYY/YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $MasaStudiLulusan->tahun)}}"
                                        required />
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.1/dist/summernote-bs5.min.css">
@endpush

@push('after-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.1/dist/summernote-bs5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#matkulDiampu').summernote({
                height: 250
            });

            $('#sertifikatKompetensi').summernote({
                height: 250
            });
        });
    </script>
@endpush
