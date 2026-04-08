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
        Schema::create('siswas', function (Blueprint $table) {
    $table->integer('nis')->primary(); // Tetap Primary Key
    $table->string('username', 50)->unique(); // Tambahkan username unik
    $table->string('password'); // Tambahkan password
    $table->string('kelas', 10);
    $table->timestamps();
});
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
