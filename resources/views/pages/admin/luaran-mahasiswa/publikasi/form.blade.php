@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            <span class="text-muted fw-light">Pengakuan/Publikasi Mahasiswa /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Luaran Karya Mahasiswa | Pengakuan/Publikasi Mahasiswa </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                    <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaMahasiswa">Nama Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaMahasiswa" name="nama_mahasiswa"
                                        value="{{ old('nama_mahasiswa', $publikasi_ilmiah->nama_mahasiswa) }}" autofocus required />
                                </div>
                            </div>
                            <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="judul_artikel">Judul Artikel</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="judul_artikel" name="judul_artikel"
            value="{{ $publikasi_ilmiah->judul_artikel ?? '' }}"
            autofocus required />
    </div>
</div>
                            @php
                                $options = ['Jurnal penelitian tidak terakreditasi'=>'Jurnal penelitian tidak terakreditasi', '	Jurnal penelitian nasional terakreditasi' , 'Jurnal penelitian internasional','	Jurnal penelitian internasional bereputasi','Seminar wilayah/lokal/perguruan tinggi','Seminar nasional','Seminar internasional','Pagelaran/pameran/presentasi dalam forum di tingkat wilayah','	Pagelaran/pameran/presentasi dalam forum di tingkat nasional','Pagelaran/pameran/presentasi dalam forum di tingkat internasional'];
                            @endphp

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="jenis_artikel">Jenis Artikel</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="jenis_artikel" name="jenis_artikel" required>
                                        @foreach ($options as $value => $label)
                                            <option value="{{ $value }}" {{ old('jenis_artikel', $publikasi_ilmiah->jenis_artikel) === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tahun">
                                    Tahun Penelitian
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $tahun }}"
                                    readonly />
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
