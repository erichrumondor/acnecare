<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nama_produk'); // backup kalau produk dihapus
            $table->enum('waktu_pakai', ['pagi','malam','pagi_malam']);
            $table->string('frekuensi')->nullable(); // "2x sehari", "3x seminggu"
            $table->date('mulai_pakai');
            $table->date('selesai_pakai')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('treatments'); }
};