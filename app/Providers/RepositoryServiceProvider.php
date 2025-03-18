<?php
namespace App\Providers;

use App\Interfaces\BookingRepositoryInterface;
use App\Repositories\BookingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BookingRepositoryInterface::class, 
            BookingRepository::class
        );
    }
}