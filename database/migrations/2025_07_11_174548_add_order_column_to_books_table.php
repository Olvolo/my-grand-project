<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('order_column')->default(0)->after('is_hidden');
        });
    }
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('order_column');
        });
    }
};
