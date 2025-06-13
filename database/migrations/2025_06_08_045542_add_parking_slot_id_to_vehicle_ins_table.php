<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicle_ins', function (Blueprint $table) {
            $table->unsignedBigInteger('parking_slot_id')->nullable()->after('vehicle_id');
            $table->foreign('parking_slot_id')->references('id')->on('parking_slots')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicle_ins', function (Blueprint $table) {
            $table->dropForeign(['parking_slot_id']);
            $table->dropColumn('parking_slot_id');
        });
    }
};
