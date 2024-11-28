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
        Schema::create('boarding_houses', function (Blueprint $table) {
            $table->id('id_house')->primary;
            $table->string('name_house');
            $table->string('slug');
            $table->string('thumbnail');
            $table->unsignedBigInteger('id_city')->nullable();
            $table->foreign('id_city')->references('id_city')->on('cities');
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id_category')->on('categories');
            $table->text('description');
            $table->integer('price');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};
