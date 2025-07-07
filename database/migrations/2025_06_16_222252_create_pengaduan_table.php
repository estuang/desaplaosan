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

    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);                       // Nama pengadu
            $table->string('judul', 150);                      // Judul pengaduan
            $table->text('isi');                               // Isi pengaduan
            $table->enum('status', ['menunggu', 'diproses', 'disetujui' , 'ditolak'])->default('menunggu'); // Status pengaduan
            $table->timestamps();                              // created_at dan updated_at
        });
    }
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
