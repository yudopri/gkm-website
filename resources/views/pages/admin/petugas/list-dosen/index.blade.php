@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            List Data Dosen
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel List Dosen</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap mb-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Dosen</th>
                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($list_dosen as $dosen)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $dosen->profile->nama }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <a href="{{ route('admin.petugas.detail.kt.pendidikan.show', $dosen->id) }}" class="btn btn-sm btn-info">
                                                    <span class="tf-icons bx bx-show-alt bx-18px me-2"></span>Lihat
                                                </a>
                                                <a href="{{ route('admin.petugas.list-dosen.export.pdf', $dosen->id) }}" target="_blank"
                                                    class="btn btn-sm btn-danger">
                                                    <span class="tf-icons bx bxs-file-pdf bx-18px me-2"></span>PDF
                                                </a>
                                                <a href="{{ route('admin.petugas.list-dosen.export.excel', $dosen->id) }}" class="btn btn-sm btn-success">
                                                    <span class="tf-icons bx bx-spreadsheet bx-18px me-2"></span>Export Excel
                                                </a>
<<<<<<< HEAD
                                                <a href="{{ route('admin.rekap-data.kerjasama-tridharma.pendidikan', ['tahun_ajaran' => '2024-2025']) }}" class="btn btn-sm" style="background-color: orange; color: white;">
                                                    <span class="tf-icons bx bx-file bx-18px me-2"></span>Rekap
                                                </a>
=======
                                                <form action="{{ route('admin.petugas.list-dosen.import.excel') }}" method="POST" enctype="multipart/form-data" class="d-inline">
                                                    @csrf
                                                    <label for="file-upload" class="btn btn-sm btn-primary">
                                                        <span class="tf-icons bx bx-upload bx-18px me-2"></span>Import Excel
                                                    </label>
                                                    <input id="file-upload" type="file" name="file" accept=".xlsx,.csv" onchange="this.form.submit()" style="display: none;">
                                                </form>

>>>>>>> 9f374239500b382f643e282e940c5d5b66d59713
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="11"> Belum ada data dosen </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- #e tabel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
