@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data kepuasan_pengguna /</span>
            <span class="text-muted fw-light">kepuasan_pengguna Industri/Praktisi /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data kepuasan_pengguna | Dosen Industri/Praktisi </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jenis_kemampuan">Jenis Kemampuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jenis_kemampuan" name="jenis_kemampuan"
                                        value="{{ old('jenis_kemampuan', $kepuasan_pengguna->jenis_kemampuan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_sangat_baik">Tingkat Kepuasan Sangat Baik</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_sangat_baik" name="tingkat_kepuasan_sangat_baik"
                                        value="{{ old('tingkat_kepuasan_sangat_baik', $kepuasan_pengguna->tingkat_kepuasan_sangat_baik) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_baik">Tingkat Kepuasan Baik</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_baik" name="tingkat_kepuasan_baik"
                                        value="{{ old('tingkat_kepuasan_baik', $kepuasan_pengguna->tingkat_kepuasan_baik) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_cukup">Tingkat Kepuasan Cukup</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_cukup" name="tingkat_kepuasan_cukup"
                                        value="{{ old('tingkat_kepuasan_cukup', $kepuasan_pengguna->tingkat_kepuasan_cukup) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tingkat_kepuasan_kurang">Tingkat Kepuasan Kurang</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="tingkat_kepuasan_kurang" name="tingkat_kepuasan_kurang"
                                        value="{{ old('tingkat_kepuasan_kurang', $kepuasan_pengguna->tingkat_kepuasan_kurang) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="rencana_tindakan">Rencana Tindak Lanjut</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="rencana_tindakan" name="rencana_tindakan"
                                        value="{{ old('rencana_tindakan', $kepuasan_pengguna->rencana_tindakan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan">Jumlah Lulusan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan" name="jumlah_lulusan"
                                        value="{{ old('jumlah_lulusan', $kepuasan_pengguna->jumlah_lulusan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_responden">Jumlah Tanggapan Kepuasan Pengguna Terlacak</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_responden" name="jumlah_responden"
                                        value="{{ old('jumlah_responden', $kepuasan_pengguna->jumlah_responden) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun Lulusan (YYYY/YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $kepuasan_pengguna->tahun) }}"
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
