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
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->enum('payment_method', ['down_payment', 'full_payment'])->nullable(); 
            $table->string('payment_status')->nulllable();
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
