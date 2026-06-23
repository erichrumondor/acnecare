<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skin_journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->tinyInteger('rating')->default(3); // 1-5
            $table->string('kondisi')->nullable();     // membaik, stabil, memburuk
            $table->text('catatan')->nullable();
            $table->string('foto')->nullable();        // path foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skin_journals');
    }
};