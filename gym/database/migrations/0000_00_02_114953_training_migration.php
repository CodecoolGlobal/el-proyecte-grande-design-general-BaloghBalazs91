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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start');
            $table->integer('duration');
            $table->foreignIdFor(\App\Models\User::class, 'trainer_id')->nullable()->constrained('users')->onDelete('set null');    # a training belongs to one trainer
            $table->foreignIdFor(\App\Models\TrainingMethod::class)->nullable();    # a training belongs to one method
            $table->foreignIdFor(\App\Models\Room::class)->nullable();              # a training belongs to one room
            $table->integer('capacity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
