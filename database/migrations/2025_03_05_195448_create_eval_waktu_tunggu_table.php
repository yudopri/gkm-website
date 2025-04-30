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
        Schema::create('eval_waktu_tunggu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('tahun')->nullable();
            $table->string('masa_studi')->nullable();
            $table->integer('jumlah_lulusan')->default(0);
            $table->integer('jumlah_lulusan_terlacak')->default(0);
            $table->integer('jumlah_lulusan_terlacak_dipesan')->default(0);
            $table->integer('jumlah_lulusan_waktu_tiga_bulan')->default(0);
            $table->integer('jumlah_lulusan_waktu_enam_bulan')->default(0);
            $table->integer('jumlah_lulusan_waktu_sembilan_bulan')->default(0);
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
        Schema::dropIfExists('eval_waktu_tunggu');
    }
};
