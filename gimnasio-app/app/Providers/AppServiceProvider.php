<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

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
        if ($this->app->environment('production') || env('FORCE_HTTPS', false)) {
            $appUrl = env('APP_URL', config('app.url'));

            if ($appUrl) {
                URL::forceRootUrl($appUrl);
            }

            URL::forceScheme('https');
            SymfonyRequest::setTrustedProxies(['0.0.0.0/0', '::/0'], SymfonyRequest::HEADER_X_FORWARDED_ALL);
        }
    }
}
