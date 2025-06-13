<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'google_id',
        'avatar',
        'address',
        'phone',
        'company',
        'created_by'
    ];

    protected $hidden = [
        'google_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->created_by)) {
                $customer->created_by = null; // Set null jika tidak ada created_by
            }
        });
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function vehicleIns(): HasMany
    {
        return $this->hasMany(VehicleIn::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }
}
