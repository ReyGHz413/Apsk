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
        Schema::create('tanggapans', function (Blueprint $table) {
            // 1. Gunakan id() agar otomatis Auto Increment & Big Integer Unsigned
            $table->id('id_tanggapan'); 

            // 2. Gunakan foreignId agar tipe datanya (Big Integer Unsigned) 
            // cocok dengan aspirasis.id dan kategoris.id_kategori
            $table->foreignId('id_aspirasi')->constrained('aspirasis')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori')->onDelete('cascade');

            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->string('feedback', 200); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};