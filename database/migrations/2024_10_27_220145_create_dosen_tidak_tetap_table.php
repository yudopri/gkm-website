<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dosen_tidak_tetap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();

            $table->string('nama_dosen');
            $table->string('nidn_nidk')->nullable();
            $table->string('pendidikan_pascasarjana')->nullable();
            $table->string('bidang_keahlian')->nullable();
            $table->string('jabatan_akademik')->nullable();
            $table->text('sertifikat_pendidik')->nullable();
            $table->text('sertifikat_kompetensi')->nullable();
            $table->text('mk_diampu')->nullable();
            $table->boolean('kesesuaian_keahlian_mk')->nullable()->default(0);

            /* foreign_keys */
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran_semester')->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_tidak_tetap');
    }
};
