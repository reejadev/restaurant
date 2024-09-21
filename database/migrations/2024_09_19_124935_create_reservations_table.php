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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('schedule_id')->constrained();
            $table->string("Name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("guest")->nullable();
            $table->string("date")->nullable();
            $table->string("time")->nullable();
            $table->string("message")->nullable();
            $table->decimal('cost', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};