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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('id_testimoni')->primary;
<<<<<<< HEAD
            $table->unsignedBigInteger('id_room')->nullable();
            $table->foreign('id_room')->references('id_room')->on('rooms');
=======
            $table->unsignedBigInteger('id_house')->nullable();
            $table->foreign('id_house')->references('id_house')->on('boarding_houses');
>>>>>>> eed4b87 (first commit)
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->string('photo');
            $table->string('content');
            $table->integer('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
