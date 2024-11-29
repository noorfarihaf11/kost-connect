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
            $table->unsignedBigInteger('id_payment')->nullable();
            $table->foreign('id_payment')->references('id_payment')->on('payments');
            $table->string('name'); 
            $table->string('email'); 
            $table->string('phone_number'); 
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->enum('customer_status', ['active', 'inactive'])->default('inactive');
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
