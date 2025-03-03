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
        Schema::create('seleksi_mahasiswa_baru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();

            $table->string('tahun_akademik')->nullable();
            $table->integer('daya_tampung')->nullable();
            $table->integer('pendaftar')->nullable();
            $table->integer('lulus_seleksi')->nullable();
            $table->integer('maba_reguler')->nullable();
            $table->integer('maba_transfer')->nullable();
            $table->integer('mhs_aktif_reguler')->nullable();
            $table->integer('mhs_aktif_transfer')->nullable();

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
        Schema::dropIfExists('seleksi_mahasiswa_baru');
    }
};
