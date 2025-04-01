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
        Schema::create('notific_cat_trans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_category_id')->constrained('notification_categories')->cascadeOnDelete();
            $table->string('lang');
            $table->string('name');
            $table->mediumText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notific_cat_trans');
    }
};
