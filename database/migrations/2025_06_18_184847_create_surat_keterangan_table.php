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
        Schema::create('surat_keterangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('file_upload')->nullable(); // File upload surat keterangan
            $table->enum('status_verifikasi', ['pending', 'diterima', 'ditolak'])->default('pending'); // Status verifikasi surat keterangan
            $table->string('keterangan')->nullable(); // Keterangan tambahan untuk surat keterangan
            $table->string('keterangan_warga')->nullable(); // Keterangan tambahan untuk warga
            $table->string('kategori')->nullable(); // Kategori surat keterangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keterangan');
    }
};
