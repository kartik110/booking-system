<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BookingRepositoryInterface;
use App\Repositories\BookingRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
