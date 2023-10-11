<?php

namespace App\Providers;

use Illuminate\Auth\Events as AuthEvents;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events;
use App\Listeners;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        AuthEvents\Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AuthEvents\Login::class => [
            Listeners\LogActivity::class.'@login',
        ],
        Events\CreatingFactory::class => [
            Listeners\FactoryListeners::class.'@create'
        ],
        Events\UpdatingFactory::class => [
            Listeners\FactoryListeners::class.'@update'
        ],
        Events\DeletingFactory::class => [
            Listeners\FactoryListeners::class.'@delete'
        ],
        Events\CreatingEmployee::class => [
            Listeners\EmployeeListener::class.'@create'
        ],
        Events\UpdatingEmployee::class => [
            Listeners\EmployeeListener::class.'@update'
        ],
        Events\DeletingEmployee::class => [
            Listeners\EmployeeListener::class.'@delete'
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
