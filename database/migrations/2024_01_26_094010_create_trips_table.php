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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('vehicle_color');
            $table->string('vehicle_model');
            $table->string('passenger_name');
            $table->string('passenger_contact');
            $table->unsignedBigInteger('passenger_id');
            $table->string('driver_contact');
            $table->unsignedBigInteger('driver_id');
            $table->string('driver_name');
            $table->string('comment');
            $table->decimal('distance', 10, 2);
            $table->decimal('total_fare', 10, 2);
            $table->string('status');
            $table->string('payment_status');
            $table->integer('rating')->nullable();
            $table->timestamps();

            $table->foreign('vehicle_id')->references('id')->on('vehicle_documents');
            $table->foreign('passenger_id')->references('id')->on('users');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
