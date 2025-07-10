<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Переименовываем старую колонку
            $table->renameColumn('content', 'content_html');
            // Добавляем новую колонку для исходного Markdown
            $table->text('content_markdown')->nullable()->after('content_html');
        });
    }
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('content_markdown');
            $table->renameColumn('content_html', 'content');
        });
    }
};
