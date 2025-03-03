@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            <span class="text-muted fw-light">Dosen Tidak Tetap /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Dosen | Dosen Tidak Tetap </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaDosen">Nama Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaDosen" name="nama_dosen"
                                        value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nidn">NIDN/NIDK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nidn" name="nidn_nidk"
                                        value="{{ old('nidn_nidk', $dosen->nidn_nidk) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="pascaSarjana">
                                    Pendidikan Pasca Sarjana
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pascaSarjana" name="pendidikan_pascasarjana"
                                        value="{{ old('pendidikan_pascasarjana', $dosen->pendidikan_pascasarjana) }}" />
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
                                <label class="col-sm-2 col-form-label" for="jabatanAkademik">Jabatan Akademik</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="jabatanAkademik" name="jabatan_akademik">
                                        <option value=" "> </option>
                                        @foreach ($jabatanAkademik as $jabatan)
                                            <option value="{{ $jabatan->nama }}"
                                                {{ old('jabatan_akademik', $dosen->jabatan_akademik) === $jabatan->nama ? 'selected' : '' }}>
                                                {{ $jabatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sertifikatPendidik">Sertifikat Pendidik Profesional</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sertifikatPendidik" name="sertifikat_pendidik"
                                        value="{{ old('sertifikat_pendidik', $dosen->sertifikat_pendidik) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sertifikatKompetensi">Sertifikat Kompetensi/ Profesi/ Industri</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sertifikatKompetensi" name="sertifikat_kompetensi"
                                        value="{{ old('sertifikat_kompetensi', $dosen->sertifikat_kompetensi) }}"
                                        placeholder="kompetensi1, kompetensi2, dst." />
                                    <div class="form-text"> pisahkan dengan koma (,) </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="matkulDiampu">
                                    Mata Kuliah yang Diampu pada PS
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="matkulDiampu" name="mk_diampu">{{ old('mk_diampu', $dosen->mk_diampu) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kesesuaianKeahlian">
                                    Kesesuaian Bidang Keahlian dengan Mata Kuliah yang Diampu
                                </label>
                                <div class="col-sm-10 d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id="kesesuaianKeahlian" name="kesesuaian_keahlian_mk" value="1"
                                        {{ old('kesesuaian_keahlian_mk', $dosen->kesesuaian_keahlian_mk ?? false) ? 'checked' : '' }} />
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
        });
    </script>
@endpush
