@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            <span class="text-muted fw-light">Seleksi Mahasiswa Baru /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Mahasiswa | Seleksi Mahasiswa Baru </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tahunAkademik">Tahun Akademik</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahunAkademik" name="tahun_akademik"
                                        value="{{ old('tahun_akademik', $seleksi->tahun_akademik) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="dayaTampung">Daya Tampung</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="dayaTampung" name="daya_tampung"
                                        value="{{ old('daya_tampung', $seleksi->daya_tampung) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="calonPendaftar">Jumlah Calon Mahasiswa Pendaftar</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="calonPendaftar" name="pendaftar"
                                        value="{{ old('pendaftar', $seleksi->pendaftar) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="lulusSeleksi">Jumlah Calon Mahasiswa Lulus Seleksi</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="lulusSeleksi" name="lulus_seleksi"
                                        value="{{ old('lulus_seleksi', $seleksi->lulus_seleksi) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mabaReguler">Jumlah Mahasiswa Baru Reguler</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mabaReguler" name="maba_reguler"
                                        value="{{ old('maba_reguler', $seleksi->maba_reguler) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mabaTransfer">Jumlah Mahasiswa Baru Transfer</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mabaTransfer" name="maba_transfer"
                                        value="{{ old('maba_transfer', $seleksi->maba_transfer) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="aktifReguler">Jumlah Mahasiswa Aktif Reguler</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="aktifReguler" name="mhs_aktif_reguler"
                                        value="{{ old('mhs_aktif_reguler', $seleksi->mhs_aktif_reguler) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="aktifTransfer">Jumlah Mahasiswa Aktif Transfer</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="aktifTransfer" name="mhs_aktif_transfer"
                                        value="{{ old('mhs_aktif_transfer', $seleksi->mhs_aktif_transfer) }}" />
                                </div>
                            </div>

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
            $('#manfaatBagiPS').summernote({
                height: 300
            });
        });
    </script>
@endpush
