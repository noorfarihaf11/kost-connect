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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');
            $table->unsignedBigInteger('id_reservation');
            $table->foreign('id_reservation')->references('id_reservation')->on('reservations');
            $table->unsignedBigInteger('id_transaction')->nullable();
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('proof_of_payment')->nullable(); 
            $table->integer('total_amount')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
