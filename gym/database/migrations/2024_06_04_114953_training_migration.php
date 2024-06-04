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
        Schema::create('training', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->integer('duration');
            $table->unsignedBigInteger('id_trainer')->nullable();
            $table->unsignedBigInteger('id_room')->nullable();
            $table->integer('capacity');
            $table->json('participants')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Training');
    }
};
