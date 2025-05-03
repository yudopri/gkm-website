<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Edit Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet"/>
  <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('backend/img/logo/logo-polije.png') }}" />

  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white">
  <div class="w-full h-16 bg-[#00B388]"></div>
  <main class="max-w-[600px] mx-auto px-6 py-10">
   <h1 class="text-2xl font-semibold text-[#0F5B4F] mb-8">Edit Profile</h1>
   <form class="bg-[#0F5B4F] rounded-xl p-8 text-white space-y-6" action="{{ route('admin.profile.update', $id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Avatar -->
    <div class="flex flex-col items-center gap-4">
        <div class="w-32 h-32 rounded-full bg-white overflow-hidden flex items-center justify-center" id="avatarPreview">
            @if (!empty($profile->user->avatar))
                <img src="{{ asset($profile->user->avatar) }}" class="object-cover w-full h-full rounded-full" alt="Avatar Lama">
            @else
                <!-- Kalau belum ada avatar, bisa kasih gambar default -->
                <img src="{{ asset('img/default-avatar.png') }}" class="object-cover w-full h-full rounded-full" alt="Avatar Default">
            @endif
        </div>

        <label for="avatar" class="cursor-pointer text-xs underline text-white hover:text-gray-300">Change Profile Image</label>
        <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*"/>
    </div>

    <!-- Nama Lengkap -->
    <div>
        <label for="nama" class="block mb-1 font-semibold text-xs">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" value="{{$profile->nama ?? ''}}" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required/>
    </div>

    <!-- NIP -->
    <div>
        <label for="nip" class="block mb-1 font-semibold text-xs">NIP</label>
        <input id="nip" name="nip" type="text" value="{{$profile->nip ?? ''}}" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required/>
    </div>

    <!-- NIDN -->
    <div>
        <label for="nidn" class="block mb-1 font-semibold text-xs">NIDN</label>
        <input id="nidn" name="nidn" type="text" value="{{$profile->nidn ?? ''}}" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required/>
    </div>
    <!-- NO Handphone -->
    <div>
        <label for="handphone" class="block mb-1 font-semibold text-xs">No Handphone</label>
        <input id="handphone" name="handphone" type="text" value="{{$profile->nidn ?? ''}}" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required/>
    </div>

    <!-- Jabatan Fungsional -->
    <div>
        <label for="jabatan_fungsional" class="block mb-1 font-semibold text-xs">Jabatan Fungsional</label>
        <select id="jabatan_fungsional" name="jabatan_fungsional" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required>
            <option value="">Pilih Jabatan Fungsional</option>
            @foreach($jabatanFungsionalList as $jabatanFungsi)
                <option value="{{ $jabatanFungsi->nama }}" {{ $profile->jabatan_fungsional == $jabatanFungsi->nama ? 'selected' : '' }}>{{ $jabatanFungsi->nama }}</option>
            @endforeach
        </select>
    </div>

    <!-- Jabatan -->
    <div>
        <label for="jabatan" class="block mb-1 font-semibold text-xs">Jabatan</label>
        <select id="jabatan" name="jabatan_id" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required>
            <option value="">Pilih Jabatan</option>
            @foreach($jabatanList as $jabatan)
                <option value="{{ $jabatan->id }}" {{ ($profile->jabatan->id ?? '') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->nama }}</option>
            @endforeach
        </select>
    </div>

    <!-- Jurusan -->
<div>
    <label for="jurusan" class="block mb-1 font-semibold text-xs">Jurusan</label>
    <select id="jurusan" name="jurusan_id" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required>
        <option value="">Pilih Jurusan</option>
        @foreach($jurusanList as $jurusan)
            <option value="{{ $jurusan->id }}"
                {{ optional(optional(optional($profile)->program_studi)->jurusan)->id == $jurusan->id ? 'selected' : '' }}>
                {{ $jurusan->nama }}
            </option>
        @endforeach
    </select>
</div>

<!-- Program Studi -->
<div>
    <label for="program_studi" class="block mb-1 font-semibold text-xs">Program Studi</label>
    <select id="program_studi" name="program_studi_id" class="w-full rounded-md px-3 py-2 text-[#0F5B4F] font-medium" required>
        <option value="">Pilih Program Studi</option>
        @foreach($programStudiList as $program)
            <option value="{{ $program->id }}"
                data-jurusan="{{ $program->jurusan_id }}"
                {{ optional($profile->program_studi)->id == $program->id ? 'selected' : '' }}>
                {{ $program->nama }}
            </option>
        @endforeach
    </select>
</div>



    <!-- Buttons -->
    <div class="flex justify-end gap-4">
        <a href="{{ url()->previous() }}" class="bg-gray-300 text-[#0F5B4F] font-semibold px-6 py-2 rounded hover:bg-gray-400 transition">
            Cancel
        </a>
        <button type="submit" class="bg-[#00B388] text-white font-semibold px-6 py-2 rounded hover:bg-[#00996f] transition">
            Save
        </button>
    </div>
</form>

  </main>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const jurusanSelect = document.getElementById('jurusan');
        const programStudiSelect = document.getElementById('program_studi');

        // Simpan semua opsi program studi
        const allProgramOptions = Array.from(programStudiSelect.querySelectorAll('option'))
            .filter(option => option.value !== ""); // Buang opsi placeholder

        jurusanSelect.addEventListener('change', function () {
            const selectedJurusanId = this.value;

            // Hapus semua opsi sekarang
            programStudiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';

            // Filter berdasarkan jurusan_id
            allProgramOptions.forEach(option => {
                if (option.getAttribute('data-jurusan') === selectedJurusanId) {
                    programStudiSelect.appendChild(option);
                }
            });
        });

        // Trigger sekali saat awal jika ada jurusan yang sudah selected
        jurusanSelect.dispatchEvent(new Event('change'));
    });


document.getElementById('avatar').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('avatarPreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" class="object-cover w-full h-full rounded-full" alt="Avatar Preview">`;
        };
        reader.readAsDataURL(file);
    }
});
    </script>

 </body>
</html>
