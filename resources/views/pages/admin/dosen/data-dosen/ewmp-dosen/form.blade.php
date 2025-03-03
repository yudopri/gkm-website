@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            <span class="text-muted fw-light">Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Dosen | Ekuivalen Waktu Mengajar Penuh (EWMP) Dosen </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaDosen">Nama Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaDosen" name="nama_dosen"
                                        value="{{ old('nama_dosen', $ewmp->nama_dosen) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="dtps">DTPS</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id="dtps" name="is_dtps" value="1"
                                        {{ old('is_dtps', $ewmp->is_dtps ?? false) ? 'checked' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="psDiakreditasi">
                                    PS yang Diakreditasi
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="psDiakreditasi" name="ps_diakreditasi"
                                        value="{{ old('ps_diakreditasi', $ewmp->ps_diakreditasi) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="psLainDalamPT">
                                    PS Lain di dalam PT
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="psLainDalamPT" name="ps_lain_dalam_pt"
                                        value="{{ old('ps_lain_dalam_pt', $ewmp->ps_lain_dalam_pt) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="psLainLuarPT">
                                    PS Lain di luar PT
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="psLainLuarPT" name="ps_lain_luar_pt"
                                        value="{{ old('ps_lain_luar_pt', $ewmp->ps_lain_luar_pt) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ewmpPenelitian">
                                    Penelitian
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="ewmpPenelitian" name="penelitian"
                                        value="{{ old('penelitian', $ewmp->penelitian) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="ewmpPkm">
                                    PkM
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="ewmpPkm" name="pkm"
                                        value="{{ old('pkm', $ewmp->pkm) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tugasTambahan">
                                    Tugas Tambahan dan/atau Penunjang
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="tugasTambahan" name="tugas_tambahan"
                                        value="{{ old('tugas_tambahan', $ewmp->tugas_tambahan) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="JumlahSks">
                                    Jumlah (sks)
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="JumlahSks" name="jumlah_sks"
                                        value="{{ old('jumlah_sks', $ewmp->jumlah_sks) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="AvgPerSemester">
                                    Rata-rata per Semester (sks)
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" step=".01" class="form-control" id="AvgPerSemester"
                                        name="avg_per_semester" value="{{ old('avg_per_semester', $ewmp->avg_per_semester) }}" />
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

            $('#matkulDiampuLain').summernote({
                height: 250
            });
        });
    </script>
@endpush
