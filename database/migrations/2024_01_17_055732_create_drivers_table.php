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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('location')->nullable();
            $table->string('vehicle_model');
            $table->string('vehicle_type');
            $table->string('vehicle_plate_number');
            $table->string('vehicle_color');
            $table->integer('profile_status')->default(PENDING);
            $table->integer('driver_status')->default(AVAILABLE);
            $table->integer('seats');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
