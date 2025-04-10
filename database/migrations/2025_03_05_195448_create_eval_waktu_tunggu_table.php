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
            $table->string('tahun', 4)->nullable();
            $table->integer('jumlah_lulusan');
            $table->integer('jumlah_lulusan_terlacak');
            $table->integer('jumlah_lulusan_terlacak_dipesan');
            $table->double('jumlah_lulusan_waktu');
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
