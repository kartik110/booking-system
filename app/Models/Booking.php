<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $dates = ['booking_date', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Add accessors for formatted values
    public function getTypeAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }

    public function getSlotAttribute($value)
    {
        return $value ? ucfirst(str_replace('_', ' ', $value)) : null;
    }


    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'booking_date',
        'booking_type',
        'booking_slot',
        'booking_from',
        'type',
        'booking_to',
    ];
}
