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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            // Внешний ключ, связывающий главу с книгой
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('title'); // Название главы
            $table->string('slug')->unique(); // Slug для URL главы (уникальный для всех глав)
            $table->longText('content'); // Содержимое главы (HTML после конвертации из Markdown)
            $table->integer('order'); // Порядковый номер главы в книге (для сортировки)
            $table->boolean('is_hidden')->default(false); // Флаг для скрытого контента, если нужно
            $table->timestamps(); // created_at и updated_at

            // Добавление уникального индекса для связки book_id и slug
            // Это гарантирует, что в одной книге не будет двух глав с одинаковым slug
            $table->unique(['book_id', 'slug']);
            // Добавление уникального индекса для связки book_id и order
            // Это гарантирует, что в одной книге не будет двух глав с одинаковым порядковым номером
            $table->unique(['book_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
