@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Data Dosen /</span>
            <span class="text-muted fw-light">Dosen Pembimbing Utama Tugas Akhir /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Data Dosen | Dosen Pembimbing Utama Tugas Akhir </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaDosen">Nama Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaDosen" name="nama_dosen"
                                        value="{{ old('nama_dosen', $dosen->nama_dosen) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mhsBimbinganPS">Jumlah Mahasiswa yang Dibimbing pada PS</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mhsBimbinganPS" name="mhs_bimbingan_ps"
                                        value="{{ old('mhs_bimbingan_ps', $dosen->mhs_bimbingan_ps) }}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="mhsBimbinganPSLain">
                                    Jumlah Mahasiswa yang Dibimbing pada PS Lain di POLIJE
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" class="form-control" id="mhsBimbinganPSLain" name="mhs_bimbingan_ps_lain"
                                        value="{{ old('mhs_bimbingan_ps_lain', $dosen->mhs_bimbingan_ps_lain) }}" />
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
