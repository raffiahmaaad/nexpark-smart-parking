<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('parking_slots', function (Blueprint $table) {
            $table->id();
            $table->string('area_name');
            $table->string('slot_number');
            $table->enum('status', ['available', 'booked', 'occupied'])->default('available');
            $table->foreignId('vehicle_in_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_slots');
    }
};
