@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kerjasama Tridharma /</span>
            <span class="text-muted fw-light">Pengabdian Masyarakat /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Kerjasama Tridharma | Pengabdian Masyarakat </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Lembaga Mitra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" name="lembaga_mitra"
                                        value="{{ old('lembaga_mitra', $kerjasama->lembaga_mitra) }}" required />
                                </div>
                            </div>

                            @php
                                $options = ['lokal' => 'Wilayah/Lokal', 'nasional' => 'Nasional', 'internasional' => 'Internasional'];
                            @endphp

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="exampleFormControlSelect1">Tingkat</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1" name="tingkat" required>
                                        @foreach ($options as $value => $label)
                                            <option value="{{ $value }}" {{ old('tingkat', $kerjasama->tingkat) === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="judulKegiatanKerjasama">
                                    Judul Kegiatan Kerjasama
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="judulKegiatanKerjasama" name="judul_kegiatan"
                                        value="{{ old('judul_kegiatan', $kerjasama->judul_kegiatan) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="manfaatBagiPS">
                                    Manfaat Bagi PS
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="manfaatBagiPS" name="manfaat">{{ old('manfaat', $kerjasama->manfaat) }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="waktuDanDurasi">Waktu dan Durasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="waktuDanDurasi" name="waktu_durasi"
                                        value="{{ old('waktu_durasi', $kerjasama->waktu_durasi) }}" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="buktiKerjasama">Bukti Kerjasama (URL)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="buktiKerjasama" name="bukti_kerjasama"
                                        value="{{ old('bukti_kerjasama', $kerjasama->bukti_kerjasama) }}" placeholder="https://drive.google.com/.."
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="TahunBerakhirnyaKerjasama">
                                    Tahun Berakhirnya Kerjasama (YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="TahunBerakhirnyaKerjasama" name="tahun_berakhir"
                                        value="{{ old('tahun_berakhir', $kerjasama->tahun_berakhir) }}" required />
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
