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
        Schema::create('menu_users', function (Blueprint $table) {
            $table->id('no_seting')->primary();
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_menu');
            $table->boolean('checked')->nullable();
            $table->foreign('id_role')->references('id_role')->on('roles');
            $table->foreign('id_menu')->references('id_menu')->on('menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_users');
    }
};
