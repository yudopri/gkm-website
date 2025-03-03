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
        Schema::create('rekognisi_dtps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('nama_dosen');
            $table->string('bidang_keahlian')->nullable();
            $table->string('nama_rekognisi')->nullable();
            $table->string('bukti_pendukung')->nullable();
            $table->integer('tingkat')->nullable();
            $table->date('tahun')->nullable();

            /* foreign_keys */
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
        Schema::dropIfExists('rekognisi_dtps');
    }
};
