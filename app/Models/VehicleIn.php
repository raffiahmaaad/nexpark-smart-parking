<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class VehicleIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'vehicle_id',
        'parking_slot_id',
        'customer_id',
        'check_in',
        'duration',
        'status'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'duration' => 'integer'
    ];

    /**
     * Get the vehicle associated with the vehicle in record.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the customer associated with the vehicle in record.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who created the record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(ParkingSlot::class, 'parking_slot_id');
    }

    public function payment()
    {
        return $this->hasOne(\App\Models\Payment::class, 'vehicle_in_id');
    }

    public static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });
    }
}
