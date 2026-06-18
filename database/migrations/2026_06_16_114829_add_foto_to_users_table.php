<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('email');
            $table->string('tipe_kulit')->nullable()->after('foto');
            $table->text('alergi')->nullable()->after('tipe_kulit');
        });
    }
    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['foto', 'tipe_kulit', 'alergi']);
        });
    }
};