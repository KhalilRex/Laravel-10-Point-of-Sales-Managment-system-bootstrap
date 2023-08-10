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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('PhoneNumber');
            $table->string('Email')->unique();
            //$table->string('Type');
            $table->tinyInteger('is_admin')->default(2);
            $table->string('Password');
            $table->string('Country')->nullable();
            $table->string('Address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
