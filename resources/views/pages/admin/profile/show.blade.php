<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   GKM POLIJE
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('backend/img/logo/logo-polije.png') }}" />

  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white">
  <div class="w-full h-16 bg-[#00B388]">
  </div>
  <main class="max-w-[1200px] mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-12 gap-8">
   <!-- Left panel -->
   <section class="col-span-12 md:col-span-3 bg-[#0F5B4F] rounded-xl p-8 flex flex-col items-center gap-6 relative">
    <a href="{{ route('admin.dashboard') }}" class="self-start bg-white text-[#0F5B4F] font-semibold text-sm p-2 rounded hover:bg-gray-100 transition mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </a>


    <div class="w-40 h-40 rounded-full bg-white overflow-hidden flex items-center justify-center">
        <img src="{{ asset($profile->user->avatar) }}" alt="Foto Profile" class="object-cover w-full h-full">
    </div>

    <a href="{{ route('admin.profile.edit', $user_id)}}" class="absolute top-6 right-6 bg-white text-[#0F5B4F] font-semibold text-sm px-4 py-2 rounded hover:bg-gray-100 transition">
     Edit Profile
    </a>
    <div class="w-full text-white mt-4">
     <h2 class="font-semibold text-lg border-b border-white pb-1 max-w-max mb-4">
        {{$profile->nama ?? ""}}
     </h2>
     <p class="text-sm mb-2">
        {{$profile->nip ?? ""}}
     </p>
     <p class="text-sm mb-2">
        {{$profile->nidn ?? ""}}
     </p>
     <p class="text-sm mb-2">
        {{$profile->jabatan_fungsional ?? ""}}
     </p>
     <p class="text-sm mb-2">
        {{$profile->jabatan->nama ?? ""}}
     </p>
     <p class="text-sm mb-2">
        {{$profile->program_studi->jurusan->nama ?? ""}}
     </p>
     <p class="text-sm">
        {{$profile->program_studi->nama ?? ""}}
     </p>
    </div>
   </section>
   <!-- Right panel -->
   <section class="col-span-12 md:col-span-9 flex flex-col gap-6">
    <!-- Skills and description container -->
    <div class="col-span-12 md:col-span-7 bg-[#0F5B4F] rounded-xl p-6 flex flex-col gap-6">
        <h3 class="text-white font-semibold text-base border-b border-white pb-2">
          Jurusan
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-2">
          @php
              $jurusanList = [
                  'Teknologi Informasi',
                  'Produksi Pertanian',
                  'Peternakan',
                  'Manajemen Agribisnis',
                  'Teknologi Pertanian',
                  'Bahasa, Komunikasi, dan Pariwisata',
                  'Kesehatan',
                  'Teknik',
                  'Bisnis',
                  'Kelas Internasional'
              ];
          @endphp

          @foreach($jurusanList as $jurusan)
            <div class="flex items-center justify-center text-center bg-white text-[#0F5B4F] text-xs font-medium rounded-lg p-3 min-h-[70px] shadow hover:shadow-md transition">
              {{ $jurusan }}
            </div>
          @endforeach
        </div>
      </div>


     <!-- Description -->
     <div class="col-span-12 md:col-span-5 bg-[#0F5B4F] rounded-xl p-6 text-white text-xs leading-tight">
      SI GKM di Program Studi Teknik Informatika PSDKU Sidoarjo adalah sebuah Sistem Informasi yang dirancang untuk membantu dalam mengelola, mendokumentasikan, dan memantau seluruh kegiatan penjaminan mutu akademik di tingkat program studi. Sistem ini berfungsi sebagai platform terintegrasi yang mendukung berbagai aktivitas evaluasi internal, perencanaan peningkatan mutu, serta pelaporan kinerja akademik secara berkelanjutan. Melalui SI GKM, Prodi Teknik Informatika dapat lebih efektif dalam memastikan bahwa standar kualitas pendidikan tercapai dan terus mengalami peningkatan dari waktu ke waktu.
     </div>
    </div>
    <!-- Empty green box below skills -->
    <div class="col-span-12 md:col-span-7 bg-[#0F5B4F] rounded-xl h-48">
    </div>
    <!-- Buttom image -->
    <div class="overflow-hidden rounded-xl">
        <picture>
            <source srcset="{{ asset('frontend/img/hqdefault.webp') }}" type="image/webp">
            <img src="{{ asset('frontend/img/hqdefault.jpg') }}" alt="Politeknik Negeri Jember"
                 class="w-full object-cover rounded-xl" height="150" width="900" loading="lazy">
          </picture>


       </div>
   </section>
  </main>
 </body>
</html>
