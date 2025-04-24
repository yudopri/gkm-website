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
        Schema::create('kurikulum_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_mata_kuliah');
            $table->string('kode_mata_kuliah');
            $table->boolean('mata_kuliah_kompetensi')->nullable();
            $table->integer('sks_kuliah')->nullable();
            $table->integer('sks_seminar')->nullable();
            $table->integer('sks_praktikum')->nullable();
            $table->integer('konversi_sks')->nullable();
            $table->integer('semester')->nullable();
            $table->string('metode_pembelajaran')->nullable();
            $table->string('dokumen')->nullable();
            $table->string('unit_penyelenggara')->nullable();
            $table->boolean('capaian_kuliah_sikap')->nullable();
            $table->boolean('capaian_kuliah_pengetahuan')->nullable();
            $table->boolean('capaian_kuliah_keterampilan_umum')->nullable();
            $table->boolean('capaian_kuliah_keterampilan_khusus')->nullable();
            $table->string('tahun')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulum_pembelajaran');
    }
};
