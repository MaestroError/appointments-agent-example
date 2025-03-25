<?php

namespace App\Models;

use App\Enums\SlotStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Service;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'day',
        'start_time',
        'status',
        'customer_name',
        'customer_email'
    ];

    protected $casts = [
        'day' => 'date',
        'start_time' => 'datetime',
        'status' => SlotStatus::class
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', SlotStatus::Available);
    }

    public function scopeBooked($query)
    {
        return $query->where('status', SlotStatus::Booked);
    }
}
