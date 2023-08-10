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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('categories_Id')->constrained('categories')->default(1);
            $table->string('Title');
            $table->string('Description')->nullable();
            $table->string('Image')->nullable();
            $table->decimal('Price', 10, 2);
            $table->decimal('Sale', 10, 2)->nullable(); //quantity
            $table->string('product_code')->nullable();
            $tables->text('barcode')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('product_image')->nullable(); //code
            $table->integer('alert_stock')->default('100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
