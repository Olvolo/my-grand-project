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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique(); // Название книги, должно быть уникальным
            $table->string('slug')->unique(); // Slug для URL книги
            $table->text('description')->nullable(); // Аннотация или краткое описание книги (Markdown)
            $table->string('cover_image')->nullable(); // Путь к файлу обложки книги
            $table->string('publication_year')->nullable(); // Год публикации (можно строкой, если есть "конец 90-х")
            $table->string('language')->default('ru'); // Язык книги, по умолчанию "ru"
            $table->string('publisher')->nullable(); // Издательство
            $table->boolean('is_hidden')->default(false); // Флаг для скрытого контента
            $table->timestamps(); // created_at и updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
