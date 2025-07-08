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
        Schema::create('book_author', function (Blueprint $table) {
            // Внешний ключ для связи с книгами
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            // Внешний ключ для связи с авторами
            $table->foreignId('author_id')->constrained()->onDelete('cascade');

            // Уникальный составной ключ, чтобы избежать дублирования связей
            $table->primary(['book_id', 'author_id']);
            // $table->timestamps(); // Можно добавить, если нужно отслеживать время связи
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_author');
    }
};
