@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            Tahun Ajaran Semester
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Tabel Tahun Ajaran Semester</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        <!-- #s tabel -->
                        <div class="table-responsive text-nowrap mb-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-info">
                                    <tr>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <!-- Aksi -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($tahun_ajaran as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->tahun_ajaran }}</td>
                                            <td class="text-center text-capitalize">{{ $value->semester }}</td>

                                            <!-- Aksi -->
                                            <td class="text-center">
                                                <a href="{{ route('admin.dosen.kt.pendidikan.index', $value->slug) }}" class="btn btn-sm btn-info">
                                                    <span class="tf-icons bx bx-edit bx-18px me-2"></span>Isi Form
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="11"> Belum ada data tahun ajaran semester </td>
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
