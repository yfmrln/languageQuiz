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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('English')->nullable();
            $table->string('Spanish')->nullable();
            $table->string('French')->nullable();
            $table->string('German')->nullable();
            $table->string('Japanese')->nullable();
            $table->string('Serbian')->nullable();
            $table->string('Dutch')->nullable(); 
            $table->string('Japanese_hiragana')->nullable();
            $table->string('Japanese_romaji')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('category')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /*   $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); */

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
};
