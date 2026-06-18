<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('forum_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->text('konten');
            $table->enum('topik', ['papula','pustula','komedo','nodul','produk','tips','umum']);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('forum_posts'); }
};