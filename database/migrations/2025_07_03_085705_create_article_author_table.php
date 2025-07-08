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
        Schema::create('article_author', function (Blueprint $table) {
            // Внешний ключ для связи со статьями
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            // Внешний ключ для связи с авторами
            $table->foreignId('author_id')->constrained()->onDelete('cascade');

            // Уникальный составной ключ, чтобы избежать дублирования связей
            $table->primary(['article_id', 'author_id']);
            // created_at и updated_at для промежуточных таблиц обычно не нужны,
            // но если вам нужно знать, когда именно была установлена связь, можно добавить:
            // $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_author');
    }
};
