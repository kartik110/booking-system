<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:full_day,half_day,custom',
            'slot' => 'required_if:type,half_day|nullable|in:first_half,second_half',
            'start_time' => 'required_if:type,custom|nullable|date_format:H:i',
            'end_time' => 'required_if:type,custom|nullable|date_format:H:i|after:start_time',
        ];
    }
}