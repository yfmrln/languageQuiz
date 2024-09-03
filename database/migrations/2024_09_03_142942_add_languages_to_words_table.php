<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->string('Dutch')->nullable(); // オランダ語
            $table->string('Japanese_hiragana')->nullable(); // 日本語ひらがな
            $table->string('Japanese_romaji')->nullable(); // 日本語ローマ字
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('words', function (Blueprint $table) {
            $table->dropColumn('Dutch');
            $table->dropColumn('Japanese_hiragana');
            $table->dropColumn('Japanese_romaji');
        });
    }
};
