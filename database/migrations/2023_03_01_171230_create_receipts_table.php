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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
           /* $table->foreignId('customer_Id')->constrained('customers')->nullable();
           $table->foreignId('staff_Id')->constrained('staff')->nullable();
            
            $table->integer('customer_phone')->nullable();
            */
            $table->integer('order_id');
            $table->integer('product_id'); 
            $table->decimal('discount', 10, 2)->nullable();
            $table->integer('quantity');
            $table->decimal('unitprice', 10, 2)->nullable(); //total of a product (price - discount)
            $table->decimal('amount', 10, 2)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
