<?php
namespace App\Repositories;

use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use Carbon\Carbon;

class BookingRepository implements BookingRepositoryInterface
{
    public function createBooking(array $data)
    {
        return Booking::create($data);
    }

    public function checkAvailability(array $data)
    {
        $date = Carbon::parse($data['booking_date']);
        
        return Booking::where('booking_date', $date)
            ->where(function ($query) use ($data) {
                // Check for full day conflicts
                $query->where('type', 'full_day')
                    ->orWhere(function ($q) use ($data) {
                        if ($data['type'] === 'full_day') {
                            $q->whereNotNull('id'); // Block all if new is full_day
                        } elseif ($data['type'] === 'half_day') {
                            $q->where('type', 'half_day')
                                ->orWhere('type', 'custom');
                        } else {
                            $q->where('type', 'custom')
                                ->where(function ($qc) use ($data) {
                                    $qc->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                                        ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']]);
                                });
                        }
                    });
            })
            ->exists();
    }
}