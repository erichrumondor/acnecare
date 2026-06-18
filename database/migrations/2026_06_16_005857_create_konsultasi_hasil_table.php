<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('konsultasi_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('hasil', ['komedo_hitam','komedo_putih','papula','pustula','nodul','tidak_terdeteksi']);
            $table->json('jawaban')->nullable(); // simpan semua jawaban user
            $table->enum('keparahan', ['ringan','sedang','berat'])->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('konsultasi_hasil'); }
};