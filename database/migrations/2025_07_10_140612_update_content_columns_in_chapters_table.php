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
        Schema::table('chapters', function (Blueprint $table) {
            // 1. Переименовываем существующую колонку 'content'
            $table->renameColumn('content', 'content_html');

            // 2. Добавляем новую колонку для хранения исходного Markdown
            $table->text('content_markdown')->nullable()->after('content_html');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            // Определяем обратные действия для отката миграции
            $table->dropColumn('content_markdown');
            $table->renameColumn('content_html', 'content');
        });
    }
};
