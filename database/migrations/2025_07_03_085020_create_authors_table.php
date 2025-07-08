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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Имя автора, должно быть уникальным
            $table->string('slug')->unique(); // Slug для URL, тоже уникальный
            $table->text('bio')->nullable(); // Биография автора (Markdown), может быть пустой
            $table->string('photo')->nullable(); // Путь к фотографии автора, может быть пустым
            $table->boolean('is_teacher')->default(false); // Флаг для Учителя (Бидия Дандарон)
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
