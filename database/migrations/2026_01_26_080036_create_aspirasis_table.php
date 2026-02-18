<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->string('kategori_pengaduan');
            $table->text('detail_pengaduan');
            $table->string('foto_sarana')->nullable();
            $table->enum('status', ['Pending', 'Diproses', 'Selesai'])->default('Pending');
            $table->text('umpan_balik')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};