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
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('locale', 5)->nullable()->after('id');
            $table->string('slug')->after('title');
            $table->unique(['slug', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropUnique(['slug', 'locale']);  // Удаляем индекс
            $table->dropColumn(['locale', 'slug']); // Удаляем колонки
        });
    }
};
