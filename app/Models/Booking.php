<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_code',
        'customer_id',
        'vehicle_id',
        'parking_area',
        'parking_slot',
        'start_time',
        'duration',
        'total_price',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    /**
     * Get the customer associated with the booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Get the vehicle associated with the booking.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Generate a unique booking code.
     */
    public static function generateBookingCode()
    {
        $prefix = 'BK';
        $date = now()->format('ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return $prefix . $date . $random;
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include confirmed bookings.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
