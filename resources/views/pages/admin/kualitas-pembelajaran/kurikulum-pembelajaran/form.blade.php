@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Pengakuan/kurikulum pembelajaran /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kinerja Dosen | Pengakuan/kurikulum pembelajaran </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama_mata_kuliah">Nama Mata Kuliah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_mata_kuliah" name="nama_mata_kuliah"
                                        value="{{ old('nama_mata_kuliah', $kurikulum->nama_mata_kuliah) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kode_mata_kuliah">Kode Mata Kuliah</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kode_mata_kuliah" name="kode_mata_kuliah"
                                        value="{{ old('kode_mata_kuliah', $kurikulum->kode_mata_kuliah) }}" placeholder="Reviewer Jurnal.." required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mata_kuliah_kompetensi">Mata Kuliah Kompetensi</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <!-- Hidden field to send "0" if checkbox is unchecked -->
                                    <input type="hidden" name="mata_kuliah_kompetensi" value="0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input ms-2"
                                        id="mata_kuliah_kompetensi"
                                        name="mata_kuliah_kompetensi"
                                        value="1"
                                        {{ old('mata_kuliah_kompetensi', $kurikulum->mata_kuliah_kompetensi ?? false) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="mata_kuliah_kompetensi">Ya</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sks_kuliah">SKS Kuliah/Teori</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sks_kuliah" name="sks_kuliah"
                                        value="{{ old('sks_kuliah', $kurikulum->sks_kuliah) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sks_seminar">SKS Seminar</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sks_seminar" name="sks_seminar"
                                        value="{{ old('sks_seminar', $kurikulum->sks_seminar) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sks_praktikum">SKS Pratikum</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="sks_praktikum" name="sks_praktikum"
                                        value="{{ old('sks_praktikum', $kurikulum->sks_praktikum) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="konversi_sks">Konversi SKS</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="konversi_sks" name="konversi_sks"
                                        value="{{ old('konversi_sks', $kurikulum->konversi_sks) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="semester">Semester</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="semester" name="semester"
                                        value="{{ old('semester', $kurikulum->semester) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="metode_pembelajaran">Metode Pembelajaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="metode_pembelajaran" name="metode_pembelajaran"
                                        value="{{ old('metode_pembelajaran', $kurikulum->metode_pembelajaran) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="dokumen">Dokumen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dokumen" name="dokumen"
                                        value="{{ old('dokumen', $kurikulum->dokumen) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="unit_penyelenggara">Unit Penyelenggara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="unit_penyelenggara" name="unit_penyelenggara"
                                        value="{{ old('unit_penyelenggara', $kurikulum->unit_penyelenggara) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="capaian_kuliah_sikap">Capaian Kuliah Sikap</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <!-- Hidden field to send "0" if checkbox is unchecked -->
                                    <input type="hidden" name="capaian_kuliah_sikap" value="0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input ms-2"
                                        id="capaian_kuliah_sikap"
                                        name="capaian_kuliah_sikap"
                                        value="1"
                                        {{ old('capaian_kuliah_sikap', $kurikulum->capaian_kuliah_sikap ?? false) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="capaian_kuliah_sikap">Ya</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="capaian_kuliah_pengetahuan">Capaian Kuliah Pengetahuan</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <!-- Hidden field to send "0" if checkbox is unchecked -->
                                    <input type="hidden" name="capaian_kuliah_pengetahuan" value="0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input ms-2"
                                        id="capaian_kuliah_pengetahuan"
                                        name="capaian_kuliah_pengetahuan"
                                        value="1"
                                        {{ old('capaian_kuliah_pengetahuan', $kurikulum->capaian_kuliah_pengetahuan ?? false) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="capaian_kuliah_pengetahuan">Ya</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="capaian_kuliah_keterampilan_umum">Capaian Kuliah Keterampilan Umum</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <!-- Hidden field to send "0" if checkbox is unchecked -->
                                    <input type="hidden" name="capaian_kuliah_keterampilan_umum" value="0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input ms-2"
                                        id="capaian_kuliah_keterampilan_umum"
                                        name="capaian_kuliah_keterampilan_umum"
                                        value="1"
                                        {{ old('capaian_kuliah_keterampilan_umum', $kurikulum->capaian_kuliah_keterampilan_umum ?? false) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="capaian_kuliah_keterampilan_umum">Ya</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="capaian_kuliah_keterampilan_khusus">Capaian Kuliah Keterampilan Khusus</label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <!-- Hidden field to send "0" if checkbox is unchecked -->
                                    <input type="hidden" name="capaian_kuliah_keterampilan_khusus" value="0">
                                    <input
                                        type="checkbox"
                                        class="form-check-input ms-2"
                                        id="capaian_kuliah_keterampilan_khusus"
                                        name="capaian_kuliah_keterampilan_khusus"
                                        value="1"
                                        {{ old('capaian_kuliah_keterampilan_khusus', $kurikulum->capaian_kuliah_keterampilan_khusus ?? false) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label ms-2" for="capaian_kuliah_keterampilan_khusus">Ya</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun (YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $kurikulum->tahun) }}"
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
