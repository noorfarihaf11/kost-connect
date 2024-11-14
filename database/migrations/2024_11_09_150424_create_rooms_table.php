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
            $table->string('name_room');
            $table->string('room_type');
            $table->integer('square_feet');
            $table->integer('price_per_month');
            $table->boolean('is_available');
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
