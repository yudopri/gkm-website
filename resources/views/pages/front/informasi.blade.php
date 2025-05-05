@extends('layouts.front')

@section('hero')
<div class="bg-primary hero-header">
  {{-- Header --}}
  <header class="text-center mb-8" data-aos="fade-down" data-aos-duration="800">
    <h2 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-green-400 animate-text">
      🚀 Panduan Penggunaan
    </h2>
    <p class="mt-2 text-gray-100 italic">
      Langkah ringkas untuk mengoptimalkan penggunaan sistem GKM Polije
    </p>

    @php
    $guidebookExists = file_exists(public_path('guidebook.pdf'));
@endphp

<div class="mt-4 flex justify-center">
    @if ($guidebookExists)
        <a href="{{ asset('guidebook.pdf') }}" target="_blank"
           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs bg-gradient-to-r from-green-400 to-teal-500 text-black font-medium rounded-full shadow-sm hover:shadow-md transition">
            <i class="fas fa-download text-xs"></i>
            <span>Download Guidebook</span>
        </a>
    @else
        <button onclick="showMissingFileAlert()" type="button"
           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs bg-gradient-to-r from-gray-400 to-gray-500 text-black font-medium rounded-full shadow-sm hover:shadow-md transition cursor-not-allowed">
            <i class="fas fa-download text-xs"></i>
            <span>Download Guidebook</span>
        </button>
    @endif
</div>


  </header>


  {{-- Cards Grid --}}
  <div
  class="relative group bg-white rounded-2xl shadow-md p-4 md:p-6 overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl border border-gray-200"
  data-aos="zoom-in"
  data-aos-duration="600"
>


    @php
      $cards = [
        [
          'icon'  => '🔐',
          'title' => 'Login',
          'steps' => [
            'Buka website GKM Polije.',
            'Masukkan username dan password.',
            'Klik tombol Login.',
          ],
        ],
        [
          'icon'  => '🧑‍💻',
          'title' => 'Dosen, Staff, & Mahasiswa',
          'steps' => [
            'Masuk ke menu Tahun Ajaran.',
            'Pilih Tahun Ajaran yang sesuai.',
            'Pilih menu yang diinginkan.',
            'Pilih Tambah/Ubah/Hapus sesuai kebutuhan.',
            'Ikuti instruksi pada form atau tabel.',
          ],
        ],
        [
          'icon'  => '🛠️',
          'title' => 'Admin & Petugas',
          'steps' => [
            'Buka menu List Dosen.',
            'Export atau Import sesuai kebutuhan.',
          ],
        ],
        [
          'icon'  => '⚠️',
          'title' => 'Catatan & Tips',
          'steps' => [
            'Selalu logout setelah selesai.',
            'Gunakan template yang benar.',
            'Hindari data duplikat.',
            'Hubungi admin jika error.',
          ],
        ],
      ];
    @endphp

    @forelse ($cards as $card)
      <div
        class="relative group bg-white rounded-2xl shadow-md p-4 md:p-6 overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl"
        data-aos="zoom-in"
        data-aos-duration="600"
      >
        {{-- Decorative Blob --}}
        <div class="absolute top-0 right-0 w-24 h-24 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-40 group-hover:opacity-60 transition-opacity"></div>

        <div class="relative z-10 flex items-center mb-3">
            <div class="text-sm md:text-base px-4 py-2 bg-gradient-to-tr from-teal-400 to-green-300 text-black rounded-full shadow flex items-center gap-2">
              <span class="text-xl">{{ $card['icon'] }}</span>
              <span class="font-semibold">{{ $card['title'] }}</span>
            </div>
          </div>



        <ol class="list-decimal list-inside text-gray-800 space-y-1 text-sm">
          @foreach ($card['steps'] as $step)
            <li>{{ $step }}</li>
          @endforeach
        </ol>
      </div>
    @empty
      <p class="col-span-full text-center text-gray-100">Belum ada panduan tersedia.</p>
    @endforelse
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showMissingFileAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'File Tidak Tersedia',
            text: 'Guidebook belum tersedia saat ini.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }
</script>
@endsection
