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
        Schema::table('users', function (Blueprint $table) {
            // Добавляем булеву колонку 'is_admin' со значением по умолчанию 'false'
            // Помещаем ее после колонки 'name' для порядка
            $table->boolean('is_admin')->default(false)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Указываем, как удалить эту колонку, если мы захотим отменить миграцию
            $table->dropColumn('is_admin');
        });
    }
};
