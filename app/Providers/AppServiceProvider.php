<?php

namespace App\Providers;

use App\Models\Userlog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // log all queries when in not in production
        if (! app()->isProduction()) {
            DB::listen(function ($query) {
                logger(Str::replaceArray('?', $query->bindings, $query->sql));
            });
        }

        // log all N+1 queries
        Model::preventLazyLoading();

        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            Log::warning("N+1 Query detected.\r\n" . sprintf('N+1 Query detected in model %s on relation %s.', get_class($model), $relation));
        });

        Gate::define('developer', function ($user) {
            return $user->is_developer;
        });

        Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $this->setYear();

            $this->logUser($event->user);
        });
    }

    private function setYear()
    {
        if (! session('APP')) {
            session([
                'APP.YEAR' => date('Y'),
                'APP.PERIOD' => 'week',
            ]);
        }
    }

    private function logUser($user)
    {
        try {
            if ($position = Location::get()) {
                $country_name = $position->countryName;
                $country_code = $position->countryCode;
            } else {
                $country_name = null;
                $country_code = null;
            }

            Userlog::create([
                'user_id' => $user->id,
                'country_name' => $country_name,
                'country_code' => $country_code,
            ]);
        } catch (QueryException $e) {
            Log::info("User log ERROR: {$e->getMessage()}");
        }
    }
}
