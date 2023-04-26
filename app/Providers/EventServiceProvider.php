<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $this->logUser($event->user);
            $this->setYear();
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }

    private function logUser($user)
    {
        try {
            DB::table('userlogs')->insert([
                'user_id' => $user->id,
                'ip' => request()->ip(),
            ]);
        } catch (QueryException $e) {
            Log::info("User log ERROR: {$e->getMessage()}");
        }
    }

    private function setYear()
    {
        if (!session('APP')) {
            session([
                'APP.YEAR' => date('Y'),
                'APP.PERIOD' => 'month',
            ]);
        }
    }
}
