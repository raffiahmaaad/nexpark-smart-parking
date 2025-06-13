<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_in_id', 'duration', 'total_fee'];

    public function vehicleIn()
    {
        return $this->belongsTo(VehicleIn::class);
    }
}
