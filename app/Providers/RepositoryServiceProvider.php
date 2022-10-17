<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Contracts\ParticipantRepository::class, \App\Repositories\ParticipantRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\IdentifierRepository::class, \App\Repositories\IdentifierRepositoryEloquent::class);
        $this->app->bind(\App\Services\Contracts\AppointmentService::class, \App\Services\AppointmentServiceEntity::class);
        $this->app->bind(\App\Repositories\Contracts\AppointmentRepository::class, \App\Repositories\AppointmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PerformerRepository::class, \App\Repositories\PerformerRepositoryEloquent::class);
        //:end-bindings:
    }
}
