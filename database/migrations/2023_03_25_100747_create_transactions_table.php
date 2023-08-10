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
            $table->id();
            $table->integer('order_id');
            $table->integer('paid_amount');
            $table->integer('balance');
            $table->string('payment_method')->default('cash');
            $table->integer('user_id');
            $table->integer('transac_amount');
            $table->date('transac_date')->nullable();
            $table->decimal('payment_type', 10, 2)->nullable();
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
