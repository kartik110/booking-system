<?php
namespace App\Interfaces;

interface BookingRepositoryInterface
{
    public function createBooking(array $data);
    public function checkAvailability(array $data);
}