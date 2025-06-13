<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Truncate existing data
        DB::table('parking_slots')->truncate();

        // Insert new default slots for Area A (20 slots)
        $slots = [];
        for ($i = 1; $i <= 20; $i++) {
            $slots[] = [
                'area_name' => 'A',
                'slot_number' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('parking_slots')->insert($slots);
    }

    public function down()
    {
        // Clear all slots
        DB::table('parking_slots')->truncate();
    }
};
