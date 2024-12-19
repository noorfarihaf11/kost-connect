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
            $table->string('order_id')->nullable();
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'waiting_for_confirmation', 'paid', 'failed'])->default('pending');
            $table->date('payment_period')->nullable(); 
            $table->integer('total_amount')->nullable(); 
            $table->date('payment_due_date')->nullable(); // Menambahkan batas pembayaran
            $table->enum('payment_type', ['first_payment', 'monthly_payment']);
            $table->string('snap_token')->nullable();
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
