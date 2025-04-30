@extends('layouts.dosen')

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

                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="masa_studi" name="masa_studi"
                                  value="{{ old('masa_studi') ?? $masaStudi }}"  />
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan">Jumlah Lulusan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan" name="jumlah_lulusan"
                                        value="{{ old('jumlah_lulusan', $EvalWaktuTunggu->jumlah_lulusan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan_terlacak">Jumlah Lulusan Terlacak</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan_terlacak" name="jumlah_lulusan_terlacak"
                                        value="{{ old('jumlah_lulusan_terlacak', $EvalWaktuTunggu->jumlah_lulusan_terlacak) }}" required />
                                </div>
                            </div>

                            @if($masaStudi == 'Diploma Tiga')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan_terlacak_dipesan">Jumlah Lulusan Terlacak Dipesan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan_terlacak_dipesan" name="jumlah_lulusan_terlacak_dipesan"
                                        value="{{ old('jumlah_lulusan_terlacak_dipesan', $EvalWaktuTunggu->jumlah_lulusan_terlacak) }}" required />
                                </div>
                            </div>
                            @endif

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan_waktu_tiga_bulan">Jumlah Lulusan Waktu < 3 Bulan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan_waktu_tiga_bulan" name="jumlah_lulusan_waktu_tiga_bulan"
                                        value="{{ old('jumlah_lulusan_waktu_tiga_bulan', $EvalWaktuTunggu->jumlah_lulusan_waktu_tiga_bulan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan_waktu_enam_bulan">Jumlah Lulusan Waktu 3 Bulan - 6 Bulan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan_waktu_enam_bulan" name="jumlah_lulusan_waktu_enam_bulan"
                                        value="{{ old('jumlah_lulusan_waktu_enam_bulan', $EvalWaktuTunggu->jumlah_lulusan_waktu_enam_bulan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jumlah_lulusan_waktu_sembilan_bulan">Jumlah Lulusan Waktu > 6 Bulan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="jumlah_lulusan_waktu_sembilan_bulan" name="jumlah_lulusan_waktu_sembilan_bulan"
                                        value="{{ old('jumlah_lulusan_waktu_sembilan_bulan', $EvalWaktuTunggu->jumlah_lulusan_waktu_sembilan_bulan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun Lulusan (YYYY/YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $EvalWaktuTunggu->tahun) }}"
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
