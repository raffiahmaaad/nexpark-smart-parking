<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingSlot extends Model
{
    protected $fillable = [
        'area_name',
        'slot_number',
        'status',
        'vehicle_in_id'
    ];

    protected $casts = [
        'status' => 'string'
    ];

    /**
     * Get the vehicle_in record associated with the parking slot.
     */
    public function vehicle_in(): BelongsTo
    {
        return $this->belongsTo(VehicleIn::class, 'vehicle_in_id');
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isBooked(): bool
    {
        return $this->status === 'booked';
    }

    public function isOccupied(): bool
    {
        return $this->status === 'occupied';
    }
}
