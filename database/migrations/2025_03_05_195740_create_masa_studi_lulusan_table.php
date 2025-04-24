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
        Schema::create('masa_studi_lulusan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('tahun')->nullable();
            $table->string('masa_studi')->nullable();
            $table->integer('jumlah_mhs_diterima')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_1')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_2')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_3')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_4')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_5')->default(0);
            $table->integer('jumlah_mhs_lulus_akhir_ts_6')->default(0);
            $table->integer('jumlah_lulusan')->default(0);
            $table->integer('mean_masa_studi')->default(0);
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
        Schema::dropIfExists('masa_studi_lulusan');
    }
};
