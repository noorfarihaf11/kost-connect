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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('id_room')->primary;
            $table->unsignedBigInteger('id_house')->nullable();
            $table->foreign('id_house')->references('id_house')->on('boarding_houses');
            $table->string('name');
            $table->string('image')->nullable();
            $table->text('description');
            $table->integer('price_per_month');
            $table->integer('square_feet');
            $table->boolean('is_available')->nullable();
            $table->integer('available_rooms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
