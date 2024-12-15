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
            $table->unsignedBigInteger('id_owner')->nullable();
            $table->foreign('id_owner')->references('id_owner')->on('owners');
            $table->unsignedBigInteger('id_city')->nullable();
            $table->foreign('id_city')->references('id_city')->on('cities');
            $table->string('name');
            $table->string('address');
            $table->enum('gender_type', ['putra', 'putri','campur']);
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boarding_houses');
    }
};
