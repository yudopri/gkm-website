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
            $table->string('sks');
            $table->string('semester');
            $table->string('metode_pembelajaran');
            $table->string('dokumen');
            $table->string('unit_penyelengara');
            $table->string('sks_kuliah');
            $table->string('capaian_kuliah');
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
