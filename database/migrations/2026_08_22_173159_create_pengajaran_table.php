<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajaran', function (Blueprint $table) {

            $table->id();

            // Dosen
            $table->foreignId('lecturer_id')
                ->constrained('lecturer')
                ->cascadeOnDelete();

            // Mata kuliah
            $table->string('kode_mk', 20);

            $table->foreign('kode_mk')
                ->references('kode_mk')
                ->on('matakuliah')
                ->cascadeOnDelete();

            $table->timestamps();

            // Satu dosen tidak boleh
            // mendapatkan MK yang sama dua kali
            $table->unique([
                'lecturer_id',
                'kode_mk',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajaran');
    }
};