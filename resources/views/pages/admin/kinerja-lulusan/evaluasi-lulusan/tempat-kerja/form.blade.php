@extends('layouts.dashboard')

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
                                <label class="col-sm-2 col-form-label" for="namaDosen">Nama Dosen Industri/Praktisi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaDosen" name="nama_dosen"
                                        value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="NIDK">NIDK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="NIDK" name="nidk" value="{{ old('nidk', $dosen->nidk) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="PerusahaanIndustri">
                                    Perusahaan/Industri
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="PerusahaanIndustri" name="perusahaan"
                                        value="{{ old('perusahaan', $dosen->perusahaan) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="PendTertinggi">
                                    Pendidikan Tertinggi
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="PendTertinggi" name="pendidikan_tertinggi"
                                        value="{{ old('pendidikan_tertinggi', $dosen->pendidikan_tertinggi) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bidangKeahlian">Bidang Keahlian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="bidangKeahlian" name="bidang_keahlian"
                                        value="{{ old('bidang_keahlian', $dosen->bidang_keahlian) }}" placeholder="keahlian1, keahlian2, dst." />
                                    <div class="form-text"> pisahkan dengan koma (,) </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sertifikatKompetensi">Sertifikat Kompetensi/ Profesi/ Industri</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="sertifikatKompetensi" name="sertifikat_kompetensi">{{ old('sertifikat_kompetensi', $dosen->sertifikat_kompetensi) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="matkulDiampu">
                                    Mata Kuliah yang Diampu
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="matkulDiampu" name="mk_diampu">{{ old('mk_diampu', $dosen->mk_diampu) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="BobotKredit">Bobot Kredit (sks)</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="BobotKredit" name="bobot_kredit_sks"
                                        value="{{ old('bobot_kredit_sks', $dosen->bobot_kredit_sks) }}" />
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
