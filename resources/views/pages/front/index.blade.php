@extends('layouts.front')

@section('hero')
    <div class="container-xxl bg-primary hero-header">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="text-white mb-4 animated zoomIn">
                        Gugus Kendali Mutu <br>
                        Politeknik Negeri Jember
                    </h1>
                    <p class="text-white pb-3 animated zoomIn">
                        SI GKM di Prodi Teknik Informatika PSDKU Sidoarjo adalah Sistem Informasi yang digunakan untuk mengelola dan memantau kegiatan
                        penjaminan mutu guna meningkatkan kualitas pendidikan di program studi.
                    </p>
                    <!-- <a href="" class="btn btn-outline-light rounded-pill border-2 py-3 px-5 animated slideInRight">Learn
                            More</a> -->
                </div>
                <div class="col-lg-6 text-center text-lg-start">
                    <img class="img-fluid animated zoomIn" src="{{ asset('frontend/img/hero.png') }}" alt="logo-frontend" />
                </div>
            </div>
        </div>
    </div>
@endsection
