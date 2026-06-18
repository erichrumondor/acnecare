<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // admin
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('foto')->nullable();
            $table->enum('kategori', ['edukasi','tips','mitos_fakta','produk','lainnya']);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('articles'); }
};