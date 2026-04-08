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
        Schema::create('aspirasis', function (Blueprint $table) {
            // 1. Primary Key: Menggunakan id() agar otomatis Auto Increment
            $table->id(); 

            // 2. Foreign Key NIS: Harus cocok dengan tipe data di tabel siswas (biasanya Integer)
            $table->integer('nis');

            // 3. Foreign Key Kategori: Gunakan foreignId agar cocok dengan id() milik tabel kategoris
            // Ini akan otomatis membuat tipe data BIGINT UNSIGNED
            $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori')->onDelete('cascade');

            $table->string('lokasi', 50);
            $table->string('ket', 50);
            
            // 4. Tambahkan kolom foto (berdasarkan struktur ukk.sql kamu sebelumnya)
            $table->string('foto')->nullable(); 
            
            $table->timestamps();

            // 5. Foreign Key untuk NIS
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};