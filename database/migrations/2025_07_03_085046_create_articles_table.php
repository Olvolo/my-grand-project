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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // Заголовок статьи, уникальный
            $table->string('slug')->unique(); // Slug для URL статьи, уникальный
            $table->longText('content'); // Содержимое статьи (HTML после конвертации из Markdown)
            $table->timestamp('published_at')->nullable(); // Дата публикации статьи
            $table->boolean('is_hidden')->default(false); // Флаг для скрытого контента
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
