@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Pengakuan/Rekognisi DTPS /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kinerja Dosen | Pengakuan/PKM DTPS </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="jumlah_judul">Jumlah Judul PKM</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="jumlah_judul" name="jumlah_judul"
            value="{{ $totals[$pkm_dtps->sumber_dana] ?? 0 }}"
            autofocus required />
    </div>
</div>


                            @php
                                $options = ['lokal' => 'Perguruan Tinggi (POLIJE)/Mandiri', 'nasional' => 'Lembaga Dalam Negeri (Diluar Polije)', 'internasional' => 'Lembaga Luar Negeri'];
                            @endphp

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sumber_dana">Sumber Dana</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="sumber_dana" name="sumber_dana" required>
                                        @foreach ($options as $value => $label)
                                            <option value="{{ $value }}" {{ old('sumber_dana', $pkm_dtps->sumber_dana) === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tahun">
                                    Tahun Penelitian
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $tahun }}"
                                    readonly />
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
