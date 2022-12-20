<?php

namespace App\Providers;

use App\Services\EquipmentService\Repositories\EquipmentRepository;
use App\Services\EquipmentService\Repositories\EquipmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EquipmentRepositoryInterface::class, EquipmentRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
