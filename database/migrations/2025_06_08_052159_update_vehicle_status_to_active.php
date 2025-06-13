<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Vehicle; // Import the Vehicle model

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update all existing vehicles to status 1 (Active)
        Vehicle::where('status', 0)->update(['status' => 1]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally, you can revert the status back to 0 if needed
        // Vehicle::where('status', 1)->update(['status' => 0]);
    }
};
