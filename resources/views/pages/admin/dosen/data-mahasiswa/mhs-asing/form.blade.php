@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Mahasiswa /</span>
            <span class="text-muted fw-light">Mahasiswa Asing /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Mahasiswa | Mahasiswa Asing </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mhsAktif">Jumlah Mahahsiswa Aktif</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mhsAktif" name="mhs_aktif"
                                        value="{{ old('mhs_aktif', $mhs->mhs_aktif) }}" autofocus />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mhsAsingFulltime">Jumlah Mahasiswa Asing Penuh Waktu (Full-time)</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mhsAsingFulltime" name="mhs_asing_fulltime"
                                        value="{{ old('mhs_asing_fulltime', $mhs->mhs_asing_fulltime) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mhsAsingParttime">Jumlah Mahasiswa Asing Paruh Waktu (Part-time)</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mhsAsingParttime" name="mhs_asing_parttime"
                                        value="{{ old('mhs_asing_parttime', $mhs->mhs_asing_parttime) }}" />
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
