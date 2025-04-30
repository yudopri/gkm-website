@extends('layouts.dosen')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Luaran Karya Mahasiswa /</span>
            <span class="text-muted fw-light">Pengakuan/Produk jasa Mahasiswa /</span>
            {{ $form_title }}
        </h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Luaran Karya Mahasiswa | Pengakuan/Produk jasa Mahasiswa </h5>
                        <small class="text-muted float-end"> - </small>
                    </div>

                    <div class="card-body">
                        <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                            @csrf @method($form_method)

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaMahasiswa">Nama Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaMahasiswa" name="nama_mahasiswa"
                                        value="{{ old('nama_mahasiswa', $produk_jasa->nama_mahasiswa) }}" autofocus required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="namaProduk">Nama Produk/Jasa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="namaProduk" name="nama_produk"
                                        value="{{ old('nama_produk', $produk_jasa->nama_produk) }}" placeholder="Reviewer Jurnal.." required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="deskripsiProduk">Deskripsi Produk/Jasa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="deskripsiProduk" name="deskripsi_produk"
                                        value="{{ old('deskripsi_produk', $produk_jasa->deskripsi_produk) }}" placeholder="Reviewer Jurnal.." required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="bukti">Bukti Pendukung Produk/Jasa (URL)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="bukti" name="bukti"
                                        value="{{ old('bukti', $produk_jasa->bukti) }}" placeholder="https://drive.google.com/.."
                                        required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="Tahun">
                                    Tahun (YYYY)
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Tahun" name="tahun" value="{{ old('tahun', $produk_jasa->tahun) }}"
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
