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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->string('code');
            $table->unsignedBigInteger('id_house');
            $table->foreign('id_house')->references('id_house')->on('boarding_houses');
            $table->unsignedBigInteger('id_room');
            $table->foreign('id_room')->references('id_room')->on('rooms');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phone_number'); 
            $table->enum('payment_method', ['down_payment', 'full_payment'])->nullable(); 
            $table->string('payment_status')->nulllable(); 
            $table->date('start_date'); 
            $table->integer('duration'); 
            $table->integer('total_amount')->nullable(); 
            $table->date('transaction_date')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
