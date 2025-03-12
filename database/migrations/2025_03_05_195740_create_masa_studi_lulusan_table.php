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
            $table->string('tahun', 4)->nullable();
            $table->integer('jumlah_mhs_diterima');
            $table->integer('jumlah_mhs_lulus');
            $table->integer('jumlah_lulusan');
            $table->double('mean_masa_studi');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
