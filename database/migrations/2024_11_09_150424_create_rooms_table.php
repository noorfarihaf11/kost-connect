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
            $table->unsignedBigInteger('id_city')->nullable();
            $table->foreign('id_city')->references('id_city')->on('cities');
            $table->string('name_room');
            $table->enum('room_type', ['putra', 'putri', 'campur']);
            $table->text('description');
            $table->integer('price_per_month');
            $table->text('address');
            $table->integer('square_feet');
            $table->boolean('is_available');
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
