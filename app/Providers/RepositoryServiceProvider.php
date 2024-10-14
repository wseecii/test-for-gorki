<?php

namespace App\Providers;

use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }
}
