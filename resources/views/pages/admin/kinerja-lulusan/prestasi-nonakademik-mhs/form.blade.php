@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            <span class="text-muted fw-light">Dosen Industri/Praktisi /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Dosen | Dosen Industri/Praktisi </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama_kegiatan">Nama Kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                        value="{{ old('nama_kegiatan', $nonakademik->nama_kegiatan) }}" required />
                                </div>
                            </div>

                            @php
                                $options = ['lokal' => 'Lokal', 'nasional' => 'Nasional', 'internasional' => 'Internasional'];
                            @endphp

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat">Tingkat</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="tingkat" name="tingkat" required>
                                        @foreach ($options as $value => $label)
                                            <option value="{{ $value }}" {{ old('tingkat', $nonakademik->tingkat) === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="prestasi">Prestasi yang dicapai</label>
                                <div class="col-sm-10">
                                    <input type="text"  class="form-control" id="prestasi" name="prestasi"
                                        value="{{ old('prestasi', $nonakademik->prestasi) }}" required />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun Lulusan (YYYY/YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $nonakademik->tahun)}}"
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
