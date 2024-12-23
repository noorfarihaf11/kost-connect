<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('room_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('rating'); // Rating (1-5) tanpa nullable
            $table->text('review')->nullable(); // Review pengguna
            $table->timestamps();
            $table->unsignedBigInteger('id_room');
            $table->foreign('id_room')->references('id_room')->on('rooms');
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id_customer')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reviews');
    }
};

