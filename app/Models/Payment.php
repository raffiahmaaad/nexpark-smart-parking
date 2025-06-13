<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_in_id',
        'amount',
        'payment_method',
        'proof_image',
        'status',
        'notes',
        'confirmed_at',
        'confirmed_by',
        'rejected_at',
        'rejected_by'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'rejected_at' => 'datetime'
    ];

    public function vehicleIn()
    {
        return $this->belongsTo(VehicleIn::class);
    }

    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}
