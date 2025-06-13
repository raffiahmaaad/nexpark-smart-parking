<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingSlot;

class ParkingSlotSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama
        ParkingSlot::truncate();

        // Area A (Lantai 1)
        for ($i = 1; $i <= 20; $i++) {
            ParkingSlot::create([
                'area_name' => 'A',
                'slot_number' => 'A-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available'
            ]);
        }

        // Area B (Lantai 2)
        for ($i = 1; $i <= 20; $i++) {
            ParkingSlot::create([
                'area_name' => 'B',
                'slot_number' => 'B-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available'
            ]);
        }

        // Area C (Lantai 3)
        for ($i = 1; $i <= 20; $i++) {
            ParkingSlot::create([
                'area_name' => 'C',
                'slot_number' => 'C-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available'
            ]);
        }
    }
}
