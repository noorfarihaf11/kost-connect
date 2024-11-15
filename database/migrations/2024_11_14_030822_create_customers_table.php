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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('id_customer');
            $table->unsignedBigInteger('id_reservation')->nullable();
            $table->foreign('id_reservation')->references('id_reservation')->on('reservations');
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phone_number'); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->string('customer_status')->nulllable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
