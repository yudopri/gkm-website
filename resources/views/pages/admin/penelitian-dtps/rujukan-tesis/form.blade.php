@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kinerja Dosen /</span>
            <span class="text-muted fw-light">Pengakuan/Rekognisi DTPS /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kinerja Dosen | Pengakuan/Rekognisi DTPS </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaDosen">Nama Dosen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaDosen" name="nama_dosen"
                                        value="{{ old('nama_dosen', $rujukanTesis->nama_dosen) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tema_penelitian">Tema Penelitian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tema_penelitian" name="tema_penelitian"
                                        value="{{ old('tema_penelitian', $rujukanTesis->tema_penelitian) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nama_mahasiswa">Nama Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"
                                        value="{{ old('nama_mahasiswa', $rujukanTesis->nama_mahasiswa) }}" placeholder="keahlian1, keahlian2, dst."
                                        required />
                                    <div class="form-text"> pisahkan dengan koma (,) </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="judul">Judul Penelitian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        value="{{ old('judul', $rujukanTesis->judul) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun (YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $rujukanTesis->tahun)}}"
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
