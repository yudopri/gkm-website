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
        Schema::create('kepuasan_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('aspek_penilaian');
            $table->integer('tingkat_kepuasan_sangat_baik')->default(0);
            $table->integer('tingkat_kepuasan_baik')->default(0);
            $table->integer('tingkat_kepuasan_cukup')->default(0);
            $table->integer('tingkat_kepuasan_kurang')->default(0);
            $table->text('rencana_tindakan')->nullable();
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
        Schema::dropIfExists('kepuasan_mahasiswa');
    }
};
