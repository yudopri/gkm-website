@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Pengakuan/kepuasan mahasiswa DTPS /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kinerja Dosen | Pengakuan/kepuasan mahasiswa DTPS </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="aspek_penilaian">Aspek Penilaian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="aspek_penilaian" name="aspek_penilaian"
                                        value="{{ old('aspek_penilaian', $kepuasan_mahasiswa->aspek_penilaian) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_sangat_baik">Tingkat Kepuasan Sangat Baik</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_sangat_baik" name="tingkat_kepuasan_sangat_baik"
                                        value="{{ old('tingkat_kepuasan_sangat_baik', $kepuasan_mahasiswa->tingkat_kepuasan_sangat_baik) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_baik">Tingkat Kepuasan Baik</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_baik" name="tingkat_kepuasan_baik"
                                        value="{{ old('tingkat_kepuasan_baik', $kepuasan_mahasiswa->tingkat_kepuasan_baik) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_cukup">Tingkat Kepuasan Cukup</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_cukup" name="tingkat_kepuasan_cukup"
                                        value="{{ old('tingkat_kepuasan_cukup', $kepuasan_mahasiswa->tingkat_kepuasan_cukup) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_kurang">Tingkat Kepuasan Buruk</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_kurang" name="tingkat_kepuasan_kurang"
                                        value="{{ old('tingkat_kepuasan_kurang', $kepuasan_mahasiswa->tingkat_kepuasan_kurang) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="rencana_tindakan">Rencana Tindak Lanjut</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rencana_tindakan" name="rencana_tindakan"
                                        value="{{ old('rencana_tindakan', $kepuasan_mahasiswa->rencana_tindakan) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun (YYYY/YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $kepuasan_mahasiswa->tahun) }}"
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
