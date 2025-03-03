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
        Schema::create('ewmp_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();

            $table->string('nama_dosen');
            $table->boolean('is_dtps')->default(0);
            $table->decimal('ps_diakreditasi')->nullable();
            $table->decimal('ps_lain_dalam_pt')->nullable();
            $table->decimal('ps_lain_luar_pt')->nullable();
            $table->decimal('penelitian')->nullable();
            $table->decimal('pkm')->nullable();
            $table->decimal('tugas_tambahan')->nullable();
            $table->decimal('jumlah_sks')->nullable();
            $table->decimal('avg_per_semester')->nullable();

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
        Schema::dropIfExists('ewmp_dosen');
    }
};
