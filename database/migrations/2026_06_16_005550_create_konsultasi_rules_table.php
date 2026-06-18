<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('konsultasi_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_pertanyaan');
            $table->text('pertanyaan');
            $table->string('jawaban_ya')->nullable();  // kode gejala
            $table->string('jawaban_tidak')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('konsultasi_rules'); }
};