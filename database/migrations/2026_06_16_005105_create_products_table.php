<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('merek')->nullable();
            $table->enum('kategori', ['cleanser','toner','serum','moisturizer','sunscreen','spot_treatment','mask','lainnya']);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2)->nullable();
            $table->string('foto')->nullable();
            $table->json('jenis_jerawat')->nullable(); // ['papula','pustula','komedo','nodul']
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('products'); }
};